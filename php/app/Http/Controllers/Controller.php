<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $mobile
     * @return bool
     */
    public function isMobile($mobile)
    {
        if (!is_numeric($mobile)) {
            return false;
        }
        return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
    }

    /**
     * @param int $len
     * @return string
     */
    public function get_random($len = 2)
    {
        //range 是将10到99列成一个数组
        $numbers = range(10, 99);
        //shuffle 将数组顺序随即打乱
        shuffle($numbers);
        //取值起始位置随机
        $start = mt_rand(1, 10);
        //取从指定定位置开始的若干数
        $result = array_slice($numbers, $start, $len);
        $random = "";
        for ($i = 0; $i < $len; $i++) {
            $random = $random . $result[$i];
        }
        return $random;
    }



    /**
     * @param $mob
     * @param null $type
     * @return array
     * 短信接口一，自写短信内容。该接口提交的短信均由人工审核，下发后请联系在线客服。适合：节假日祝福、会员营销群发等。
     * 1、设定微米账号的接口UID和接口密码
     * 2、传入目标手机号码，多个以“,”分隔，一次性调用最多100个号码，示例：139********,138********
     * 3、传入短信内容。必须设置好短信签名，签名规范：
     * 1）短信内容一定要带签名，签名放在短信内容的最前面；
     * 2）签名格式：【***】，签名内容为三个汉字以上（包括三个）；
     * 3）短信内容不允许双签名，即短信内容里只有一个“【】”
     */
    public function send_sms($mob, $type = null)
    {
        $set_type = $this->send_num($mob, $type);
        if ($set_type == true) { //num < 5
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://api.weimi.cc/2/sms/send.html");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                $uid = '5CipH7ou8gpw';
                $pas = 'hbnv53a3';
                $cid = "R7NwD6BxC0Mc";
                $vcode = $this->get_random();
                $p2 = "3";
                curl_setopt($ch, CURLOPT_POSTFIELDS, 'uid=' . $uid . '&pas=' . $pas . '&mob=' . $mob . '&cid=' . $cid . '&p1=' . $vcode . '&p2=' . $p2 . '&type=json');
                $res = curl_exec($ch);
                curl_close($ch);
                if ($res) {
                    $data = json_decode($res, true);
                    if ($data['code'] == 0) {
                        /**
                         * user_phone用户手机号
                         * time发送时间
                         * num发送次数
                         * code 随机验证码
                         * type请求发送类型（注册，找回密码）
                         * 发送次数验证，当发送次数超过5次时，等待20分钟才可再次发送短信
                         */
                        $send_num = Session::get('user_Send_num');
                        if (!empty($send_num)) {
                            $num = $send_num['num']++;
                            Session::forget('user_Send_num');
                            $array2 = array(
                                'num' => $num,
                                'type' => $type,
                                'Send_time' => time()
                            );
                        } else {
                            $array2 = array(
                                'num' => 1,
                                'type' => $type,
                                'Send_time' => time()
                            );
                        }
                        $array = array(
                            'user_phone' => $mob,
                            'Send_time' => time() + 120,
                            'code' => $vcode,
                            'type' => $type
                        );
                        Redis::set('user_SMS', json_encode($array));
                        Redis::set('user_Send_num', json_encode($array2));
                        return array('code'=>$vcode,'sta'=>0);
                    } else {
                        return array('msg' => "短信发送失败，请联系客服！");
                    }
                } else {
                    return  array('msg' => "短信发送失败，请联系客服！");

                }

        } else {
            return $set_type['msg'];
        }
    }

    /**
     * @param $mob
     * @param $type
     * @return bool
     * 当前请求次数 user_Send_num
     * 用户验证码信息 user_SMS
     * 用户注册调用 register
     * 判断手机号码（用户）user_phone
     * 判断发送参数，日期与次数
     * 发送次数等于5，则需等待20分钟才可再次调用；
     * 获取当前请求次数user_Send_num，判断手机号码（用户）是否一致，判断发送日期与当前日期是否一致，判断发送次数是否受限，判断发送时间是否超时；
     * 如果当天请求次数没有达到5次，且超时则清空发送信息记录 user_SMS，return TRUE;   否则 返回错误信息；
     * 如果次数达到5次并没有超时则不发送短信，否则清除发送次数记录 user_Send_num ，return TRUE；
     */

    public function send_num($mob, $type)
    {
       /* var_dump(Redis::get('user_SMS'));
        var_dump(Redis::get('user_Send_num'));die;*/
        if ($this->isMobile($mob)) {
            if ($type == "register") {
                //判断用户是否已注册
                $set_user = User::where(['username' => $mob])->select('id')->get()->toArray();
                if (!empty($set_user)) {
                    return array("msg" => "用户已注册，请登陆", "sta" => "1", "data" => "");
                }
                $send_num_data = Redis::get('user_Send_num');
                $send_num=json_decode($send_num_data,true);
                if (!empty($send_num)) {
                    $send_date = date('Y-m-d', $send_num['Send_time']) == date('Y-m-d', time());//判断日期
                    if($send_date==false){
                        Redis::forget('user_Send_num');
                        return true;
                    }
                    if ($mob == $send_num['user_phone'] && $send_num['num'] == 5 && $send_date == true) {//发送次数等于5，则需等待20分钟才可再次调用
                        $sendtime = $send_num['Send_time'];//发送日期加上20分钟
                        $end_time = $send_num['Send_time'] + 1200;
                        //$second = floor((strtotime($end_time) - strtotime($sendtime)) % 86400 % 60);秒
                        //$minute=floor((strtotime($end_time)-strtotime($sendtime))%86400/60);分
                        $second = floor((strtotime($end_time) - strtotime($sendtime)) % 86400 % 60);
                        if ($second <> 0 || $second > 0) {
                            $msg = "您的操作过于频繁，请在" . $second . "秒后再试";
                            $array = array('msg' => $msg, 'sta' => "1");
                            return $array;
                        } else {
                            Redis::forget('user_Send_num');
                            return true;
                        }
                    } else {
                        $sendtime = $send_num['Send_time'];//发送日期加上2分钟
                        $end_time = $send_num['Send_time'] + 120;
                        $second = floor((strtotime($end_time) - strtotime($sendtime)) % 86400 % 60);
                        if ($second <> 0 && $second > 0) {
                            $msg = "您的操作过于频繁，请在" . $second . "秒后再试";
                            $array = array('msg' => $msg, 'sta' => "1");
                            return $array;
                        } else {
                            Redis::forget('user_SMS');//清空数据
                            return true;
                        }
                    }
                } else {
                    return true;
                }
            } else {
                /**
                 * 别的发送请求
                 */
                return true;
            }
        }else{
            return array('msg' => "短息发送失败，请输入合法的手机号码！");
        }

    }

}
