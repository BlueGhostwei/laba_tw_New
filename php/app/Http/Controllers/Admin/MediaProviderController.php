<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media_community;
use App\Models\News;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class MediaProviderController extends Controller
{
    public function index(){

    }

    public function create(){

    }

    public function order_details($id){
        //查询news表
      $result=News::find($id);
      return view('Admin.order.details',['news_data'=>$result]);
    }

    /**
     *判断用户角色，修改相应得数据状态，发送消息队列
     */
    public function  Save_Feedback(Request $request){
        dd($request->all());



    }

    /**
     * @return string
     * 发送系统提示消息
     */
    public function save()
    {
        return $this->validatesRequestErrorBag;
    }

    /**
     * @return mixed
     * //媒体供应商订单列表
     */
    public function Event_list(){
        //查询用户所属媒体
       $Media=Media_community::find(Auth::user()->media_id);
       $media_id=$Media->id;
            //查询媒体未处理订单
            $result=DB::select("SELECT id,start_time,end_time,order_code,media_id,news_type,title,price FROM news WHERE  instr(concat(',',media_id,','),',$media_id,')<>0 AND status = 2 ORDER BY id DESC ;");
      return view('Admin.vider.event_list',['result'=>$result]);
    }


    /**
     * @return mixed
     */
    public function user_center(){
        return view('Admin.vider.user_index');
    }

    public function Bill_query()
    {
        return view('Admin.vider.bll_query');
    }



}
