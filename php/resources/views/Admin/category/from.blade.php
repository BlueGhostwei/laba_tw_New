@extends('Admin.layout.main')
@section('title', '资源管理')
@section('header_related')
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="{{url('Admin/js/layer.js')}}"></script>
@endsection
@section('content')
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="ndt">
                    <!--新闻任务	-->
                    <div class="sbox_1 clearfix">
                        {{ csrf_field() }}
                        <div class="sbox_1_w">
                            @if(isset($result_data) && $result_data != null)
                                @foreach($result_data as $key =>$vel)
                                    @if($vel['category_id']==3)
                                        <div class="sbox_1_item clearfix">
                                            <span class="l" data="option_4" category_id="{{$vel['category_id']}}">
                                                <strong>{{$vel['name']}}</strong></span>
                                            <div class="m">
                                                <ul class="sortable">
                                                    <li data_id="0"><a class="cur" href="">全国</a></li>
                                                    @if(isset($vel['data']) && $vel['data'] !=null)
                                                        @foreach($vel['data'] as $key =>$vel)
                                                            <li data_id="{{$vel->id}}"><a href="">{{$vel->name}}</a>
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        <li data_id="0"><a class="cur" href="">全国</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <span class="r"><a href="">更多</a></span>
                                        </div>
                                    @else
                                        <div class="sbox_1_item clearfix">
                                                <span class="l" data="option_1" category_id="{{$vel['category_id']}}">
                                                    <strong>{{$vel['name']}}</strong></span>
                                            <div class="m">
                                                <ul class="sortable">
                                                    <li><a href="" class="cur">不限</a></li>
                                                    @foreach($vel['data'] as $key=>$vel)
                                                        <li data_id="{{$vel['id]}}"><a href=""><i class="del"></i></a></li>
                                                        @endforeach
                                                    <li><a href="">全国门户<i class="del"></i></a></li>
                                                    <li><a href="">垂直行业<i class="del"></i></a></li>
                                                    <li><a href="">地方门户<i class="del"></i> </a></li>
                                                    <li class="add"><a href="" target="_blank">添加</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="sbox_1_item clearfix">
                                    <span class="l" data="option_1"><strong>网站类型</strong></span>
                                    <div class="m">
                                        <ul class="sortable">
                                            <li><a href="" class="cur">不限</a></li>
                                            <li><a href="">全国门户<i class="del"></i></a></li>
                                            <li><a href="">垂直行业<i class="del"></i></a></li>
                                            <li><a href="">地方门户<i class="del"></i> </a></li>
                                            <li class="add"><a href="" target="_blank">添加</a></li>
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
                            @endif
                        </div>
                        <div class="sbox_1_b"><i></i><strong>高级搜索</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="xinzengfenlei" style="display: none">
        <div class="XZFL"><p>媒体类型:</p>
            <select name="select" id="select">
                @if(isset($midia_type) && !empty($midia_type))
                    @foreach($midia_type as $k=>$v)
                        {{--<option media_id="{{$v['media_id']}}">{{$v['media_name']}}</option>--}}
                    @endforeach
                @else
                    <option>网络媒体</option>
                    <option>户外媒体</option>
                    <option>平面媒体</option>
                    <option>电视媒体</option>
                    <option>广播媒体</option>
                    <option>记者媒体</option>
                @endif
            </select>
        </div>
        <div class="IF3"><p>分类名称:</p>
            <input type="text" name="media_name" id="media_name" class="IFN2"/>
        </div>
        <div class="IF3"><p>是否发布:</p>
            <input type="radio" name="radio_true" checked id="radio1" value="0"/>
            &nbsp;是&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="radio_false" id="radio2" value="1"/>
            &nbsp;否
        </div>
        <div class="IF3"><p>排序:</p>
            <input type="text" name="Sorting" id="FLsorting" class="FLn1" value=""/>
        </div>
        <div class="IF3">
            <input type="submit" name="media_button" id="media_button" value="确    认" class="LGButton3"
                   style="margin-top:15%;"/>
        </div>
        <p>&nbsp;</p>
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
            //询问框
            var curl = $(this).parents("li");//获取li的下标
            var cate_id = "";//获取分类id
            var _token = $('input[name="_token"]').val();
            layer.confirm('确认删除？', {
                btn: ['确认', '取消'] //按钮
            }, function () {
                //发送ajax请求删除
                $.ajax({
                    url: '{{route('category.cate_dele')}}',
                    data: {
                        'id': cate_id,
                        '_token': _token
                    },
                    type: 'post',
                    dataType: "json",
                    stopAllStart: true,
                    success: function (data) {
                        if (data.sta == '0') {
                            curl.remove();//移除结构
                            layer.msg('删除成功', {icon: 1});
                            // layer.msg(data.msg || '请求成功');
                        } else {
                            layer.msg(data.msg || '请求失败');
                        }
                    },
                    error: function () {
                        layer.msg('网络发生错误！！');
                        return false;
                    }
                });
                return false;
            }, function () {
                //return false;
            });
        });
        $(".sbox_1_item .m ul li.add a").unbind("click").click(function () {            /*	移除 添加按钮 点击事件并绑定新事件	*/
            layer.open({
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                area: ['35%', '50%'], //宽高
                content: $('.xinzengfenlei')
            });
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