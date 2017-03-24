@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
@endsection
@section('content')

    <div class="content"><div class="Invoice"><div class="INa1dd" style="margin-top:20px;">
                <h3 class="title1"><strong><a href="#">帐单查询</a></strong></h3>
                <div class="info1 clearfix">
                    <div class="info1_l">
                        <div class="bill1" style="border-bottom:1px dotted #e5e5e5;">
                            <h3>平台打款金额：</h3>
                            <p>￥0 元</p></li>
                        </div>
                        <div class="bill1">
                            <h3>余额：0</h3>
                            <p></p>
                        </div>
                    </div>
                    <div class="info1_m">
                        <div class="bill1 bill2">
                            <h3>已发布订单数：</h3>
                            <p>0个</p>
                        </div>
                        <div class="bill1 bill2" style="margin-top:19px;">
                            <h3>未完成订单数：</h3>
                            <p>0个</p>
                        </div>
                    </div>
                    <div class="info1_r"><img src="{{url('admin/images/pic6.jpg')}}" ></div>
                </div>
                <!--<div class="info2">
                    <div class="info2_l">
                        <h3>可发单数：全部</h3>
                        <a href="" class="btn_b">我要去下单</a>
                    </div>
                    <div class="info2_r">
                        <a href="" class="HYzhangdan">充值</a>
                        <a href="" class="HYzhangdan">提现</a>
                    </div>
                </div>-->
            </div></div></div>



    <div class="content"><div class="Invoice">
            <div class="INa1dd"><div class="ndt" style="margin-top:30px;padding-bottom:0;">

                    <div class="hdorder radius1">
                        <h3 class="title1"><strong><a href="#">财务明细</a></strong></h3>
                        <div class="dhorder_m">
                            <div class="tab1" >
                                <ul>
                                    <li class="cur" ><a href="#" class="typesel">全部</a></li>
                                    <li><a href="javascript:void (0)" val="0" class="typesel" >提现</a></li>
                                    <li><a href="javascript:void (0)" val="1" class="typesel">充值</a></li>
                                    <li><a href="javascript:void (0)" val="2" class="typesel">消费</a></li>
                                </ul>
                                <div class="search_2">

                                        <div class="l">
                                            <span>起止时间</span>
                                        </div>
                                        <div class="l">
                                            <input type="text" class="txt2" id="datepicker1" />-<input type="text" class="txt2" id="datepicker2" />
                                        </div>
                                        <div class="l">
                                            <input type="submit" name="submit" id="search" class="sub4" value="查询" />
                                        </div>
                                </div>
                                <a href="" class="daochu">导出财务明细</a>
                            </div>
                            <div class="tab1_body" style="min-height:515px;">
                                <table class="table_in1 cur">
                                    <thead>
                                    <tr>
                                        <th>日期</th>
                                        <th>订单号</th>
                                        <th>订单类型</th>
                                        <th>订单名称</th>
                                        <th>截图/链接</th>
                                        <th>金额</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(empty($lists))
                                    <tr>
                                        <td colspan="9">
                                            <div class="nodata">
                                                <img src="/images/nodata.png" />
                                                <p>您目前暂无明细信息</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                        @foreach($lists as $list)
                                            <tr>
                                                <td>{{$list->created_at}}</td>
                                                <td>{{$list->order_code}}</td>
                                                @if($list->type==0)
                                                <td>提现</td>
                                                @elseif($list->type==1)
                                                    <td>充值</td>
                                                    @else
                                                    <td>消费</td>
                                                    @endif

                                                <td>{{$list->title}}</td>
                                                <td><a href="" target="_blank"><img class="link" src="/images/ico_link.png" alt="链接/截图" /></a></td>
                                                <td><span class="color_red2">{{$list->price}}元</span></td>
                                            </tr>
                                            @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>





                </div></div>
        </div></div>


    <script type="text/javascript">
        /*	日历	*/
        var picker1 = new Pikaday({
            field: document.getElementById('datepicker1'),
            firstDay: 1,
            minDate: new Date('2000-01-01'),
            maxDate: new Date('2020-12-31'),
            yearRange: [2000,2020]
        });
        var picker2 = new Pikaday({
            field: document.getElementById('datepicker2'),
            firstDay: 1,
            minDate: new Date('2000-01-01'),
            maxDate: new Date('2020-12-31'),
            yearRange: [2000,2020]
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            var type ;
            $(".typesel").click(function() {
                type = $(this).attr('val');
            })
            $("#search").click(function () {
                console.log(type);
            })
        })
    </script>
@endsection