<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Input;

use App\Http\Controllers\Controller;

class PasswordController extends Controller
{

    public function getIndex(Request $request){
      $data=$request->all();
      if(Controller::isMobile($data)){
          //判断用户是否注册
          $set_user=User::where(['username'=>$data])->select('id')->get()->toArray();
          if(empty($set_user)){
            return json_encode(['msg'=>'该手机用户未注册','sta'=>1,'data'=>'']);
          }
          //生成随机验证码
          //获取验证码
          $randStr = str_shuffle('1234567890');
          $rand = substr($randStr,0,4);//4位参数
          //发送短信



      }else{
          return json_encode(['msg'=>'手机号码错误，请重新输入','sta'=>1,'data'=>''],JSON_UNESCAPED_UNICODE);
      }
    }
    public function postIndex(){

    }
}
