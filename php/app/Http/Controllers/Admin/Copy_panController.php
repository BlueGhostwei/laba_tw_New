<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Copy_pan;
use Response;
use Input;
use Auth;
use Validator;


class Copy_panController extends Controller
{
    public function index()
    {

    }

    /**
     * @param Request $request
     *   'text_type' => "required",
     * 'content' => "required",
     * 'number' => "required",
     * 'cycle' => "required",
     * 'article_num' => "required",
     * 'article_price' => "required",
     */
    public function create(Request $request)
    {
        $data=$request->all();
        $data['user_id']=Auth::id();
        dd($data);
        $Copy_pan = new Copy_pan();
        $message = array(
            'title.required'=>'请添加文章标题',
            "text_type.required" => "请选择文章类型",
            "content.required" => "文章内容能为空",
            "number.required" => "请选择文章字数",
            "cycle.required" => "请选择编辑类型",
            "article_num.required" => "请选择篇数",
            "article_price.required" => "价格不能为空",
            );
        $validator = Validator::make($data, $Copy_pan->rules('create'),$message);
        $messages=$validator->messages();
        if($validator->fails()){
            $msg = $messages->toArray();
            foreach ($msg as $k => $v) {
                return json_encode(['sta' => "1", 'msg' => $v[0], 'data' => ''], JSON_UNESCAPED_UNICODE);
            }
        }else{
            //获取价格
            //判断用户财富是否足够支付
            //返回结果

        }

    }

    public function store()
    {

    }

    public function remove()
    {

    }
}
