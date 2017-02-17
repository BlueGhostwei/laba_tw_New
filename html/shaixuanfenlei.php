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
		
	<!--	分类管理	-->
	<div class="hdorder radius1">
		<h3 class="title1"><strong><a href="#">分类管理</a></strong>
			<div class="search_1">
				<form action="" method="" name="">
					<div class="l">
						<span>起始时间</span>
					</div>
					<div class="l">
						<input type="text" class="txt2" id="datepicker1" />-<input type="text" class="txt2" id="datepicker2" />
					</div>
					
					<div class="l">
						<input type="text" class="txt5" placeholder="资源名称" />
						<input type="submit" name="submit" class="sub4" value="查询" />
					</div>
				</form>
			</div>
			<div class="clr"></div>
		</h3>
		<div class="dhorder_m">
			<div class="tab1">
				<ul>       
					<li class="cur"><a href="#">网站类型</a></li>
					<li><a href="#">入口级别</a></li>
					<li><a href="#">入口形式</a></li>
					<li><a href="#">正文链接</a></li>
					<li><a href="#">覆盖区域</a></li>
					<li><a href="#">频道类型</a></li>
					<span><a href="xinzengshaixuanfenlei.php">+新增资源</a></li></span>
				</ul>
			</div>
			<div class="tab1_body">
				<!--网站类型-->
				<table class="table_in1 cur">
				<thead>
					<tr>
						<th>排序</th>
						<th>资源类型</th>
						<th>资源名称</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>网站类型</td>
						<td>网站首页</td>
						<td>发布</td>
						<td><select>
								<option>查看</option>
								<option>删除</option>
							</select></td>
					</tr>
				</tbody>
				</table>
				<!--入口级别-->
				<table class="table_in1" id="jibie">
				<thead>
					<tr>
						<th>排序</th>
						<th>资源类型</th>
						<th>资源名称</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>入口级别</td>
						<td>网站首页</td>
						<td>发布</td>
						<td><select>
								<option>查看</option>
								<option>删除</option>
							</select></td>
					</tr>
				</tbody>
				</table>
				<!--入口形式-->
				<table class="table_in1" id="xingshi">
				<thead>
					<tr>
						<th>排序</th>
						<th>资源类型</th>
						<th>资源名称</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>入口形式</td>
						<td>网站首页</td>
						<td>发布</td>
						<td><select>
								<option>查看</option>
								<option>删除</option>
							</select></td>
					</tr>
				</tbody>
				</table>
				<!--正文链接-->
				<table class="table_in1" id="lianjie">
				<thead>
					<tr>
						<th>排序</th>
						<th>资源类型</th>
						<th>资源名称</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>正文链接</td>
						<td>网站首页</td>
						<td>发布</td>
						<td><select>
								<option>查看</option>
								<option>删除</option>
							</select></td>
					</tr>
				</tbody>
				</table>
				<!--覆盖区域-->
				<table class="table_in1" id="quyu">
				<thead>
					<tr>
						<th>排序</th>
						<th>资源类型</th>
						<th>资源名称</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>覆盖区域</td>
						<td>网站首页</td>
						<td>发布</td>
						<td><select>
								<option>查看</option>
								<option>删除</option>
							</select></td>
					</tr>
				</tbody>
				</table>
				<!--频道类型-->
				<table class="table_in1" id="pindao">
				<thead>
					<tr>
						<th>排序</th>
						<th>资源类型</th>
						<th>资源名称</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>频道类型</td>
						<td>网站首页</td>
						<td>发布</td>
						<td><select>
								<option>查看</option>
								<option>删除</option>
							</select></td>
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
