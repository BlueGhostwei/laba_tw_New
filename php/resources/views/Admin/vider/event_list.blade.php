@extends('Admin.layout.main')
@section('title', '媒体供应商-活动订单')
@section('header_related')
@endsection
@section('content')
    <div class="w100 nav_hdorder clearfix clr">
        <div class="content">
            <div class="Invoice" style="background:#fff;">
                <div class="INa1dd">
                    <div class="w100">
                        <ul class="tab">
                            <a href="{{route('vider.Event_list')}}"><li class="cur">活动订单</li></a>
                            <li><a href="">预约订单</a></li>
                            {{--<li><a href="resource_management.php">资源管理</a></li>--}}
                            <a href="{{route('vider.bill_query')}}"> <li>账单查询</li></a>
                            <a href="{{route('vider.user_center')}}"><li>用户中心</li></a>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="main" style="margin-top:20px;">

                    <!--	活动订单	-->
                    <div class="hdorder radius1">
                        <h3 class="title1"><strong><a href="#">活动订单</a></strong>
                            <div class="search_1">
                                <form action="" method="" name="">
                                    <div class="l">
                                        <span>起始时间</span>
                                    </div>
                                    <div class="l">
                                        <input type="text" name="start" class="txt2" id="datepicker1"/>-<input type="text"
                                                                                                  class="txt2" name="end"
                                                                                                  id="datepicker2"/>
                                    </div>
                                    {{--<div class="l">--}}
                                        {{--<select class="sel1">--}}
                                            {{--<option value="">平台</option>--}}
                                            {{--<option value="">ID号</option>--}}
                                            {{--<option value="">名称</option>--}}
                                            {{--<option value="">类型</option>--}}
                                            {{--<option value="">时间</option>--}}
                                            {{--<option value="">实费</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                    <div class="l">
                                        <input type="text" class="txt5" name="title" placeholder="活动名称"/>
                                        {{--<input type="text" class="txt5" placeholder="资源名称"/>--}}
                                        <input type="submit" name="submit" class="sub4" value="查询"/>
                                    </div>
                                </form>
                            </div>
                            <div class="clr"></div>
                        </h3>
                        <div class="dhorder_m">
                            <div class="tab1">
                                <ul>
                                    <li class="cur"><a href="#">全部订单</a></li>
                                    <li><a href="#">已派单</a></li>
                                    <li><a href="#">已提交</a></li>
                                    <li><a href="#">投诉申诉</a></li>
                                    <li><a href="#">已完成</a></li>
                                    <li><a href="#">已流单</a></li>
                                    <li><a href="#">已拒单</a></li>
                                </ul>
                            </div>
                            <div class="tab1_body">
                                <table class="table_in1 cur">
                                    <thead>
                                    <tr>
                                        <th>订单号</th>
                                        <th>资源名称</th>
                                        <th>活动名称</th>
                                        <th>开始时间</th>
                                        <th>结束时间</th>
                                        <th>价格</th>
                                        <th>订单状态</th>
                                        <th>完成链接/截图</th>
                                        <th>质检状态</th>
                                        <th>质检处理</th>
                                        {{--<th>质检扣款</th>--}}
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($result) )

                                        @foreach($result as $key =>$v)
                                        <tr>
                                            <td>{{$v->order_code}}</td>
                                            @if($v->news_type=='news')
                                            <td>新闻发布</td>
                                            @endif
                                            <td>{{$v->title}}</td>
                                            <td>{{date('Y-m-d H:i ',$v->start_time)}}</td>
                                            <td>{{date('Y-m-d H:i ',$v->end_time)}}</td>
                                            <td><span class="color_red1">{{$v->price}}</span></td>
                                            <td>
                                                @if($v->release_sta == 1)
                                                    已派单
                                                @elseif($v->release_sta == 2)
                                                    已提交
                                                @elseif($v->release_sta == 3)
                                                    投诉申诉
                                                @elseif($v->release_sta == 4)
                                                    已完成
                                                @elseif($v->release_sta == 5)
                                                    已拒单
                                                @else
                                                    已流单
                                                @endif
                                            </td>
                                            <td><img class="link" src="{{url('Admin/images/ico_link.png')}}"
                                                                                alt="完成链接/截图"/></td>
                                            <td><span class="color_green">
                                                    @if($v->quality==1)
                                                        优
                                                    @elseif($v->quality==2)
                                                        良
                                                        @else
                                                    差
                                                        @endif
                                                </span></td>
                                            <td>
                                                @if($v->quality==1||$v->quality==2)
                                                    合格
                                                    @else
                                                不合格
                                                    @endif
                                            </td>
                                            {{--<td><span class="color_red2">80元</span></td>--}}
                                            <td>
                                                <a href="{{route('order.details',$v->id)}}"><span>查看</span></a>&nbsp;
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        无信息
                                        @endif
                                    </tbody>
                                </table>
                                <table class="table_in1">
                                    <thead>
                                    <tr>
                                        <th>订单号</th>
                                        <th>资源名称</th>
                                        <th>活动名称</th>
                                        <th>开始时间</th>
                                        <th>结束时间</th>
                                        <th>价格</th>
                                        <th>订单状态</th>
                                        <th>完成链接/截图</th>
                                        <th>质检状态</th>
                                        <th>质检处理</th>
                                        {{--<th>质检扣款</th>--}}
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($list1) )

                                        @foreach($list1 as $key =>$v)
                                            <tr>
                                                <td>{{$v->order_code}}</td>
                                                @if($v->news_type=='news')
                                                    <td>新闻发布</td>
                                                @endif
                                                <td>{{$v->title}}</td>
                                                <td>{{date('Y-m-d H:i ',$v->start_time)}}</td>
                                                <td>{{date('Y-m-d H:i ',$v->end_time)}}</td>
                                                <td><span class="color_red1">{{$v->price}}</span></td>
                                                <td>
                                                    @if($v->release_sta == 1)
                                                        已派单
                                                    @elseif($v->release_sta == 2)
                                                        已提交
                                                    @elseif($v->release_sta == 3)
                                                        投诉申诉
                                                    @elseif($v->release_sta == 4)
                                                        已完成
                                                    @elseif($v->release_sta == 5)
                                                        已拒单
                                                    @else
                                                        已流单
                                                    @endif
                                                </td>
                                                <td><img class="link" src="{{url('Admin/images/ico_link.png')}}"
                                                         alt="完成链接/截图"/></td>
                                                <td><span class="color_green">
                                                    @if($v->quality==1)
                                                            优
                                                        @elseif($v->quality==2)
                                                            良
                                                        @else
                                                            差
                                                        @endif
                                                </span></td>
                                                <td>
                                                    @if($v->quality==1||$v->quality==2)
                                                        合格
                                                    @else
                                                        不合格
                                                    @endif
                                                </td>
                                                {{--<td><span class="color_red2">80元</span></td>--}}
                                                <td>
                                                    <a href="{{route('order.details',$v->id)}}"><span>查看</span></a>&nbsp;
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        无信息
                                    @endif
                                    </tbody>
                                </table>
                                <table class="table_in1">
                                    <thead>
                                    <tr>
                                        <th>订单号</th>
                                        <th>资源名称</th>
                                        <th>活动名称</th>
                                        <th>开始时间</th>
                                        <th>结束时间</th>
                                        <th>价格</th>
                                        <th>订单状态</th>
                                        <th>完成链接/截图</th>
                                        <th>质检状态</th>
                                        <th>质检处理</th>
                                        {{--<th>质检扣款</th>--}}
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($list2) )

                                        @foreach($list2 as $key =>$v)
                                            <tr>
                                                <td>{{$v->order_code}}</td>
                                                @if($v->news_type=='news')
                                                    <td>新闻发布</td>
                                                @endif
                                                <td>{{$v->title}}</td>
                                                <td>{{date('Y-m-d H:i ',$v->start_time)}}</td>
                                                <td>{{date('Y-m-d H:i ',$v->end_time)}}</td>
                                                <td><span class="color_red1">{{$v->price}}</span></td>
                                                <td>
                                                    @if($v->release_sta == 1)
                                                        已派单
                                                    @elseif($v->release_sta == 2)
                                                        已提交
                                                    @elseif($v->release_sta == 3)
                                                        投诉申诉
                                                    @elseif($v->release_sta == 4)
                                                        已完成
                                                    @elseif($v->release_sta == 5)
                                                        已拒单
                                                    @else
                                                        已流单
                                                    @endif
                                                </td>
                                                <td><img class="link" src="{{url('Admin/images/ico_link.png')}}"
                                                         alt="完成链接/截图"/></td>
                                                <td><span class="color_green">
                                                    @if($v->quality==1)
                                                            优
                                                        @elseif($v->quality==2)
                                                            良
                                                        @else
                                                            差
                                                        @endif
                                                </span></td>
                                                <td>
                                                    @if($v->quality==1||$v->quality==2)
                                                        合格
                                                    @else
                                                        不合格
                                                    @endif
                                                </td>
                                                {{--<td><span class="color_red2">80元</span></td>--}}
                                                <td>
                                                    <a href="{{route('order.details',$v->id)}}"><span>查看</span></a>&nbsp;
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        无信息
                                    @endif
                                    </tbody>
                                </table>
                                <table class="table_in1">
                                    <thead>
                                    <tr>
                                        <th>订单号</th>
                                        <th>资源名称</th>
                                        <th>活动名称</th>
                                        <th>开始时间</th>
                                        <th>结束时间</th>
                                        <th>价格</th>
                                        <th>订单状态</th>
                                        <th>完成链接/截图</th>
                                        <th>质检状态</th>
                                        <th>质检处理</th>
                                        {{--<th>质检扣款</th>--}}
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($list3) )

                                        @foreach($list3 as $key =>$v)
                                            <tr>
                                                <td>{{$v->order_code}}</td>
                                                @if($v->news_type=='news')
                                                    <td>新闻发布</td>
                                                @endif
                                                <td>{{$v->title}}</td>
                                                <td>{{date('Y-m-d H:i ',$v->start_time)}}</td>
                                                <td>{{date('Y-m-d H:i ',$v->end_time)}}</td>
                                                <td><span class="color_red1">{{$v->price}}</span></td>
                                                <td>
                                                    @if($v->release_sta == 1)
                                                        已派单
                                                    @elseif($v->release_sta == 2)
                                                        已提交
                                                    @elseif($v->release_sta == 3)
                                                        投诉申诉
                                                    @elseif($v->release_sta == 4)
                                                        已完成
                                                    @elseif($v->release_sta == 5)
                                                        已拒单
                                                    @else
                                                        已流单
                                                    @endif
                                                </td>
                                                <td><img class="link" src="{{url('Admin/images/ico_link.png')}}"
                                                         alt="完成链接/截图"/></td>
                                                <td><span class="color_green">
                                                    @if($v->quality==1)
                                                            优
                                                        @elseif($v->quality==2)
                                                            良
                                                        @else
                                                            差
                                                        @endif
                                                </span></td>
                                                <td>
                                                    @if($v->quality==1||$v->quality==2)
                                                        合格
                                                    @else
                                                        不合格
                                                    @endif
                                                </td>
                                                {{--<td><span class="color_red2">80元</span></td>--}}
                                                <td>
                                                    <a href="{{route('order.details',$v->id)}}"><span>查看</span></a>&nbsp;
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        无信息
                                    @endif
                                    </tbody>
                                </table>
                                <table class="table_in1">
                                    <thead>
                                    <tr>
                                        <th>订单号</th>
                                        <th>资源名称</th>
                                        <th>活动名称</th>
                                        <th>开始时间</th>
                                        <th>结束时间</th>
                                        <th>价格</th>
                                        <th>订单状态</th>
                                        <th>完成链接/截图</th>
                                        <th>质检状态</th>
                                        <th>质检处理</th>
                                        {{--<th>质检扣款</th>--}}
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($list4) )

                                        @foreach($list4 as $key =>$v)
                                            <tr>
                                                <td>{{$v->order_code}}</td>
                                                @if($v->news_type=='news')
                                                    <td>新闻发布</td>
                                                @endif
                                                <td>{{$v->title}}</td>
                                                <td>{{date('Y-m-d H:i ',$v->start_time)}}</td>
                                                <td>{{date('Y-m-d H:i ',$v->end_time)}}</td>
                                                <td><span class="color_red1">{{$v->price}}</span></td>
                                                <td>
                                                    @if($v->release_sta == 1)
                                                        已派单
                                                    @elseif($v->release_sta == 2)
                                                        已提交
                                                    @elseif($v->release_sta == 3)
                                                        投诉申诉
                                                    @elseif($v->release_sta == 4)
                                                        已完成
                                                    @elseif($v->release_sta == 5)
                                                        已拒单
                                                    @else
                                                        已流单
                                                    @endif
                                                </td>
                                                <td><img class="link" src="{{url('Admin/images/ico_link.png')}}"
                                                         alt="完成链接/截图"/></td>
                                                <td><span class="color_green">
                                                    @if($v->quality==1)
                                                            优
                                                        @elseif($v->quality==2)
                                                            良
                                                        @else
                                                            差
                                                        @endif
                                                </span></td>
                                                <td>
                                                    @if($v->quality==1||$v->quality==2)
                                                        合格
                                                    @else
                                                        不合格
                                                    @endif
                                                </td>
                                                {{--<td><span class="color_red2">80元</span></td>--}}
                                                <td>
                                                    <a href="{{route('order.details',$v->id)}}"><span>查看</span></a>&nbsp;
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        无信息
                                    @endif
                                    </tbody>
                                </table>
                                <table class="table_in1">
                                    <thead>
                                    <tr>
                                        <th>订单号</th>
                                        <th>资源名称</th>
                                        <th>活动名称</th>
                                        <th>开始时间</th>
                                        <th>结束时间</th>
                                        <th>价格</th>
                                        <th>订单状态</th>
                                        <th>完成链接/截图</th>
                                        <th>质检状态</th>
                                        <th>质检处理</th>
                                        {{--<th>质检扣款</th>--}}
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($list5) )

                                        @foreach($list5 as $key =>$v)
                                            <tr>
                                                <td>{{$v->order_code}}</td>
                                                @if($v->news_type=='news')
                                                    <td>新闻发布</td>
                                                @endif
                                                <td>{{$v->title}}</td>
                                                <td>{{date('Y-m-d H:i ',$v->start_time)}}</td>
                                                <td>{{date('Y-m-d H:i ',$v->end_time)}}</td>
                                                <td><span class="color_red1">{{$v->price}}</span></td>
                                                <td>
                                                    @if($v->release_sta == 1)
                                                        已派单
                                                    @elseif($v->release_sta == 2)
                                                        已提交
                                                    @elseif($v->release_sta == 3)
                                                        投诉申诉
                                                    @elseif($v->release_sta == 4)
                                                        已完成
                                                    @elseif($v->release_sta == 5)
                                                        已拒单
                                                    @else
                                                        已流单
                                                    @endif
                                                </td>
                                                <td><img class="link" src="{{url('Admin/images/ico_link.png')}}"
                                                         alt="完成链接/截图"/></td>
                                                <td><span class="color_green">
                                                    @if($v->quality==1)
                                                            优
                                                        @elseif($v->quality==2)
                                                            良
                                                        @else
                                                            差
                                                        @endif
                                                </span></td>
                                                <td>
                                                    @if($v->quality==1||$v->quality==2)
                                                        合格
                                                    @else
                                                        不合格
                                                    @endif
                                                </td>
                                                {{--<td><span class="color_red2">80元</span></td>--}}
                                                <td>
                                                    <a href="{{route('order.details',$v->id)}}"><span>查看</span></a>&nbsp;
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        无信息
                                    @endif
                                    </tbody>
                                </table>
                                <table class="table_in1">
                                    <thead>
                                    <tr>
                                        <th>订单号</th>
                                        <th>资源名称</th>
                                        <th>活动名称</th>
                                        <th>开始时间</th>
                                        <th>结束时间</th>
                                        <th>价格</th>
                                        <th>订单状态</th>
                                        <th>完成链接/截图</th>
                                        <th>质检状态</th>
                                        <th>质检处理</th>
                                        {{--<th>质检扣款</th>--}}
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($list6) )

                                        @foreach($list6 as $key =>$v)
                                            <tr>
                                                <td>{{$v->order_code}}</td>
                                                @if($v->news_type=='news')
                                                    <td>新闻发布</td>
                                                @endif
                                                <td>{{$v->title}}</td>
                                                <td>{{date('Y-m-d H:i ',$v->start_time)}}</td>
                                                <td>{{date('Y-m-d H:i ',$v->end_time)}}</td>
                                                <td><span class="color_red1">{{$v->price}}</span></td>
                                                <td>
                                                    @if($v->release_sta == 1)
                                                        已派单
                                                    @elseif($v->release_sta == 2)
                                                        已提交
                                                    @elseif($v->release_sta == 3)
                                                        投诉申诉
                                                    @elseif($v->release_sta == 4)
                                                        已完成
                                                    @elseif($v->release_sta == 5)
                                                        已拒单
                                                    @else
                                                        已流单
                                                    @endif
                                                </td>
                                                <td><img class="link" src="{{url('Admin/images/ico_link.png')}}"
                                                         alt="完成链接/截图"/></td>
                                                <td><span class="color_green">
                                                    @if($v->quality==1)
                                                            优
                                                        @elseif($v->quality==2)
                                                            良
                                                        @else
                                                            差
                                                        @endif
                                                </span></td>
                                                <td>
                                                    @if($v->quality==1||$v->quality==2)
                                                        合格
                                                    @else
                                                        不合格
                                                    @endif
                                                </td>
                                                {{--<td><span class="color_red2">80元</span></td>--}}
                                                <td>
                                                    <a href="{{route('order.details',$v->id)}}"><span>查看</span></a>&nbsp;
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        无信息
                                    @endif
                                    </tbody>
                                </table>

                            </div>
                            {{--<div style="padding:30px 33px;background:#fff;">--}}
                                {{--<div class="info_hdorder clearfix">--}}
                                    {{--<strong>本月订单统计</strong>--}}
                                    {{--<ul>--}}
                                        {{--<li>总订单数0个/0元</li>--}}
                                        {{--<li>已完成0个/0元</li>--}}
                                        {{--<li>流单数0个/0元</li>--}}
                                        {{--<li>拒单数0个/0元</li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        </div>

                    </div>


                    <div class="clr"></div>
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
