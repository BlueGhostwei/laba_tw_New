@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
<script src="{{url('Admin/js/laypage.js')}}"  type="text/javascript"></script>
<style type="text/css">
    .laypage_curr{
        background: #CCCCCC;
        color: #fff;
        border-radius: 15px;

        height: 30px;
        line-height: 30px;
        border: 1px solid #E6E6E6;
        padding: 0 16px;
    }
    .laypage_prev{
        color: #fff;
        border-radius: 15px;
        height: 28px;
        line-height: 28px;
        border: 1px solid #E6E6E6;
        padding: 0 16px;
    }
    .laypage_next{

        border: 1px solid #E6E6E6;
        border-radius: 15px;

        float: left;
        height: 30px;
        line-height: 30px;
        padding: 0 11px;
        margin: 0 1px;
    }
    .laypage_main{

    }
</style>
@endsection
@section('content')
    {{--<div class="main-container">
        <div class="container-fluid">
            @include('Admin.layout.breadcrumb', [
                'title' => '首页',
                '' => [
                    '' => '',
                ]
            ])
        </div>
        </div>--}}
    <div class="content"><div class="Invoice"><div class="INa1dd">
                <div class="main">
                    <!--	幻灯片	-->
                    <div class="banner">
                        <div id="slideBox" class="slideBox">
                            <div class="bd">
                                <ul>
                                    <li><a href="#" target="_blank"><img src="{{url('Admin/img/1.jpg')}}" /></a></li>
                                    <li><a href="#" target="_blank"><img src="{{url('Admin/img/2.jpg')}}" /></a></li>
                                    <li><a href="#" target="_blank"><img src="{{url('Admin/img/3.jpg')}}" /></a></li>
                                </ul>
                            </div>
                            <div class="hd">
                                <ul><li>1</li><li>2</li><li>3</li></ul>
                            </div>

                            <!-- 下面是前/后按钮代码，如果不需要删除即可 -->
                            <a class="prev" href="javascript:void(0)"></a>
                            <a class="next" href="javascript:void(0)"></a>
                        </div>
                    </div>

                    <!--	搜索条	-->
                    <div class="searchbar clearfix">
						{{ csrf_field() }}
                        <div class="s_date">
			<span class="sp1">
				<span>Monday</span><b>1</b><i>Feb</i>
			</span>
			<span class="sp2">
				<span>AM</span><b>01:01</b>
			</span>
                        </div>
                        <script type="text/javascript">showtime();</script>
                        <div class="s_search">
                            <form class="form1" method="" action="">
                                <input class="sub1" type="submit" name="submit" value="搜媒体" />
                                <div class="w_txt1">
                                    <input class="txt1" type="text" value="" placeholder="请输入媒体名称关键词，例：”新浪网”" />
                                </div>
                            </form>
                        </div>
                    </div>

                    <!--	投放分布	-->
                    <div class="tffb radius1">
                        <h3 class="title1"><strong><a href="#">投放分布</a></strong></h3>
                        <div class="tffb_m axis" id="tb1">
                        </div>
                    </div>

                    <!--	任务管理	-->
                    <div class="rwgl radius1">
                        <h3 class="title1"><strong><a href="#">任务管理</a></strong>
                            <div class="search_1">
                                <form >
                                    <div class="l">
                                        <span>起始时间</span>
                                    </div>
                                    <div class="l">
                                        <input type="text" class="txt2" id="datepicker1" />-<input type="text" class="txt2" id="datepicker2" />
                                    </div>
                                    <div class="l">
                                        <input type="text" id="keyword" class="txt3" placeholder="请输入关键字" />
                                        <input type="button" name="submit" id="searchnews" class="sub2" value="" />
                                    </div>
                                </form>
                            </div>
                            <div class="clr"></div>
                        </h3>
                        <div class="rwgl_m">
                            <div class="tab1">
                                <ul>
                                    <li class="cur"><a href="#">派单类</a></li>
                                    {{--<li><a href="#">预约类</a></li>--}}
                                </ul>
                                <select class="paixu" id="paixu0">
                                    <option value="">默认排序</option>
                                    <option value="0">ID号</option>
                                    <option value="1">名称</option>
                                    <option value="2">类型</option>
                                    <option value="3">时间</option>
                                    <option value="4">实际消费</option>
                                </select>
                            </div>
                            <div class="tab1_body">
                                <table class="table_in1 cur" id="datatable1">
                                    <thead>
                                    <tr>
                                        <th class="nosort">ID号</th>
                                        <th class="nosort">名称</th>
                                        <th class="nosort"><select id="paixu1">
                                                <option>类型</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>
                                        </th>
                                        <th>时间</th>
                                        <th class="nosort">实际消费/元</th>
                                        <th class="nosort"><select id="paixu2">
                                                <option>状态</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select></th>
                                        <th class="nosort">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody id="listcontent">
                                    @foreach($news as $new)
                                        <tr>
                                            <td>{{$new->order_code}}</td>
                                            <td>{{$new->title}}</td>
                                            <td>{{$new->news_type}}</td>
                                            <td>{{$new->created_at}}</td>
                                            <td>{{$new->price}}</td>
                                            <td>{{$new->status}}</td>
                                            <td><select>
                                                    <option>删除</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{--<table class="table_in1" id="datatable2">--}}
                                    {{--<thead>--}}
                                    {{--<tr>--}}
                                        {{--<th>ID号</th>--}}
                                        {{--<th>名称</th>--}}
                                        {{--<th><select>--}}
                                                {{--<option>类型</option>--}}
                                                {{--<option>1</option>--}}
                                                {{--<option>2</option>--}}
                                                {{--<option>3</option>--}}
                                            {{--</select>--}}
                                        {{--</th>--}}
                                        {{--<th>时间</th>--}}
                                        {{--<th>实际消费/元</th>--}}
                                        {{--<th class="nosort"><select>--}}
                                                {{--<option>状态</option>--}}
                                                {{--<option>1</option>--}}
                                                {{--<option>2</option>--}}
                                                {{--<option>3</option>--}}
                                            {{--</select></th>--}}
                                        {{--<th class="nosort">操作</th>--}}
                                    {{--</tr>--}}
                                    {{--</thead>--}}
                                    {{--<tbody>--}}
                                    {{--<tr>--}}
                                        {{--<td>sdf100000815</td>--}}
                                        {{--<td>3互联网大数据新闻编写</td>--}}
                                        {{--<td>2文案策划</td>--}}
                                        {{--<td>2016-9-12  15:12:00</td>--}}
                                        {{--<td>6200</td>--}}
                                        {{--<td>3预约状态</td>--}}
                                        {{--<td><select>--}}
                                                {{--<option>1删除</option>--}}
                                                {{--<option>1</option>--}}
                                                {{--<option>2</option>--}}
                                                {{--<option>3</option>--}}
                                            {{--</select></td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                        {{--<td>sdf100000815</td>--}}
                                        {{--<td>互联网大数据新闻编写</td>--}}
                                        {{--<td>文案策划</td>--}}
                                        {{--<td>2016-9-12  15:13:00</td>--}}
                                        {{--<td>6231400</td>--}}
                                        {{--<td>35预约状态</td>--}}
                                        {{--<td><select>--}}
                                                {{--<option>2删除</option>--}}
                                                {{--<option>1</option>--}}
                                                {{--<option>2</option>--}}
                                                {{--<option>3</option>--}}
                                            {{--</select></td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                        {{--<td>sdf100000815</td>--}}
                                        {{--<td>互联网大数据新闻编写</td>--}}
                                        {{--<td>文案策划</td>--}}
                                        {{--<td>2016-9-12  15:12:00</td>--}}
                                        {{--<td>600</td>--}}
                                        {{--<td>预约状态</td>--}}
                                        {{--<td><select>--}}
                                                {{--<option>删除</option>--}}
                                                {{--<option>1</option>--}}
                                                {{--<option>2</option>--}}
                                                {{--<option>3</option>--}}
                                            {{--</select></td>--}}
                                    {{--</tr>--}}
                                    {{--</tbody>--}}
                                {{--</table>--}}
                            </div>
                        </div>

                    </div>

                    <!--	新闻中心、盈利状况、联系我们	-->
                    <div class="box_1 clearfix">
                        <div class="row3 row3_1 radius1">
                            <h3 class="title1"><strong><a href="#">新闻中心</a></strong></h3>
                            <ul>
                                <li class="clearfix"><a href="">你的任务已经被某某媒体商确认电视广告精准投放已经实现</a><span>2016-9-16</span></li>
                                <li class="clearfix"><a href="">你的任务已经被某某媒体商确认电视广告精准投放已经实现</a><span>2016-9-16</span></li>
                                <li class="clearfix"><a href="">你的任务已经被某某媒体商确认电视广告精准投放已经实现</a><span>2016-9-16</span></li>
                                <li class="clearfix"><a href="">你的任务已经被某某媒体商确认电视广告精准投放已经实现</a><span>2016-9-16</span></li>
                            </ul>
                            <div class="clr"></div>
                        </div>

                        @if(Auth::user()->role ==3)
                            <div class="row3 row3_2 radius1">
                                <h3 class="title1"><strong><a href="#">会员升级</a></strong></h3>
                                <div style="margin:3% 20%; width: 60%;"><img src="{{url('Admin/img/bthuiyuan.jpg')}}" width="100%" height="100%"></div>
                                <p style="width: 80%; margin: 3% 10%; line-height: 25px; color: #999; font-size: 14px">会员升级，拥有独立账户管理分销业务，自由选择添加管理分销账户，灵活设置账户信息等等。</p>
                            </div>

                            @else
                            <div class="row3 row3_2 radius1">
                                <h3 class="title1"><strong><a href="#">盈利状况</a></strong></h3>
                                <ul>
                                    <li class="li1">
                                        <p>分销会员总收益<br/>
                                            <b>￥0</b></p>
                                        <span></span></li>
                                    <li class="li2">
                                        <p>纯分销收益<br/>
                                            <b>￥0</b></p>
                                        <span></span></li>
                                    <li class="li3">
                                        <p>占账户总收益率<br/>
                                            <b>0%</b></p>
                                        <span></span></li>
                                </ul>
                            </div>
                            @endif






                        <div class="row3 row3_3 radius1">
                            <h3 class="title1"><strong><a href="#">联系我们</a></strong></h3>
                            <div class="row3_3_m">
                                <p>请输入你的电话号码<br/>
                                    稍后即可接到我们的来电。</p>
                                <div class="callback">
                                    <form>
                                        <input type="submit" name="submit" value="免费回电" class="sub3" />
                                        <div class="w_txt4">
                                            <input type="text" name="" value="" placeholder="请输入手机号码" class="txt4" />
                                        </div>
                                    </form>
                                </div>
                                <p style="color:#FF8400;">该通话对您免费，请放心接听。</p>
                                <p>手机请直接输入<br/>座机前请加区号</p>
                            </div>
                        </div>
                    </div>


                    <div class="clr"></div>
                </div>
            </div></div></div>


    <script type="text/javascript">
        /*	日历	*/
        var type = '2';
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
    <script>
/*         var pages = 1;
        laypage({
            cont: 'page', //容器。值支持id名、原生dom对象，jquery对象,
            pages: pages, //总页数
//            curr: location.hash.replace('#!fenye=', ''), //获取hash值为fenye的当前页
//            hash: 'fenye', //自定义hash值
            jump: function(obj){
                $.ajax({
                    type: "get",
                    url: "{{url('Admin/getnewspage')}}",
                    data: {
                        'page':obj.curr,
                        'type':'1'
                    },
                    success: function (msg) {
                        if (msg) {
                            $('#listcontent').html(msg);
                        } else {
                            layer.msg(data.msg);
//                        window.location.reload();
                        }
                    }
                });

            }
        }); */
    </script>

    <script type="text/javascript">
//<div id="datatable1_filter" class="dataTables_filter"><label>搜索<input type="search" class="" placeholder="过滤..." aria-controls="datatable1"></label></div>
		var datatable;
		$(function () {
			var dt_option = {
				"searching" : true,		//是否允许Datatables开启本地搜索
				"paging" : true,			//是否开启本地分页
				"pageLength" : 6,			//每页显示记录数
				"lengthChange" : false,		//是否允许用户改变表格每页显示的记录数 
				"lengthMenu": [ 5, 10, 100 ],		//用户可选择的 每页显示记录数
				"info" : true,
				"columnDefs" : [{
		        	"targets": 'nosort',
					"orderable": false
				}],
				"pagingType": "simple_numbers",
				"language": {
					"search": "搜索",
					sZeroRecords : "没有查询到数据",
					"info": "显示第 _PAGE_/_PAGES_ 页，共_TOTAL_条",
					"infoFiltered": "(筛选自_MAX_条数据)",
					"infoEmpty": "没有符合条件的数据",
					oPaginate: {    
						"sFirst" : "首页",
						"sPrevious" : "上一页",
						"sNext" : "下一页",
						"sLast" : "尾页"    
					},
					searchPlaceholder: "过滤..."
				},
				"order" : [[3,"desc"]]
			};
			datatable =  $('#datatable1').DataTable(dt_option);

            var _token = $('input[name="_token"]').val();
            $("#searchnews").click(function () {
                $.ajax({
                    type:"GET",
                    url:"{{url('Admin/searchnewspage')}}",
                    data:{
                        'start':$("#datepicker1").val(),
                        'end':$("#datepicker2").val(),
                        'title':$("#keyword").val()
                    },
                    success:function (msg) {
						console.log(msg);
                        if (msg) {
							if( $.fn.dataTable.isDataTable(" #datatable1 ") ){
								datatable.destroy();
							}
							$('#listcontent').html(msg);
							datatable =  $('#datatable1').DataTable(dt_option);
                        } else {
							if( $.fn.dataTable.isDataTable(" #datatable1 ") ){
								datatable.destroy();
							}
                            $('#listcontent').html("<tr><td colspan='7'>没有查询到数据！</td></tr>");
//                        window.location.reload();
                        }
                    }
                })
            })
			
			$("#paixu0").change(function(){
				var option = $(this).val();
				if( $.fn.dataTable.isDataTable(" #datatable1 ") ){
					if( option == "" ){
						datatable.column(3).order("desc").draw();		//默认排序
					}else{
						datatable.column(option).order("asc").draw();
					}
				}
			});
			$("#paixu1").change(function(){
				var option = $(this).val();
				if( $.fn.dataTable.isDataTable(" #datatable1 ") ){
					if( option == "" ){
						datatable.column(3).order("desc").draw();
					}else{
						datatable.column(option).order("asc").draw();
					}
				}
			});
			
        })
    </script>


@endsection

