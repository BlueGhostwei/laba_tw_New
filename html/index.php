<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>首页 - 亚媒社</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/style2.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/plugins.js"></script>
	<script src="js/jquery.touchslider.min.js"  type="text/javascript"></script>

	<script type="text/javascript" src="js/jquery.SuperSlide.2.1.1.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/echarts.min.js"></script>
	<script type="text/javascript" src="js/date.js"></script>
	<script type="text/javascript" src="js/main2.js"></script>

</head>
<body>

<?php include("head.php"); ?>

<div class="content"><div class="Invoice"><div class="INa1dd">
<div class="main">
	<!--	幻灯片	-->
	<div class="banner">
		<div id="slideBox" class="slideBox">
			<div class="bd">
				<ul>
					<li><a href="#" target="_blank"><img src="images/banner1.jpg" /></a></li>
					<li><a href="#" target="_blank"><img src="images/pic2.jpg" /></a></li>
					<li><a href="#" target="_blank"><img src="images/pic3.jpg" /></a></li>
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
				<form action="" method="" name="">
					<div class="l">
						<span>起始时间</span>
					</div>
					<div class="l">
						<input type="text" class="txt2" id="datepicker1" />-<input type="text" class="txt2" id="datepicker2" />
					</div>
					<div class="l">
						<input type="text" class="txt3" placeholder="请输入关键字" />
						<input type="submit" name="submit" class="sub2" value="" />
					</div>
				</form>
			</div>
			<div class="clr"></div>
		</h3>
		<div class="rwgl_m">
			<div class="tab1">
				<ul>
					<li class="cur"><a href="#">派单类<i class="num">120</i></a></li>
					<li><a href="#">预约类</a></li>
				</ul>
				<select class="paixu">
					<option value="">默认排序</option>
					<option value="">ID号</option>
					<option value="">名称</option>
					<option value="">类型</option>
					<option value="">时间</option>
					<option value="">实际消费</option>
				</select>
			</div>
			<div class="tab1_body">
<table class="table_in1 cur" id="datatable1">
<thead>
	<tr>
		<th>ID号</th>
		<th>名称</th>
		<th><select>
				<option>类型</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
			</select>
		</th>
		<th>时间</th>
		<th>实际消费/元</th>
		<th class="nosort"><select>
				<option>状态</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
			</select></th>
		<th class="nosort">操作</th>
	</tr>
</thead>
<tbody>
	<tr>
		<td>1sdf100000815</td>
		<td>5互联网大数据新闻编写</td>
		<td>3文案策划</td>
		<td>2016-10-12  15:12:00</td>
		<td>1600</td>
		<td>预约状态</td>
		<td><select>
				<option>删除</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
			</select></td>
	</tr>
	<tr>
		<td>2sdf100000815</td>
		<td>4互联网大数据新闻编写</td>
		<td>7文案策划</td>
		<td>2017-9-12  15:12:00</td>
		<td>600</td>
		<td>预约状态</td>
		<td><select>
				<option>删除</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
			</select></td>
	</tr>
	<tr>
		<td>3sdf100000815</td>
		<td>1互联网大数据新闻编写</td>
		<td>文案策划</td>
		<td>2016-9-12  16:12:00</td>
		<td>600</td>
		<td>6预约状态</td>
		<td><select>
				<option>删除</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
			</select></td>
	</tr>
	<tr>
		<td>sdf100000815</td>
		<td>3互联网大数据新闻编写</td>
		<td>2文案策划</td>
		<td>2016-9-12  15:12:00</td>
		<td>6200</td>
		<td>3预约状态</td>
		<td><select>
				<option>1删除</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
			</select></td>
	</tr>
	<tr>
		<td>sdf100000815</td>
		<td>互联网大数据新闻编写</td>
		<td>文案策划</td>
		<td>2016-9-12  15:13:00</td>
		<td>6231400</td>
		<td>35预约状态</td>
		<td><select>
				<option>2删除</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
			</select></td>
	</tr>
	<tr>
		<td>sdf100000815</td>
		<td>互联网大数据新闻编写</td>
		<td>文案策划</td>
		<td>2016-9-12  15:12:00</td>
		<td>600</td>
		<td>预约状态</td>
		<td><select>
				<option>删除</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
			</select></td>
	</tr>
</tbody>
</table>
<table class="table_in1" id="datatable2">
<thead>
	<tr>
		<th>ID号</th>
		<th>名称</th>
		<th><select>
				<option>类型</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
			</select>
		</th>
		<th>时间</th>
		<th>实际消费/元</th>
		<th class="nosort"><select>
				<option>状态</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
			</select></th>
		<th class="nosort">操作</th>
	</tr>
</thead>
<tbody>
	<tr>
		<td>sdf100000815</td>
		<td>3互联网大数据新闻编写</td>
		<td>2文案策划</td>
		<td>2016-9-12  15:12:00</td>
		<td>6200</td>
		<td>3预约状态</td>
		<td><select>
				<option>1删除</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
			</select></td>
	</tr>
	<tr>
		<td>sdf100000815</td>
		<td>互联网大数据新闻编写</td>
		<td>文案策划</td>
		<td>2016-9-12  15:13:00</td>
		<td>6231400</td>
		<td>35预约状态</td>
		<td><select>
				<option>2删除</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
			</select></td>
	</tr>
	<tr>
		<td>sdf100000815</td>
		<td>互联网大数据新闻编写</td>
		<td>文案策划</td>
		<td>2016-9-12  15:12:00</td>
		<td>600</td>
		<td>预约状态</td>
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
			<div class="page_1">
				<span class="info">显示第1到1条派单订单，共1条派单订单</span>
				<span class="pages">
<a href="" class="prev">上一页</a>
<a href="" class="cur">1</a>
<a href="">2</a>
<a href="">3</a>
<a href="">4</a>
<a href="">5</a>
<span class="sus">...</span>
<a href="">248</a>
<a href="" class="next">下一页</a>
				</span>
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
		<div class="row3 row3_2 radius1">
			<h3 class="title1"><strong><a href="#">盈利状况</a></strong></h3>
			<ul>
				<li class="li1">
					<p>分销会员总收益<br/>
						<b>￥2100.00</b></p>
					<span></span></li>
				<li class="li2">
					<p>纯分销收益<br/>
						<b>￥1100.00</b></p>
					<span></span></li>
				<li class="li3">
					<p>占账户总收益率<br/>
						<b>25%</b></p>
					<span></span></li>
			</ul>
		</div>
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

<?php include("foot.php"); ?>

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


</body>
</html>
