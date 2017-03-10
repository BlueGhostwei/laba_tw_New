<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use DB;
use App\Models\Media_community;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rules\In;
use App\Models\Encyclopedia;
use Input;
use App\Models\Category;
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
        /* $price = Config::get('price');*/
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
            }
        }
        $keyword = array_get(Input::all(), 'keyword');
//        $keyword="1";
        if (isset($keyword)) {
            if ($keyword == "0") {

                $data_list = DB::table('media_community')
                    ->select('id', 'network', 'Entrance_level', 'Entrance_form', 'channel', 'standard', 'coverage', 'media_md5', 'diagram_img', 'media_name', 'pf_price', 'px_price', 'mb_price', 'Website_Description')
                    ->orderBy('id', 'desc')->get()->toArray();
                $this->to_sql_array($data_list);
            } else {
                $media_cate = array_get(Input::all(), 'data');

                $media_cate = $this->build_data($media_cate);

                $sql = $this->build_sql($media_cate);
                dd($sql);
//                $data_list = DB::select($sql);
//                $this->to_sql_array($data_list);


//                $sql =`network` =1 OR `Entrance_form` =5 OR `channel` =14;
//                $sql = "SELECT * FROM `media_community` WHERE `"
//
//                $data_list = DB::table('media_community')
//                    ->where('network', $media_cate[0]['data_id'])
//                    ->orWhere('Entrance_level', $media_cate[1]['data_id'])
//                    ->orWhere('Entrance_form', $media_cate[2]['data_id'])
//                    ->orWhere('coverage', $media_cate[3]['data_id'])
//                    ->orWhere('channel', $media_cate[4]['data_id'])
//                    ->orderBy('id', 'desc')->get()/*->paginate(10)*/;
//                foreach ($data_list as $k => $v) {
//                    $data_list[$k]->media_md5 = md52url($v->media_md5);
//                    $data_list[$k]->documents_img = md52url($v->documents_img);
//                    $data_list[$k]->diagram_img = md52url($v->diagram_img);
//                }
//                $data_list = $this->to_sql($data_list);
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

        $sql = 'SELECT `id`, `network`, `Entrance_level`, `Entrance_form`, `channel`, `standard`, `coverage`, `media_md5`, `diagram_img`, `media_name`, `pf_price`, `px_price`, `mb_price`,`Website_Description` FROM `media_community` WHERE ';
        foreach ($array as $k => $v) {
            if ($v[1] == '0') {

            } else {
                $sql .= Get_Set_Name($v[0]) . " = " . $v[1] . " OR ";
            }

        }
        $sql = substr($sql, 0, -3);
        $sql .= " order by id desc";
        return $sql;
    }

    protected function to_sql_array($data_list)
    {

        //dd($data_list);
        foreach ($data_list as $k => $vel) {
            $vel->coverage = DB::table('region')->where('id', $vel->coverage)->pluck('name')->first();
            //$vel->network = DB::table('category')->where('id', $vel->network)->select('name', 'id')->get()->toArray();
            $vel->Entrance_level = DB::table('category')->where('id', $vel->Entrance_level)->pluck('name')->first();
            $vel->Entrance_form = DB::table('category')->where('id', $vel->Entrance_form)->pluck('name')->first();
            $vel->channel = DB::table('category')->where('id', $vel->channel)->pluck('name')->first();
            $vel->standard = DB::table('category')->where('id', $vel->standard)->pluck('name')->first();
            $vel->media_md5 = md52url($vel->media_md5);
            $vel->diagram_img = md52url($vel->diagram_img);
        }

        return $data_list;
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
     * 会员订单
     */
    public function Member_order()
    {
        $Encyclopedia = new Encyclopedia();
        $data = Input::get('data');
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
                    'content' => 'required|min:200'
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
            'content.min' => '内容最小为200个字符'
        );
        $validator=Validator::make($data,$rules,$messgage);
        $messages=$validator->messages();
        if($validator->fails()){
            $msg = $messages->toArray();
            foreach ($msg as $k => $v) {
                return json_encode(['sta' => "1", 'msg' => $v[0], 'data' => ''], JSON_UNESCAPED_UNICODE);
            }
        }else{
            //判断开始时间。
            $this_time=time();
            if(strtotime($data['start_time'])<$this_time ){
                return json_encode(['msg' => "开始时间必须大于当前时间", 'sta' => "1", 'data' => ''], JSON_UNESCAPED_UNICODE);
            }
            if(strtotime($data['start_time'])>strtotime($data['end_time'])){
                return json_encode(['msg' => "结束时间必须大于开始时间", 'sta' => "1", 'data' => ''], JSON_UNESCAPED_UNICODE);
            }

            $result= $Encyclopedia->create($data);
            if($result){
                //扣除对应金额
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
        return view('Admin.media.copy_plan');
    }

    //微信营销
    public function Wechat_market()
    {
        return view('Admin.media.wechat_market');
    }


}
