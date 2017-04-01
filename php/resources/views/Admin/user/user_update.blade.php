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
                                {{ csrf_field() }}
                                <ul style="margin-left:30px;">
                                    <li><a href="{{route('member.info')}}">资料编辑</a></li>
                                    <li class="cur"><a href="{{route('member.safety_set')}}">安全设置</a></li>
                                </ul>
                            </div>
                            @if(isset($type) && $type=="pass")

                                <div class="tab1_body">

                                    <div class="safe_2 clearfix">
                                        <div class="WMain3 WMain3_2 clearfix"><p><i class="LGntas"></i>帐号：</p>

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
                                            <input type="password" name="pass_confirm" class="txt6">
                                        </div>
                                        <div class="WMain3 WMain3_2 clearfix" style="margin-top:50px;">
                                            <input type="button" value="提交" id="submit_button" class=" sub5">
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
                            @elseif(isset($type) && $type=="email")
                                <div class="tab1_body">
                                    <div class="safe_2 clearfix">
                                        <div class="WMain3 WMain3_2 clearfix"><p><i class="LGntas"></i>会员帐号：</p>
                                            @if(isset(Auth::user()->username) && Auth::user()->username!=null){{Auth::user()->username}}@endif
                                        </div>
                                        <div class="WMain3 WMain3_2 clearfix"><p><i class="LGntas"></i>邮箱地址：</p>
                                            <input type="text" name="user_Eail" class="txt6"
                                                   value=" @if(isset(Auth::user()->user_Eail) && Auth::user()->user_Eail!=null){{Auth::user()->user_Eail}}@endif">
                                            <div><span>输入有效的邮箱地址，以便接收系统邮件通知及重置用户名 示例：cndns@163.com</span></div>
                                        </div>
                                        <div class="WMain3 WMain3_2 clearfix"><p><i class="LGntas"></i>邮箱验证码：</p>
                                            <input type="text" name="user_code" class="Bpass_"
                                                   style="margin-right: 10px;">
                                            <input type="submit" name="code_button" id="code_button" value="获取验证码"
                                                   class="LGn3">
                                        </div>
                                        <div class="WMain3 WMain3_2 clearfix" style="margin-top:50px;">
                                            <input type="button" id="submit_button" value="提交" class="sub5">
                                        </div>
                                        <div class="clr"></div>
                                    </div>

                                </div>
                                @elseif($type=='security')
                                <div class="tab1_body">
                                    <div class="safe_2 clearfix">
                                        <div class="WMain3 WMain3_2 clearfix"><p><i class="LGntas"></i>兴趣爱好类：</p>
                                            <select class="sel_2">
                                                <option value="" data_id="0">请选择问题</option>
                                                @if(isset($data_con) && !empty($data_con->hobby))
                                                       @foreach($data_con->hobby as $ky =>$rst)
                                                        <option value="{{$rst->id}}" data_id="{{$rst->id}}">{{$rst->question_name}}</option>
                                                        @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="WMain3 WMain3_2 clearfix"><p><i class="LGntas"></i>您的回答：</p>
                                            <input type="text" name="answer"  class="txt6">
                                        </div>
                                        <div class="WMain3 WMain3_2 clearfix"><p><i class="LGntas"></i>家庭工作类：</p>
                                            <select class="sel_2">
                                                <option value=""  data_id="0">请选择问题</option>
                                                @if(isset($data_con) && !empty($data_con->home))
                                                    @foreach($data_con->home as $ky =>$rst)
                                                        <option value="{{$rst->id}}" data_id="{{$rst->id}}">{{$rst->question_name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="WMain3 WMain3_2 clearfix"><p><i class="LGntas"></i>您的回答：</p>
                                            <input type="text" name="answer" class="txt6">
                                        </div>
                                        <div class="WMain3 WMain3_2 clearfix"><p><i class="LGntas"></i>教育杂项类：</p>
                                            <select class="sel_2">
                                                <option value="" data_id="0">请选择问题</option>
                                                @if(isset($data_con) && !empty($data_con->education))
                                                    @foreach($data_con->education as $ky =>$rst)
                                                        <option value="{{$rst->id}}" data_id="{{$rst->id}}">{{$rst->question_name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="WMain3 WMain3_2 clearfix"><p><i class="LGntas"></i>您的回答：</p>
                                            <input type="text" name="answer" class="txt6">
                                        </div>
                                        <div class="WMain3 WMain3_2 clearfix" style="margin-top:50px;">
                                            <input type="button" id=submit_button value="提交" class="sub5">
                                        </div>
                                        <div class="clr"></div>
                                    </div>
                                    <div class="safe2_b">
                                       {{-- 友情提醒：用户名和密码要做好相应记录，以免忘记。--}}
                                    </div>

                                </div>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $(".tab1>ul>li>a").unbind("click");
            var _token = $('input[name="_token"]').val();
            $('#submit_button').click(function () {
                var data = {};
                data['_token'] = _token;
                var type = "{{$type}}";
                if (type == "pass") {
                    var old_pass = $('input[name="old_pass"]').val();
                    var new_pass = $('input[name="new_pass"]').val();
                    var pass_confirm = $('input[name="pass_confirm"]').val();
                    data['type'] = "update_pass";
                    data['old_pass'] = old_pass;
                    data['new_pass'] = new_pass;
                    data['pass_confirm'] = pass_confirm;

                    if (old_pass == '') {
                        layer.msg('请输入您的密码！');
                        $('input[name="old_pass"]').focus();
                        return false;
                    }
                    if (new_pass == '') {
                        layer.msg('请输入密码！')
                        return false;
                    }
                    if (new_pass != pass_confirm) {
                        layer.msg('输入的密码不一致！');
                        return false;
                    }
                } else if (type == "email") {
                    data['type']="update_email";
                    data['user_Eail']= $('input[name="user_Eail"]').val();
                    data['user_code'] = $('input[name="user_code"]').val();
                }else if(type=='security'){
                    //获取分类信息
                    data['type']="security";
                    data['question']={};
                    $( ".sel_2 option:selected" ).each(function(i) {
                        if($(this).val()==''){
                            layer.msg("请完善问题");
                        }
                        data['question'][i]=$(this).val();
                    });
                    data['answer'] ={};
                    $("input:text[name='answer']").each(function(i){
                        data['answer'][i]=$(this).val();
                    });
                }
                $.ajax({
                    url:"{{route('member.info')}}",
                    data: data,
                    type: 'post',
                    dataType: "json",
                    stopAllStart: true,
                    success: function (data) {
                        if (data.sta == '0') {
                            layer.msg(data.msg || '请求成功');
                            window.location.href="{{route('member.safety_set')}}"
                        } else {
                            layer.msg(data.msg || '请求失败');
                        }
                    },
                    error: function () {
                        layer.msg(data.msg || '网络发生错误');
                        return false;
                    }
                });

            });

            $('#code_button').click(function () {
                //发送邮箱验证码
                var username = "{{Auth::user()->username}}";
                var user_email = $('input[name="user_Eail"]').val();
                $.ajax({
                    url: '{{route('pass.email')}}',
                    data: {
                        'type': "find_pass",
                        'username': username,
                        'user_email': user_email,
                        '_token': _token
                    },
                    type: 'post',
                    dataType: "json",
                    stopAllStart: true,
                    success: function (data) {
                        if (data.sta == '0') {
                            setTiming();
                            layer.msg(data.msg || '请求成功');

                        } else {
                            layer.msg(data.msg || '请求失败');
                        }
                    },
                    error: function () {
                        layer.msg('网络发生错误！！');
                        return false;
                    }
                });
            });


        });
        var timeout = 60;
        var int1;
        function setTiming() {
            if (timeout >= 1) {
                clearTimeout(int1);
                $("#code_button").css("cursor", "default");
                $("#code_button").val("" + timeout + " 重新发送");
                int1 = setTimeout(function () {
                    timeout--;
                    setTiming();
                }, 1000);
            } else {
                clearTimeout(int1);
                $("#code_button").val("重新发送");
                $("#code_button").css("cursor", "pointer");
                timeout = 60;
            }
        }
    </script>
@endsection
