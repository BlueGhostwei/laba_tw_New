<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class SMSController extends Controller
{

    public function index(Request $request){
        //获取手机号码
        $mobile_number=Input::get("moblie_number");
        //判断手机号码格式
        if(Controller::isMobile($mobile_number)){
           //判断用户是否已注册
            $set_user=User::where(['username'=>$mobile_number])->select('id')->get();
            if($set_user){
                return  json_encode(["msg"=>"用户已注册，请登陆","sta"=>"1","data"=>""]);
            }else{
                //判断有效时间

                //获取验证码
                $randStr = str_shuffle('1234567890');
                $rand = substr($randStr,0,4);//4位参数
                //调用sms短息接口
                //记录发送次数与时间
                //返回接口状态

            }
        }else{

        }

        //判断是否已注册
       /* $set_user=User::where(['username'=>$mobile_number])->select('id')->frist();*/

        //获取随机验证码
        //调用sms接口发送短信
        //返回接口状态


    }
   
}
