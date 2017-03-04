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
    var picker3 = new Pikaday({
        field: document.getElementById('datepicker3'),
        firstDay: 1,
        minDate: new Date('2000-01-01'),
        maxDate: new Date('2020-12-31'),
        yearRange: [2000,2020]
    });

</script>
<div class="foot">
    <p>@2016-2020版权所有</p>
    <div class="" id="go_top"><a href="javascript:scroll(0,0)">顶部</a></div>
    <script>
        $(function(){
            $(window).scroll(function(){
                if($(window).scrollTop()>=1){
                    $("#go_top").show();
                }else{
                    $("#go_top").hide();
                }
            });
        })
    </script>
</div>
<style type="text/css">
    .clr{	clear:both;	}
    #f_nav {	background:#000;	text-align:center;	padding:10px 0;	text-align:center;	line-height:1.8;	}
    #f_nav a{	color:#fff;		padding:0px 10px;	}
    #f_nav strong{	color:#E53935;	}
</style>
<div class="float_serv">
    <ul>
        <li class="serv_1"><a title="xxxx1" href=""></a></li>
        <li class="serv_2"><a title="xxxx2" href=""></a></li>
        <li class="serv_3"><a title="xxxx3" href=""></a></li>
        <li class="serv_4"><a title="电话：135 0000 0000" href=""></a></li>
        <li class="serv_5"><a title="xxxx5" href=""></a></li>
    </ul>
</div>
{{--
<div class="clr" id="f_nav">
    <a href="login.php">登录</a>
    <a href="reg.php">注册</a>
    <a href="fapiao.php">发票申请</a>
    <a href="chongzhi.php">账户充值</a>
    <a href="huiyuanedit.php">会员资料编辑</a>
    <a href="baike.php">网络-百科</a>
    <a href="huodongorder.php" title="媒体供应商_活动订单.psd">活动订单</a>
</div>--}}
