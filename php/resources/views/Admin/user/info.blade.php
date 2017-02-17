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
                            <a href="javascript:;">安全设置</a>
                        </div>
                        <div class="Hcontent">
                            <ul>
                                <li style="display:block;">

                                    <div class="LGnta1" style="float:left;">
                                        <div class="LGnt6"><p><i class="LGntas">*</i>个人头像:</p>
                                            <form id="form1" method="post">
                                                <div class="LGnt11" id="show_upload">
                                                    <img id="user_pic_img" src="{{url('Admin/img/bn66.png')}}"/>
                                                    {{ csrf_field() }}
                                                    <input id="user_avatar" name="file" accept="image/*"
                                                           type="file"
                                                           style="display: none"/>
                                                    <p id="user_pic">上传头像</p>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>企业名称:</p>
                                            <input type="text" name="companyn_name" id="companyn_name" class="LGnt2"/>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>联系人:</p>
                                            <input type="text" name="Contact_person" id="Contact_person" class="LGnt2"/>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>QQ:</p>
                                            <input type="text" name="user_QQ" id="user_QQ" class="LGnt2"/>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>手机:</p>
                                            <input type="text" name="user_phone" id="user_phone" class="LGnt2"/>
                                            <span>修改</span>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>邮箱:</p>
                                            <input type="text" name="user_Eail" id="user_Eail" class="LGnt2"/>
                                            <span>绑定</span>
                                        </div>
                                        <i style=" padding-left:80px; font-size:12px; color:#999; float:left;">温馨提示：请填写有效邮箱地址，以便接受通知及订单信息，建议使用QQ，hotmail等邮箱</i>
                                        <div style="margin-top:40px; float:left; width:100%">
                                            <input type="submit" name="button" id="submit_button" value="提 交"
                                                   class="LGButton3"/>
                                        </div>
                                    </div>
                                    <div class="LGnta2">
                                        <h4>完善资料</h4>
                                        <span>资料更完整，账号更安全。完善资料将帮助我们更好的提供服务。</span>
                                    </div>
                                </li>
                                <li>安全设置</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{url('Admin/js/jquery-2.1.1.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $(".lanrenzhijia .tab a").click(function () {
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
            }
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
                            }else{
                                alert('头像上传失败！');
                            }
                        });

                });
            });
            $('#submit_button').click(function () {
                var data=[];
                var _token= $('input[name="_token"]').val();
                data['user_avatar']=$('#user_avatar').val();
                data['companyn_name']=$('#companyn_name').val();
                data['Contact_person']=$('#Contact_person').val();
                data['user_phone']=$('#user_phone').val();
                data['user_QQ']=$('#user_QQ').val();
                data['user_Eail']=$('#user_Eail').val();
                if(!IsTel[data['user_phone']] ){
                     alert("手机号码不合法！");
                }
                $.ajax({
                    url:'{{route('member.info')}}',
                    data: {
                        'type':'update_info',
                        'data':data,
                        '_token':_token
                    },
                    type: 'post',
                    dataType: "json",
                    stopAllStart: true,
                    success: function (data) {
                        if (data.sta == '0') {
                            alert(data.msg || '请求成功');
                        } else {
                            alert(data.msg || '请求失败');
                        }
                    },
                    error: function () {
                        alert('网络发生错误');
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
