<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use DB;
use Input;
use App\Models\Category;
use App\Models\Media_community;
use Validator;

class CategoryController extends Controller
{


    /**
     *网络类型
     * 入口级别
     * 入口形式
     * 频道类型^
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

    /**
     * @param Request $request
     * @return mixed
     *自定义验证规则
     *
     */

    public function media_save(Request $request)
    {
        $media=new Media_community();
        $message = array(
                    "media_type.required"=>"请选择媒体类型",
                    "documents_type.required"=>"请选择证件类型",
                    "media_name.required"=>"请输入媒体名称",
                    "media_name.min"=>"媒体名称至少两个字符",
                    "media_name.max"=>"媒体名称最多不超过20个字符",
                    "media_name.unique"=>"媒体名称已被占用",
                    "principal.required"=>"媒体负责人不能为空",
                    "user_Eail.required"=>"邮箱不能为空",
                    "user_Eail.email"=>"请输入正确的邮箱",
                    "user_QQ.required"=>"QQ不能为空",
                    "address.required"=>"联系地址不能为空",
                    "Zip_code.required"=>"邮编不能为空",
                    "documents_img.required"=>"选择要上传的证件照片",
                    "Website_Description.required"=>"请输入媒体简介",
                    "media_md5.required"=>"请上传媒体LOGO",
                    "pf_price.required"=>"请输入平台价格",
                    "px_price.required"=>"请输入代理价格",
                    "mb_price.required"=>"请输入会员价格",
                    "network.required"=>"请选择网络类型",
                    "Entrance_level.required"=>"请选择入口级别",
                    "Entrance_form.required"=>"请选择入口形式",
                    "coverage.required"=>"请选择覆盖区域",
                    "channel.required"=>"请选择频道类型",
        );
        $validator = Validator::make($request->all(),$media->rules()['media_rule'],$message);
        $messages = $validator->messages();
       if ($validator->fails()){
           $msg = $messages->toArray();
           foreach ($msg as $k => $v) {
               return json_encode(['sta' => "0", 'msg' => $v[0], 'data' => ''],JSON_UNESCAPED_UNICODE);
           }
       }
        if(Controller::isMobile($request->mobile_number)==false){
            return json_encode(['msg'=>"联系人电话不合法",'sta'=>"1",'data'=>""],JSON_UNESCAPED_UNICODE);
        }
      
        $result=Media_community::create($request->only($media->getFillable()));
        if($result){
            return json_encode(['msg'=>"媒体保存成功",'sta'=>"0",'data'=>$result],JSON_UNESCAPED_UNICODE);
        }else{
            return json_encode(['msg'=>"媒体保存失败",'sta'=>"1",'data'=>""],JSON_UNESCAPED_UNICODE);
        }
    }

    //删除分类
    public function cate_dele()
    {
        $id = Input::get('cate_id');
        $cate = Category::find($id);
        if ($cate) {
            $cate->delete();
            return json_encode(['msg' => "请求成功", 'sta' => "0", 'data' => ""], JSON_UNESCAPED_UNICODE);
        } else {
            return json_encode(['msg' => "请求失败", 'sta' => "1", 'data' => ""], JSON_UNESCAPED_UNICODE);
        }


    }

    //创建媒体
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
        //dd($result);
        return view('Admin.category.media_from', ['media_type' => $media_type, 'media_info' => $result]);
    }

    public function media_List()
    {
        echo 34123;
        die;
    }
}
