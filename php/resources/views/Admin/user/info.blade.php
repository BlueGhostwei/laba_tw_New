@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
    <link rel="stylesheet" href="{{url('Admin/js/zoom/css/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" href="{{url('Admin/js/zoom/dist/zoomify.min.css')}}">
    <link rel="stylesheet" href="{{url('Admin/js/zoom/css/style.css')}}">

@endsection
@section('content')
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="ndt">
                    <div class="Ifapiao"><h2>会员信息</h2></div>
                    <div class="lanrenzhijia">
                        <div class="tab">
                            <a href="javascript:;" class="on">资料编辑</a>
                            <a href="{{route('member.safety_set')}}"><li>安全设置</li></a>
                        </div>
                        <div class="Hcontent">
                            <ul>
                                <li style="display:block;">

                                    <div class="LGnta1" style="float:left;">
                                        <div class="LGnt6"><p><i class="LGntas">*</i>个人头像:</p>
                                            <form id="form1" method="post">
                                                <div class="LGnt11" id="show_upload">
                                                       @if(isset(Auth::user()->user_avatar) && Auth::user()->user_avatar!=null)
                                                        <img id="user_pic_img" src="{{ md52url(Auth::user()->user_avatar, false, '') }}"/>
                                                        @else
                                                        <img id="user_pic_img" src="{{url('Admin/img/bn66.png')}}"/>
                                                        @endif
                                                    {{ csrf_field() }}
                                                     <input id="user_avatar" name="file" accept="image/*" type="file" style="display: none"/>
                                                           @if(isset(Auth::user()->user_avatar) && Auth::user()->user_avatar!=null)
                                                               <input type="hidden" name="user_image" value="{{Auth::user()->user_avatar}}">
                                                               @else
                                                               <input type="hidden" name="user_image" value=" ">
                                                               @endif


                                                    <p id="user_pic">上传头像</p>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>企业名称:</p>
                                            <input type="text" name="company_name" id="company_name" class="LGnt2"
                                                   value="@if(isset(Auth::user()->company_name) && Auth::user()->company_name!=null){{Auth::user()->company_name}}@endif "/>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>联系人:</p>
                                            <input type="text" name="contact_person" id="contact_person" class="LGnt2"
                                                   value="@if(isset(Auth::user()->contact_person) && Auth::user()->contact_person!=null){{Auth::user()->contact_person}}@endif "/>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>昵称:</p>
                                            <input type="text" name="nickname" id="nickname" class="LGnt2"
                                                   value="@if(isset(Auth::user()->nickname) && Auth::user()->nickname!=null){{Auth::user()->nickname}}@endif"/>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>QQ:</p>
                                            <input type="text" name="user_QQ" id="user_QQ" class="LGnt2"
                                                   value="@if(isset(Auth::user()->user_QQ) && Auth::user()->user_QQ!=null){{Auth::user()->user_QQ}}@endif"/>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>手机:</p>
                                            <input type="text" name="user_phone" id="user_phone" class="LGnt2"
                                                   value="@if(isset(Auth::user()->user_phone) && Auth::user()->user_phone!=null){{Auth::user()->user_phone}}@endif"/>
                                            <span>修改</span>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>邮箱:</p>
                                            <input type="text" name="user_Eail" id="user_Eail" class="LGnt2"
                                                   value="@if(isset(Auth::user()->user_Eail) && Auth::user()->user_Eail!=null){{Auth::user()->user_Eail}}@endif"/>
                                            <span>绑定</span>
                                        </div>
                                        <i style=" padding-left:80px; font-size:12px; color:#999; float:left;">温馨提示：请填写有效邮箱地址，以便接受通知及订单信息，建议使用QQ，hotmail等邮箱</i>
                                        <div style="margin-top:40px; float:left; width:100%">
                                            <input type="submit" name="button" id="submit_button" value="提 交"
                                                   class="LGButton3" style="background: #ff4a50;"/>
                                        </div>
                                    </div>
                                    <div class="LGnta2">
                                        <h4>完善资料</h4>
                                        <span>资料更完整，账号更安全。完善资料将帮助我们更好的提供服务。</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
           /* $(".lanrenzhijia .tab a").click(function () {
                $(this).addClass('on').siblings().removeClass('on');
                var index = $(this).index();
                number = index;
                $('.lanrenzhijia .Hcontent li').hide();
                $('.lanrenzhijia .Hcontent li:eq(' + index + ')').show();
            });
            var auto = 1;  //等于1则自动切换，其他任意数字则不自动切换
            if (auto == 1) {
                var number = 0;
                var maxNumber = $('.lanrenzhijia .tab a').length;

                function autotab() {
                    number++;
                    number == maxNumber ? number = 0 : number;
                    $('.lanrenzhijia .tab a:eq(' + number + ')').addClass('on').siblings().removeClass('on');
                    $('.lanrenzhijia .Hcontent ul li:eq(' + number + ')').show().siblings().hide();
                }
            }*/
            //分界线
            $("#user_pic").click(function () {
                $("#user_avatar").click();  //隐藏了input:file样式后，点击头像就可以本地上传
                    $("#user_avatar").change(function () {
                        //创建FormData对象
                        var data = new FormData($('#form1')[0]);
                        $.ajax({
                            url: '{{url('upload')}}',
                            type: 'POST',
                            data: data,
                            dataType: 'JSON',
                            cache: false,
                            processData: false,
                            contentType: false
                        }).done(function(ret){

                            if(ret.sta == 1){
                                $("#user_pic_img").attr("src", ret.url ) ;
                               $('input[name="user_image"]').val(ret.md5);
                            }else{
                                layer.msg('头像上传失败');
                            }
                        });

                });
            });
            $('#submit_button').click(function () {
                var data=[];
                var _token= $('input[name="_token"]').val();
                var user_avatar=$('input[name="user_image"]').val();
                var company_name =$('#company_name').val();
                var contact_person=$('#contact_person').val();
                var  user_phone =$('#user_phone').val();
                var  user_QQ =$('#user_QQ').val();
                var  nickname =$('#nickname').val();
                var  user_Eail=$('#user_Eail').val();
                if(!IsTel(user_phone) ){
                    layer.msg('请输入正确的手机号码');
                    return false
                }
                $.ajax({
                    url:'{{route('member.info')}}',
                    data: {
                        'type':'update_info',
                        'user_avatar':user_avatar,
                        'nickname':nickname,
                        'company_name':company_name,
                        'contact_person':contact_person,
                        'user_phone':user_phone,
                        'user_QQ':user_QQ,
                        'user_Eail':user_Eail,
                        '_token':_token
                    },
                    type: 'post',
                    dataType: "json",
                    stopAllStart: true,
                    success: function (data) {
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
            });
            function IsTel(Tel){
                var re=new RegExp(/^((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)$/);
                var retu=Tel.match(re);
                if(retu){
                    return true;
                }else{
                    return false;
                }
            }

        });
    </script>
    <script src="{{url('Admin/js/zoom/dist/zoomify.min.js')}}"></script>
    <script type="text/javascript">
        $('#user_pic_img').zoomify();
    </script>
@endsection
@section('footer_related')
@endsection
