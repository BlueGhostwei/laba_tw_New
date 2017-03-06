<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Validation\Rules\In;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;
use  Validator;
use Session;
use Input;
use Mail;
use Illuminate\Support\Facades\Redis;
use Redirect;
use App\Models\SendSMS;
use App\Http\Controllers\Controller;
date_default_timezone_set("Asia/Shanghai");
class PasswordController extends Controller
{

    /**
     * @return mixed
     */

    public function pass_find()
    {
        return view('Admin.pass.pass_index');
    }

    /**
     * @param Request $request
     * @return $this
     *
     *
     */
    public function pass_find_second(Request $request)
    {
        $user_num = Input::get('username');
        if (!empty($user_num)) {
            return view('Admin.pass.pass_index2', ['user_num' => $user_num]);
        } else {

            return Redirect::back()->withErrors("请求错误，请刷新页面重试")->withInput();
        }
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     * 验证手机/邮箱验证码
     */
    public function pass_find_send()
    {
        $username = Input::get('username');
        $user_email = Input::get('user_email');
        $user_code = Input::get('user_code');
        $send_type = Input::get('send_type');
        if ($send_type != null && $send_type == 0) {
            $user_tel = Input::get('user_tel');
            $sel_user = User::where('user_phone', $user_tel)->orWhere('username', $username)->select('id')->get()->toArray();
            if (!empty($sel_user)) {
                //发送手机验证码
                $set_user = Redis::get('user_SMS');
                $v1 = json_decode($set_user, true);
                if ($v1['type'] == 'find_pass' && $user_tel == $v1['user_phone']) {
                    if ($v1['code'] == $user_code) {
                        $end_time=$v1['Send_time'];
                        $endtime = date('Y-m-d H:i:s', $end_time + 180);
                        $this_time = date('Y-m-d H:i:s', time());
                        $second = intval((strtotime($this_time) - strtotime($endtime)) % 86400);
                        if ($second <> 0 && $second < 0) { //小于零
                            $array2 = array(
                                'user_phone' => $user_tel,
                                'Send_time' => time(),
                                'code' => $user_code,
                                'type' => 0,
                                'sta' => true
                            );
                            Redis::del('uses_SMS');
                            Redis::set('uses_find', json_encode($array2));
                            return Redirect::route('Admin.pass_Overlay', ['username' => $username]);
                        }else{
                            Redis::del('uses_SMS');
                            return Redirect::back()->withErrors('验证失败，验证超时！')->withInput();
                        }
                    } else {
                        return Redirect::back()->withErrors('验证码错误！')->withInput();
                    }
                } else {
                    return Redirect::back()->withErrors('请求错误，请刷新页面重试')->withInput();
                }
            } else {
                return Redirect::back()->withErrors('该手机号码与用户绑定的手机号码不一致')->withInput();
            }

        }else{
            //邮箱验证
            $set_user = Redis::get('pass_email');
            $v1 = json_decode($set_user, true);
            if($username==$v1['username'] && $user_email==$v1['user_Eail'] && $user_code==$v1['user_code']){
                //时间判断
                $end_time=$v1['send_time'];
                $endtime = date('Y-m-d H:i:s', $end_time + 180);
                $this_time = date('Y-m-d H:i:s', time());
                $second = intval((strtotime($this_time) - strtotime($endtime)) % 86400);
                if ($second <> 0 && $second < 0) { //小于零
                    $array2 = array(
                        'pass_email' => $user_email,
                        'Send_time' => time(),
                        'code' => $user_code,
                        'type' => 1,
                        'sta' => true
                    );
                    Redis::del('pass_email');
                    Redis::set('uses_find',json_encode($array2));
                    return Redirect::route('Admin.pass_Overlay', ['username' => $username]);
                }else{
                    return Redirect::back()->withErrors('请求失败,验证超时')->withInput();
                }


            }else{
                return Redirect::back()->withErrors('验证失败，参数错误')->withInput();
            }


        }
    }

    /**
     *
     * 重置密码
     */
    public function pass_find_Overlay()
    {
        $user=Input::get('username');
        return view('Admin.pass.pass_index3',['username'=>$user]);
    }

    /**
     * @return mixed
     *
     */
    public function pass_find_update(){
        $type = Input::get('type');
        $user = Input::get('username');
        $user_pass = Input::get('password');
        if (!empty($type) && $type == "find_pass") {
            $find_redis = Redis::get('uses_find');
            $rvb = json_decode($find_redis, true);
            if (!empty($rvb)) {
                if (isset($rvb['user_phone']) && $rvb['user_phone'] == $user && $rvb['sta'] == true && $rvb['sta']==0) {
                    Redis::del('uses_find');
                    $result= User::where('username', $user)->update(['password' => bcrypt($user_pass)]);
                    return json_encode(['msg' => '请求成功', 'sta' => 1, 'data' => '']);
                }elseif($user && $rvb['sta'] == true && $rvb['sta']==1){
                    Redis::del('uses_find');
                    $result= User::where('username', $user)->update(['password' => bcrypt($user_pass)]);
                    return json_encode(['msg' => '请求成功', 'sta' => 0, 'data' => '']);
                }
            } else {
                Redis::del('uses_find');
                return json_encode(['msg' => '请求失败', 'sta' => 1, 'data' => '']);
            }
        }
    }

    public function pass_info(){
        return view('Admin.pass.pass_info');
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function getuser(Request $request)
    {
        $rules = array(
            'username' => "required",
            'user_code' => "required|captcha|min:4"
        );
        $message = array(
            'username:required' => "请输入用户名",
            'user_code:required' => "请输入验证码",
            'user_code:min' => "验证码错误",
            'user_code.captcha' => '验证码错误，请重试'
        );
        if (empty($request->username)) {
            return Redirect::back()->withErrors("请输入用户名")->withInput();
        }
        $set_user = User::where('username', $request->username)->get()->toArray();
        if (!empty($set_user)) {
            $Validator = Validator::make($request->all(), $rules, $message);
            if ($Validator->fails()) {
                return Redirect::back()->withErrors($Validator->errors())->withInput();
            } else {
                //保存申请用户信息（时限）
                return Redirect::route('Admin.pass_find_second', ['username' => $request->username]);
            }
        } else {
            return Redirect::back()->withErrors("该用户尚未注册")->withInput();
        }

    }

    /**
     * @param Request $request
     * @return mixed
     *
     *
     */
    /*public function getIndex(Request $request)
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
                    $this_time = date("Y-m-d H:i:s", time());
                    $sendtime = date("Y-m-d H:i:s", $get_send['time']);
                    $second = floor((strtotime($sendtime) - strtotime($this_time)) % 86400 % 60);
                    if ($second > 0 && $second !== 0) {
                        //清空缓存
                        return json_encode(['msg' => '您的操作太频繁，请在' . $second . '秒后再试', 'sta' => 1, 'data' => ''], JSON_UNESCAPED_UNICODE);
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
                            'time' => time() + 120,
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
                    'time' => time() + 120,
                    'num' => 1,
                    'code' => $rand
                );
                Session::set('user_find_password', $array);
                return json_encode(['msg' => '发送成功', 'sta' => 0, 'data' => ''], JSON_UNESCAPED_UNICODE);
            }
        } else {
            return json_encode(['msg' => '手机号码错误，请重新输入', 'sta' => 1, 'data' => ''], JSON_UNESCAPED_UNICODE);
        }
    }*/


    /**
     * @return mixed
     *
     *
     */
    public function send_email()
    {
        if(!empty(Input::get('username')) && !empty(Input::get('user_email'))){
            $result= User::where('username',Input::get('username'))->orWhere('user_Eail',Input::get('user_email'))->select('id')->get()->toArray();
            //调用邮件接
            if(!empty($result)){
                $rand_code=Controller::get_random();
                $msg="尊敬的用户，您的验证码是：".$rand_code;
               // $msg="尊敬的用户";
                Mail::raw($msg,function($message){
                    $message->subject('亚媒社');
                    $message->to(trim(Input::get('user_email')));
                });
                $array=array(
                    'username'=>Input::get('username'),
                    'user_Eail'=>Input::get('user_email'),
                    'user_code'=>$rand_code,
                    'send_time'=>time(),
                    'type'=>'find_pass',
                );
                Redis::set('pass_email',json_encode($array));
                return json_encode(['msg' => '邮件发送成功', 'sta' => 0, 'data' => $rand_code], JSON_UNESCAPED_UNICODE);
            }else{
                return json_encode(['msg' => '邮件发送失败，用户未绑定邮箱或邮箱错误', 'sta' => 1, 'data' => ''], JSON_UNESCAPED_UNICODE);
            }
        }else{
            return json_encode(['msg' => '邮件发送失败，请完善信息', 'sta' => 1, 'data' => ''], JSON_UNESCAPED_UNICODE);
        }
    }



}
