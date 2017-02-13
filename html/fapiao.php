<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script src="js/jquery.touchslider.min.js"  type="text/javascript"></script>
</head>
<body >

<?php include("head.php"); ?>


<!--发票申请-->
<div class="content"><div class="Invoice">
<div class="INa1dd"><div class="ndt">
	<div class="Ifapiao"><h2>申请发票</h2></div>
    <div class="IF1">
    	<div class="IF2">
            <div class="IF3">
            	<p>票据类型号:</p>
            	<div class="IFN5">
                	<li class="IFN5atvis">收据</li>
                    <li>普通发票（含税）</li>
                    <li>专用发票（含税）</li>
                </div>
            </div>
            <div class="IF3"><p>发票明细:</p>
                  <select name="select" id="select">
                    <option>网络服务费</option>
                  </select>
      		</div>
            <div class="IF3"><p>可开具金额:</p>
                <input type="radio" name="radio" id="radio1" value="radio1"/>
                &nbsp;充值金额&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="radio" id="radio2" value="radio2" />
                &nbsp;消费金额
            </div>
            <div class="IF3"><p>发票金额:</p>
                  <input type="text" name="textfield" id="textfield"  class="IFN1"/>
                  <span>元</span>
            </div>
            <div class="IF3"><p>发送方式：</p>
                  <input type="radio" name="radio1" id="radio" value="radio" />
                &nbsp;电子档 &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="radio1" id="radio2" value="radio2" />
                &nbsp;纸质快递1000起
            </div>
            <div class="IF3"><p>发票抬头:</p>
      			<input type="text" name="textfield2" id="textfield2"  class="IFN2"/>
            </div>
    		<div class="IF3"><p>备注:</p>
     			 <textarea name="textfield3" id="textfield3" class="IFN3"></textarea>
            </div>
    		<div class="IF3">
            	<p>&nbsp;</p>
                <div class="IFN4">
                    <span style="color:#000; font-weight:700">发票问题</span>
                    <span>标题作为含有哪些关键词要写清楚，关键词最好不要超过2个</span>
                    <span>文章要求：关键词有哪些一定要写清楚，关键词文章内要出现几次，是否带连接、联系方式、图片等、如需带请自行准备   如能提供范文最好，我们可以按照格式撰写。</span>
                </div>
            </div>
            <div class="IF3">
            	<p>&nbsp;</p>
      			<input type="submit" name="button" id="button" value="提 交" class="Button"/>
            </div>
        </div>
    </div>
</div></div>
</div></div>

<?php include("foot.php"); ?>


</body>
</html>
