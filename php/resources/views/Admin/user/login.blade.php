<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="{{url('Admin/css/style.css')}}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{url('Admin/js/jquery-2.1.1.min.js')}}"></script>
    <script  type="text/javascript"  src="{{url('Admin/js/layer.js')}}"></script>
</head>
<body style="background:url(../img/BodyBg.jpg) no-repeat;">
<div id=Login>
    <div style=" width:250px; margin:auto;"><a href="{{route('admin.dashboard')}}"><img src="{{url('Admin/img/logolaba.png')}}" style=" width:250px; height:auto"></a></div>
    <form action="{{ route('user.post_login') }}" method="post">
        {{ csrf_field() }}
        <div style="width: 633px;HEIGHT: 580px;background:#fff;border-radius:10px;">
            <div class=LoginHead>
                <H1>用户登录</H1>
                <div class=CopyRight>&nbsp;</DIV>
            </div>
            <div class="LGn1">
                <div class="LGnt1"><p>用户名:</p>
                    <input type="text" name="username" id="username"  class="LGnt2" value="{{old('username')}}"/>
                    {{--<i>忘记用户名？</i>--}}
                </div>
                <div class="LGnt1"><p>密&nbsp;&nbsp;&nbsp;&nbsp;码:</p>
                    <input type="password" name="user_password" id="password"  class="LGnt2"/>
                    <i><a href="{{route('Admin.pass_find')}}">忘记密码？</a></i>
                </div>
                <div class="LGnt1"><p>验证码:</p>
                    <input type="text" name="user_code" id="user_code"  class="LGnt3"/>
                    <div class="LGnt4"><img src="{{ url('yanzheng/mews') }}" onclick="this.src='{{ url('yanzheng/mews') }}?r='+Math.random();" alt=""></div>
                </div>
                <div style="float:left; margin-left:45px;">
                    <input type="submit" name="button" id="button" value="提 交" class="LGButton1"/>
                   <a href="{{route('user.register')}}"> <input type="button" name="button" id="button" value="注 册" class="LGButton2"/></a>
                </div>
                <div class="LOGOds">
                    <div class=dsRight>&nbsp;</DIV><h3>第三方登录</h3><div class=dsRight>&nbsp;</DIV>
                    <ul class="LGnt5">
                        <a href=""> <li><img src="{{url('Admin/img/1at.jpg')}}" /><p>微信</p></li></a>
                        <li><img src="{{url('Admin/img/2at.jpg')}}" /><p>QQ</p></li>
                        <li><img src="{{url('Admin//img/3at.jpg')}}" /><p>微博</p></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
@foreach ($errors->all() as $error)
    <script type="text/javascript">
        layer.msg("{{$error}}");
    </script>
@endforeach