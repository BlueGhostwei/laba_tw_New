<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Request;
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
        $price=Config::get('price');
        if (!empty($media_type)) {
            $get_arr = $media_type[0];
            $result = array_get($get_arr, 'classification');
            foreach ($result as $key => $vel) {
                if ($vel['name'] == "覆盖区域") {
                    $result[$key]['data'] = $provinces;
                }
                if($vel['name']=='会员价'){
                    $result[$key]['data'] = $price;
                }
            }
            //dd($result);
        }
        //查询省市
        $provinces = DB::table('region')->where('pid', "0")->select(['id', 'name'])->get();
        return view('Admin.category.from', ['midia_type' => $media_type,'result_data'=>$result, 'provinces' => $provinces]);
    }

    public function store(Request $request)
    {
        $media_type = Config::get('mediatype');


        return view('Admin.category.store', ['midia_type' => $media_type]);
    }

    public function show()
    {

        return view('Admin.category.show');
    }

    //添加分类
    public function create_category(Request $request)
    {
        $category = new Category();
        $validate = Validator::make($request->all(), $category->rules()['update_info']);
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
        return json_encode(['msg' => "请求成功", 'sta' => "0", 'data' => ""], JSON_UNESCAPED_UNICODE);
        $cate = Category::find($id);
        if ($cate) {
            $cate->delete();
            return json_encode(['msg' => "请求成功", 'sta' => "0", 'data' => ""], JSON_UNESCAPED_UNICODE);
        } else {
            return json_encode(['msg' => "请求失败", 'sta' => "1", 'data' => ""], JSON_UNESCAPED_UNICODE);
        }


    }
}
