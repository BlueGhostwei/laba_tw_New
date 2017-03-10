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
                          <span>新闻发布</span>
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
                                                    @if(isset($vel['data']) &&  !empty($vel['data']))
                                                        @foreach($vel['data'] as $key =>$rsk)
                                                            <li data_id="{{$rsk->id}}"><a href="">{{$rsk->name}}</a>
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        <li data_id="0"><a class="cur" href="">暂无</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <span class="r"><a href="">更多</a></span>
                                        </div>
                                    @else
                                        <div class="sbox_1_item clearfix">
                                                <span class="l" data="option_1">
                                                    <strong>{{$vel['name']}}</strong></span>
                                            <div class="m">
                                                <ul class="sortable">
                                                    <li><a href="" class="cur">不限</a></li>
                                                    @if(isset($vel['data']) && $vel['data'] !=null)
                                                        @foreach($vel['data'] as $kst=>$rvb)
                                                            @if($rvb['name']=="50" || $rvb['name']=="1000")
                                                                <li data_id="{{$rvb['id']}}"><a href="">{{$rvb['name']}}
                                                                        以上<i
                                                                                class="del"></i></a></li>
                                                            @else
                                                                <li data_id="{{$rvb['id']}}"><a href="">{{$rvb['name']}}
                                                                        <i
                                                                                class="del"></i></a></li>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <li><a href="">示例分类<i class="del"></i></a></li>
                                                    @endif
                                                    <li class="add" category_id="{{$vel['category_id']}}"><a href=""
                                                                                                             target="_blank">添加</a>
                                                    </li>
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
                                            <li class="ghostwrite"><a href="" target="_blank">添加</a></li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <span>
                            内容代写
                        </span>
                        <div class="sbox_1_w">
                            <div class="sbox_1_item clearfix">
                                <span class="l" data="option_1"><strong>文案类型</strong></span>
                                <div class="m">
                                    <ul class="sortable">
                                        @if(isset($ghostwrite) && !empty($ghostwrite))
                                            @foreach($ghostwrite as $ky =>$vt)
                                            <li><a href=""
                                                @if($ky==0)
                                                    class="cur"
                                                    @endif
                                                ><i class="del"></i>{{$vt->name}}</a></li>
                                            @endforeach
                                           @else
                                            <li><a href="" class="cur"><i class="del"></i>常规新闻稿</a></li>
                                            @endif
                                        <li class="to_ghostwrite"><a href="" target="_blank" style="position: relative;color: #fff;background: #2D9FDD;padding: 0 10px 0 10px;">添加</a></li>
                                    </ul>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="xinzengfenlei" style="display: none">
        <div class="XZFL"><p>媒体类型:</p>
            <select name="select" id="select">
                @if(isset($result_data) && $result_data != null)
                    @foreach($result_data as $ky =>$v)
                        <option media_id="{{$v['category_id']}}">{{$v['name']}}</option>
                    @endforeach
                @else
                    <option>暂无媒体类型</option>
                @endif
            </select>
        </div>
        <div class="IF3"><p>分类名称:</p>
            <input type="text" name="media_name" id="media_name" class="IFN2"/>
        </div>
        <div class="IF3">
            <input type="submit" name="media_button" id="media_button" value="确    认" class="LGButton3"
                   style="margin-top:15%;"/>
        </div>
        <p>&nbsp;</p>
    </div>
    <div class="ghostwrite" style="display: none;width: 75%; height: auto;margin: auto;padding-left: 25%; padding-top: 5%;">
        <div class="IF3">
            <p>类型名称:</p>
            <input type="text" name="ghostname" id="ghostname" class="IFN2"/>
        </div>
        <div class="IF3">
            <input type="button" name="ghostwrite_button" id="ghostwrite_button" value="确    认" class="LGButton3"
                   style="margin-top:8%;margin-left: 25%"/>
        </div>
        <p>&nbsp;</p>
    </div>
    <script type="text/javascript">
        var _token = $('input[name="_token"]').val();
        $('#ghostwrite_button').click(function () {
            var ghostname = $('input[name="ghostname"]').val();
            $.ajax({
                url: '{{route('category.save')}}',
                data: {
                    'name':ghostname,
                    'media_id': "0",
                    '_token': _token,
                    'pt':"ghostwrite"
                },
                type: 'post',
                dataType: "json",
                stopAllStart: true,
                success: function (data) {
                    if (data.sta == '0') {
                        layer.msg('保存成功', {icon: 1});
                        window.location.reload();
                    } else {
                        layer.msg('保存失败');
                    }
                },
                error: function () {
                    layer.msg('网络发生错误');
                }
            });
        return false
        });
        $('#media_button').click(function () {
            var select_id = $('#select option:selected').attr('media_id');
            var media_name = $('input[name="media_name"]').val();
            $.ajax({
                url: '{{route('category.save')}}',
                data: {
                    'name':media_name,
                    'media_id': select_id,
                    '_token': _token,
                    'pt':''
                },
                type: 'post',
                dataType: "json",
                stopAllStart: true,
                success: function (data) {
                    if (data.sta == '0') {
                        layer.msg('保存成功', {icon: 1});
                        window.location.reload();
                    } else {
                        layer.msg('保存失败');
                    }
                },
                error: function () {
                    layer.msg('网络发生错误');
                }
            });
            return false;
        });

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
            var cate_id = $(this).parents("li").attr('data_id');//获取分类id
            layer.confirm('确认删除？', {
                btn: ['确认', '取消'] //按钮
            }, function () {
                //发送ajax请求删除
                $.ajax({
                    url: '{{route('category.cate_dele')}}',
                    data: {
                        'cate_id': cate_id,
                        '_token': _token
                    },
                    type: 'post',
                    dataType: "json",
                    stopAllStart: true,
                    success: function (data) {
                        if (data.sta == '0') {
                            curl.remove();//移除结构
                            layer.msg('删除成功', {icon: 1});
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
            //获取当前单击添加的类型id
            var category_id = $(this).parent("li").attr('category_id');
            $("#select option").map(function () {
                if ($(this).attr('media_id') == category_id) {
                    $(this).attr("selected", "selected");
                }
            }).get().join(", ");
            layer.open({
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                area: ['35%', '50%'], //宽高
                content: $('.xinzengfenlei')
            });
            return false;
        });
        $(".sbox_1_item .m ul li.to_ghostwrite a").unbind("click").click(function () {  /*内容代写*/
            layer.open({
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                area: ['35%', '50%'], //宽高
                content: $('.ghostwrite')
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