<?php

namespace App\Http\Controllers\Admin;

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
                    ->select('id', 'network', 'Entrance_level', 'Entrance_form', 'channel', 'standard', 'coverage', 'media_md5', 'diagram_img', 'media_name', 'pf_price', 'px_price', 'mb_price', 'Website_Description')
                    ->orderBy('id', 'desc')->get()->toArray();
                $data_list = $this->to_sql_array($data_list);
            } else {
                $data = array (
                    0 => '6,24',
                    1 => '1,10',
                    2 => '2,4',
                    3 => '3,233,706,1006',
                    4 => '4,14',
                    5 => '5,21,19',
                    6 => '6,24',
                );


                dd($this->build_sql_ios());
                $handle = fopen('log.txt','a+');
                fwrite($handle,var_export(Input::all(),true));
                fwrite($handle,"\r\n");
                fclose($handle);
                $media_cate = Input::get('data');
                $sql = $this->build_sql($media_cate);
                $data_list = DB::select($sql);
                $data_list = $this->to_sql_array($data_list);
            }
            return json_encode(['msg' => '请求成功', 'sta' => '0', 'data' => $data_list]);
        } else {
            $data_list = DB::table('media_community')
                ->select('id', 'network', 'Entrance_level', 'Entrance_form', 'channel', 'standard', 'coverage', 'media_md5', 'diagram_img', 'media_name', 'pf_price', 'px_price', 'mb_price')
                ->orderBy('id', 'desc')->paginate(10);

            $data_list = $this->to_sql($data_list);
        }
        return view('Admin.media.index', ['result_data' => $result, 'media_list' => $data_list]);
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
        $data = array (
            0 => '0,16,31,29',
            1 => '1,10',
            2 => '2,4',
            3 => '3,233,706,1006',
            4 => '4,14',
            5 => '5,21,19',
            6 => '6,24',
        );

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
        dd($sqlarr);
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
//                dd($arr);
//                dd($vel->coverage);
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
        if(!empty(Input::get('form5data')) && empty($arr['form5data'])){
            $data=Input::get('form5data');
        }else{
            $data= $arr['form5data'];
        }
        $Manuscripts_attr = $data['Manuscripts_attr'];
        $data['price']="234123";
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
        $set_title=News::where('title','=',$data['title'])->first();
        if($set_title){
            return json_encode(['msg' => '新闻标题已被占用', 'sta' => "1", 'data' => ''], JSON_UNESCAPED_UNICODE);
        }
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

            $data['news_type']=$arr['key'];
            //查询价格
            $data['price']='14231';
            //生成订单号
            $data['order_code']=Controller::makePaySn(Auth::id());
            $data['media_id']=implode(',',$data['media_id']);
            dd($data['media_id']);
            $data['start_time']=strtotime($data['start_time']);
            $data['end_time']=strtotime($data['end_time']);
            $result = News::create($data);
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


}
