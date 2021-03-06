<?php

namespace App\Http\Controllers\Admin;

use App\Models\Wealthlog;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use DB,Auth,Input,Config;
use App\Models\Media_community;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rules\In;
use App\Models\Encyclopedia;
use App\Models\Category;
use Session;
use App\Models\User;
use PhpParser\Node\Stmt\DeclareDeclare;

class MediaController extends Controller
{


    public function selec_key()
    {
        $data_list = DB::table('media_community')
            ->select('id', 'network', 'Entrance_level', 'Entrance_form', 'channel', 'standard', 'coverage', 'media_md5', 'diagram_img', 'media_name', 'pf_price', 'px_price', 'mb_price')
            ->orderBy('id', 'desc')->paginate(10);

        $data_list = $this->to_sql($data_list);
        return json_encode(['msg' => '请求成功', 'sta' => '0', 'data' => $data_list]);
    }

    /**
     * @return mixed
     *  //获取分类信息
     * //获取媒体信息
     * //keyword条件搜索
     * //数据整合
     * //页面遍历
     */
    public function index()
    {
        /**
         * 获取分类信息，与媒体信息
         */
        $key = Input::get('key');
        if ($key == "media") {
            $media_id = Input::get('media_id');
            $result = $this->get_media($media_id);
            return json_encode(['msg' => "请求成功", 'sta' => "0", 'data' => $result]);
        }
        $media_type = Config::get('mediatype');
        $provinces = DB::table('region')->where('pid', "0")->select(['id', 'name'])->get();
        $price = Config::get('price');
        if (!empty($media_type)) {
            $get_arr = $media_type[0];
            $result = array_get($get_arr, 'classification');
            foreach ($result as $key => $vel) {
                $category_id = $vel['category_id'];
                $set_cate_data = Category::where(['media_id' => $category_id])
                    ->select('id', 'name', 'media_id')->get()->toArray();
                if (!empty($set_cate_data)) {
                    $result[$key]['data'] = $set_cate_data;
                }
                if ($vel['category_id'] == "3") {
                    $result[$key]['data'] = $provinces;
                }
                if ($vel['category_id'] == "5") {
                    $result[$key]['data'] = $price;
                }

            }
        }
        $keyword = array_get(Input::all(), 'keyword');
        if (isset($keyword)) {

            if ($keyword == "0") {
                $data_list = DB::table('media_community')
                    ->select('id', 'network', 'Entrance_level', 'Entrance_form', 'channel', 'standard', 'coverage', 'media_md5', 'diagram_img', 'media_name', 'pf_price', 'px_price', 'mb_price', 'Website_Description','media_type')
                    ->orderBy('id', 'desc')->get()->toArray();

                $data_list = $this->to_sql_array($data_list);
            } else {
                $media_cate = Input::get('data');
                $table='media_community';
                $set_data="id,network,Entrance_level,Entrance_form,channel,standard,coverage,media_md5,diagram_img,media_name,pf_price,px_price,mb_price,Website_Description,media_type";
//                dd($media_cate);
                $sql=Controller::joint_sql($table,$set_data,$media_cate);
                // $sql = $this->build_sql($media_cate);
                $data_list = DB::select($sql);
                $data_list = $this->to_sql_array($data_list);
            }
            return json_encode(['msg' => '请求成功', 'sta' => '0', 'data' => $data_list]);
        } else {
            $data_list = DB::table('media_community')
                ->select('id', 'network', 'Entrance_level', 'Entrance_form', 'channel', 'standard', 'coverage', 'media_md5', 'diagram_img', 'media_name', 'pf_price', 'px_price', 'mb_price','media_type')
                ->orderBy('id', 'desc')->paginate(10);

            $data_list = $this->to_sql($data_list);
        }
        $id = Input::get('id');
        if(!empty($id)){
            $selectdata = Media_community::find($id)->first();
            $selectdata->media_md5 = empty(md52url($selectdata->media_md5)) ? '' : md52url($selectdata->media_md5);
        }else{
            $selectdata = null;
        }
        return view('Admin.media.index', ['result_data' => $result, 'media_list' => $data_list,'select'=>$selectdata]);
    }


    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|static
     *
     */
    protected function get_media($id)
    {
        $set_meaid = Media_community::where('id', $id)->select('id', 'media_md5', 'media_name', 'Website_Description', 'mb_price')->first();
        $set_meaid->media_md5 = md52url($set_meaid->media_md5);
        return $set_meaid;
    }
    /**
     * @param Request $request
     * @return mixed
     *自定义验证规则
     */

    public function media_save(Request $request)
    {
//        dd($request->all());
        $user_id=Auth::id();
        $media = new Media_community();
        $message = array(
            "media_type.required" => "请选择媒体类型",
            "documents_type.required" => "请选择证件类型",
            "media_name.required" => "请输入媒体名称",
            "media_name.min" => "媒体名称至少两个字符",
            "media_name.max" => "媒体名称最多不超过20个字符",
            "media_name.unique" => "媒体名称已被占用",
            "principal.required" => "媒体负责人不能为空",
            "user_Eail.required" => "邮箱不能为空",
            "user_Eail.email" => "请输入正确的邮箱",
            "user_Eail.unique" => "该邮箱已经被占用",
            "user_QQ.required" => "QQ不能为空",
            "address.required" => "联系地址不能为空",
            "Zip_code.required" => "邮编不能为空",
            "documents_img.required" => "选择要上传的证件照片",
            "Website_Description.required" => "请输入媒体简介",
            "media_md5.required" => "请上传媒体LOGO",
            "diagram_img.required" => "请上传入口示意图",
            "pf_price.required" => "请输入平台价格",
            "px_price.required" => "请输入代理价格",
            "mb_price.required" => "请输入会员价格",
            "network.required" => "请选择网络类型",
            "Entrance_level.required" => "请选择入口级别",
            "Entrance_form.required" => "请选择入口形式",
            "coverage.required" => "请选择覆盖区域",
            "channel.required" => "请选择频道类型",
        );
        if(!empty(Input::get('media_id'))){
            $validator = Validator::make($request->all(), $media->rules()['media_update_rule'], $message);
        }else{
            $validator = Validator::make($request->all(), $media->rules()['media_rule'], $message);
        }
        $messages = $validator->messages();
        if ($validator->fails()) {
            $msg = $messages->toArray();
            foreach ($msg as $k => $v) {
                return json_encode(['sta' => "0", 'msg' => $v[0], 'data' => ''], JSON_UNESCAPED_UNICODE);
            }
        }
        if (Controller::isMobile(trim($request->mobile_number)) == false) {
            return json_encode(['msg' => "联系人电话不合法", 'sta' => "1", 'data' => ""], JSON_UNESCAPED_UNICODE);
        }
        if(!empty(Input::get('media_id'))){
            $arr=$request->all();
            $new=array_splice($arr,1);
            $result = Media_community::where('id',Input::get('media_id'))->update($new );
        }else{
            //$result = Media_community::create($request->only($media->getFillable()));
            $arr=$request->all();
            DB::transaction(function() use($arr){
                $result = Media_community::create($arr);
                $set_user=User::where('username',$arr['mobile_number'])->select('id')->get()->toArray();
                if($set_user){
                    $rv=array('msg'=>'联系人电话已被占用','phone'=>$arr['mobile_number']);
                    Session::set('save_err',$rv);
                    DB::rollback();//事务回滚
                }else{
                    //dd(234123);
                    $user= new User();
                    //$rand_num=Controller::getRandChar(6);
                    $user->username=$arr['mobile_number'];
                    $user->password='123456';
                    $user->role='1';
                    $user->confirm='1';
                    //$user->media_id=$result->id;//绑定媒体
                    $rst=$user->save();
                    if (!$rst) {
                        DB::rollback();//事务回滚
                    }
                }
            });
        }
        $get_err=Session::get('save_err');
        if(!empty($get_err) ){
            if($get_err['phone']==trim($request->mobile_number)){
                return json_encode(['msg' =>$get_err['msg'], 'sta' => "1", 'data' => ''], JSON_UNESCAPED_UNICODE);
            }
            Session::forget('save_err');
        }
        return json_encode(['msg' => "请求成功", 'sta' => "0", 'data' => ''], JSON_UNESCAPED_UNICODE);

    }
    /**
     * @return mixed
     * 创建媒体
     */
    public function media_from()
    {
        $media_type = Config::get('mediatype');
        $provinces = DB::table('region')->where('pid', "0")->select(['id', 'name'])->get();
        $price = Config::get('price');
        if (!empty($media_type)) {
            $get_arr = $media_type[0];
            $result = array_get($get_arr, 'classification');
            foreach ($result as $key => $vel) {
                $category_id = $vel['category_id'];
                $set_cate_data = Category::where(['media_id' => $category_id])->get()->toArray();
                if (!empty($set_cate_data)) {
                    $result[$key]['data'] = $set_cate_data;
                }
                if ($vel['category_id'] == "3") {
                    $result[$key]['data'] = $provinces;
                }
                if ($vel['category_id'] == '5') {
                    $result[$key]['data'] = $price;
                }
            }
        }
        return view('Admin.category.media_from', ['media_type' => $media_type, 'media_info' => $result]);
    }
    /**
     * @return mixed
     *  pf_price px_price mb_price media_name
     * 'media_md5','network','Entrance_level','Entrance_form','coverage','channel'
     */
    public function media_List()
    {
        //$media_type = Config::get('mediatype');
        $data_list = DB::table('media_community')
            ->select('id', 'network', 'Entrance_level', 'Entrance_form', 'channel', 'coverage','standard', 'media_md5', 'media_name', 'pf_price', 'px_price', 'mb_price')->paginate(10);
        foreach ($data_list as $key => $vel) {

            $vel->coverage = DB::table('region')->where('id', $vel->coverage)->select('id', 'name')->get()->toArray();
            $vel->network = DB::table('category')->where('id', $vel->network)->select('name', 'id')->get()->toArray();
            $vel->Entrance_level = DB::table('category')->where('id', $vel->Entrance_level)->select('name', 'id')->get()->toArray();
            $vel->Entrance_form = DB::table('category')->where('id', $vel->Entrance_form)->select('name', 'id')->get()->toArray();
            $vel->channel = DB::table('category')->where('id', 0)->select('name', 'id')->get()->toArray();
            $vel->standard = DB::table('category')->where('id', $vel->standard)->select('name', 'id')->get()->toArray();
        }
        //dd($data_list);
        return view('Admin.category.media_list', ['data_list' => $data_list]);
    }

    /**
     * @return mixed
     *
     */
    public function set_cate()
    {
        $media_type = Config::get('mediatype');
        $provinces = DB::table('region')->where('pid', "0")->select(['id', 'name'])->get();
        /* $price = Config::get('price');*/
        if (!empty($media_type)) {
            $get_arr = $media_type[0];
            $result = array_get($get_arr, 'classification');
//            $result = array_slice($result, 0, 5);
            foreach ($result as $key => $vel) {
                $category_id = $vel['category_id'];
                $set_cate_data = Category::where(['media_id' => $category_id])
                    ->select('id', 'name', 'media_id')->get()->toArray();
                if (!empty($set_cate_data)) {
                    $result[$key]['data'] = $set_cate_data;
                }
                if ($vel['category_id'] == "3") {
                    $result[$key]['data'] = $provinces;
                }
            }
        }
        return json_encode(['msg' => '', 'sta' => '0', 'data' => $result]);
    }
    /**
     * @param $id
     * @return $this
     *
     */
    public function media_List_update($id)
    {
        if (!empty($id)) {
            //加载页面数据信息
            $media_type = Config::get('mediatype');
            $provinces = DB::table('region')->where('pid', "0")->select(['id', 'name'])->get();
            $price = Config::get('price');
            if (!empty($media_type)) {
                $get_arr = $media_type[0];
                $result = array_get($get_arr, 'classification');
                foreach ($result as $key => $vel) {
                    $category_id = $vel['category_id'];
                    $set_cate_data = Category::where(['media_id' => $category_id])->get()->toArray();
                    if (!empty($set_cate_data)) {
                        $result[$key]['data'] = $set_cate_data;
                    }
                    if ($vel['category_id'] == "3") {
                        $result[$key]['data'] = $provinces;
                    }
                    if ($vel['category_id'] == '5') {
                        $result[$key]['data'] = $price;
                    }
                }
            }
            //加载更新媒体数据
            $setlect_data = Media_community::find($id);
            return view('Admin.category.media_from_update' ,['media_type' => $media_type, 'media_info' => $result,'update_media'=>$setlect_data,'type'=>'media_update']);
        } else {
            //页面接收session并提示信息
            return Redirect::back()->withErrors('请求错误');
        }
    }
    /**
     *
     *
     */
    public function media_List_dele()
    {
        $data = Input::all();
    }
    /**
     * @param $array
     * @return $array
     *
     * 将客户端的请求数据重新编码
     *
     */
    protected function build_data($array)
    {
        foreach ($array as $k => $v) {
            $array[$k] = explode(',', $v);
        }
        return $array;
    }

    /**
     * @param $array
     * @return string
     *
     * 生成原生sql语句
     *
     */
    protected function build_sql($array)
    {
       /* $data = array (
            0 => '0,16,31,29',
            1 => '1,10',
            2 => '2,4',
            3 => '3,233,706,1006',
            4 => '4,14',
            5 => '5,21,19',
            6 => '6,24',
        );*/

        $sql = 'SELECT `id`, `network`, `Entrance_level`, `Entrance_form`, `channel`, `standard`, `coverage`, `media_md5`, `diagram_img`, `media_name`, `pf_price`, `px_price`, `mb_price`,`Website_Description` FROM `media_community` WHERE ';
        foreach ($array as $k => $v) {
            if ($v['data_id'] <> '') {
                if ($v['category_id'] == '5') {        //	价格
                    $sql .= Get_Set_Name($v['category_id']) . " " . Config::get('price')[$v['data_id']]['sql'] . " AND ";
                } else {
                    $sql .= Get_Set_Name($v['category_id']) . " = '" . $v['data_id'] . "' AND ";
                }
            }
        }
        $sql = substr($sql, 0, -4);
        $sql .= " order by id desc";
        return $sql;
    }


    public function build_sql_ios(){
        $data = array (
            0 => '5,21,19',
            1 => '1,10',
            2 => '2,4',
            3 => '3,233,706,1006',
            4 => '4,14',
            5 => '5,21,19',
            6 => '6,24',
        );
        $price = Config::get('price');
        $sqlarr = array_column($price, 'sql', 'id');
//        dd($sqlarr);
        $sql = 'SELECT `id`, `network`, `Entrance_level`, `Entrance_form`, `channel`, `standard`, `coverage`, `media_md5`, `diagram_img`, `media_name`, `pf_price`, `px_price`, `mb_price`,`Website_Description` FROM `media_community` WHERE ';
        foreach ($data as $k => $v) {
            $arr = explode(',',$v);
            $key = $arr[0]; unset($arr[0]);
            asort($arr);
            $arr = implode(",",$arr);
            if($arr =='0'){
            }else{
                if($key == '5'){
                }else{
                    $sql .= "instr(concat(',',".Get_Set_Name($key).",','),',$arr,')<>0 AND ";
                }
            }
        }
        $sql = substr($sql, 0, -4);
        $sql .= " order by id desc";
        return $sql;
    }

    /**
     * @param $data_list
     * @return mixed
     *
     */
    protected function to_sql_array($data_list)
    {
    //  dd($data_list);
        $type = Config::get('mediatype');
        $type = array_column($type,'media_name','media_id');
        foreach ($data_list as $k => $vel) {
            if($vel->coverage==0){
                $vel->coverage ='不限';
            }else{
                $arr = explode(',',$vel->coverage);
                $vel->coverage = '';
//                dd($arr);
//                dd($vel->coverage);
                for($i=0;$i<count($arr);$i++){
                    $vel->coverage .=  DB::table('region')->where('id', $arr[$i])->pluck('name')->first();
                    $vel->coverage .=',';
                }
            }
            if(isset($vel->media_type)){
                $vel->media_type = $type[$vel->media_type];
            }

            $vel->Entrance_level = $this->get_category($vel->Entrance_level);
            $vel->Entrance_form = $this->get_category($vel->Entrance_form);
            $vel->channel = $this->get_category($vel->channel);
            $vel->standard = $this->get_category($vel->standard);
            $vel->media_md5 = empty(md52url($vel->media_md5)) ? '' : md52url($vel->media_md5);
            $vel->diagram_img = empty(md52url($vel->diagram_img)) ? '' : md52url($vel->diagram_img);
        }
        return $data_list;
    }
    public function get_category($key){
        if($key==0){
            $key ='不限';
        }else{
            $arr = explode(',',$key);
            $key = '';
            for($i=0;$i<count($arr);$i++){
                $key .=  DB::table('category')->where('id', $arr[$i])->pluck('name')->first();
                $key .=',';
            }
        }
        return $key;
    }

    protected function to_sql($data_list)
    {
        foreach ($data_list as $key => $vel) {
            $vel->coverage = DB::table('region')->where('id', $vel->coverage)->select('id', 'name')->get()->toArray();
            //$vel->network = DB::table('category')->where('id', $vel->network)->select('name', 'id')->get()->toArray();
            $vel->Entrance_level = DB::table('category')->where('id', $vel->Entrance_level)->select('name', 'id')->get()->toArray();
            $vel->Entrance_form = DB::table('category')->where('id', $vel->Entrance_form)->select('name', 'id')->get()->toArray();
            $vel->channel = DB::table('category')->where('id', $vel->channel)->select('name', 'id')->get()->toArray();
            $vel->standard = DB::table('category')->where('id', $vel->standard)->select('name', 'id')->get()->toArray();
        }
        return $data_list;
    }


    /**
     * @return mixed
     *  会员订单
     *  根据用户提交素材的不同，分段处理。
     *  生成订单；
     *  扣除对应金额
     *  返回提交状态
     */
    public function Member_order()
    {
        $arr = Input::all();
//        dd($arr);
//        $price= DB::table('media_community')->where('id', 2)->pluck('pf_price')->first();
//        dd($price);
        if(!empty(Input::get('form5data')) && empty($arr['form5data'])){
            $data=Input::get('form5data');
        }else{
            $data= $arr['form5data'];
        }
        $media_id = $data['media_id'];
//        dd($media_id);
        $data['price']='1231';
        $Manuscripts_attr = $data['Manuscripts_attr'];
        switch ($Manuscripts_attr) {
            case '1';
                $rules = array(
                    'media_id' => 'required',
                    'title' => 'required|max:25',
                    'Manuscripts_attr' => 'required',
                    'url_line' => 'required|url',
                    'keyword' => 'required:min:2',
                    'start_time' => 'required',
                    'end_time' => 'required',
                    'remark' => 'required',
                    'price'=>'required'

                );
                break;
            case '2';
                $rules = array(
                    'media_id' => 'required',
                    'title' => 'required|max:25',
                    'Manuscripts' => 'required',
                    'Manuscripts_attr' => 'required',
                    'keyword' => 'required:min:2',
                    'start_time' => 'required',
                    'end_time' => 'required',
                    'remark' => 'required',
                    'price'=>'required'
                );
                break;
            case '3';
                $rules = array(
                    'media_id' => 'required',
                    'title' => 'required|max:25',
                    'Manuscripts_attr' => 'required',
                    'keyword' => 'required:min:2',
                    'start_time' => 'required',
                    'end_time' => 'required',
                    'remark' => 'required',
                    'content' => 'required|min:200',
                    'price'=>'required'
                );
                break;
        }
        $messgage = array(
            'media_id.required' => '请选择媒体',
            'title.required' => '请填写标题',
            'title.max' => '标题最大限制为25个字符',
            'Manuscripts.required' => '请选择提交的外部稿件',
            'Manuscripts_attr.required' => '请选择提交稿件类型',
            'url_line.required' => '请填写外部链接',
            'url_line.url' => '链接地址不合法',
            'keyword.required' => '关键字不能为空',
            'keyword.min' => '关键字最小为2个字符',
            'start_time.required' => '请设置文章发布时间',
            'end_time.required' => '请设置文章结束时间',
            'remark.required' => '备注信息不能为空',
            'content.required' => '内容不能为空',
            'content.min' => '内容最小为200个字符',
            'price.required'=>'价格不能为空'
        );
//        $set_title=News::where('title','=',$data['title'])->first();
//        if($set_title){
//            return json_encode(['msg' => '新闻标题已被占用', 'sta' => "1", 'data' => ''], JSON_UNESCAPED_UNICODE);
//        }
        $data['user_id']=Auth::id();
        $validator = Validator::make($data, $rules, $messgage);
        $messages = $validator->messages();
        if ($validator->fails()) {
            $msg = $messages->toArray();
            foreach ($msg as $k => $v) {
                return json_encode(['sta' => "1", 'msg' => $v[0], 'data' => ''], JSON_UNESCAPED_UNICODE);
            }
        } else {
            //判断开始时间。
            $this_time = time();
            if (strtotime($data['start_time']) < $this_time) {
                return json_encode(['msg' => "开始时间必须大于当前时间", 'sta' => "1", 'data' => ''], JSON_UNESCAPED_UNICODE);
            }
            if (strtotime($data['start_time']) > strtotime($data['end_time'])) {
                return json_encode(['msg' => "结束时间必须大于开始时间", 'sta' => "1", 'data' => ''], JSON_UNESCAPED_UNICODE);
            }
            $start =$data['start_time'];
            $end = $data['end_time'];
//            dd($user);
            for ($i=0;$i<count($media_id);$i++){
                $data['news_type']=$arr['key'];
                //查询价格
                $data['price']= DB::table('media_community')->where('id', $media_id[$i])->pluck('pf_price')->first();
                ;
                //生成订单号
                $data['order_code']=Controller::makePaySn(Auth::id());
//                $data['media_id']=implode(',',$data['media_id']);
                $data['media_id'] = $media_id[$i];
                $data['start_time']=strtotime($start);
                $data['end_time']=strtotime($end);
                $result = News::create($data);

            }

        }
        return json_encode(['msg' => "请求成功", 'sta' => "0", 'data' => $result], JSON_UNESCAPED_UNICODE);


    }


    //百科营销
    public function Encyclopedia()
    {
        //获取所有媒体

        $media = Media_community::select('*')->orderBy('id', 'desc')->paginate(10);
        return view('Admin.media.market');
    }

    //短视频
    public function Short_video()
    {
        return view('Admin.media.short_video');
    }

    //微信公众号
    public function Public_Wechat()
    {
        return view('Admin.media.wechat');
    }

    //论坛
    public function forum()
    {
        return view('Admin.media.forum');
    }

    //秒拍
    public function Second_shot()
    {
        return view('Admin.media.second_shot');
    }

    //文案策划
    public function Copy_plan()
    {
        $ghostwrite = Category::where('pt', 'ghostwrite')->orderBy('id', 'desc')->get();
        // dd($ghostwrite);
        return view('Admin.media.copy_plan', ['ghostwrite' => $ghostwrite]);
    }

    //微信营销
    public function Wechat_market()
    {
        return view('Admin.media.wechat_market');
    }
    public function search(){
        $data = $this->get_search_data();
        $data = $this->to_sql_array($data);
        return view('Admin.dashboard.searchpage',['data'=>$data,'keyword'=>Input::get('keyword')]);
    }
    public function get_search_data(){
        $keyword = empty(Input::get('keyword'))?'':Input::get('keyword');
        $data = Media_community::where('media_name','like','%'.$keyword.'%')->orderBy('id','desc')->get();
        return $data;
    }


}
