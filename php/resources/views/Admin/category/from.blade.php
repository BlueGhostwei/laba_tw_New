@extends('Admin.layout.main')
@section('title', '资源管理')
@section('header_related')
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
@endsection
@section('content')
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="ndt">
                    <!--新闻任务	-->
                    <div class="radius1">
                        <h3 class="title1"><strong><a href="#">新闻任务</a></strong></h3>

                        <div class="sbox_1 clearfix">

                            <div class="sbox_1_w">
                                <div class="sbox_1_item clearfix">
                                    <span class="l" data="option_1"><strong>网站类型</strong></span>
                                    <div class="m">
                                        <ul class="sortable">
                                            <li><a href="" class="cur">不限</a></li>
                                            <li><a href="">全国门户<i class="del"></i></a></li>
                                            <li><a href="">垂直行业<i class="del"></i></a></li>
                                            <li><a href="">地方门户</a></li>
                                            <span   target="_blank">编辑</span>&nbsp;&nbsp;<span  target="_blank">添加</span>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sbox_1_item clearfix">
                                    <span class="l" data="option_2"><strong>入口级别</strong></span>
                                    <div class="m">
                                        <ul class="sortable">
                                            <li><a href="" class="cur">不限</a></li>
                                            <li><a href="">网站首页</a></li>
                                            <li><a href="">频道首页</a></li>
                                            <li><a href="">二级频道首页</a></li>
                                            <li><a href="">三级频道首页</a></li>
                                            <li><a href="">列表页入口</a></li>
                                            <li><a href="">无入口</a></li>
                                            <li class="add"><a href="" target="_blank">添加</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sbox_1_item clearfix">
                                    <span class="l" data="option_3"><strong>入口形式</strong></span>
                                    <div class="m">
                                        <ul class="sortable">
                                            <li><a href="" class="cur">不限</a></li>
                                            <li><a href="">文字标题</a></li>
                                            <li><a href="">焦点图片</a></li>
                                            <li><a href="">图文混排</a></li>
                                            <li><a href="">其他图片</a></li>
                                            <li><a href="">通栏</a></li>
                                            <li><a href="">文字链</a></li>
                                            <li><a href="">画中画</a></li>
                                            <li><a href="">Banner</a></li>
                                            <li><a href="">Button</a></li>
                                            <li><a href="">Floating</a></li>
                                            <li><a href="">流媒体</a></li>
                                        </ul>
                                    </div>
                                    <span class="r"><a href="">更多</a></span>
                                </div>
                                <div class="sbox_1_item clearfix">
                                    <span class="l" data="option_4"><strong>覆盖区域</strong></span>
                                    <div class="m">
                                        <ul class="sortable">
                                            <li><a href="" class="cur">不限</a></li>
                                            <li><a href="">全国</a></li>
                                            <li><a href="">北京</a></li>
                                            <li><a href="">上海</a></li>
                                            <li><a href="">广州</a></li>
                                            <li><a href="">深圳</a></li>
                                            <li><a href="">重庆</a></li>
                                            <li><a href="">天津</a></li>
                                            <li><a href="">江苏</a></li>
                                            <li><a href="">浙江</a></li>
                                            <li><a href="">福建</a></li>
                                            <li><a href="">湖南</a></li>
                                            <li><a href="">湖北</a></li>
                                            <li><a href="">广东</a></li>
                                            <li><a href="">广西</a></li>
                                            <li><a href="">广东</a></li>
                                            <li><a href="">广西</a></li>
                                            <li><a href="">广东</a></li>
                                            <li><a href="">广西</a></li>
                                            <li><a href="">广东</a></li>
                                            <li><a href="">广西</a></li>
                                            <li><a href="">广东</a></li>
                                            <li><a href="">广西</a></li>
                                            <li><a href="">广东</a></li>
                                            <li><a href="">广西</a></li>
                                            <li><a href="">广东</a></li>
                                            <li><a href="">广西</a></li>
                                            <li><a href="">广东</a></li>
                                            <li><a href="">广西</a></li>
                                            <li><a href="">广东</a></li>
                                            <li><a href="">广西</a></li>
                                        </ul>
                                    </div>
                                    <span class="r"><a href="">更多</a></span>
                                </div>
                                <div class="sbox_1_item clearfix">
                                    <span class="l" data="option_5"><strong>频道类型</strong></span>
                                    <div class="m">
                                        <ul class="sortable">
                                            <li><a href="" class="cur">不限</a></li>
                                            <li><a href="">新闻</a></li>
                                            <li><a href="">财经</a></li>
                                            <li><a href="">IT科技</a></li>
                                            <li><a href="">娱乐</a></li>
                                            <li><a href="">旅游</a></li>
                                            <li><a href="">教育</a></li>
                                            <li><a href="">房产</a></li>
                                            <li><a href="">家居</a></li>
                                            <li><a href="">汽车</a></li>
                                            <li><a href="">女性</a></li>
                                            <li><a href="">时尚</a></li>
                                            <li><a href="">美容</a></li>
                                            <li><a href="">母婴育儿</a></li>
                                        </ul>
                                    </div>
                                    <span class="r"><a href="">更多</a></span>
                                </div>
                                <div class="sbox_1_item clearfix">
                                    <span class="l" data="option_6"><strong>会员价</strong></span>
                                    <div class="m">
                                        <ul class="sortable">
                                            <li><a href="" class="cur">不限</a></li>
                                            <li><a href="">50元以下</a></li>
                                            <li><a href="">50-100</a></li>
                                            <li><a href="">100-200</a></li>
                                            <li><a href="">200-500</a></li>
                                            <li><a href="">500-1000</a></li>
                                            <li><a href="">1000以上</a></li>
                                        </ul>
                                    </div>
                                    <span class="r"><a href="">更多</a></span>
                                </div>

                            </div>
                            <div class="sbox_1_b"><i></i><strong>高级搜索</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".sbox_1_item .m ul li a").click(function () {
            $(this).addClass("cur").parent("li").siblings("li").find("a").removeClass("cur");
            var option = $(this).parents(".m").prev("span").attr("data");
            var value = $.trim($(this).html());
            var li = "<li data='" + option + "'><a href=''>" + value + "</a></li>";
            if (value == "不限") {
                $(".sbox_2 .m li[data='" + option + "']").remove();
            } else if ($(".sbox_2 .m li[data='" + option + "']").length > 0) {
//		$(".sbox_2 .m li[data='"+option+"']").remove();
                $(".sbox_2 .m li[data='" + option + "']").find("a").html(value);
            } else {
                $(".sbox_2 .m").append(li);
            }
            return false;
        });


        //$(".sbox_1_w").sortable();										/*	网站类型、入口级别 上下拖拽	*/
        $(".sortable").sortable();
        /*	分类 左右拖拽	*/
        //$(".sortable").sortable({"cancel":"li.add,li:first-child"});		/*	分类 左右拖拽	*/
        $(".sortable").disableSelection();


        $(".sbox_1_item .m ul li a i").click(function () {            /*	点击 右上角x 移除分类	*/
            $(this).parents("li").remove();
            return false;
        });
        $(".sbox_1_item .m ul li.add a").unbind("click").click(function () {            /*	移除 添加按钮 点击事件并绑定新事件	*/
            console.log("xx");
            return false;
        });


        $(".sbox_2 .m").on("click", "li a", function () {
            var option = $(this).parent("li").attr("data");
            var value = $.trim($(this).html());
            $(this).parent("li").remove();
            $(".sbox_1_item span.l[data='" + option + "']").next(".m").find("ul li a").removeClass("cur");
            $(".sbox_1_item span.l[data='" + option + "']").next(".m").find("ul li:first-child a").addClass("cur");
            return false;
        });
        $(".sbox_1_item .r a").click(function () {
            if ($(this).attr("data") == "on") {
                $(this).attr("data", "off");
                $(this).parent().siblings(".m").find("ul").css("height", "25px");
                $(this).parents(".sbox_1_item").css("height", "73px");
            } else {
                $(this).attr("data", "on");
                $(this).parent().siblings(".m").find("ul").css("height", "auto");
                $(this).parents(".sbox_1_item").css("height", "auto");
                var height = $(this).parents(".sbox_1_item").height();
                //	console.log(height);
                $(this).parents(".sbox_1_item").find(".l").css("height", height);
            }
            return false;
        });
    </script>
@endsection