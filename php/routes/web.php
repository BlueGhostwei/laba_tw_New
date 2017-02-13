<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/', function () {return view('welcome');});
//游客路由
Route::group(['middleware' => 'guest'], function () {
    Route::group(['namespace' => 'Admin'], function () {
        //验证码
        Route::get('yanzheng/test',['as'=>'captcha.test','uses'=>'CaptchaController@index']);
        //生成
        Route::get('yanzheng/mews',['as'=>'captcha.mews','uses'=>'CaptchaController@mews']);
        //验证验证码
        Route::any('yanzheng/cpt',['as'=>'captcha.cpt','uses'=>'CaptchaController@cpt']);
        //微信登陆
        Route::get('auth/weixin', 'WeixinController@redirectToProvider');
        Route::get('auth/weixin/callback', 'WeixinController@handleProviderCallback');
        //登陆注册
        Route::get('Admin/user/login', ['as' => 'user.login', 'uses' => 'UserController@getLogin']);
        Route::post('Admin/user/post_login',['as' => 'user.post_login', 'uses' => 'UserController@post_login']);
        Route::get('Admin/user/register', ['as' => 'user.register', 'uses' => 'UserController@getRegister']);
        Route::post('Admin/user/register', 'UserController@postRegister');
        //sms短信接口
        //Route::post('Admin/send/sms',['as'=>'send.sms','uses'=>'UserController@postRegister']);
        Route::post('Admin/send/sms',['as'=>'send.sms','uses'=>'SMSController@index']);

    });

});
//需要登陆并需要权限登陆（acl）的路由
Route::group(['middleware' => 'auth'], function () {
   // echo 34342;die;
    Route::group(['namespace' => 'Admin'], function () {
        Route::get('/',['as'=>'admin.dashboard','uses'=>'DashboardController@index'] );
    //网络媒体
        Route::get('Admin/media/release',['as'=>"media.release",'uses'=>'MediaController@index']);
    });
});