<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link href="{{url('Admin/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('Admin/css/style2.css')}}" rel="stylesheet" type="text/css" />
    <script src="http://www.jq22.com/jquery/jquery-1.6.2.js"></script>
    {{--<script type="text/javascript" src="{{url("Admin/js/jquery.reveal.js")}}"></script>--}}
    {{-- <script src="http://www.jq22.com/js/jq.js"></script>--}}
    <script src="{{url('Admin/js/jquery-2.1.1.min.js')}}"></script>
    <script src="{{url('Admin/js/layer.js')}}"></script>

</head>
<style type="text/css">
    .reveal-modal{
        left: 50%;
        margin-left: -380px;
        width: 570px;
        /* background: #fff url(../css/modal-gloss.png) no-repeat -200px -80px;*/
        position: absolute;
        z-index: 101;
        padding: 30px 100px;
    }
    *{
        margin: 0;
        font-family: "微软雅黑";
    }
    .liutextbox .liutext {
        float: left;
        width: 33%;
        text-align: center;
    }
    .liulist {
        float: left;
        width: 33%;
        height: 7px;
        background: #ccc;
    }


</style>

<body style="background:url({{url('Admin/img/RELogin.jpg')}}) repeat-x top;">
<div id=RELogin style="">
    <div style=" width:250px; margin:auto;"><a href="{{url('Admin/user/login')}}"><img src="img/logolaba.png" style=" width:250px; height:auto"></a></div>

    @if ($step == 1)
        <div style="width: 850px;HEIGHT: 700px;background:#fff;border-radius:10px;" >
            <div class=LoginHead>
                <H1>重置用户名</H1>
                <div class=reset_Right>&nbsp;</DIV>
            </div>








            <div class="yzshenfen" >
                <div class="for-liucheng">
                    <div class="liulist for-cur"></div>
                    <div class="liulist"></div>
                    <div class="liulist"></div>
                    <div class="liutextbox">

                        <div class="liutext for-cur"><em>1</em><br /><strong>验证身份</strong></div>
                        <div class="liutext"><em>2</em><br /><strong>重置用户名</strong></div>
                        <div class="liutext"><em><img src="{{url('Admin/img/Bpass1.png')}}" /></em><br /><strong>完成</strong></div>
                    </div>
                </div>
                <div class="mibao">

                    @for ($i = 0; $i < count($question); $i++)
                        <div class="WMain3 WMain3_2 clearfix question"><p><i class="LGntas"></i>问题{{$i+1}}：</p>
                            {{$question[$i]['question_name']}}
                        </div>
                        <div class="WMain3 WMain3_2 clearfix answerfield"><p><i class="LGntas"></i>您的回答：</p>
                            <input type="hidden" class="id" name="id" value="{{$question[$i]['id']}}"/>
                            <input type="text" name="answer"  id="textfield" class="txt6">
                        </div>
                    @endfor









                    <div class="WMain3 WMain3_2 clearfix" style="margin-top:50px;">
                        <input type="submit" value="提交" class="sub5">
                    </div>
                    <div class="clr"></div>
                </div>
            </div>
        </div>
    @elseif ($step == 2)
        <div style="width: 850px;HEIGHT: 600px;background:#fff;border-radius:10px;" >
            <div class=LoginHead>
                <H1>重置用户名</H1>
                <div class=reset_Right>&nbsp;</DIV>
            </div>
            <div class="yzshenfen" >
                <div class="for-liucheng">

                    <div class="liulist for-cur"></div>
                    <div class="liulist for-cur"></div>
                    <div class="liulist"></div>
                    <div class="liutextbox">

                        <div class="liutext for-cur"><em>1</em><br /><strong>验证身份</strong></div>
                        <div class="liutext for-cur"><em>2</em><br /><strong>重置用户名</strong></div>
                        <div class="liutext"><em><img src="{{url('Admin/img/Bpass1.png')}}" /></em><br /><strong>完成</strong></div>
                    </div>
                </div>
                <div class="forget-pwd">
                    <div class="LGnt6"><p>旧手机号码:</p>
                        {{$phone}}
                    </div>
                    <div class="LGnt6"><p>新手机号码:</p>
                        <input type="text" name="textfield" id="phonefield"  class="Bpass_name"/>
                        {{ csrf_field() }}
                    </div>
                    <div class="LGnt6" style=" margin-top:15px; margin-bottom:10%;"><p>验证码:</p>
                        <input type="text" name="textfield" id="textfield"  class="Bpass_"/>
                        <div class="LGnt4">
                            <input type="submit" name="button" id="send_sms_button" value="获取验证码" class="LGn3"/>
                        </div>
                    </div>
                    <input type="submit" name="button" id="button" value="提 交" class="LGButton3" style="margin-bottom:50px;" />
                </div>
            </div>
        </div>
    @else
        <div style="width: 850px;HEIGHT: 530px;background:#fff;border-radius:10px;" >
            <div class=LoginHead>
                <H1>重置用户名</H1>
                <div class=reset_Right>&nbsp;</DIV>
            </div>
            <div class="yzshenfen" >
                <div class="for-liucheng">

                    <div class="liulist for-cur"></div>
                    <div class="liulist for-cur"></div>
                    <div class="liulist for-cur"></div>
                    <div class="liutextbox">

                        <div class="liutext for-cur"><em>1</em><br /><strong>验证身份</strong></div>
                        <div class="liutext for-cur"><em>2</em><br /><strong>重置用户名</strong></div>
                        <div class="liutext for-cur"><em><img src="{{url('Admin/img/Bpass1.png')}}" /></em><br /><strong>完成</strong></div>
                    </div>
                </div>
                <div class="forget-pwd" style="margin-top:80px; width:350px;">
                    <dd style="width:30px; height:150px;float:left;"><em><img src="{{url('Admin/img/Bpass1.png')}}" /></em></dd>
                    <dd style="float:left;">
                        <strong>您的新登录用户名已设置成功</strong><br />
                        <i>今后将使用用户名登录喇叭传媒平台账户，请牢记。</i><br />
                        <p>您可能需要：<a href="{{url('Admin/user/logout')}}">重新登录</a></p>
                    </dd>
                </div>
            </div>
        </div>
    @endif




</div>




</body>
<script type="text/javascript">
    $(function () {
        var _token = $('input[name="_token"]').val();
        $(".sub5").click(function () {
            var length = $(".question").length;
            var data = new Array();
//            data[0] = $(".id").val(;
            $(".answerfield").each(function (i) {
                data[i] = {};
                var name = $(this).children(".id").attr('name');
                var value = $(this).children(".txt6").attr('name')
                data[i][name] = $(this).children(".id").val();
                data[i][value] = $(this).children(".txt6").val();

            });
            $.ajax({
                type: "POST",
                url: "{{url('Admin/check_question')}}",
                data: {
                    "data": data
                },
                dataType: "json",
                success: function (data) {
                    if (data.sta == 1) {
                        layer.msg(data.msg);
                    } else {
                        window.location.reload();
                    }
                }
            });
//            console.log(data);
        });

        $(".LGButton3").click(function () {
            $.ajax({
                type: "POST",
                url: "{{url('Admin/resetphone')}}",
                data: {
                    "username": $("#phonefield").val(),
                    "user_code":$("#textfield").val()
                },
                dataType: "json",
                success: function (data) {
                    if (data.sta == 1) {
                        layer.msg(data.msg);
                    } else {
                        window.location.reload();
                    }
                }
            });
//            console.log(data);
        })
        $("#send_sms_button").click(function () {
            // var _form=form.getFormData();//获取表单参数
            var moblie_number = $('#phonefield').val();
            //判断手机号码是否正确合法
            if (!IsTel(moblie_number)) {
                layer.msg('请输入正确的手机号码');
                $("#phonefield").focus();
                return false;
            }
            $.ajax({
                url: '{{route('send.sms')}}',
                data: {
                    'type':"register",
                    'moblie_number': moblie_number,
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
            function IsTel(Tel) {
                var re = new RegExp(/^((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)$/);
                if (re.test(Tel)) {
                    return true;
                } else {
                    return false;
                }
            }
            var timeout = 60;
            var int1;
            function setTiming() {
                if (timeout >= 1) {
                    clearTimeout(int1);
                    $("#send_sms_button").css("cursor", "default");
                    $("#send_sms_button").val("" + timeout + " 重新发送");
                    int1 = setTimeout(function () {
                        timeout--;
                        setTiming();
                    }, 1000);
                } else {
                    clearTimeout(int1);
                    $("#send_sms_button").val("重新发送");
                    $("#send_sms_button").css("cursor", "pointer");
                    timeout = 60;
                }
            }
        });





    })
</script>

</html>

