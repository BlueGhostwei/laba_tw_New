@extends('Admin.layout.main')
@section('title', '媒体供应商-账单查询')
@section('header_related')
@endsection
@section('content')

    <div class="w100 nav_hdorder clearfix clr">
        <div class="content">
            <div class="Invoice" style="background:#fff;">
                <div class="INa1dd">
                    <div class="w100">
                        <ul class="tab">
                            <a href="{{route('vider.Event_list')}}">  <li>活动订单</li></a>
                            <li><a href="">预约订单</a></li>
                           {{-- <li><a href="resource_management.php">资源管理</a></li>--}}
                            <a href="{{route('vider.bill_query')}}"> <li class="cur">账单查询</li></a>
                            <a href="{{route('vider.user_center')}}"> <li>用户中心</li></a>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--帐单查询-->
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd" style="margin-top:20px;">
                <div class="info1 clearfix">
                    <div class="info1_l">
                        <div class="bill1" style="border-bottom:1px dotted #e5e5e5;">
                            <h3>平台打款金额：</h3>
                            <p>￥15890.00 元</p></li>
                        </div>
                        <div class="bill1">
                            <h3>余额：</h3>
                            <p>￥5890.00 元</p>
                        </div>
                    </div>
                    <div class="info1_m">
                        <div class="bill1 bill2">
                            <h3>拥有媒体帐号数：</h3>
                            <p>84565个</p>
                        </div>
                        <div class="bill1 bill2" style="margin-top:19px;">
                            <h3>已完成订单数：</h3>
                            <p>65个</p>
                        </div>
                    </div>
                    <div class="info1_r"><img src="/images/pic6.jpg"></div>
                </div>
                <div class="info2">
                    <div class="info2_l">
                        <h3>可接单数：0 单</h3>
                        <a href="" class="btn_b">我要去接单</a>
                    </div>
                    <div class="info2_r">
                        <h3>申诉中的单数：</h3>
                        <b>0 单</b>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="ndt" style="margin-top:30px;padding-bottom:0;">

                    <div class="hdorder radius1">
                        <h3 class="title1"><strong><a href="#">财务明细</a></strong></h3>
                        <div class="dhorder_m">
                            <div class="tab1">
                                <ul>
                                    <li class="cur"><a href="#">全部</a></li>
                                    <li><a href="#">本月</a></li>
                                    <li><a href="#">上月</a></li>
                                </ul>
                                <div class="search_2">
                                    <form action="" method="" name="">
                                        <div class="l">
                                            <span>起止时间</span>
                                        </div>
                                        <div class="l">
                                            <input type="text" class="txt2" id="datepicker1"/>-<input type="text"
                                                                                                      class="txt2"
                                                                                                      id="datepicker2"/>
                                        </div>
                                        <div class="l">
                                            <input type="submit" name="submit" class="sub4" value="查询"/>
                                        </div>
                                    </form>
                                </div>
                                <a href="" class="daochu">导出财务明细</a>
                            </div>
                            <div class="tab1_body" style="min-height:515px;">
                                <table class="table_in1 cur">
                                    <thead>
                                    <tr>
                                        <th width="10%">日期</th>
                                        <th>订单号</th>
                                        <th>平台</th>
                                        <th>资源名称</th>
                                        <th>活动名称</th>
                                        <th>截图/链接</th>
                                        <th>类型</th>
                                        <th>金额</th>
                                        <th>余额</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="9">
                                            <div class="nodata">
                                                <img src="/images/nodata.png"/>
                                                <p>您目前暂无明细信息</p>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table_in1">
                                    <thead>
                                    <tr>
                                        <th width="10%">日期</th>
                                        <th>订单号</th>
                                        <th>平台</th>
                                        <th>资源名称</th>
                                        <th>活动名称</th>
                                        <th>截图/链接</th>
                                        <th>类型</th>
                                        <th>金额</th>
                                        <th>余额</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>2016.8.18</td>
                                        <td>24r34f66</td>
                                        <td>新浪</td>
                                        <td>秒分必争创业</td>
                                        <td>秒分必争创业</td>
                                        <td><a href="" target="_blank"><img class="link" src="/images/ico_link.png"
                                                                            alt="链接/截图"/></a></td>
                                        <td><span class="color_green">优</span></td>
                                        <td><span class="color_red2">80元</span></td>
                                        <td><span class="color_red2">80元</span></td>
                                    </tr>
                                    <tr>
                                        <td>2016.8.18</td>
                                        <td>24r34f66</td>
                                        <td>新浪</td>
                                        <td>秒分必争创业</td>
                                        <td>秒分必争创业</td>
                                        <td><a href="" target="_blank"><img class="link" src="/images/ico_link.png"
                                                                            alt="链接/截图"/></a></td>
                                        <td><span class="color_green">优</span></td>
                                        <td><span class="color_red2">80元</span></td>
                                        <td><span class="color_red2">80元</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table_in1">
                                    <thead>
                                    <tr>
                                        <th width="10%">日期</th>
                                        <th>订单号</th>
                                        <th>平台</th>
                                        <th>资源名称</th>
                                        <th>活动名称</th>
                                        <th>截图/链接</th>
                                        <th>类型</th>
                                        <th>金额</th>
                                        <th>余额</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>2016.8.1811</td>
                                        <td>24r34f66</td>
                                        <td>新浪</td>
                                        <td>秒分必争创业</td>
                                        <td>秒分必争创业</td>
                                        <td><a href="" target="_blank"><img class="link" src="/images/ico_link.png"
                                                                            alt="链接/截图"/></a></td>
                                        <td><span class="color_green">优</span></td>
                                        <td><span class="color_red2">80元</span></td>
                                        <td><span class="color_red2">80元</span></td>
                                    </tr>
                                    <tr>
                                        <td>2016.8.18</td>
                                        <td>24r34f66</td>
                                        <td>新浪</td>
                                        <td>秒分必争创业</td>
                                        <td>秒分必争创业</td>
                                        <td><a href="" target="_blank"><img class="link" src="/images/ico_link.png"
                                                                            alt="链接/截图"/></a></td>
                                        <td><span class="color_green">优</span></td>
                                        <td><span class="color_red2">80元</span></td>
                                        <td><span class="color_red2">80元</span></td>
                                    </tr>
                                    <tr>
                                        <td>2016.8.18</td>
                                        <td>24r34f66</td>
                                        <td>新浪</td>
                                        <td>秒分必争创业</td>
                                        <td>秒分必争创业</td>
                                        <td><a href="" target="_blank"><img class="link" src="/images/ico_link.png"
                                                                            alt="链接/截图"/></a></td>
                                        <td><span class="color_green">优</span></td>
                                        <td><span class="color_red2">80元</span></td>
                                        <td><span class="color_red2">80元</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        /*	日历	*/
        var picker1 = new Pikaday({
            field: document.getElementById('datepicker1'),
            firstDay: 1,
            minDate: new Date('2000-01-01'),
            maxDate: new Date('2020-12-31'),
            yearRange: [2000, 2020]
        });
        var picker2 = new Pikaday({
            field: document.getElementById('datepicker2'),
            firstDay: 1,
            minDate: new Date('2000-01-01'),
            maxDate: new Date('2020-12-31'),
            yearRange: [2000, 2020]
        });
    </script>
@endsection
