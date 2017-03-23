@extends('Admin.layout.main')
@section('title', '媒体供应商-活动列表')
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
                                        <input type="text" class="txt2" id="datepicker1"/>-<input type="text"
                                                                                                  class="txt2"
                                                                                                  id="datepicker2"/>
                                    </div>
                                    <div class="l">
                                        <select class="sel1">
                                            <option value="">平台</option>
                                            <option value="">ID号</option>
                                            <option value="">名称</option>
                                            <option value="">类型</option>
                                            <option value="">时间</option>
                                            <option value="">实费</option>
                                        </select>
                                    </div>
                                    <div class="l">
                                        <input type="text" class="txt5" placeholder="活动名称"/>
                                        <input type="text" class="txt5" placeholder="资源名称"/>
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
                                    <li><a href="#">已取消</a></li>
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
                                        <th>质检扣款</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($result) && $result[0] != null)
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
                                            <td>已受理</td>
                                            <td><a href="" target="_blank"><img class="link" src="/images/ico_link.png"
                                                                                alt="完成链接/截图"/></a></td>
                                            <td><span class="color_green">优</span></td>
                                            <td>合格</td>
                                            <td><span class="color_red2">80元</span></td>
                                            <td><select>
                                                    <option>查看</option>
                                                    <option>删除</option>
                                                </select></td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td>24r34f66</td>
                                            <td>广告发布</td>
                                            <td>秒分必争创业</td>
                                            <td>2016.8.18</td>
                                            <td>2016.8.27</td>
                                            <td><span class="color_red1">￥2830</span></td>
                                            <td>已受理</td>
                                            <td><a href="" target="_blank"><img class="link" src="/images/ico_link.png"
                                                                                alt="完成链接/截图"/></a></td>
                                            <td><span class="color_green">优</span></td>
                                            <td>合格</td>
                                            <td><span class="color_red2">80元</span></td>
                                            <td><select>
                                                    <option>删除</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select></td>
                                        </tr>
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
                                        <th>质检扣款</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>24r34f66</td>
                                        <td>广告发布</td>
                                        <td>秒分必争创业</td>
                                        <td>2016.8.18</td>
                                        <td>2016.8.27</td>
                                        <td><span class="color_red1">￥2830</span></td>
                                        <td>已受理</td>
                                        <td><a href="" target="_blank"><img class="link" src="/images/ico_link.png"
                                                                            alt="完成链接/截图"/></a></td>
                                        <td><span class="color_green">优</span></td>
                                        <td>合格</td>
                                        <td><span class="color_red2">80元</span></td>
                                        <td><select>
                                                <option>删除</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>24r34f66</td>
                                        <td>广告发布</td>
                                        <td>秒分必争创业</td>
                                        <td>2016.8.18</td>
                                        <td>2016.8.27</td>
                                        <td><span class="color_red1">￥2830</span></td>
                                        <td>已受理</td>
                                        <td><a href="" target="_blank"><img class="link" src="/images/ico_link.png"
                                                                            alt="完成链接/截图"/></a></td>
                                        <td><span class="color_green">优</span></td>
                                        <td>合格</td>
                                        <td><span class="color_red2">80元</span></td>
                                        <td><select>
                                                <option>删除</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>24r34f66</td>
                                        <td>广告发布</td>
                                        <td>秒分必争创业</td>
                                        <td>2016.8.18</td>
                                        <td>2016.8.27</td>
                                        <td><span class="color_red1">￥2830</span></td>
                                        <td>已受理</td>
                                        <td><a href="" target="_blank"><img class="link" src="/images/ico_link.png"
                                                                            alt="完成链接/截图"/></a></td>
                                        <td><span class="color_green">优</span></td>
                                        <td>合格</td>
                                        <td><span class="color_red2">80元</span></td>
                                        <td><select>
                                                <option>删除</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select></td>
                                    </tr>
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
                                        <th>质检扣款</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>24r34f66</td>
                                        <td>广告发布</td>
                                        <td>秒分必争创业</td>
                                        <td>2016.8.18</td>
                                        <td>2016.8.27</td>
                                        <td><span class="color_red1">￥2830</span></td>
                                        <td>已受理</td>
                                        <td><a href="" target="_blank"><img class="link" src="/images/ico_link.png"
                                                                            alt="完成链接/截图"/></a></td>
                                        <td><span class="color_green">优</span></td>
                                        <td>合格</td>
                                        <td><span class="color_red2">80元</span></td>
                                        <td><select>
                                                <option>删除</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>24r34f66</td>
                                        <td>广告发布</td>
                                        <td>秒分必争创业</td>
                                        <td>2016.8.18</td>
                                        <td>2016.8.27</td>
                                        <td><span class="color_red1">￥2830</span></td>
                                        <td>已受理</td>
                                        <td><a href="" target="_blank"><img class="link" src="/images/ico_link.png"
                                                                            alt="完成链接/截图"/></a></td>
                                        <td><span class="color_green">优</span></td>
                                        <td>合格</td>
                                        <td><span class="color_red2">80元</span></td>
                                        <td><select>
                                                <option>删除</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select></td>
                                    </tr>
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
                                        <th>质检扣款</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>24r34f66</td>
                                        <td>广告发布</td>
                                        <td>秒分必争创业</td>
                                        <td>2016.8.18</td>
                                        <td>2016.8.27</td>
                                        <td><span class="color_red1">￥2830</span></td>
                                        <td>已受理</td>
                                        <td><a href="" target="_blank"><img class="link" src="/images/ico_link.png"
                                                                            alt="完成链接/截图"/></a></td>
                                        <td><span class="color_green">优</span></td>
                                        <td>合格</td>
                                        <td><span class="color_red2">80元</span></td>
                                        <td><select>
                                                <option>删除</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>24r34f66</td>
                                        <td>广告发布</td>
                                        <td>秒分必争创业</td>
                                        <td>2016.8.18</td>
                                        <td>2016.8.27</td>
                                        <td><span class="color_red1">￥2830</span></td>
                                        <td>已受理</td>
                                        <td><a href="" target="_blank"><img class="link" src="/images/ico_link.png"
                                                                            alt="完成链接/截图"/></a></td>
                                        <td><span class="color_green">优</span></td>
                                        <td>合格</td>
                                        <td><span class="color_red2">80元</span></td>
                                        <td><select>
                                                <option>删除</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>24r34f66</td>
                                        <td>广告发布</td>
                                        <td>秒分必争创业</td>
                                        <td>2016.8.18</td>
                                        <td>2016.8.27</td>
                                        <td><span class="color_red1">￥2830</span></td>
                                        <td>已受理</td>
                                        <td><a href="" target="_blank"><img class="link" src="/images/ico_link.png"
                                                                            alt="完成链接/截图"/></a></td>
                                        <td><span class="color_green">优</span></td>
                                        <td>合格</td>
                                        <td><span class="color_red2">80元</span></td>
                                        <td><select>
                                                <option>删除</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>24r34f66</td>
                                        <td>广告发布</td>
                                        <td>秒分必争创业</td>
                                        <td>2016.8.18</td>
                                        <td>2016.8.27</td>
                                        <td><span class="color_red1">￥2830</span></td>
                                        <td>已受理</td>
                                        <td><a href="" target="_blank"><img class="link" src="/images/ico_link.png"
                                                                            alt="完成链接/截图"/></a></td>
                                        <td><span class="color_green">优</span></td>
                                        <td>合格</td>
                                        <td><span class="color_red2">80元</span></td>
                                        <td><select>
                                                <option>删除</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div style="padding:30px 33px;background:#fff;">
                                <div class="info_hdorder clearfix">
                                    <strong>本月订单统计</strong>
                                    <ul>
                                        <li>总订单数0个/0元</li>
                                        <li>已完成0个/0元</li>
                                        <li>流单数0个/0元</li>
                                        <li>取消数0个/0元</li>
                                        <li>拒单数0个/0元</li>
                                    </ul>
                                </div>
                            </div>

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
