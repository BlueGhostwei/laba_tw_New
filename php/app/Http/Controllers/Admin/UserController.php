<?php

namespace App\Http\Controllers\Admin;

use App\Models\AclRole;
use App\Models\AclUser;
use App\Models\News;
use App\Models\Order;
use App\Models\Wealthlog;
use League\Flysystem\Exception;
use Session;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Security;
use Illuminate\Validation\Rules\In;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;
use Validator;
use Redirect;
use Auth;
use Illuminate\Support\Facades\DB;
use Config;
use Input;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;


class UserController extends Controller
{

    /**
     * @return mixed
     * 生成token
     */
    public function Set_token()
    {
        return json_encode(['msg' => '', 'sta' => "0", 'data' => csrf_token()]);
    }

    /**
     * @return mixed
     * 登录页面
     */
    public function getLogin()
    {
        return view('Admin.user.login');

    }

    /**
     * @return mixed
     * 用户请求注册页面
     */
    public function getRegister()
    {
        return view('Admin.user.register');
    }

    public function getResetUsername()
    {
//        dd($this->get_security_question());
//        $this->setStep(1);
//        echo $this->getStep();
        $user = Auth::user();
//        echo $user->username;
        return view('Admin.user.reset_Uname', ['step' => $this->getStep(), 'question' => $this->get_security_question(), 'phone' => $user->username]);
    }


    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     * 验证用户登录 手机号码邮箱登陆
     */
    public function post_login(Request $request)
    {
        $username = trim(Input::get('username'));
        $password = trim(Input::get('user_password'));
        $remember = Input::get('remember', false);
        $field = isEmail($username) ? 'email' : 'username';
        if ($field == 'email') {
            //验证用户
            $set_user = User::where(['user_Eail' => $username, 'deleted_at' => null])->first();
        } else {
            //判断用户手机号码
            if (Controller::isMobile($username) == false) {
                return Redirect::back()->withErrors('请输入正确的手机号码')->withInput();
                //return json_encode(["msg" => "", "sta" => 1, "data" => ""], JSON_UNESCAPED_UNICODE);
            }
            //验证用户
            $set_user = User::where(['username' => $username, 'deleted_at' => null])->first();
        }
        if ($set_user->id == null) {
            return Redirect::back()->withErrors('用户不存在，请注册')->withInput();
        }
        //判断用户状态是否锁定
        if ($set_user->lock == "1") {
            return Redirect::back()->withErrors('该用户已被锁定，请联系客服')->withInput();
        }
        //定义验证验证码规则
        $rules = [
            "user_code" => 'required|captcha'
        ];
        $messages = [
            'user_code.required' => '请输入验证码',
            'user_code.captcha' => '验证码错误，请重试'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors())->withInput();//验证码错误！
        } else {
            //通过验证
            if ($field == 'email') {
                $rst = Auth::attempt(['user_Eail' => $username, 'password' => $password], $remember);
            } else {
                $rst = Auth::attempt(['username' => $username, 'password' => $password], $remember);
            }
            if ($rst == true) {
                return redirect()->intended('/');//登录成功，跳转页面
            } else {
                return Redirect::back()->withErrors('用户名或者密码错误')->withInput();
            }

        }

    }

    /**
     * @return mixed
     * 用户订单列表
     *
     */
    public function order_list()
    {
        $order = Input::get('order');
        if (!empty($order)) {
            //获取缓存、得到订单号
            $order = explode(',', $order);
            $user_order = [];
            foreach ($order as $k => $v) {
                $result = News::where(['id'=> $v,'status'=>'1'])
                    ->select('id', 'title', 'start_time', 'price', 'remark', 'created_at', 'news_type')
                    ->get()->toArray();
                $user_order[$k] = array_first($result);
            }
        } else {
            $user_order = News::where(['user_id'=> Auth::id(),'status'=>'1'])
                ->select('id', 'title', 'start_time', 'price', 'remark', 'created_at', 'news_type')
                ->orderBy('id', 'desc')->get()->toArray();//未支付订单
        }
        $count = count($user_order);
        return view('Admin.user.order_list', ['user_order' => $user_order, 'count' => $count]);
    }

    /**
     *支付页面跳转封装函数最终返回url地址
     */
    public function Jump_page(){
        if(Input::get('to')=='success'){
            return view('Admin.pay.paySuccess');
        }elseif(Input::get('to')=='error'){
            return view('Admin.pay.payFail');
        }else{
            return Redirect()->route('admin.dashboard');
        }
    }
    /**
     * @return mixed
     * 用户订单处理
     * array:4 [
     * "order_id" => "8,7"//订单id
     * "price" => "222"//价格
     * "password" => "123456"//密码
     * "_token" => "jrEtqwTIbKwnnBBKSnjjayD46pOBqMwAT5qJZMph"
     * ]
     */
    public function Settlement()
    {
        $arr = Input::all();
        //取消订单
        if (isset($arr['type']) && $arr['type']=='cancel_order'){
            $order_id=explode(',',$arr['order_id']);
            foreach ($order_id as $k=>$v){
              $price=News::where(['id'=>$v,'user_id'=>Auth::id()])->delete();
            }
            return json_encode(['msg'=>'请求成功','sta'=>'0','data'=>'']);
        }
        //支付订单
        if ($arr) {
            //验证密码
            $pass=$arr['password'];
            if(Hash::check($pass, Auth::user()->password) == false){
                return json_encode(['msg'=>'密码错误，请重新输入','sta'=>'1','data'=>'']);
            }
            //获取订单号
            $arr_p=[];
            $order_id=explode(',',$arr['order_id']);
            foreach ($order_id as $k =>$v){
                $price=News::where(['id'=>$v,'user_id'=>Auth::id()])->select('price','status')->first();
                if($price && $price->status=='2'){//订单已支付
                    return json_encode(['msg'=>'参数错误，请刷新页面重试！','sta'=>'1','data'=>'']);
                }
                if(empty($arr_p)){
                    $arr_p[$k]=$price->price;
                }else{
                    $arr_p=array_first($arr_p)+$price->price;
                }
            }
            //对比价格（对比前端页面传过来的价格，true结算，false反馈）
           if(!empty($arr_p) && array_first($arr_p)==$arr['price']){
               //查询账号余额
               if(Auth::user()->wealth < $arr['price'] ){
                   return json_encode(['msg'=>'账户余额不足，请充值！','sta'=>'1','data'=>'']);
               }
               //扣除金额
               //修改订单状态
               //事务处理
               DB::transaction(function() use($arr,$order_id){
                   $wealth=Auth::user()->wealth - $arr['price'];
                   User::where('id',Auth::id())->update(['wealth'=>$wealth]);
                   foreach ($order_id as $key =>$vel){
                       News::where('id',$vel)->update(['status'=>'2']);
                   }
                   $rvb=['sta'=>1,'time'=>time()];
                   Session::set('pay_status',$rvb);
               });
               $status=Session::get('pay_status');
               if(!empty($status) && $status['sta']==1 && time()-($status['time']+20)<=0){//条件判断
                   //返回支付状态，订单id，以备客户申请发票
                   return json_encode(['msg'=>'支付成功','sta'=>'0','data'=>$arr['order_id']]);
               }else{
                   Session::forget('pay_status');
                   return json_encode(['msg'=>'支付失败','sta'=>'1','data'=>$arr['order_id']]);
               }
           }else{
               return json_encode(['msg'=>'参数错误，请刷新页面重试!','sta'=>'1','data'=>'']);
           }
        }
    }


    /**
     * @return mixed
     * ios登陆
     */
    public function Api_postLogin()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        $remember = Input::get('remember', false);

        $redirect = urldecode(Input::get('redirect', '/'));
        //判断用户手机号码
        if (Controller::isMobile(Input::get('username')) == false) {
            return json_encode(['msg' => '请输入正确的手机号码', 'sta' => "1", 'data' => ''], JSON_UNESCAPED_UNICODE);
        }
        //验证用户
        $set_user = User::where(['username' => Input::get("username"), 'deleted_at' => null])->get()->toArray();
        if (empty($set_user)) {
            return json_encode(["msg" => "用户不存在，请注册", "sta" => 1, "data" => ""], JSON_UNESCAPED_UNICODE);
        }
        //判断用户状态是否锁定
        //通过验证
        $rst = Auth::attempt(['username' => $username, 'password' => $password], $remember);
        if ($rst == true) {
            $set_data = User::where(['username' => $username, 'deleted_at' => null])->select('*')->get()->toArray();
            $data = ([
                'id' => $set_data[0]['id'],
                'rst' => $rst,
                'username' => $username,
                'password' => $password,
                'redirect' => $redirect,
                'role'=>$set_user[0]['role']
            ]);
            //dd(json_encode($data));
            return json_encode(['sta' => "0", 'msg' => "请求成功", 'data' => $data], JSON_UNESCAPED_UNICODE);
        } else {
            return json_encode(["msg" => "用户名或者密码错误", "sta" => 1, "data" => ""], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function getLogout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::route('user.login');
    }

    /**
     * @return mixed
     *
     */
    public function _logout()
    {
        Auth::logout();
        return json_encode(["msg" => "请求成功", "sta" => "0", "data" => ""], JSON_UNESCAPED_UNICODE);
    }

    public function _checkLogin()
    {
        if (Auth::check()) {
            return json_encode(["msg" => "已登录", "sta" => "0", "data" => ""], JSON_UNESCAPED_UNICODE);
        } else {
            return json_encode(["msg" => "未登录", "sta" => "1", "data" => ""], JSON_UNESCAPED_UNICODE);
        }
    }


    /**
     * @param Request $request
     * @return mixed
     * user_SMS
     * 获取手机号码。手机验证码，判断时间，判断验证码,密码
     * data['mobile_number']=$('#mobile_number').val();
     * data['password']=$('#user_password').val();
     * data['user_code']=$('#user_code').val();
     * data['confirm']=$('#confirm').val();
     */
    public function postRegister(Request $request)
    {
        $data = $request->all();
        $user_SMS = Redis::exists('user_SMS');
        if ($user_SMS == 1 && $data) {
            $send_num_data = Redis::get('user_SMS');
            $send_num = json_decode($send_num_data, true);
            if ($data['user_code'] == $send_num['code']) {
                //验证码5分钟内有效
                $endtime = date('Y-m-d H:i:s', $send_num['Send_time'] + 600);
                $this_time = date('Y-m-d H:i:s', time());
                //当前时间是否大于发送时间+时间限制 在限制时间内，当前时间小于发送时间+限制
                $second = intval((strtotime($this_time) - strtotime($endtime)) % 86400);
                if ($second <> 0 && $second > 0) {
                    Redis::del('user_SMS');
                    return json_encode(['sta' => "1", 'msg' => '验证码已失效，请重新申请', 'data' => ""], JSON_UNESCAPED_UNICODE);
                }
                if ($data['username'] != $send_num['user_phone']) {
                    return json_encode(['msg' => "验证用户不一致！", 'sta' => "1", 'data' => ''], JSON_UNESCAPED_UNICODE);
                }
                $user = new User();
                $validate = Validator::make($request->all(), $user->rules()['create']);
                $messages = $validate->messages();
                if ($validate->fails()) {
                    $msg = $messages->toArray();
                    foreach ($msg as $k => $v) {
                        return json_encode(['sta' => "1", 'msg' => $v[0], 'data' => ''], JSON_UNESCAPED_UNICODE);
                    }
                }
                $data = $user->create($request->only($user->getFillable()));
                Auth::login($data);
                // $data = User::where(['username'=>$request->username])->update(['created_by' => Auth::id()]);
                if ($data) {
                    Redis::del('user_SMS');
                    return json_encode(['sta' => "0", 'msg' => '注册成功', 'data' => $data], JSON_UNESCAPED_UNICODE);
                }
            } else {
                return json_encode(['msg' => "验证码错误", 'sta' => "1", 'data' => '']);
            }
        }
        return json_encode(['sta' => "1", 'msg' => '请求错误，请刷新页面重试', 'data' => ''], JSON_UNESCAPED_UNICODE);

    }

    /**
     * @return mixed
     */
    public function user_info()
    {
        return view('Admin.user.info');
    }

    /**
     * @return mixed
     *
     */

    public function _user_data()
    {
        //$user = Auth::user();
        $user = User::where('id', Auth::id())->get()->toArray();
        $user = $user[0];
        foreach ($user as $k => $v) {
            $user[$k] = !empty($user[$k]) ? $v : "";
        }
        $user['user_avatar'] = md52url($user['user_avatar']);
        return json_encode(['msg'=>'','sta'=>"0",'data'=>$user]);

    }

    /**
     * @return mixed
     *
     */
    public function safety_set()
    {
        return view('Admin.user.safety_set');
    }

    public function safety_update($data)
    {
        if ($data == 'security') {
            $data_con = config('security');
            return view('Admin.user.user_update', ['type' => $data, 'data_con' => $data_con]);
        }
        return view('Admin.user.user_update', ['type' => $data]);

    }


    public function _data_con()
    {

        $question = Config('security');
        $type = Config('questiontype');
//        dd($type);
        foreach ($type as $k => $v) {
            $data[$v['type']] = array_merge($this->get_question($question, $v['type']));
        }
        return json_encode(['msg' => '', 'sta' => "0", 'data' => $data]);
    }

    protected function get_question($array, $type)
    {

        foreach ($array as $k => $v) {
            if ($v['type'] == $type) {
                $arr[] = array_merge($v);
            }
        }
        return $arr;
    }

    public function get_security_question()
    {
        $result_array = Security::where('user_id', Auth::id())->select('id', 'ques_id')->get()->toArray();

        if (!empty($result_array)) {
            for ($i = 0; $i < count($result_array); $i++) {
                //echo Get_Question_Name($result_array[$i]['id']);
                $result_array[$i]['question_name'] = Get_Question_Name($result_array[$i]['ques_id']);
            }
            return $result_array;
        } else {
            return null;
        }
    }

    public function get_security_question_api()
    {
//        dd($this->get_security_question());
        if (empty($this->get_security_question())) {
            return response()->json(['msg'=>'没有设置密保！','sta'=>'1','data'=>'']);
        } else {
            return response()->json(['msg'=>'获取成功！','sta'=>'0','data'=>$this->get_security_question()]);
        }
    }

    /**
     * 显示提现界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show_withdraw(){
        $user = Auth::user();
        $type = Config::get('payway');
        return view('Admin.user.withdraw',['types'=>$type,'wealth'=>$user->wealth]);
    }

    /**
     * 返回最新的8个用户数据
     * @return string
     */
    public function get_new_user(){
        $users = User::select('username','nickname','user_avatar')->orderBy('id','DESC')->limit(8)->get();
        foreach ($users as $user=>$value){
            $value->user_avatar = md52url($value->user_avatar);
        }
        return json_encode(['msg'=>'获取成功！','sta'=>"0",'data'=>$users]);
    }

    /**
     * IOS 接口 获取提现相关内容
     * @return string
     */

    public function get_withdraw_data(){
        $user = Auth::user();
        $wealth = $user->wealth;
        $type = Config::get('payway');
        return json_encode(['msg'=>'获取成功！','sta'=>'0','data'=>['wealth'=>$wealth,'type'=>$type]]);
    }

    /**
     *
     *生成提现订单接口
     * @param password个人密码 money提现金额 payment提现账号 type提现方式
     * @return string
     */
    public function withdraw(){
        $user = Auth::user();
        $password = Input::get('password');
        $money = Input::get('money');
        $payment = Input::get('payment');
        if($money>$user->wealth){
            return json_encode(['msg'=>'提现金额不能大于账户余额！','sta'=>'1','data'=>'']);
        }
        $type = Input::get('type');
        if(in_array('',Input::all())){
            return json_encode(['msg'=>'不允许参数为空！','sta'=>'1','data'=>'']);
        }
        $rsl = Hash::check($password, $user->password);
        if($rsl){
            $wealthlog = new Wealthlog();
            $wealthlog->user_id = $user->id;
            $wealthlog->username = $user->username;
            $wealthlog->order_code = Controller::makePaySn(Auth::id());
            $wealthlog->price = $money;
            $wealthlog->payment = $payment;
            $wealthlog->paytype = $type;
            $wealthlog->type = 0;
            $wealthlog->title = '提现';
            $wealthlog->maketime = time();
            $wealthlog->money = $user->wealth;
            if($wealthlog->save()){
                return json_encode(['msg'=>'操作成功，提现金额将会在24小时后到账。！','sta'=>'0','data'=>'']);
            }else{
                return json_encode(['msg'=>'操作错误！','sta'=>'1','data'=>'']);
            }
        }else{
            return json_encode(['msg'=>'密码错误！','sta'=>'1','data'=>'']);
        }
    }


    /**
     * 返回提现列表界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show_withdraw_list(){
        $type = Config::get('payway');
        $type =array_column($type, 'name', 'id');
        return view('Admin/user/withdraw_list',['lists'=>$this->get_withdraw_list(),'type'=>$type]);
    }

    /**
     *
     * 返回提现列表数据
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */

    public function get_withdraw_list(){
        if (empty(Input::all())){
            $data = DB::table('wealthlog')->where('type','=','0')->limit(10)->orderBy('id','DESC')->get();
        }else{
            $page = Input::get('page');
            $keyword = Input::get('keyword');
            $starttime = empty(Input::get('start'))?null:Input::get('start');
            $end = empty(Input::get('end'))?null:Input::get('end');
            $rev = '10';
            $offset = ($page-1)*$rev;
            $data = Db::table('wealthlog');
            $data->where('type','=','0');
            if (!empty($keyword)){
                $data->where('username','like','%'.$keyword.'%');
            }
            if (!empty($starttime)&&!empty($end)){
                $data->whereBetween('maketime', [strtotime($starttime), strtotime($end)]);
            }
            if(empty($keyword)||(empty($starttime)&&empty($end))){
                $data->skip($offset)->take($rev);
            }
            $data->orderBy('id','DESC');
            $data = $data->get();
        }
        return $data;
    }

    public function get_order_list(){
//        dd($this->get_my_order());
        return view('Admin/user/myorder',['lists'=>$this->get_my_order()]);
    }

    public function get_my_order(){
        $type = Input::get('type');
        $start = Input::get('start');
        $end = Input::get('end');
        $page = Input::get('page');
        if(empty($type)&&empty($start)&&empty($end)&&empty($page)){
            $data = DB::table('wealthlog')->where('user_id','=',Auth::id())->limit(10)->orderBy('id','DESC')->get();
        }else{
            $rev = '10';
            $offset = ($page-1)*$rev;
            $data = Db::table('wealthlog');
            if(!empty($type)){
                $data->where('type','=',$type);
            }
            if(!empty($start)&&!empty($end)){
                $data->whereBetween('maketime', [strtotime($start), strtotime($end)]);
            }
            if(empty($type)||(empty($starttime)&&empty($end))){
                $data->skip($offset)->take($rev);
            }
            $data->orderBy('id','DESC');
            $data = $data->get();
        }
        return $data;
    }
    public function finish_withdraw(){
        $id = Input::get('id');
        if (empty($id)){
            return response()->json(['msg'=>'参数不能为空！','sta'=>'1','data'=>'']);
        }else{
            $weathlog = Wealthlog::find($id);
            $user = User::find($weathlog->user_id);
            if($weathlog->state==1){
                return response()->json(['msg'=>'该提现已完成！','sta'=>'1','data'=>'']);
            }else{
                $price = $weathlog->price;
                $wealth = $user->wealth;
                if($price>$wealth){
                    $weathlog->state = 2;
                    $weathlog->remark = '操作失败！余额不足!';
                    $weathlog->save();
                    return response()->json(['msg'=>'操作失败！余额不足!','sta'=>'1','data'=>'']);
                }else{
                    $bool = DB::transaction(function () use($price,$wealth,$weathlog,$user){
                        $wealth = $wealth - $price;
                        $weathlog->state = 1;
                        $user->wealth = $wealth;
                        $weathlog->save();
                        $user->save();
                    });
                    if ($bool){
                        return response()->json(['msg'=>'操作失败！','sta'=>'1','data'=>'']);
                    }else{
                        return response()->json(['msg'=>'操作成功!','sta'=>'0','data'=>'']);
                    }
                }
            }

        }
    }

    /**
     * @param Request $request
     * @return mixed
     *
     */
    public function update_info(Request $request)
    {

        $id = Auth::id();
        $type = Input::get('type');
        $Old_pass = Input::get('old_pass');
        $New_pass = Input::get('new_pass');
        $user_Eail = Input::get('user_Eail');
        $user_code = Input::get('user_code');
        $user = User::find($id);

        switch ($type) {
            case "update_info";
                if ($user) {
                    if (!empty($request->user_Eail)) {
                        $validate = Validator::make($request->all(), $user->rules()['update_info']);
                        $messages = $validate->messages();
                        if ($validate->fails()) {
                            $msg = $messages->toArray();
                            foreach ($msg as $k => $v) {
                                return json_encode(['sta' => "0", 'msg' => $v[0], 'data' => ''], JSON_UNESCAPED_UNICODE);
                            }
                        }
                    }
                    $result = User::where('id', $id)->update([
                        'user_avatar' => isset($request->user_avatar)?$request->user_avatar:"\\0",
                        'company_name' => isset($request->company_name)?$request->company_name:"\0",
                        'user_phone' => isset($request->user_phone)?$request->user_phone:"\0",
                        'nickname' => isset($request->nickname)?$request->nickname:"\0",
                        'contact_person' => isset($request->contact_person)?$request->contact_person:"\0",
                        'user_Eail' => isset($request->user_Eail)?$request->user_Eail:"\0",
                        'user_QQ' => isset($request->user_QQ)?$request->user_QQ:"\0",
                        'address'=>isset($request->address)?$request->address:''
                    ]);





                    if ($result) {
                        return json_encode(['msg' => '更新资料成功', 'sta' => '0', 'data' => ''], JSON_UNESCAPED_UNICODE);
                    } else {
                        return json_encode(['msg' => '更新资料失败', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
                    }
                }

                break;
            case "update_pass";
                if (!empty($Old_pass)) {
                    if (Hash::check($Old_pass, $user->password) == false) {
                        return json_encode(['msg' => '旧密码错误，请重新输入', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
                    }
                    User::where('id', $user->id)->update(['password' => bcrypt($New_pass)]);
                    Auth::logout();
                    return json_encode(['msg' => '密码修改成功，请重新登陆', 'sta' => '0', 'data' => ''], JSON_UNESCAPED_UNICODE);
                } else {
                    return json_encode(['msg' => '旧密码不能为空，请重新输入', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
                }
                break;
            case "update_email";
                $get_email = Redis::get('pass_email');
                $rv = json_decode($get_email, true);
                if ($user_Eail == $rv['user_Eail'] && $user_code == $rv['user_code']) {
                    $end_time = $rv['send_time'];
                    $endtime = date('Y-m-d H:i:s', $end_time + 180);
                    $this_time = date('Y-m-d H:i:s', time());
                    $second = intval((strtotime($this_time) - strtotime($endtime)) % 86400);
                    if ($second <> 0 && $second < 0) { //小于零
                        User::where('id', Auth::id())->update(['user_Eail' => $user_Eail]);
                        Redis::del('pass_email');
                        return json_encode(['msg' => '邮箱绑定成功', 'sta' => '0', 'data' => ''], JSON_UNESCAPED_UNICODE);
                    } else {
                        Redis::del('pass_email');
                        return json_encode(['msg' => '验证码已过期，请重新获取', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
                    }
                }
                break;
            case "security";

                $questin = Input::get('question');
                $answer = Input::get('answer');
                if (count($questin) == 3 && count($answer) == 3) {
                    $user_id = Auth::id();//用户id
                    Security::where('user_id', $user_id)->delete();
                    foreach ($questin as $key => $vel) {
                        if ($vel == 0) {
                            return json_encode(['msg' => '请完善密保问题', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
                        }
                        $save_data['user_id'] = $user_id;
                        $save_data['ques_id'] = $vel;
                        $save_data['answer'] = $answer[$key];
                        $security = new Security();
                        $result = $security->create($save_data);
                        if ($result) {
                            //更新用户表密保字段
                            User::where('id', $user_id)->update(['security' => '1']);
                        }
                    }
                    return json_encode(['msg' => '密保设置成功', 'sta' => '0', 'data' => ''], JSON_UNESCAPED_UNICODE);
                }
                break;
        }

    }

    /**
     * @param Request $request
     * @return string
     */
    public function resetPhone(Request $request)
    {
//        $user = Auth::user();
        $data = $request->all();
        $user_SMS = Redis::exists('user_SMS');
        if ($user_SMS == 1 && $data) {
            $send_num_data = Redis::get('user_SMS');
            $send_num = json_decode($send_num_data, true);
            if ($data['user_code'] == $send_num['code']) {
                //验证码5分钟内有效
                $endtime = date('Y-m-d H:i:s', $send_num['Send_time'] + 600);
                $this_time = date('Y-m-d H:i:s', time());
                //当前时间是否大于发送时间+时间限制 在限制时间内，当前时间小于发送时间+限制
                $second = intval((strtotime($this_time) - strtotime($endtime)) % 86400);
                if ($second <> 0 && $second > 0) {
                    Redis::del('user_SMS');
                    return json_encode(['sta' => "1", 'msg' => '验证码已失效，请重新申请', 'data' => ""], JSON_UNESCAPED_UNICODE);
                }
                if ($data['username'] != $send_num['user_phone']) {
                    return json_encode(['msg' => "验证用户不一致！", 'sta' => "1", 'data' => ''], JSON_UNESCAPED_UNICODE);
                }
                $user = Auth::user();
                $user->username = $data['username'];

                if ($user->save()) {
                    Redis::del('user_SMS');
                    $this->setStep(3);
                    Auth::logout();
                    return json_encode(['sta' => "0", 'msg' => '修改成功！', 'data' => $data], JSON_UNESCAPED_UNICODE);
                }
            } else {
                return json_encode(['msg' => "验证码错误", 'sta' => "1", 'data' => '']);
            }
        }
        return json_encode(['sta' => "1", 'msg' => '请求错误，请刷新页面重试', 'data' => ''], JSON_UNESCAPED_UNICODE);
    }

    public function check_question()
    {
        $data = Input::get('data');
        if (count($data) == 0) {
            return json_encode(['msg' => '参数错误！', 'sta' => '1', 'data' => '']);
        }
        $checkbool = 0;
        for ($i = 0; $i < count($data); $i++) {
            $arr = explode(',', $data[$i]);
            if ($arr['1'] == DB::table('security')->where('id', $arr['0'])->pluck('answer')->first()) {
                $checkbool++;
            }
        }
        if ($checkbool == count($data)) {
            $this->setStep(2);
            return json_encode(['msg' => '验证成功！', 'sta' => '0', 'data' => ''], JSON_UNESCAPED_UNICODE);
        } else {
            return json_encode(['msg' => '验证失败！', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
        }
        /*
        $data = Input::get('data');
        if(count($data)==0){
            die(json_encode(['msg' => '参数错误！', 'sta' => '1', 'data' => '']));
        }
        $checkbool = 0;
        for ($i=0;$i<count($data);$i++){
            dd($data[$i]);
            if ($data[$i]['answer']==DB::table('security')->where('id',$data[$i]['id'])->pluck('answer')->first()){
                $checkbool ++;
            }
        }
        if ($checkbool==count($data)){
            $this->setStep(2);
            return json_encode(['msg' => '验证成功！', 'sta' => '0', 'data' => ''], JSON_UNESCAPED_UNICODE);
        }else{
            return json_encode(['msg' => '验证失败！', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
        }*/
    }

    /**
     * @return mixed
     * 在线充值
     */
    public function Onlnetop_up()
    {
        $lists = Config::get('recharge');
//        dd($_SERVER['HTTP_HOST'].'/alipay/webnotify');
        return view('Admin.user.top-up', ['lists' => $lists]);
    }

    public function getStep()
    {
        $step = Session::get('step', 1);
        return $step;
    }

    public function setStep($step)
    {
        Session::put('step', $step);
    }

    public function userManage()
    {
        $users = User::orderBy('user.id', 'desc')->select('user.username', 'user.id', 'user.role', 'user.created_at', 'user.created_by', 'user.wealth', 'user.lock', 'acl_user.acl_name')->join('acl_user', 'user.role', 'acl_user.acl_id')->where('user.deleted_at', null)->paginate(10);
       // dd($users);
        foreach ($users as $k => $v) {
//            $users[$k]['created_by']=User::find($users[$k]['created_by'])->username;
            $users[$k]['ordernum'] = Wealthlog::where('user_id','=',$users[$k]['id'])->count();
            if ($users[$k]['created_by'] != 0) {
                $users[$k]['created_by'] = User::find($users[$k]['created_by'])->username;
            } else {
                $users[$k]['created_by'] = '--';
            }
        }
        return view('Admin.user.userManage', ['users' => $users]);
    }


    public function getUserList()
    {
        $type = Input::get('type');
        $username = Input::get('username');

        $users = User::orderBy('user.id', 'Desc')->select('user.username', 'user.id', 'user.role', 'user.created_at', 'user.created_by', 'user.lock', 'acl_user.acl_name', 'user.wealth')->join('acl_user', 'user.role', 'acl_user.acl_id')->where('user.username', 'like', '%' . $username . '%')->paginate(10);
        foreach ($users as $k => $v) {
//            $users[$k]['created_by']=User::find($users[$k]['created_by'])->username;
            if ($users[$k]['created_by'] != 0) {
                $users[$k]['created_by'] = User::find($users[$k]['created_by'])->username;
            } else {
                $users[$k]['created_by'] = '--';
            }
        }
        if ($type == 'web') {
//            dd($users);
            return view('Admin.user.userManage', ['users' => $users]);
        } else {
            if (empty($users)) {
                return json_encode(['msg' => '没有找到类似数据！', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
            } else {
                return json_encode(['msg' => '查询成功！', 'sta' => '0', 'data' => $users], JSON_UNESCAPED_UNICODE);
            }
        }


    }

    public function addUser()
    {
        $acl = $this->getAclRole();
        $id = intval(Input::get('id'));
        if (empty($id)) {
            $user = null;
        } else {
            $user = User::find($id);
            $user->pic = md52url($user->user_avatar);
//            dd($user);
        }
        return view('Admin.user.userAdd', ['user' => $user, 'aclusers' => $acl]);
    }

    public function getAclRole()
    {
        return AclUser::all()->toArray();
    }


    public function addUser_api(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $type = $data['type'];
        $id = intval($data['id']);
        switch ($type) {
            case 'add':
$passbool = $data['pass'] == $data['pass1'];
                $bool = !empty($data['username']) && !empty($data['pass']) && !empty($data['pass1']) && !empty($data['role']) && isset($data['lock']);
                if ($bool && $passbool) {
                    if (empty(User::where('username', $data['username'])->first())) {
//                            dd(User::where('username', $data['username'])->first());
                        $user = new User();
                        $user->username = $data['username'];
                        $user->password = $data['pass'];
                        $user->role = $data['role'];
                        $user->contact_person = $data['person'];
                        $user->user_Eail = $data['mail'];
                        $user->created_by =Auth::id();
                        $user->address = $data['address'];
                        $user->lock = $data['lock'];
                        $user->user_avatar=$data['pic'];
                        $user->company_name =$data['company'];
                        $user->user_QQ =$data['qq'];
                        if($user->save()){
                            return json_encode(['msg' => '添加成功！', 'sta' => '0', 'data' =>''], JSON_UNESCAPED_UNICODE);
                        }else{
                            return json_encode(['msg' => '内部错误！', 'sta' => '1', 'data' =>''], JSON_UNESCAPED_UNICODE);

                        }
                    } else {
//                            dd(User::where('username', $data['username'])->first());
                        return json_encode(['msg' => '用户已存在！', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
                    }
                } else {
                    return json_encode(['msg' => '参数错误！', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
                }
                break;
            case 'update':
                $passbool = $data['pass'] == $data['pass1'];
                $bool = !empty($data['username']) && !empty($data['pass']) && !empty($data['pass1']) && !empty($data['role']) && isset($data['lock']);
//                dd($passbool);
                if ($bool && $passbool) {
                    $user = User::find($id);
                    $user->username = $data['username'];
                    $user->password = $data['pass'];
                    $user->role = $data['role'];
                    $user->contact_person = $data['person'];
                    $user->user_Eail = $data['mail'];
                    $user->user_phone = $data['phone'];
                    $user->lock = $data['lock'];
                    $user->address = $data['address'];
                    $user->user_avatar=$data['pic'];
                    $user->company_name =$data['company'];
                    $user->user_QQ =$data['qq'];
                    if($user->save()){
                        return json_encode(['msg' => '修改成功！', 'sta' => '0', 'data' =>''], JSON_UNESCAPED_UNICODE);
                    }else{
                        return json_encode(['msg' => '内部错误！', 'sta' => '1', 'data' =>''], JSON_UNESCAPED_UNICODE);

                    }
                } else {
                    return json_encode(['msg' => '参数错误！', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
                }
                break;
            case "delete":

                if ($id == Auth::id()) {
                    return json_encode(['msg' => '不能删除自身！', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
                } else {
                    $user = User::find($id);
                    if ($user->delete()) {
                        return json_encode(['msg' => '删除成功！', 'sta' => '0', 'data' => ''], JSON_UNESCAPED_UNICODE);
                    } else {
                        return json_encode(['msg' => '内部错误！', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
                    }
                }


                break;
        }

    }

}
