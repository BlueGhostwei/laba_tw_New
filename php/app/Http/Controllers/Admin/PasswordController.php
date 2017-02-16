<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Input;

use App\Http\Controllers\Controller;

class PasswordController extends Controller
{

    public function getIndex(Request $request)
    {
        //date_default_timezone_set('Asia/Shanghai');
        // $data = $request->all();
        $data = 13226431320;
        if (Controller::isMobile($data)) {
            //判断用户是否注册
            $set_user = User::where(['username' => $data])->select('id')->get()->toArray();
            if (empty($set_user)) {
                return json_encode(['msg' => '该手机用户未注册', 'sta' => 1, 'data' => '']);
            }
            $get_session = Session::exists('user_find_password');
            if ($get_session) {
                $get_send = Session::get('user_find_password');
                if ($get_send['user_phone'] == $data) {
                    $this_time = date("Y-m-d H:i:s",time());
                    $sendtime=   date("Y-m-d H:i:s",$get_send['time']);
                    $second=floor((strtotime($sendtime)-strtotime($this_time))%86400%60);
                    if ($second > 0 && $second !== 0 ) {
                        //清空缓存
                        return json_encode(['msg' => '您的操作太频繁，请在'.$second.'秒后再试', 'sta' => 1, 'data' => ''], JSON_UNESCAPED_UNICODE);
                    }
                    Session::forget('user_find_password');
                    //生成随机验证
                    $randStr = str_shuffle('1234567890');
                    $rand = substr($randStr, 0, 4);//4位参数
                    //发送接口，发送短信
                    //接收发送状态，如果发送成功，写入缓存
                    $rst = true;
                    if ($rst == true) {
                        $array = array(
                            'user_phone' => $data,
                            'time' => time()+120,
                            'num' => 1,
                            'code' => $rand
                        );
                        Session::set('user_find_password', $array);
                    } else {
                        return json_encode(['msg' => '发送失败', 'sta' => 1, 'data' => ''], JSON_UNESCAPED_UNICODE);
                    }
                    return json_encode(['msg' => '发送成功', 'sta' => 0, 'data' => $rand], JSON_UNESCAPED_UNICODE);
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
                    'time' => time()+120,
                    'num' => 1,
                    'code' => $rand
                );
                Session::set('user_find_password', $array);
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
