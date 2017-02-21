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
        //找回密码
        Route::get('Admin/find_password', ['as' => 'Admin.find_password', 'uses' => 'PasswordController@getIndex']);
        Route::post('Admin/find_password', 'PasswordController@postIndex');
    });

});
//需要登陆并需要权限登陆（acl）的路由
Route::group(['middleware' => 'auth'], function () {
   // echo 34342;die;
    Route::group(['namespace' => 'Admin'], function () {

        //平台分类管理
        Route::get('Admin/category/index',['as'=>'category.index','uses'=>'CategoryController@index'] );
        Route::get('Admin/category/store',['as'=>'category.store','uses'=>'CategoryController@store'] );
        Route::get('Admin/category/show',['as'=>'category.show','uses'=>'CategoryController@show'] );
        //保存分类
        Route::post('Admin/category/save',['as'=>'category.save','uses'=>'CategoryController@create_category']);

        //首页
        Route::get('/',['as'=>'admin.dashboard','uses'=>'DashboardController@index'] );
       //网络媒体
        Route::get('Admin/media/release',['as'=>"media.release",'uses'=>'MediaController@index']);
        Route::get('Admin/media/market',['as'=>'media.market','uses'=>'MediaController@Encyclopedia']);//百科
        Route::get('Admin/media/Short_video',['as'=>'media.Short_video','uses'=>'MediaController@Short_video']);//短视频
        Route::get('Admin/media/Public_Wechat',['as'=>'media.Public_Wechat','uses'=>'MediaController@Public_Wechat']);//公众号
        Route::get('Admin/media/forum',['as'=>'media.forum','uses'=>'MediaController@forum']);//论坛
        Route::get('Admin/media/Second_shot',['as'=>'media.Second_shot','uses'=>'MediaController@Second_shot']);//秒拍
        Route::get('Admin/media/Copy_plan',['as'=>'media.Copy_plan','uses'=>'MediaController@Copy_plan']);//文案策划
        Route::get('Admin/media/Wechat_market',['as'=>'media.Wechat_market','uses'=>'MediaController@Wechat_market']);//微信营销
        //个人中心
        Route::get('Admin/user/info',['as'=>'member.info','uses'=>'UserController@user_info']);
        Route::post('Admin/user/info','UserController@update_info');//会员信息
        Route::get('Admin/user/Onlnetop_up',['as'=>'member.Onlnetop_up','uses'=>'UserController@Onlnetop_up']);//在线充值
        Route::get('Admin/user/logout', ['as' => 'user.logout', 'uses' => 'UserController@getLogout']);

        // 文件上传, 图片处理
        Route::post('upload', 'UploadController@index');
        Route::post('upload/encode', 'UploadController@encode');
        Route::post('upload/Cut_out','UploadController@Cut_out');//剪切图片
        Route::get('/files/{s1}/{s2}/{s3}/{file}', 'ImageController@index');
        Route::get('upload/config', 'UploadController@config');
        //支付宝支付
        Route::get('/pay', ['as' => 'website.pay', 'uses' => 'PayController@index']);
        Route::get('/alipay/webnotify', ['as' => 'website.pay', 'uses' => 'PayController@webnotify']);
        Route::get('/alipay/webreturn', ['as' => 'website.pay', 'uses' => 'PayController@webreturn']);//网页支付
        Route::get('/mobile_pay', ['as' => 'website.mobile_pay', 'uses' => 'PayController@mobile_pay']);//手机支付
        Route::get('/alipay/alipayNotify', ['as' => 'website.alipayNotify', 'uses' => 'PayController@alipayNotify']);//手机回调
        //微信支付
        //网银支付
        



        // 权限配置
        Route::resource('/acl/resource', 'AclResourceController');
        Route::resource('/acl/role', 'AclRoleController');
        Route::resource('/acl/user', 'AclUserController');
        Route::any('user_role', 'AclUserController@user_role');
        Route::get('/system/logs', ['as' => 'system.logs', 'uses' => 'SystemController@logs']);
        Route::get('/system/action', ['as' => 'system.action', 'uses' => 'SystemController@action']);
        Route::get('/system/login-history', ['as' => 'system.login-history', 'uses' => 'SystemController@loginHistory']);
    });
});