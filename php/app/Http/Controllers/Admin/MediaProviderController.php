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

    /**
     * @return mixed
     * //媒体供应商订单列表
     */
    public function Event_list(){
        //查询用户所属媒体
       $Media=Media_community::find(Auth::user()->media_id);
       $media_id=$Media->id;

            //查询媒体未处理订单
            $result=DB::select("select start_time,end_time,order_code,media_id,news_type,title,price from news WHERE  instr(concat(',',media_id,','),',$media_id,')<>0  order by id DESC ;");
        //$order_list=News::where('media_id','5')->where('status',1)->select('start_time','end_time','order_code','media_id','news_type','title','price')->get();
       // dd($order_list);

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
