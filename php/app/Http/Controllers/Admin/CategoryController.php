<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use DB;
use Input;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{

    
    /**
     *网络类型
     * 入口级别
     * 入口形式
     * 频道类型
     * 会员价
     */
    public function index()
    {
        $media_type = Config::get('mediatype');
        $provinces = DB::table('region')->where('pid', "0")->select(['id', 'name'])->get();
        $price = Config::get('price');
        if (!empty($media_type)) {
            $get_arr = $media_type[0];
            $result = array_get($get_arr, 'classification');
            foreach ($result as $key => $vel) {
                $category_id=$vel['category_id'];
                $set_cate_data = Category::where(['media_id'=> $category_id])->get()->toArray();
                if (!empty($set_cate_data)) {
                    $result[$key]['data']=$set_cate_data;
                }
                if ($vel['category_id'] == "3") {
                    $result[$key]['data'] = $provinces;
                }
                if ($vel['category_id'] == '5') {
                    $result[$key]['data'] = $price;
                }
            }
        }
        //查询省市
        $provinces = DB::table('region')->where('pid', "0")->select(['id', 'name'])->get();
        return view('Admin.category.from', ['midia_type' => $media_type, 'result_data' => $result, 'provinces' => $provinces]);
    }
    //添加分类
    public function create_category(Request $request)
    {

        $category = new Category();
        $validate = Validator::make($request->all(), $category->rules()['create']);
        $messages = $validate->messages();
        if ($validate->fails()) {
            $msg = $messages->toArray();
            foreach ($msg as $k => $v) {
                return json_encode(['sta' => "1", 'msg' => $v[0], 'data' => ''], JSON_UNESCAPED_UNICODE);
            }
        }
        $result = $category->create($request->only($category->getFillable()));
        if ($result) {
            return json_encode(['msg' => "请求成功", 'sta' => "0", 'data' => $result], JSON_UNESCAPED_UNICODE);
        } else {
            return json_encode(['msg' => "请求失败", 'sta' => "1", 'data' => ""], JSON_UNESCAPED_UNICODE);
        }
    }

    //删除分类
    public function cate_dele()
    {
        $id=Input::get('cate_id');
        $cate = Category::find($id);
        if ($cate) {
            $cate->delete();
            return json_encode(['msg' => "请求成功", 'sta' => "0", 'data' => ""], JSON_UNESCAPED_UNICODE);
        } else {
            return json_encode(['msg' => "请求失败", 'sta' => "1", 'data' => ""], JSON_UNESCAPED_UNICODE);
        }


    }
    //创建媒体
   public function media_from(){
       $media_type = Config::get('mediatype');
       $provinces = DB::table('region')->where('pid', "0")->select(['id', 'name'])->get();
       $price = Config::get('price');
       if (!empty($media_type)) {
           $get_arr = $media_type[0];
           $result = array_get($get_arr, 'classification');
           foreach ($result as $key => $vel) {
               $category_id=$vel['category_id'];
               $set_cate_data = Category::where(['media_id'=> $category_id])->get()->toArray();
               if (!empty($set_cate_data)) {
                   $result[$key]['data']=$set_cate_data;
               }
               if ($vel['category_id'] == "3") {
                   $result[$key]['data'] = $provinces;
               }
               if ($vel['category_id'] == '5') {
                   $result[$key]['data'] = $price;
               }
           }
       }
       //dd($result);
       return view('Admin.category.media_from',['media_type'=>$media_type,'media_info'=>$result]);
   }
    public function media_List(){
        echo 34123;die;
    }
}
