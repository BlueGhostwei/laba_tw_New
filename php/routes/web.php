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



Route::get('/alipay/webnotify', ['as' => 'website.pay', 'uses' => 'Admin\PayController@webnotify']);
Route::get('/alipay/webreturn', ['as' => 'website.pay', 'uses' => 'Admin\PayController@webreturn']);
Route::get('qrcode',['as' => 'qrcode', 'uses' => 'Admin\QrcodeController@index']);



//Route::get('/', function () {return view('welcome');});
//游客路由
Route::group(['middleware' => 'guest'], function () {
    Route::group(['namespace' => 'Admin'], function () {
        Route::get('yanzheng/test',['as'=>'captcha.test','uses'=>'CaptchaController@index']);//验证码
        Route::get('yanzheng/mews',['as'=>'captcha.mews','uses'=>'CaptchaController@mews']);  //生成
        Route::any('yanzheng/cpt',['as'=>'captcha.cpt','uses'=>'CaptchaController@cpt']); //验证验证码
        //微信登陆
        Route::get('auth/weixin', 'WeixinController@redirectToProvider');
        Route::get('auth/weixin/callback', 'WeixinController@handleProviderCallback');
        //登陆注册
        Route::get('Admin/user/login', ['as' => 'user.login', 'uses' => 'UserController@getLogin']);
        Route::post('Admin/user/post_login',['as' => 'user.post_login', 'uses' => 'UserController@post_login']);
        Route::post('Admin/user/Api_postLogin',['as' => 'user.Api_postLogin', 'uses' => 'UserController@Api_postLogin']);
        Route::get('Admin/user/register', ['as' => 'user.register', 'uses' => 'UserController@getRegister']);
        Route::post('Admin/user/register', 'UserController@postRegister');//注册提交
        //sms短信接口
        Route::post('Admin/send/sms',['as'=>'send.sms','uses'=>'SMSController@index']);
        //找回密码
        Route::get('Admin/password', ['as' => 'Admin.find_password', 'uses' => 'PasswordController@getIndex']);
        Route::get('Admin/password/pass_find', ['as' => 'Admin.pass_find', 'uses' => 'PasswordController@pass_find']);
        Route::get('Admin/password/pass_find_second', ['as' => 'Admin.pass_find_second', 'uses' => 'PasswordController@pass_find_second']);
        Route::post('Admin/password/pass_find_send', ['as' => 'Admin.pass_find_send', 'uses' => 'PasswordController@pass_find_send']);
        Route::get('Admin/password/pass_Overlay', ['as' => 'Admin.pass_Overlay', 'uses' => 'PasswordController@pass_find_Overlay']);
        Route::get('Admin/password/pass_info', ['as' => 'Admin.pass_info', 'uses' => 'PasswordController@pass_info']);
        Route::post('Admin/password/pass_Overlay','PasswordController@pass_find_update');
        Route::any('Admin/password/pass_find_api','PasswordController@pass_find_api');
        Route::post('Admin/password/getuser', ['as' => 'Admin.pass.getuser', 'uses' => 'PasswordController@getuser']);
        Route::post('Admin/password/email', ['as' => 'pass.email', 'uses' => 'PasswordController@send_email']);//邮件
        Route::post('Admin/find_password', 'PasswordController@postIndex');

       // Route::resource('Admin/find_password','PasswordController');
        //验证登录状态
        Route::get('Admin/user/checklogin',['as'=>'user.checklogin','uses'=>'UserController@_checkLogin']);
        Route::any('Admin/get_token',['as'=>'set.token','uses'=>'UserController@Set_token']); //生成_token

    });

});
//需要登陆并需要权限登陆（acl）的路由
Route::group(['middleware' => ['auth','acl']], function () {
    Route::group(['namespace' => 'Admin'], function () {
        //平台分类管理
        Route::get('Admin/category/index',['as'=>'category.index','uses'=>'CategoryController@index'] );
        Route::get('Admin/category/store',['as'=>'category.store','uses'=>'CategoryController@store'] );
        Route::get('Admin/category/show',['as'=>'category.show','uses'=>'CategoryController@show'] );
        Route::post('Admin/category/save',['as'=>'category.save','uses'=>'CategoryController@create_category']);  //保存分类
        Route::post('Admin/category/cate_dele',['as'=>'category.cate_dele','uses'=>'CategoryController@cate_dele']);  //分类删除
        Route::get('Admin/category/media_from',['as'=>'category.media_from','uses'=>'CategoryController@media_from']);  //创建媒体
        Route::post('Admin/category/media_save',['as'=>'category.media_save','uses'=>'CategoryController@media_save']);  //保存媒体
        Route::get('Admin/category/media_List',['as'=>'category.media_List','uses'=>'CategoryController@media_List']);  //媒体列表
        Route::get('Admin/category/media_List_update/{id}',['as'=>'category.media_List_update','uses'=>'CategoryController@media_List_update']);  //媒体修改
        Route::get('Admin/category/media_List_dele',['as'=>'category.media_List_dele','uses'=>'CategoryController@media_List_dele']);  //媒体删除
        //首页
        Route::get('/',['as'=>'admin.dashboard','uses'=>'DashboardController@index'] );
       //网络媒体
        Route::get('Admin/media/release',['as'=>"media.release",'uses'=>'MediaController@index']);
        Route::post('Admin/media/Member_order',['as'=>"media.Member_order",'uses'=>'MediaController@Member_order']);//会员订单（新闻发布提交）
        Route::post('Admin/media/release','MediaController@index');
        Route::get('Admin/media/market',['as'=>'media.market','uses'=>'MediaController@Encyclopedia']);//百科
        Route::get('Admin/media/Short_video',['as'=>'media.Short_video','uses'=>'MediaController@Short_video']);//短视频
        Route::get('Admin/media/Public_Wechat',['as'=>'media.Public_Wechat','uses'=>'MediaController@Public_Wechat']);//公众号
        Route::get('Admin/media/forum',['as'=>'media.forum','uses'=>'MediaController@forum']);//论坛
        Route::get('Admin/media/Second_shot',['as'=>'media.Second_shot','uses'=>'MediaController@Second_shot']);//秒拍
        Route::get('Admin/media/Copy_plan',['as'=>'media.Copy_plan','uses'=>'MediaController@Copy_plan']);//文案策划
        Route::post('Admin/media/Copy_plan','Copy_panController@create');//文案策划
        Route::get('Admin/media/Wechat_market',['as'=>'media.Wechat_market','uses'=>'MediaController@Wechat_market']);//微信营销
        //个人中心
        Route::get('Admin/user/info',['as'=>'member.info','uses'=>'UserController@user_info']);
        Route::get('Admin/user/safety_set',['as'=>'member.safety_set','uses'=>'UserController@safety_set']);
        Route::get('Admin/user/order_list',['as'=>'user.order_list','uses'=>'UserController@order_list']);//会员订单列表
        Route::post('Admin/user/order_list','UserController@order_redirect');//会员订单跳转
        Route::post('Admin/user/Settlement',['as'=>'user.Settlement','uses'=>"UserController@Settlement"]);//结算订单
        Route::get('Admin/pay/results',['as'=>'pay.results','uses'=>'UserController@Jump_page']);  //支付页面跳转
        Route::get('Admin/order/details/{id}',['as'=>'order.details','uses'=>'MediaProviderController@order_details']);  //支付页面跳转
        Route::get('Admin/user/safety_update/{s1}',['as'=>'member.safety_update','uses'=>'UserController@safety_update']);

        //用户中心
        Route::get('Admin/user/ginfo','UserController@update_info');//会员信息
        Route::get('Admin/user/Onlnetop_up',['as'=>'member.Onlnetop_up','uses'=>'UserController@Onlnetop_up']);//在线充值
        Route::get('Admin/user/logout', ['as' => 'user.logout', 'uses' => 'UserController@getLogout']);
        //媒体供应商
        Route::get('Admin/vider/Event_list',['as'=>'vider.Event_list','uses'=>'MediaProviderController@Event_list']);//订单列表
        Route::get('Admin/vider/user_center',['as'=>'vider.user_center','uses'=>'MediaProviderController@user_center']);//用户中心
        Route::get('Admin/vider/bill_query',['as'=>'vider.bill_query','uses'=>'MediaProviderController@bill_query']);

        // 文件上传, 图片处理
        Route::post('upload', 'UploadController@index');
        Route::post('upload/encode', 'UploadController@encode');
        Route::post('upload/Cut_out','UploadController@Cut_out');//剪切图片
        Route::get('/files/{s1}/{s2}/{s3}/{file}', 'ImageController@index');
        Route::get('upload/config', 'UploadController@config');
        //支付宝支付
        Route::get('/pay', ['as' => 'website.pay', 'uses' => 'PayController@index']);
        //网页支付
        Route::get('/mobile_pay', ['as' => 'website.mobile_pay', 'uses' => 'PayController@mobile_pay']);//手机支付
        Route::get('/alipay/alipayNotify', ['as' => 'website.alipayNotify', 'uses' => 'PayController@alipayNotify']);//手机回调
        //微信支付

        //网银支付

        Route::get('acl/role/index', ['as' => 'acl.role.index', 'uses' => 'AclRoleController@index']);
        /* Route::get('acl/role/edit/{id}', ['as' => 'acl.role.edit', 'uses' => 'AclRoleController@edit']);*/
        //Route::post('acl/role/update/{id}', ['as' => 'acl.role.update', 'uses' => 'AclRoleController@update']);
       /* Route::get('acl/resource/index', ['as' => 'acl.resource.index', 'uses' => 'AclResourceController@index']);
        Route::get('acl/role/edit/{id}', ['as' => 'acl.role.edit', 'uses' => 'AclRoleController@edit']);

        Route::get('acl/role/index', ['as' => 'acl.role.index', 'uses' => 'AclRoleController@index']);*/
        // 权限配置inde
        // 权限配置
        Route::any('/admin/acl/resource', ['as' => 'admin.acl.resource.index', 'uses' => 'AclResourceController@index']);
        Route::any('/admin/acl/role', ['as' => 'admin.role.index', 'uses' => 'AclRoleController@index']);
        Route::get('/acl/role/user_edit/{id}', ['as' => 'acl.role.user_edit', 'uses' => 'AclRoleController@user_edit']);
        Route::get('/acl/role/edit/{id}', ['as' => 'acl.role.edit', 'uses' => 'AclRoleController@edit']);
       // Route::post('/acl/role/update/{id}', ['as' => 'acl.role.update', 'uses' => 'AclRoleController@update']);
        Route::any('/acl/role/user_role_update/{id}', ['as' => 'acl.role.user_role_update', 'uses' => 'AclRoleController@user_role_update']);

        Route::resource('/acl/resource', 'AclResourceController');
        Route::resource('/acl/role', 'AclRoleController');
        Route::resource('/acl/user', 'AclUserController');
        Route::any('user_role', 'AclUserController@user_role');



        Route::get('/system/logs', ['as' => 'system.logs', 'uses' => 'SystemController@logs']);
        Route::get('/system/action', ['as' => 'system.action', 'uses' => 'SystemController@action']);
        Route::get('/system/login-history', ['as' => 'system.login-history', 'uses' => 'SystemController@loginHistory']);
        //ios Api
        Route::any('Admin/set_cate',['as'=>'set.set_cate','uses'=>'MediaController@set_cate']); //发布新闻分类列表
        Route::any('Admin/selec_key',['as'=>'set.selec_key','uses'=>'MediaController@selec_key']);
        Route::any('Admin/security/_data_con', ['as' => 'user.security', 'uses' => 'UserController@_data_con']);//密保问题
        Route::any('Admin/user/_user_data',['as'=>'member._user_info','uses'=>'UserController@_user_data']);//用户信息
        Route::post('Admin/question',['as'=>'admin.question','uses'=>'UserController@get_security_question_api']);
        Route::post('Admin/check_question',['as'=>'admin.check_questions','uses'=>'UserController@check_question']);
        Route::get('/Admin/user/_logout',['as'=>'member._logout','uses'=>'UserController@_logout']);//用户退出
        Route::any('Admin/reset',['as'=>'admin.reset','uses'=>'UserController@getResetUsername']);
        Route::any('Admin/resetphone',['as'=>'admin.resetphone','uses'=>'UserController@resetPhone']);


        Route::get('Admin/userlist',['as'=>'admin.userlist','uses'=>'UserController@userManage']);//用户列表
        Route::get('Admin/addUser',['as'=>'admin.adduser','uses'=>'UserController@addUser']);
        Route::post('Admin/modify_info',['as'=>'admin.modify_info','uses'=>'UserController@addUser_api']);
        Route::post('Admin/search_user',['as'=>'admin.search_user','uses'=>'UserController@getUserList']);
        Route::get('Admin/search_user',['as'=>'admin.search_user','uses'=>'UserController@getUserList']);

        Route::get('Admin/getnewslist',['as'=>'admin.getnewslist','uses'=>'DashboardController@getNewslist']);

        Route::get('Admin/getnewspage',['as'=>'admin.getnewspage','uses'=>'DashboardController@getNewspage']);

        Route::get('Admin/searchnews',['as'=>'admin.searchnews','uses'=>'DashboardController@searchNews']);
        Route::get('Admin/searchnewspage',['as'=>'admin.searchnewspage','uses'=>'DashboardController@searchNewspage']);
//        Route::get('/Admin/test',['uses'=>'UserController@test']);

        Route::get('Admin/withdraw',['as'=>'admin.withdraw','uses'=>'UserController@show_withdraw']);

        Route::post('Admin/newuser',['as'=>'admin.newuser','uses'=>'UserController@get_new_user']);

        Route::post('Admin/getwithdraw',['as'=>'admin.getwithdraw','uses'=>'UserController@get_withdraw_data']);
        Route::post('Admin/withdraw',['as'=>'admin.withdraw','uses'=>'UserController@withdraw']);
        Route::get('Admin/withdrawlist',['as'=>'admin.withdrawlist','uses'=>'UserController@show_withdraw_list']);
        Route::get('Admin/getnews','DashboardController@getnews');
    });

});