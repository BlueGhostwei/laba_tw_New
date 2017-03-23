@extends('Admin.layout.main')
@section('title', '媒体供应商-用户中心')
@section('header_related')
@endsection
@section('content')

    <div class="w100 nav_hdorder clearfix clr">
        <div class="content">
            <div class="Invoice" style="background:#fff;">
                <div class="INa1dd">
                    <div class="w100">
                        <ul class="tab">
                            <a href="{{route('vider.Event_list')}}"><li>活动订单</li></a>
                            <li><a href="">预约订单</a></li>
                           {{-- <li><a href="resource_management.php">资源管理</a></li>--}}
                            <a href="{{route('vider.bill_query')}}"> <li>账单查询</li></a>
                            <a href="{{route('vider.user_center')}}"> <li class="cur">用户中心</li></a>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--用户中心-->
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="ndt" style="margin-top:20px;">
                    <div class="Ifapiao"><h2>帐户一览</h2></div>
                    <div class="lanrenzhijia">
                        <div class="tab">
                            <a href="javascript:;" class="on">资料编辑</a>
                            <a href="javascript:;">安全设置</a>
                            <a href="javascript:;">收款帐号</a>
                        </div>
                        <div class="Hcontent">
                            <ul>
                                <li style="display:block;">
                                    <div class="LGnta1 clearfix">
                                        <div class="LGnt6"><p><i class="LGntas">*</i>昵称:</p>
                                            <input type="text" name="textfield" id="textfield" class="LGnt2"/>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>姓名:</p>
                                            <input type="text" name="textfield" id="textfield" class="LGnt2"/>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>QQ:</p>
                                            <input type="text" name="textfield" id="textfield" class="LGnt2"/>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>手机:</p>
                                            <input type="text" name="textfield" id="textfield" class="LGnt2"/>
                                            <span><a href="#">修改</a></span>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas">*</i>邮箱:</p>
                                            <input type="text" name="textfield" id="textfield" class="LGnt2"/>
                                            <span><a href="#">修改</a></span>
                                        </div>
                                        <div class="LGnt6"><p><i class="LGntas"></i> &nbsp;</p>
                                            <input type="submit" value="提 交" class="LGButton4"/>
                                        </div>
                                    </div>
                                </li>
                                <li>安全设置</li>
                                <li>收款帐号</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
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
        });
    </script>
@endsection
