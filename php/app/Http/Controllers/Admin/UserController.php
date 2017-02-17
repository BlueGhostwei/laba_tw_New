<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;
use Validator;
use Redirect;
use Auth;
use Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    /**
     * @return mixed
     * 登录页面
     */
    public function getLogin()
    {
        return view('Admin.user.login');

    }

    /**
     * @return mixed
     * 用户请求注册页面
     */
    public function getRegister()
    {
        return view('Admin.user.register');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     * 验证用户登录
     */
    public function post_login(Request $request)
    {
        $username = Input::get('username');
        $password = Input::get('user_password');
        $remember = Input::get('remember', false);
        //判断用户手机号码
        if (Controller::isMobile(Input::get('username')) == false) {
            return json_encode(["msg" => "请输入正确的手机号码", "sta" => 1, "data" => ""], JSON_UNESCAPED_UNICODE);
        }
        //验证用户
        $set_user = User::where(['username' => Input::get("username"), 'deleted_at' => null])->get()->toArray();
        if (empty($set_user)) {
            return json_encode(["msg" => "用户不存在，请注册", "sta" => 1, "data" => ""], JSON_UNESCAPED_UNICODE);
        }
        //判断用户状态是否锁定

        //定义验证验证码规则
        $rules = [
            "user_code" => 'required|captcha'
        ];
        $messages = [
            'user_code.required' => '请输入验证码',
            'user_code.captcha' => '验证码错误，请重试'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);//验证码错误！
        } else {
            //通过验证
            $rst = Auth::attempt(['username' => $username, 'password' => $password], $remember);
            if ($rst == true) {

                return redirect()->intended('/');//登录成功，跳转页面
            } else {
                return Redirect::back()->withErrors('用户名或者密码错误')->withInput();
            }

        }

    }

    /**
     * @param Request $request
     * @return mixed
     * user_SMS
     * 获取手机号码。手机验证码，判断时间，判断验证码,密码
    data['mobile_number']=$('#mobile_number').val();
    data['password']=$('#user_password').val();
    data['user_code']=$('#user_code').val();
    data['confirm']=$('#confirm').val();
     */
    public function postRegister(Request $request)
    {
        $data=$request->all();
        
        dd($data);
        $user_SMS = Redis::exists('user_SMS');
        if ($user_SMS == 1 && $data) {
            $user['phone'] = $data['mobile_number'];
            $user['code'] = $data['user_code'];
            dd($user);
            $send_num_data = Redis::get('user_SMS');
            $send_num = json_decode($send_num_data, true);
            if ($user['code'] == $send_num['code']) {
                if ($user['phone'] != $send_num['user_phone']) {
                    return json_encode(['msg' => "验证用户不一致！", 'sta' => "1", 'data' => ''],JSON_UNESCAPED_UNICODE);
                }
                $user = new User();
                $validate = Validator::make($request->all(), $user->rules()['create']);
                $messages = $validate->messages();
                if ($validate->fails()) {
                    $msg = $messages->toArray();
                    foreach ($msg as $k => $v) {
                        return json_encode(['sta' => "0", 'msg' => $v[0], 'data' => ''],JSON_UNESCAPED_UNICODE);
                    }
                }
                $data = $user->create($request->only($user->getFillable()));
                //  $data = User::where(['username'=>$request->username])->update(['created_by' => Auth::id()]);
                if ($data) {
                    Redis::del('user_SMS');
                    return json_encode(['sta' => "0", 'msg' => '注册成功', 'data' => $data->id], JSON_UNESCAPED_UNICODE);
                }
            } else {
                return json_encode(['msg' => "验证码错误", 'sta' => "1", 'data' => '']);
            }
        }
        return json_encode(['sta' =>"1", 'msg' => '请求失败', 'data' => ''], JSON_UNESCAPED_UNICODE);

    }

    /**
     * @return mixed
     */
      public function user_info(){
          $id=Auth::id();
          $type=Input::get('type');
          if(!empty($type) && $type=="update_info"){
            $user=User::find($id);
              if(!empty($user)){
                  dd(Input::all());
                  $rst = User::where('id', $id)->update(['deleted_at' => NULL]);
              }
          }
       return view('Admin.user.info');
      }


}
