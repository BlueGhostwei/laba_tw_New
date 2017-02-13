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

<!--会员信息-->
<div class="content"><div class="Invoice">
<div class="INa1dd"><div class="ndt">
	<div class="Ifapiao"><h2>会员信息</h2></div>
    <div class="lanrenzhijia">
	<div class="tab">
    	<a href="javascript:;" class="on">资料编辑</a>
        <a href="javascript:;">安全设置</a>
    </div>
    <div class="Hcontent">
    	<ul>
        	<li style="display:block;">
                <div class="LGnta1" style="float:left;">
                    <div class="LGnt6"><p><i class="LGntas">*</i>个人头像:</p>
                         <div class="LGnt11">
                         	<img src="img/bn66.png" />
                            <p>上传头像</p>
                         </div>
                    </div>
                    <div class="LGnt6"><p><i class="LGntas">*</i>企业名称:</p>
                         <input type="text" name="textfield" id="textfield"  class="LGnt2"/>
                    </div>
                    <div class="LGnt6"><p><i class="LGntas">*</i>联系人:</p>
                         <input type="text" name="textfield" id="textfield"  class="LGnt2"/>
                    </div>
                    <div class="LGnt6"><p><i class="LGntas">*</i>QQ:</p>
                         <input type="text" name="textfield" id="textfield"  class="LGnt2"/>
                    </div>
                    <div class="LGnt6"><p><i class="LGntas">*</i>手机:</p>
                         <input type="text" name="textfield" id="textfield"  class="LGnt2"/>
                         <span>修改</span>
                    </div>
                    <div class="LGnt6"><p><i class="LGntas">*</i>邮箱:</p>
                         <input type="text" name="textfield" id="textfield"  class="LGnt2"/>
                         <span>绑定</span>
                    </div>
                    <i style=" padding-left:80px; font-size:12px; color:#999; float:left;">温馨提示：请填写有效邮箱地址，以便接受通知及订单信息，建议使用QQ，hotmail等邮箱</i>
                    <div style="margin-top:40px; float:left; width:100%">
                        <input type="submit" name="button" id="button" value="提 交" class="LGButton3" />
                    </div>
                </div>
                <div class="LGnta2">
                    <h4>完善资料</h4>
                    <span>资料更完整，账号更安全。完善资料将帮助我们更好的提供服务。</span>
                </div>
            </li>
            <li>安全设置</li>
        </ul>
    </div>
</div>
</div></div>
</div></div>
<script>
$(function(){
	$(".lanrenzhijia .tab a").click(function(){
		$(this).addClass('on').siblings().removeClass('on');
		var index = $(this).index();
		number = index;
		$('.lanrenzhijia .Hcontent li').hide();
		$('.lanrenzhijia .Hcontent li:eq('+index+')').show();
	});
	
	var auto = 1;  //等于1则自动切换，其他任意数字则不自动切换
	if(auto ==1){
		var number = 0;
		var maxNumber = $('.lanrenzhijia .tab a').length;
		function autotab(){
			number++;
			number == maxNumber? number = 0 : number;
			$('.lanrenzhijia .tab a:eq('+number+')').addClass('on').siblings().removeClass('on');
			$('.lanrenzhijia .Hcontent ul li:eq('+number+')').show().siblings().hide();
		}
		
	  }
});
</script>
<!--会员信息end-->


<?php include("foot.php"); ?>

</div>
</body>
</html>
