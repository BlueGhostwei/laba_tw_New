<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use DB;
use App\Models\Media_community;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rules\In;
use Input;
use App\Models\Category;
use PhpParser\Node\Stmt\DeclareDeclare;

class MediaController extends Controller
{
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
        $key=Input::get('key');
        if($key=="media"){
           $media_id=Input::get('media_id');
           $result=$this->get_media($media_id);
           return json_encode(['msg'=>"请求成功",'sta'=>"0",'data'=>$result]);
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
        $keyword = Input::get('keyword');
        if ($keyword) {
            if ($keyword == "0") {
                $data_list = DB::table('media_community')
                    ->select('id', 'network', 'Entrance_level', 'Entrance_form', 'channel', 'standard', 'coverage', 'media_md5', 'diagram_img', 'media_name', 'pf_price', 'px_price', 'mb_price')
                    ->orderBy('id', 'desc')->paginate(10);
                $data_list = $this->to_sql($data_list);
                return json_encode(['msg' => '请求成功', 'sta' => '0', 'data' => $data_list]);
            } else {
                $media_cate = Input::get('data');
                $data_list = DB::table('media_community')
                    ->where('network', $media_cate[0]['data_id'])
                    ->orWhere('Entrance_level', $media_cate[1]['data_id'])
                    ->orWhere('Entrance_form', $media_cate[2]['data_id'])
                    ->orWhere('coverage', $media_cate[3]['data_id'])
                    ->orWhere('channel', $media_cate[4]['data_id'])
                    ->orderBy('id', 'desc')->get()/*->paginate(10)*/;
                foreach ($data_list as $k => $v) {
                    $data_list[$k]->media_md5 = md52url($v->media_md5);
                    $data_list[$k]->documents_img = md52url($v->documents_img);
                    $data_list[$k]->diagram_img = md52url($v->diagram_img);
                }
                $data_list = $this->to_sql($data_list);
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
    protected  function get_media($id){
        $set_meaid=Media_community::where('id',$id)->select('id','media_md5','media_name','Website_Description','mb_price')->first();
        $set_meaid->media_md5=md52url($set_meaid->media_md5);
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

    //百科营销
    public function Encyclopedia()
    {
        //获取所有媒体

        $media = Media_community::select('*')->orderBy('id', 'desc')->paginate(10);
        dd($media);

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
