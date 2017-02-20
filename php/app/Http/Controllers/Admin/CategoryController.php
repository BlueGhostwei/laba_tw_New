<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Request;
use Config;
use Input;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    /**
     *
     */
    public function index()
    {
        $media_type = Config::get('mediatype');
        //dd($media_type);
        return view('Admin.category.from', ['midia_type' => $media_type]);
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

    public function create_category(Request $request)
    {
        $category = new Category();
        $validate = Validator::make($request->all(), $category->rules()['update_info']);
        $messages = $validate->messages();
        if ($validate->fails()) {
            $msg = $messages->toArray();
            foreach ($msg as $k => $v) {
                return json_encode(['sta' => "1", 'msg' => $v[0], 'data' => ''],JSON_UNESCAPED_UNICODE);
            }
        }
       $result= $category->create($request->only($category->getFillable()));
        if($result){
            return json_encode(['msg'=>"请求成功",'sta'=>"0",'data'=>$result],JSON_UNESCAPED_UNICODE);
        }else{
            return json_encode(['msg'=>"请求失败",'sta'=>"1",'data'=>""],JSON_UNESCAPED_UNICODE);
        }
    }
}
