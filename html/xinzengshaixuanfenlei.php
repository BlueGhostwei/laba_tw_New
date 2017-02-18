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
	<div class="hdorder radius1" style=" float: left; margin-bottom:50px;">
		<h3 class="title1"><strong><a href="#">媒体资源管理</a></strong>
		</h3>
		<div class="dhorder_m">
			<div class="FLnt1">
				<p>修改</p>
				<span>当前位置：<a href="fenlei.php">媒体资源管理</a> > <a href="fenlei.php">网络媒体</a> > 新闻发布</span>
			</div>
			<div class="IF1">
				<div class="FLmeiti1">* 媒体资源信息</div>
				<div class="FLmeiti2">
					<div class="IF3"><p>媒体类型:</p>
						<select name="select" id="select">
		                    <option>新闻发布</option>
		                    <option>百度营销</option>
		                    <option>短视频</option>
		                    <option>公众号</option>
		                </select>
					</div>
					<div class="IF3"><p>媒体名称:</p>
						<input type="text" name="textfield2" id="FLnome"  class="IFN2"/>
					</div>
					<div class="IF3"><p>媒体LOGO:</p>
						<input type="text" name="textfield2" id="FLnome" placeholder="未选择任何文件" class="IFN2"/>
						<i style="font-size: 12px;color: #ccc; padding-left:10px;">(100KB以内)</i>
					</div>
					<div class="IFMeiTi">
						<table><tr>
							<td valign="top"><p>网站类型:</p></td>
							<td><li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
							</td>
						</tr></table>
					</div>
					<div class="IFMeiTi">
						<table><tr>
							<td valign="top"><p>入口级别:</p></td>
							<td><li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
							</td>
						</tr></table>
					</div>
					<div class="IFMeiTi">
						<table><tr>
							<td valign="top"><p>入口形式:</p></td>
							<td><li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
							</td>
						</tr></table>
					</div>
					<div class="IFMeiTi">
						<table><tr>
							<td valign="top"><p>正文链接:</p></td>
							<td><li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
							</td>
						</tr></table>
					</div>
					<div class="IFMeiTi">
						<table><tr>
							<td valign="top"><p>覆盖区域:</p></td>
							<td><li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
								<li><input type="checkbox" name="checkbox" />全国门户</li>
							</td>
						</tr></table>
					</div>
					<div class="IF3"><p>平台价：</p>
						<input type="text" name="textfield2" id="FLsorting"  class="FLn1"/><span>元</span>
					</div><p>&nbsp;</p>
				</div>
				<div class="FLmeiti1">* 媒体负责人基本信息</div>
				<div class="FLmeiti2">
					<div class="IF3"><p>媒体负责人:</p>
						<input type="text" name="textfield2"  class="FLn3"/>
					</div>
					<div class="IF3"><p>联系电话:</p>
						<input type="text" name="textfield2" class="FLn3"/>
					</div>
					<div class="IF3"><p>手机验证码:</p>
						<input type="text" name="textfield2" class="FLn2"/>
					</div>
					<div class="XZFL"><p>电子邮箱:</p>
						<input type="text" name="textfield2"  class="FLn3"/>
					</div>
					<div class="IF3"><p>联系QQ:</p>
						<input type="text" name="textfield2"  class="FLn3"/>
					</div>
					<div class="IF3"><p>联系地址:</p>
						<input type="text" name="textfield2" class="IFN2"/>
					</div>
					<div class="IF3"><p>邮编:</p>
						<input type="text" name="textfield2" class="FLn3"/>
					</div>
					<div class="IF3"><p>媒体认证:</p>
						<select name="select" id="select">
		                    <option>营业执照</option>
		                    <option>身份证</option>
		                </select>
		                <input type="text" name="textfield2" placeholder="未选择任何文件"  class="FLn4"/><i style="font-size: 12px;color: #ccc; padding-left:10px;">(100KB以内)</i>
					</div>
					<div class="IF3"><p>媒体简介:</p>
						<textarea name="textfield3" class="IFN3"></textarea>
					</div>
				</div>
				<input type="submit" name="button" value="提  交" class="LGButton3" style="margin: 5% 30%" />
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
