@extends('Admin.layout.main')
@section('title', '资源管理')
@section('header_related')
@endsection
@section('content')
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="main" style="margin-top:20px;">

                    <!--	分类管理	-->
                    <div class="hdorder radius1">
                        <h3 class="title1"><strong><a href="#">媒体资源管理</a></strong>
                        </h3>
                        <div class="dhorder_m">
                            <div class="tab1">
                                <ul>
                                    <li class="cur" category_id="0"><a href="#">网络媒体</a></li>
                                    <li><a href="#" category_id="1">户外媒体</a></li>
                                    <li><a href="#" category_id="2">平面媒体</a></li>
                                    <li><a href="#" category_id="3">电视媒体</a></li>
                                    <li><a href="#" category_id="4">广播媒体</a></li>
                                    <li><a href="#" category_id="5">记者媒体</a></li>
                                </ul>
                            </div>
                            <div class="tab1_body">
                                <!--网络媒体-->
                                <table class="table_in1 cur">
                                    <thead>
                                    <tr>
                                        <th style="width: 40%;text-align:left;text-indent:50px;">媒体名称</th>
                                        <th style="width: 15%;text-align:center;text-indent:20px;">状态</th>
                                        <th style="width: 8%;text-align:center;text-indent:20px;">排序</th>
                                        <th style="width: 37%;text-align:center;text-indent:20px;">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td style="width: 40%;text-align:left;text-indent:50px;">新闻发布</td>
                                        <td style="width: 15%;text-align:center;text-indent:20px;">发布</td>
                                        <td style="width: 8%;text-align:center;text-indent:20px;">1</td>
                                        <td style="width: 37%;text-align:center;text-indent:20px;">
                                            <a href="{{route('category.show')}}">查看</a>|
                                            <a href="{{route('category.store')}}">添加</a>|
                                            <a href="#">删除</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--户外媒体-->
                                <table class="table_in1" id="jibie">
                                </table>
                                <!--平面媒体-->
                                <table class="table_in1" id="xingshi">
                                </table>
                                <!--电视媒体-->
                                <table class="table_in1" id="lianjie">
                                </table>
                                <!--广播媒体-->
                                <table class="table_in1" id="quyu">
                                </table>
                                <!--记者媒体-->
                                <table class="table_in1" id="pindao">
                                </table>
                                <div class="page_1 page_1_2" style="padding-bottom: 50px;">
					<span class="pages">
						<a href="" class="prev">上一页</a>
						<a href="" class="">1</a>
						<a href="" class="cur">2</a>
						<a href="">3</a>
						<a href="">4</a>
						<a href="">5</a>
						<span class="sus">...</span>
						<a href="" class="">248</a>
						<a href="" class="next">下一页</a>
					</span>
                                </div>
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