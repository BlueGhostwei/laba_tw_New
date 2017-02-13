<script type="text/javascript">
//头部DIV隐藏显示切换
	function showHideCode(){
		$(".ITuser").css("display","none")
        $(".ITuserda").show();
    }
	function showIMenuda(){
		$(".ITuserda").css("display","none")
        $(".ITuser").show();
    }
	function showexpmenu(){
		$(".menunt").css("display","none")
        $(".menuntda,.expmenu").show();
    }
	function showmenunt(){
		$(".menuntda,.expmenu").css("display","none")
        $(".menunt").show();
    }
</script>

<div class="frame">
	<div class="logo"><a href="index.php"><img src="img/logolaba.png" /></a></div>
    <div class="menunt" onclick="showexpmenu()"></div>
    <div class="menuntda" onclick="showmenunt()"></div>
	
<div class="w_w"">
	
    <div class="ITuser">
    	<div class="Hlogo"><img src="img/bn66.png" /><div class="Hltext">5</div></div>
        <div class="IName" onClick="show();" >
        	<p class="name">1171801173@qq.com</p>
            <p class="account">认证账户</p>
        </div>
        <div class="IMenu" onclick="showHideCode()"></div>
    </div>

	<?php include("nav.php"); ?>
</div>
	
    <!--右弹购物车-->
    <div class="ITuserda">
    	<div style="background:#204186; float:left; width:260px; height:auto;">
            <div class="Hlogo"><img src="img/bn66.png" /></div>
            <div class="IName">
                <p class="name">1171801173@qq.com</p>
                <p class="account">认证账户</p>
            </div>
            <div class="IMenuda" onclick="showIMenuda()"></div>
            <div style="width:260px; float:left; height:auto;">
            	<div class="IT_nt1"><div class="Hltext">5</div></div>
                <div class="IT_nt2"><div class="Hltext">5</div></div>
                <div class="IT_nt3"><img src="img/IT_nt3.png" /></div>
                <div class="IT_nt4"><img src="img/IT_nt4.png" /></div>
            </div>
        </div>
        <div style="background:#1d3a78; float:left; width:260px; height:auto;">
        	<div class="IIO_nt">购物车共：<span>20</span>个</div>
            <ul class="ITorder">
            	<li><a href="">
                	<div class="IOimg"><img src="img/bn66.png" /></div>
                    <div class="IOtext">
                    	<h3>定单标题</h3>
                        <p>微信号：123456</p>
                    </div>
                </a></li>
                <li><a href="">
                	<div class="IOimg"><img src="img/bn66.png" /></div>
                    <div class="IOtext">
                    	<h3>定单标题</h3>
                        <p>微信号：123456</p>
                    </div>
                </a></li>
            </ul>
        </div>
    </div>
</div>
<!--左弹导航-->
			
			<ul class="expmenu">
				<li>
					<div class="header">
						<span class="label" id="sd1">网络媒体</span>
						<span class="arrow up"></span>					</div>
					<ul class="menu">
						<li><a href=""><div class="nd1n">新闻发布</div></a></li>
                        <li><a href=""><div class="nd2n">百科营销</div></a></li>
                        <li><a href=""><div class="nd3n">短视频</div></a></li>
                        <li><a href=""><div class="nd4n">公众号</div></a></li>
                        <li><a href=""><div class="nd5n">论坛</div></a></li>
                        <li><a href=""><div class="nd6n">秒拍</div></a></li>
                        <li><a href=""><div class="nd7n">文案策划</div></a></li>
                        <li><a href=""><div class="nd8n">微博大号</div></a></li>
                        <li><a href=""><div class="nd9n">微信营销</div></a></li>
                        <li><a href=""><div class="nd10n">问答营销</div></a></li>
					</ul>
				</li>
				<li>
					<div class="header">
						<span class="label" id="sd3">户外媒体</span>
                        <span class="arrow up"></span>					</div>
					<ul class="menu">
                    	<li><a href=""><div class="nd1">地标媒体</div></a></li>
                        <li><a href=""><div class="nd2">户外大牌</div></a></li>
                        <li><a href=""><div class="nd3">户外频媒</div></a></li>
                        <li><a href=""><div class="nd4">公交媒体</div></a></li>
                        <li><a href=""><div class="nd5">地铁媒体</div></a></li>
                        <li><a href=""><div class="nd6">楼宇媒体</div></a></li>
                        <li><a href=""><div class="nd7">机场媒体</div></a></li>
                        <li><a href=""><div class="nd8">高铁媒体</div></a></li>
                        <li><a href=""><div class="nd9">影院媒体</div></a></li>
                        <li><a href=""><div class="nd10">高速媒体</div></a></li>
					</ul>
				</li>
				<li>
					<div class="header">
						<span class="label" id="sd4">平面媒体</span>					</div>
					<ul class="menu">
					</ul>
				</li>
				<li>
					<div class="header">
						<span class="label" id="sd5">电视媒体</span>					</div>
					<ul class="menu">
					</ul>
				</li>
				<li>
					<div class="header">
						<span class="label" id="sd6">广播媒体</span>					</div>
					<ul class="menu">
					</ul>
				</li>
				<li>
					<div class="header">
						<span class="label" id="sd2">记者报料</span>					</div>
					<ul class="menu">
					</ul>
				</li>
				<li>
					<div class="header">
						<span class="label" id="sd7">内容代写</span>					</div>
					<ul class="menu">
					</ul>
				</li>
				<li>
					<div class="header">
						<span class="label" id="sd8">宣传定制</span>					</div>
					<ul class="menu">
					</ul>
				</li>
			</ul>
			