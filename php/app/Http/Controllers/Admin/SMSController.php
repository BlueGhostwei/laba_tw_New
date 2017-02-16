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

    /**
     * @param Request $request
     * @return mixed
     ** 调用sms短息接口
     * 返回接口状态
     * register 注册
     */
    public function index(Request $request)
    {
        //获取手机号码
        $mobile_number = Input::get("moblie_number");
        //判断用户是否已注册
        $set_user = User::where(['username' => $mobile_number])->select('id')->get()->toArray();
        if (!empty($set_user)) {
            return json_encode(["msg" => "用户已注册，请登陆", "sta" => 1, "data" => ""],JSON_UNESCAPED_UNICODE);
        } else {
            $send_SMS = Controller::send_sms($mobile_number, "register");
            if ($send_SMS['sta'] == 0) {
                return json_encode(['msg' => '短信发送成功', 'sta' => 0, 'data' => ""], JSON_UNESCAPED_UNICODE);
            } else {
                return json_encode(['msg' => $send_SMS['msg'], 'sta' => 1, 'data' => ''], JSON_UNESCAPED_UNICODE);
            }
        }
    }

}
