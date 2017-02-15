<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\Redis;

class SMSController extends Controller
{

    public function index(Request $request)
    {
        //获取手机号码
        $mobile_number = Input::get("moblie_number");
       /* $array = array(
            'user_phone' => $mobile_number,
            'Send_time' => time() + 120,
            'code' => '1231',
            'type' => 'login'
        );
        Redis::set('user',json_encode($array));
        dd(Redis::get('user'));*/
       /* $rst=Controller::isMobile($mobile_number);
        dd($rst);*/
        //判断用户是否已注册
        $set_user = User::where(['username' => $mobile_number])->select('id')->get()->toArray();

        if (!empty($set_user)) {
            return json_encode(["msg" => "用户已注册，请登陆", "sta" => "1", "data" => ""],JSON_UNESCAPED_UNICODE);
        } else {
            /**
             * 调用sms短息接口
             * 返回接口状态
             * register 注册
             **/
            $send_SMS = Controller::send_sms($mobile_number, "register");
            dd($send_SMS);
            if ($send_SMS['sta'] == 0) {
                return json_encode(['msg' => '短信发送成功', 'sta' => 0, 'data' => ""], JSON_UNESCAPED_UNICODE);
            } else {
                return json_encode(['msg' => $send_SMS['msg'], 'sta' => 1, 'data' => ''], JSON_UNESCAPED_UNICODE);
            }
        }
    }

}
