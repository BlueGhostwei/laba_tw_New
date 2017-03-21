<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media_community;
use App\Models\News;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;

class MediaProviderController extends Controller
{
    public function index(){

    }

    public function create(){

    }

    /**
     * @return mixed
     */
    public function Event_list(){


        //查询用户所属媒体
       $Media=Media_community::find(Auth::user()->media_id);
        //查询媒体未处理订单
        $order_list=News::where('media_id','5')->where('status',1)->select('start_time','end_time','order_code','media_id','news_type','title','price')->get();
       // dd($order_list);

      return view('Admin.vider.event_list');
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
