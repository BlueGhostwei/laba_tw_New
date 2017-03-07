<?php

namespace App\Http\Controllers\Admin;

use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Security;
use Illuminate\Validation\Rules\In;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;
use Validator;
use Redirect;
use Auth;
use Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

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

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     * 验证用户登录
     */
    public function post_login(Request $request)
    {
        $username = Input::get('username');
        $password = Input::get('user_password');
        $remember = Input::get('remember', false);
        //判断用户手机号码
        if (Controller::isMobile(Input::get('username')) == false) {
            return Redirect::back()->withErrors('请输入正确的手机号码')->withInput();
            //return json_encode(["msg" => "", "sta" => 1, "data" => ""], JSON_UNESCAPED_UNICODE);
        }
        //验证用户
        $set_user = User::where(['username' => Input::get("username"), 'deleted_at' => null])->get()->toArray();
        if (empty($set_user)) {
            return Redirect::back()->withErrors('用户不存在，请注册')->withInput();
            //return json_encode(["msg" => "", "sta" => 1, "data" => ""], JSON_UNESCAPED_UNICODE);
        }
        //判断用户状态是否锁定

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
            $rst = Auth::attempt(['username' => $username, 'password' => $password], $remember);
            if ($rst == true) {
                return redirect()->intended('/');//登录成功，跳转页面
            } else {
                return Redirect::back()->withErrors('用户名或者密码错误')->withInput();
            }

        }

    }


    //ios登陆
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
            ]);
            //dd(json_encode($data));
            return json_encode(['sta' => "0", 'msg' => "请求成功", 'data' => $data], JSON_UNESCAPED_UNICODE);
        } else {
            return json_encode(["msg" => "用户名或者密码错误", "sta" => 1, "data" => ""], JSON_UNESCAPED_UNICODE);
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::route('user.login');
    }

    public function _getLogout()
    {
        Auth::logout();
        return json_encode(["msg" => "请求成功", "sta" => "0", "data" => ""], JSON_UNESCAPED_UNICODE);
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
    public function _user_info()
    {
        $user = Auth::user();
        $user->user_avatar = md52url($user->user_avatar);
        return json_encode($user);
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
        if($data=='security'){
            $data_con=config('security');
            return view('Admin.user.user_update', ['type' => $data,'data_con'=>$data_con]);
        }
        return view('Admin.user.user_update', ['type' => $data]);

    }

    public function _data_con(){
        return json_encode(['msg'=>'','sta'=>"0",'data'=>config('security')]);
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
        $user_Eail=Input::get('user_Eail');
        $user_code=Input::get('user_code');
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
                        'user_avatar' => $request->user_avatar,
                        'company_name' => $request->company_name,
                        'user_phone' => $request->user_phone,
                        'nickname' => $request->nickname,
                        'contact_person' => $request->contact_person,
                        'user_Eail' => "$request->user_Eail",
                        'user_QQ' => $request->user_QQ
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
                    return json_encode(['msg' => '密码修改成功，请重新登陆', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
                } else {
                    return json_encode(['msg' => '旧密码不能为空，请重新输入', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
                }
                break;
            case "update_email";
                $get_email=Redis::get('pass_email');
                $rv=json_decode($get_email,true);
                if($user_Eail==$rv['user_Eail'] && $user_code==$rv['user_code']){
                    $end_time=$rv['send_time'];
                    $endtime = date('Y-m-d H:i:s', $end_time + 180);
                    $this_time = date('Y-m-d H:i:s', time());
                    $second = intval((strtotime($this_time) - strtotime($endtime)) % 86400);
                    if ($second <> 0 && $second < 0) { //小于零
                        User::where('id',Auth::id())->update(['user_Eail'=>$user_Eail]);
                        Redis::del('pass_email');
                        return json_encode(['msg' => '邮箱绑定成功', 'sta' => '0', 'data' => ''], JSON_UNESCAPED_UNICODE);
                    }else{
                        Redis::del('pass_email');
                        return json_encode(['msg' => '验证码已过期，请重新获取', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
                    }
                }
                break;
            case "security";
                 $questin=Input::get('question');
                 $answer=Input::get('answer');
                 if(count($questin)==3 && count($answer)==3 ){
                     $user_id=Auth::id();//用户id
                     foreach ($questin as $key =>$vel){
                        if($vel==0){
                          return json_encode(['msg' => '请完善密保问题', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
                        }
                         $save_data['user_id']=$user_id;
                         $save_data['ques_id']=$vel;
                         $save_data['answer']=$answer[$key];
                         $security=new Security();
                         $result=$security->create($save_data);
                         if($result){
                             //更新用户表密保字段
                             User::where('id',$user_id)->update(['security'=>'1']);
                             return json_encode(['msg' => '密保设置成功', 'sta' => '0', 'data' => ''], JSON_UNESCAPED_UNICODE);
                       }else{
                             return json_encode(['msg' => '请求失败，请刷新页面重试', 'sta' => '1', 'data' => ''], JSON_UNESCAPED_UNICODE);
                         }
                     }
                 }
                break;
        }
    }

    /**
     * @return mixed
     * 在线充值
     */
    public function Onlnetop_up()
    {
        return view('Admin.user.top-up');
    }


}
