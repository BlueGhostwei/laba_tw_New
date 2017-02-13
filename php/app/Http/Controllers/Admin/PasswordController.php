<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Input;

use App\Http\Controllers\Controller;

class PasswordController extends Controller
{

    public function getIndex(Request $request)
    {
        $data = $request->all();
        if (Controller::isMobile($data)) {
            //判断用户是否注册
            $set_user = User::where(['username' => $data])->select('id')->get()->toArray();
            if (empty($set_user)) {
                return json_encode(['msg' => '该手机用户未注册', 'sta' => 1, 'data' => '']);
            }
            $get_send = Redis::exists('user_find_password');
            if ($get_send) {
             if($get_send['user_phone']==$data){
                 $this_time=time()+300;
                 if($get_send['time']>$this_time){
                   //清空缓存
                   return json_encode(['msg'=>'您的操作太频繁，请稍后再试','sta'=>1,'data'=>''],JSON_UNESCAPED_UNICODE);
                 }
                 Redis::forget('user_find_password');
                 //生成随机验证码
                 //获取验证码
                 $randStr = str_shuffle('1234567890');
                 $rand = substr($randStr, 0, 4);//4位参数
                 //发送短信
                 //接收发送状态，如果发送成功，写入缓存
                 $array = array(
                     'user_phone' => $data,
                     'time' => time(),
                     'num' => 1,
                     'code' => $rand
                 );
                 Redis::set('user_find_password', $array);
                 return json_encode(['msg' => '发送成功', 'sta' => 0, 'data' => ''], JSON_UNESCAPED_UNICODE);
             }
            } else {
                //生成随机验证码
                //获取验证码
                $randStr = str_shuffle('1234567890');
                $rand = substr($randStr, 0, 4);//4位参数
                //发送短信
                //接收发送状态，如果发送成功，写入缓存
                $array = array(
                    'user_phone' => $data,
                    'time' => time(),
                    'num' => 1,
                    'code' => $rand
                );
                Redis::set('user_find_password', $array);
                return json_encode(['msg' => '发送成功', 'sta' => 0, 'data' => ''], JSON_UNESCAPED_UNICODE);
            }


        } else {
            return json_encode(['msg' => '手机号码错误，请重新输入', 'sta' => 1, 'data' => ''], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * 验证验证码
     */
    public function postIndex()
    {

    }

}
