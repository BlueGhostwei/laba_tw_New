<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="{{url('Admin/css/style.css')}}" rel="stylesheet" type="text/css" />

</head>
<body style="background:url(../img/RELogin.jpg) repeat-x top;">
<div id=RELogin style="">
    <div style=" width:250px; margin:auto;"><a href="{{route('admin.dashboard')}}"><img src="{{url('Admin/img/logolaba.png')}}" style=" width:250px; height:auto"></a></div>
    <div style="width: 850px;HEIGHT: 530px;background:#fff;border-radius:10px;">
        <div class=LoginHead>
            <H1>找回密码</H1>
            <div class=LGRight>&nbsp;</DIV>
        </div>
        <div class="web-width">
            <div class="for-liucheng">
                <div class="liulist for-cur"></div>
                <div class="liulist for-cur"></div>
                <div class="liulist for-cur"></div>
                <div class="liulist for-cur"></div>
                <div class="liutextbox">
                    <div class="liutext for-cur"><em>1</em><br /><strong>输入用户名</strong></div>
                    <div class="liutext for-cur"><em>2</em><br /><strong>验证身份</strong></div>
                    <div class="liutext for-cur"><em>3</em><br /><strong>重置密码</strong></div>
                    <div class="liutext for-cur"><em><img src="{{url('Admin/img/Bpass1.png')}}" /></em><br /><strong>完成</strong></div>
                </div>
            </div>
            <div class="forget-pwd" style="margin-top:80px; width:350px;">
                <dd style="width:30px; height:150px;float:left;"><em><img src="{{url('Admin/img/Bpass1.png')}}" /></em></dd>
                <dd style="float:left;">
                    <strong>您的新登录密码已设置成功</strong><br />
                    <i>今后将使用新密码登录喇叭传媒平台账户，请牢记。</i><br />
                    <p>您可能需要：<a href="{{route('user.login')}}">重新登录</a></p>
                </dd>
            </div>
        </div>
    </div>
</div>
</body>
</html>