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
                                            <div class="LGnt11" id="show_upload">
                                                <img id="user_pic_img"  src="{{url('Admin/img/bn66.png')}}"/>
                                                <input id="user_avatar" name="user_avatar" accept="image/*" type="file"
                                                       style="display: none"/>
                                                <p id="user_pic">上传头像</p>
                                            </div>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>企业名称:</p>
                                            <input type="text" name="textfield" id="textfield" class="LGnt2"/>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>联系人:</p>
                                            <input type="text" name="textfield" id="textfield" class="LGnt2"/>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>QQ:</p>
                                            <input type="text" name="textfield" id="textfield" class="LGnt2"/>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>手机:</p>
                                            <input type="text" name="textfield" id="textfield" class="LGnt2"/>
                                            <span>修改</span>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>邮箱:</p>
                                            <input type="text" name="textfield" id="textfield" class="LGnt2"/>
                                            <span>绑定</span>
                                        </div>
                                        <i style=" padding-left:80px; font-size:12px; color:#999; float:left;">温馨提示：请填写有效邮箱地址，以便接受通知及订单信息，建议使用QQ，hotmail等邮箱</i>
                                        <div style="margin-top:40px; float:left; width:100%">
                                            <input type="submit" name="button" id="button" value="提 交"
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
            $("#user_pic").click(function () {
                $("#user_avatar").click(); //隐藏了input:file样式后，点击头像就可以本地上传
                $("#user_avatar").on("change", function () {
                    var objUrl = getObjectURL(this.files[0]); //获取图片的路径，该路径不是图片在本地的路径
                    if (objUrl) {
                        $("#user_pic_img").attr("src", objUrl); //将图片路径存入src中，显示出图片
                    }
                });
            });
            //建立一個可存取到該file的url
            function getObjectURL(file) {
                var url = null;
                if (window.createObjectURL != undefined) { // basic
                    url = window.createObjectURL(file);
                } else if (window.URL != undefined) { // mozilla(firefox)
                    url = window.URL.createObjectURL(file);
                } else if (window.webkitURL != undefined) { // webkit or chrome
                    url = window.webkitURL.createObjectURL(file);
                }
                return url;
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
