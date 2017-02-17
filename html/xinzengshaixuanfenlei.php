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
					<li><a href="shaixuanfenlei.php">网站类型</a></li>
					<li><a href="shaixuanfenlei.php#jibie">入口级别</a></li>
					<li><a href="shaixuanfenlei.php#xingshi">入口形式</a></li>
					<li><a href="shaixuanfenlei.php#lianjie">正文链接</a></li>
					<li><a href="shaixuanfenlei.php#quyu">覆盖区域</a></li>
					<li><a href="shaixuanfenlei.php#pindao">频道类型</a></li>
					<span  class="cur"><a href="">+新增资源</a></span>
				</ul>
			</div>
			<div class="IF1">
				<div class="xinzengfenlei">
					<div class="XZFL"><p>资源类型:</p>
						<select name="select" id="select">
		                    <option>网站类型</option>
		                    <option>入口级别</option>
		                    <option>入口形式</option>
		                    <option>正文链接</option>
		                </select>
					</div>
					<div class="IF3"><p>资源名称:</p>
						<input type="text" name="textfield2" id="FLnome"  class="IFN2"/>
					</div>
					<div class="IF3"><p>是否发布:</p>
						<input type="radio" name="radio" id="radio1" value="radio1"/>
		                &nbsp;是&nbsp;&nbsp;&nbsp;&nbsp;
		                <input type="radio" name="radio" id="radio2" value="radio2" />
		                &nbsp;否
					</div>
					<div class="IF3"><p>排序:</p>
						<input type="text" name="textfield2" id="FLsorting"  class="FLn1"/>
					</div>
					<div class="IF3"><input type="submit" name="button" id="button" value="提  交" class="LGButton3" style="margin-top:15%;" /></div>
					<p>&nbsp;</p>
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
