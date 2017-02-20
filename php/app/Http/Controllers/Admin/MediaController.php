<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    //
    public function  index(){
        return view('Admin.media.index');
    }

    //百科营销
    public function Encyclopedia(){
         return view('Admin.media.market');
    }
    //短视频
    public function Short_video(){
        return view('Admin.media.short_video');
    }
    //微信公众号
    public function Public_Wechat(){
        return view('Admin.media.wechat');
    }
    //论坛
    public function forum(){
        return view('Admin.media.forum');
    }
    //秒拍
    public function Second_shot(){
        return view('Admin.media.second_shot');
    }
    //文案策划
    public function Copy_plan(){
        return view('Admin.media.copy_plan');
    }
    //微信营销
    public function Wechat_market(){
        return view('Admin.media.wechat_market');
    }


}
