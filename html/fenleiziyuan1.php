<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>媒体供应商_活动订单 - 亚媒社</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	
	<link href="css/style2.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/plugins.js"></script>
	<script src="js/jquery.touchslider.min.js"  type="text/javascript"></script>

	<script type="text/javascript" src="js/date.js"></script>
	<script type="text/javascript" src="js/main2.js"></script>

</head>
<body>

<?php include("head.php"); ?>

<div class="content"><div class="Invoice"><div class="INa1dd">
<div class="main" style="margin-top:20px;">
		
	<!--	媒体资源管理	-->
	<div class="hdorder radius1">
		<h3 class="title1"><strong><a href="#">媒体资源管理</a></strong>
		</h3>
		<div class="dhorder_m">
			<div class="FLnt1">
				<p>查看资源</p>
				<span>当前位置：<a href="fenlei.php">媒体资源管理</a> > <a href="fenlei.php">网络媒体</a> > 新闻发布</span>
			</div>
			<div class="tab1_body">
				<!--网站类型-->
				<table class="table_in1 cur">
				<thead>
					<tr>
						
						<th style="width: 40%;text-align:left;text-indent:50px;">资源名称</th>
						<th style="width: 15%;text-align:center;text-indent:20px;">状态</th>
						<th style="width: 8%;text-align:center;text-indent:20px;">排序</th>
						<th style="width: 37%;text-align:center;text-indent:20px;">操作</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="width: 40%;text-align:left;text-indent:50px;">网站类型</td>
						<td style="width: 15%;text-align:center;text-indent:20px;">发布</td>
						<td style="width: 8%;text-align:center;text-indent:20px;">1</td>
						<td style="width: 37%;text-align:center;text-indent:20px;">
							<a href="shaixuanfenlei.php">查看资源分类</a>|
							<a href="fenleixiugai1.php">修改</a>|
							<a href="#">添加资源</a>|
							<a href="#">删除</a>
						</td>
					</tr>
					<tr>
						<td style="width: 40%;text-align:left;text-indent:50px;">入口形式</td>
						<td style="width: 15%;text-align:center;text-indent:20px;">发布</td>
						<td style="width: 8%;text-align:center;text-indent:20px;">2</td>
						<td style="width: 37%;text-align:center;text-indent:20px;">
							<a href="">查看资源分类</a>|
							<a href="#">修改</a>|
							<a href="#">添加资源</a>|
							<a href="#">删除</a>
						</td>
					</tr>
				</tbody>
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
