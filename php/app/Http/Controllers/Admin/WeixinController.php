<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\User;
use Auth;
use Log;
use Exception;
use Illuminate\Http\Request;
use Socialite;
use SocialiteProviders\Weixin\Provider;

class WeixinController extends Controller{
    /**
     * @param Request $request
     * @return mixed
     * 发送微信登陆请求
     */
    public function redirectToProvider(Request $request)
    {
        return Socialite::with('weixin')->redirect();
    }

    /**
     * @param Request $request
     * 微信返回数据
     *
     */
    public function handleProviderCallback(Request $request)
    {

        $user_data = Socialite::with('weixin')->user();
        //todo whatever
    }
}