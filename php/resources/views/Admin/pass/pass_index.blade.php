<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="{{url('Admin/css/style.css')}}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{url('Admin/js/jquery-2.1.1.min.js')}}"></script>
    <script type="text/javascript" src="{{url('Admin/js/layer.js')}}"></script>


</head>
<body style="background:url(../img/RELogin.jpg) repeat-x top;">
<div id=RELogin style="">
    <div style=" width:250px; margin:auto;"><a href="{{route('admin.dashboard')}}"><img src="{{url('Admin/img/logolaba.png')}}" style=" width:250px; height:auto"></a></div>
       <div style="width: 850px;HEIGHT: 530px;background:#fff;border-radius:10px;">
           <div class="LoginHead">
               <H1>找回密码</H1>
               <div class="LGRight">&nbsp;</div>
           </div>
           <div class="web-width">
               <div class="for-liucheng">
                   <div class="liulist for-cur"></div>
                   <div class="liulist"></div>
                   <div class="liulist"></div>
                   <div class="liulist"></div>
                   <div class="liutextbox">
                       <div class="liutext for-cur"><em>1</em><br /><strong>输入用户名</strong></div>
                       <div class="liutext"><em>2</em><br /><strong>验证身份</strong></div>
                       <div class="liutext"><em>3</em><br /><strong>重置密码</strong></div>
                       <div class="liutext"><em><img src="{{url('Admin/img/Bpass1.png')}}" /></em><br /><strong>完成</strong></div>
                   </div>
               </div>
               <form action="{{route('Admin.pass.getuser')}}" method="post" >
                   {{ csrf_field() }}
               <div class="forget-pwd">
                   <div class="LGnt6"><p>用户名:</p>
                       <input type="text" name="username" id="username"  class="Bpass_name" value="{{old('username')}}"/>
                   </div>
                   <div class="LGnt6" style=" margin-top:15px; margin-bottom:10%;"><p>验证码:</p>
                       <input type="text" name="user_code" id="user_code"  class="Bpass_"/>
                       <div class="yanzma"><img src="{{ url('yanzheng/mews') }}" onclick="this.src='{{ url('yanzheng/mews') }}?r='+Math.random();" alt=""></div>
                   </div>
                   <input type="submit" name="button" id="next_button" value="提 交" class="LGButton3" style="margin-bottom:50px;" />
               </div>
                   @foreach ($errors->all() as $error)
                    <script type="text/javascript">
                        layer.msg("{{$error}}");
                    </script>
                   @endforeach
               </form>
           </div>
       </div>

</div>
</body>
</html>
