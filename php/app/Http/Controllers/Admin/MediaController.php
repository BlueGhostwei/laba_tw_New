<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use DB;
use App\Models\Category;
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
        $media_type = Config::get('mediatype');
        $provinces = DB::table('region')->where('pid', "0")->select(['id', 'name'])->get();
       /* $price = Config::get('price');*/
        if (!empty($media_type)) {
            $get_arr = $media_type[0];
            $result = array_get($get_arr, 'classification');
            foreach ($result as $key => $vel) {
                $category_id = $vel['category_id'];
                $set_cate_data = Category::where(['media_id' => $category_id])->select('id','name','media_id')->get()->toArray();
                if (!empty($set_cate_data)) {
                    $result[$key]['data'] = $set_cate_data;
                }
                if ($vel['category_id'] == "3") {
                    $result[$key]['data'] = $provinces;
                }
               /* if ($vel['category_id'] == '5') {
                    $result[$key]['data'] = $price;
                }*/
            }
        }
        $data_list = DB::table('media_community')
            ->select('id', 'network', 'Entrance_level', 'Entrance_form', 'channel', 'coverage', 'media_md5', 'media_name', 'pf_price', 'px_price', 'mb_price')->orderBy('id','desc')->paginate(10);
        foreach ($data_list as $key => $vel) {
            $vel->coverage = DB::table('region')->where('id', $vel->coverage)->select('id', 'name')->get()->toArray();
            //$vel->network = DB::table('category')->where('id', $vel->network)->select('name', 'id')->get()->toArray();
            $vel->Entrance_level = DB::table('category')->where('id', $vel->Entrance_level)->select('name', 'id')->get()->toArray();
            $vel->Entrance_form = DB::table('category')->where('id', $vel->Entrance_form)->select('name', 'id')->get()->toArray();
            $vel->channel = DB::table('category')->where('id', 0)->select('name', 'id')->get()->toArray();
        }
        //dd($data_list);
        return view('Admin.media.index',['result_data'=>$result,'media_list'=>$data_list]);
    }

    //百科营销
    public function Encyclopedia()
    {
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
