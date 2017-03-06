@extends('Admin.layout.main')
@section('title', '修改密码')
@section('header_related')
@endsection
@section('content')
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="ndt" style="margin-top:40px;padding-bottom:180px;">

                    <div class="hdorder radius1">
                        <h3 class="title1"><strong><a href="#">会员信息</a></strong></h3>
                        <div class="dhorder_m">
                            <div class="tab1">
                                <ul style="margin-left:30px;">
                                    <li><a href="{{route('member.info')}}">资料编辑</a></li>
                                    <li class="cur"><a href="{{route('member.safety_set')}}">安全设置</a></li>
                                </ul>
                            </div>
                            <div class="tab1_body">
                                <div class="safe_2 clearfix">
                                    <div class="WMain3 WMain3_2 clearfix"><p><i class="LGntas"></i>帐号：</p>
                                        {{ csrf_field() }}
                                        @if(isset(Auth::user()->username) && Auth::user()->username!=null){{Auth::user()->username}}@endif
                                    </div>
                                    <div class="WMain3 WMain3_2 clearfix"><p><i class="LGntas"></i>旧密码：</p>
                                        <input type="password" name="old_pass" class="txt6">
                                    </div>
                                    <div class="WMain3 WMain3_2 clearfix"><p><i class="LGntas"></i>新密码：</p>
                                        <input type="password" name="new_pass" class="txt6">
                                        <div>由字母、数字和特殊符号组成，区分大小写(6~16个字符)。示例：cndns456@#!</div>
                                    </div>
                                    <div class="WMain3 WMain3_2 clearfix"><p><i class="LGntas"></i>确认密码：</p>
                                        <input type="password" name="pass_confirm"  class="txt6">
                                    </div>
                                    <div class="WMain3 WMain3_2 clearfix" style="margin-top:50px;">
                                        <input type="button"  value="提交" id="pass_button" class=" sub5">
                                    </div>
                                    <div class="clr"></div>
                                </div>
                                <div class="safe2_b" style="width:auto;">
                                    <div style="width:440px;margin:0 auto;text-align:left;position:relative;left:25px;">
                                        密码设置技巧<br/>
                                        密码设置至少6位以上，由数字、字母和符号混合而成，安全性较高。<br/>
                                        不要用手机号、电话号码、生日、学号、身份证号等个人信息。<br/>
                                        <br/>
                                        友情提醒：用户名和密码要做好相应记录，以免忘记。
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            $(".tab1>ul>li>a").unbind("click");

          $('#pass_button').click(function () {
              var _token= $('input[name="_token"]').val();
              var old_pass= $('input[name="old_pass"]').val();
              var new_pass= $('input[name="new_pass"]').val();
              var pass_confirm= $('input[name="pass_confirm"]').val();

              if(old_pass == ''){
                  layer.msg('请输入您的密码！');
                $('input[name="old_pass"]').focus();
                  return false;
              }
              if(new_pass ==''){
                  layer.msg('请输入密码！')
                  return false;
              }
              if( new_pass != pass_confirm){
                  layer.msg('输入的密码不一致！');
                  return false;
              }
              $.ajax({
                  url:'{{route('member.info')}}',
                  data: {
                      'type':"update_pass",
                      'old_pass':old_pass,
                      'new_pass':new_pass,
                      'pass_confirm':pass_confirm,
                      '_token':_token
                  },
                  type: 'post',
                  dataType: "json",
                  stopAllStart: true,
                  success: function (data) {
                      debugger
                      if (data.sta == '0') {
                          layer.msg(data.msg || '请求成功');
                      } else {
                          layer.msg(data.msg || '请求失败');
                      }
                  },
                  error: function () {
                      layer.msg(data.msg || '网络发生错误');
                      return false;
                  }
              });

          })
        });
    </script>
@endsection
