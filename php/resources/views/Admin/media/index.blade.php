@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')

@endsection
@section('content')
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="ndt">
                    <!--	新闻任务	-->
                    <div class="radius1">
                        <h3 class="title1"><strong><a href="#">新闻任务</a></strong></h3>
                        <div class="sbox_1 clearfix">
                            <div class="sbox_1_w">
                                {{ csrf_field() }}
                                @if(isset($result_data) && $result_data != null)
                                    @foreach($result_data as $key =>$vel)
                                        @if($vel['category_id']==3)
                                            <div class="sbox_1_item clearfix">
                                                <span class="l" data="option_4">
                                                    <strong>{{$vel['name']}}</strong></span>
                                                <div class="m">
                                                    <ul category_id="{{$vel['category_id']}}">
                                                        <li><a href="" class="cur">不限</a></li>
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
                                        @elseif($vel['set_name']!="standard")
                                            <div class="sbox_1_item clearfix">
                                                <span class="l" data="option_1"><strong>{{$vel['name']}}</strong></span>
                                                <div class="m">
                                                    <ul category_id="{{$vel['category_id']}}">
                                                        @if(isset($vel['data']) && $vel['data'] !=null)
                                                            <li><a href="" class="cur">不限</a></li>
                                                            @foreach($vel['data'] as $kst=>$rvb)
                                                                @if($rvb['name']==50 || $rvb['name']==1000)
                                                                    <li data_id="{{$rvb['id']}}"><a
                                                                                href="">{{$rvb['name']}}以上</a></li>
                                                                @else
                                                                    <li data_id="{{$rvb['id']}}"><a
                                                                                href="">{{$rvb['name']}}</a></li>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <li><a href="">示例分类<i class="del"></i></a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="sbox_1_item clearfix">
                                        <span class="l" data="option_1"><strong>网站类型</strong></span>
                                        <div class="m">
                                            <ul>
                                                <li><a href="" class="cur">不限</a></li>
                                                <li><a href="">全国门户</a></li>
                                                <li><a href="">垂直行业</a></li>
                                                <li><a href="">地方门户</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                <div class="sbox_3">
                                    <h4>
                                        <strong class="l">共<b>6573</b>条资源</strong>
                                <span class="r">每页显示
                                    <select class="" id="">
                                        <option value="10">10</option>
                                        <option value="5">5</option>
                                    </select>条记录
                                </span>
                                    </h4>
                                    <div class="sbox_3_table">
                                        <table class="" width="100%">
                                            <thead>
                                            <tr>
                                                <th class="sbox_3_t1" width="5%">序号</th>
                                                <th class="sbox_3_t1" width="18%">资源名称</th>
                                                <th class="sbox_3_t2" width="10%">入口形式</th>
                                                <th class="sbox_3_t3" width="10%">入口级别</th>
                                                <th class="sbox_3_t4" width="16%">正文带链接</th>
                                                <th class="sbox_3_t5" width="10%">入口示意图</th>
                                                <th class="sbox_3_t6" width="10%">代理价</th>
                                                <th class="sbox_3_t7" width="10%">会员价</th>
                                                <th class="sbox_3_t8" width="10%">平台价</th>
                                            </tr>
                                            </thead>
                                            <tbody id="wrapper_i">
                                            @if(isset($media_list) && !empty($media_list))
                                                @foreach($media_list as $key =>$vel)
                                                    <tr>
                                                        <td>{{count($media_list)-$key}}</td>
                                                        <td class="sbox_3_t1">
                                                            <img src="{{md52url($vel->media_md5)}}"
                                                                 style="width: 100px;height:30px"/>
                                                            {{$vel->media_name}}
                                                        </td>
                                                        @if(empty($vel->Entrance_form))
                                                            <td>不限</td>
                                                        @else
                                                            @foreach($vel->Entrance_form as $ky =>$vl)
                                                                <td>{{$vl->name}}</td>
                                                            @endforeach
                                                        @endif
                                                        @if(empty($vel->Entrance_level))
                                                            <td>不限</td>
                                                        @else
                                                            @foreach($vel->Entrance_level as $ky =>$vl)
                                                                <td>{{$vl->name}}</td>
                                                            @endforeach
                                                        @endif
                                                        @if(empty($vel->standard))
                                                            <td>不限</td>
                                                        @else
                                                            @foreach($vel->standard as $ky =>$vl)
                                                                <td>{{$vl->name}}</td>
                                                            @endforeach
                                                        @endif

                                                        <td class="sbox_3_t5"><img src="{{md52url($vel->diagram_img)}}"
                                                                                   style="width: 50px;height:20px"></td>
                                                        <td class="sbox_3_t6">{{$vel->pf_price}}</td>
                                                        <td class="sbox_3_t7">{{$vel->px_price}}</td>
                                                        <td class="sbox_3_t8">{{$vel->mb_price}}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>1</td>
                                                    <td class="sbox_3_t1">
                                                        <img src="{{url('Admin/images/logo_sina.jpg')}}"/>
                                                        新浪新闻
                                                    </td>
                                                    <td class="sbox_3_t2">文字标题</td>
                                                    <td class="sbox_3_t3">无入口</td>
                                                    <td class="sbox_3_t4">不能带图片、网址、
                                                        二维码、联系方式等
                                                    </td>
                                                    <td class="sbox_3_t5"></td>
                                                    <td class="sbox_3_t6">￥228.00</td>
                                                    <td class="sbox_3_t7">￥228.00</td>
                                                    <td class="sbox_3_t8">￥228.00</td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                        <div class="sbox_3_b"><a href="" class="more">加载更多</a></div>
                                    </div>
                                </div>
                                <div class="sbox_4 clearfix">
                                    <div class="WIn2">
                                        <h2>已选媒体</h2>
                                        <table width="100%" border="0">
                                            <tbody>
                                            <tr class="WIna1">
                                                <td class="WIna2">媒体名称</td>
                                                <td class="WIna3">介绍</td>
                                                <td class="WIna4">价格</td>
                                                <td class="WIna4">删除</td>
                                            </tr>
                                            <tr>
                                                <td class="WIna5"><img src="{{url('Admin/img/bn66.png')}}">新浪网</td>
                                                <td class="WIna6">新浪网XXXXXXXXXXXXXX</td>
                                                <td class="WIna7">80元</td>
                                                <td class="WIna8"><a href="">×</a></td>
                                            </tr>
                                            <tr>
                                                <td class="WIna5"><img src="{{url('Admin/img/bn66.png')}}">新浪网</td>
                                                <td class="WIna6">新浪网*****</td>
                                                <td class="WIna7">100元</td>
                                                <td class="WIna8"><a href="">×</a></td>
                                            </tr>
                                            <tr>
                                                <td class="WIna5"><img src="{{url('Admin/img/bn66.png')}}">新浪网</td>
                                                <td class="WIna6">新浪网*****</td>
                                                <td class="WIna7">100元</td>
                                                <td class="WIna8"><a href="">×</a></td>
                                            </tr>
                                            <tr>
                                                <td class="WIna5"><img src="{{url('Admin/img/bn66.png')}}">新浪网</td>
                                                <td class="WIna6">新浪网*****</td>
                                                <td class="WIna7">100元</td>
                                                <td class="WIna8"><a href="">×</a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="sbox_5">
                                    <div class="WIn2">
                                        <h2>新闻内容</h2>
                                        <div class="WMain1">
                                            <div class="WMain2">
                                                <ul>
                                                    <li style="display:block;">
                                                        <div class="WMain3"><p><i class="LGntas">*</i>活动标题:</p>
                                                            <input type="text" name="textfield" id="textfield"
                                                                   placeholder="可输入25个汉字" class="WIFN1"/>
                                                        </div>
                                                        <div class="WMain3"><p><i class="LGntas">*</i>稿件内容:</p>
                                                            <label><input type="radio" name="gao"
                                                                          onclick="waibu.style.display='';shangchuan.style.display='none';bianji.style.display='none';"
                                                                          checked/>外部连接</label>
                                                            <label><input type="radio" name="gao"
                                                                          onclick="shangchuan.style.display='';waibu.style.display='none';bianji.style.display='none';"/>上传文档</label>
                                                            <label><input type="radio" name="gao"
                                                                          onclick="bianji.style.display='';waibu.style.display='none';shangchuan.style.display='none';"/>内部编辑</label>
                                                        </div>
                                                        <div id="waibu" title="外部连接">
                                                            <div class="WMain3"><p><i class="LGntas">*</i>外部链接:</p>
                                                                <input type="text" name="textfield" id="textfield"
                                                                       class="WIFN1"/>
                                                            </div>
                                                            <div class="WMain3 WMain3_1"><p><i class="LGntas"></i>关键字:
                                                                </p>
                                                                <div id="key_input">
                                                                    <input type="text" name="textfield" id="textfield"
                                                                           class="WIFN1"
                                                                           placeholder="关键字不超过100个字符，多个关键字请用。隔开"/>
                                                                    <p>还可输入<b>100</b>个字</p>
                                                                </div>
                                                            </div>
                                                            <div class="WMain3 WMain3_2"><p><i class="LGntas">*</i>开始时间:
                                                                </p>
                                                                <input type="text" name="textfield" id="datepicker1"
                                                                       class="txt2"/>
                                                                <select class="sel_t1 options_h"></select>时
                                                                <select class="sel_t1 options_m"></select>分
                                                                <!--	<option value="00">00</option>	-->
                                                                <span>请选择当前时间15分钟后，7天之内的时间</span>
                                                            </div>
                                                            <div class="WMain3 WMain3_2"><p><i class="LGntas">*</i>截止时间:
                                                                </p>
                                                                <input type="text" name="textfield" id="datepicker2"
                                                                       class="txt2"/>
                                                                <select class="sel_t1 options_h"></select>时
                                                                <select class="sel_t1 options_m"></select>分
                                                                <span>请选择开始时间24小时后，7天之内的时间</span>
                                                            </div>
                                                        </div>

                                                        <div id="shangchuan" title="上传文档" style="display: none;">
                                                            <div class="WMain3 WMain3_2"><p><i class="LGntas"></i>稿件导入:
                                                                </p>
                                                                <input type="text" name="textfield" id="textfield"
                                                                       class="txt6"/>
                                                                <button type="button" name="textfield" id="textfield" class="txt7"/>
                                                                导入</button><br/>
                                                                <span style="margin-left: 145px;">选填，如果您的文章已编辑完成，请复制链接到此处，并点击“导入”。</span>
                                                            </div>
                                                            <div class="WMain3 WMain3_1"><p><i class="LGntas"></i>关键字:
                                                                </p>
                                                                <div id="key_input">
                                                                    <input type="text" name="textfield" id="textfield"
                                                                           class="WIFN1"
                                                                           placeholder="关键字不超过100个字符，多个关键字请用。隔开"/>
                                                                    <p>还可输入<b>100</b>个字</p>
                                                                </div>
                                                            </div>
                                                            <div class="WMain3 WMain3_2"><p><i class="LGntas">*</i>开始时间:
                                                                </p>
                                                                <input type="text" name="textfield" id="datepicker1"
                                                                       class="txt2"/>
                                                                <select class="sel_t1 options_h"></select>时
                                                                <select class="sel_t1 options_m"></select>分
                                                                <!--	<option value="00">00</option>	-->
                                                                <span>请选择当前时间15分钟后，7天之内的时间</span>
                                                            </div>
                                                            <div class="WMain3 WMain3_2"><p><i class="LGntas">*</i>截止时间:
                                                                </p>
                                                                <input type="text" name="textfield" id="datepicker2"
                                                                       class="txt2"/>
                                                                <select class="sel_t1 options_h"></select>时
                                                                <select class="sel_t1 options_m"></select>分
                                                                <span>请选择开始时间24小时后，7天之内的时间</span>
                                                            </div>
                                                        </div>

                                                        <div id="bianji" title="内部编辑" style="display: none;">
                                                            <div class="WMain3 WMain3_1"><p><i class="LGntas"></i>关键字:
                                                                </p>
                                                                <div id="key_input">
                                                                    <input type="text" name="textfield" id="textfield"
                                                                           class="WIFN1"
                                                                           placeholder="关键字不超过100个字符，多个关键字请用。隔开"/>
                                                                    <p>还可输入<b>100</b>个字</p>
                                                                </div>
                                                            </div>
                                                            <div class="WMain3 WMain3_2"><p><i class="LGntas">*</i>开始时间:
                                                                </p>
                                                                <input type="text" name="textfield" id="datepicker1"
                                                                       class="txt2"/>
                                                                <select class="sel_t1 options_h"></select>时
                                                                <select class="sel_t1 options_m"></select>分
                                                                <!--	<option value="00">00</option>	-->
                                                                <span>请选择当前时间15分钟后，7天之内的时间</span>
                                                            </div>
                                                            <div class="WMain3 WMain3_2"><p><i class="LGntas">*</i>截止时间:
                                                                </p>
                                                                <input type="text" name="textfield" id="datepicker2"
                                                                       class="txt2"/>
                                                                <select class="sel_t1 options_h"></select>时
                                                                <select class="sel_t1 options_m"></select>分
                                                                <span>请选择开始时间24小时后，7天之内的时间</span>
                                                            </div>
                                                            <div class="WMain3 WMain3_1"><p><i class="LGntas">*</i>内容编辑:
                                                                </p>
                                                                <script id="container" name="content" type="text/plain"
                                                                        style="width:90%;height:500px"></script>
                                                            </div>
                                                        </div>
                                                        <div class="WMain3 WMain3_1"><p><i class="LGntas">*</i>新闻备注:</p>
                                                            <div>
                                                                <input type="text" name="textfield" id="textfield"
                                                                       class="WIFN2"/>
                                                                <p>还可能输入<b>50</b>个字</p>
                                                            </div>
                                                        </div>
                                                        <div class="WMain3"><p><i class="LGntas"></i></p>
                                                            <label><input type="checkbox" name="admit" id="admit"/>我已经阅读并同意云媒体交易平台习家规则</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div style="margin:40px 0 80px 0; float:left; left:30%; position:relative;">
                                            <img src="{{url('Admin/img/WLButton.png')}}"/>
                                        </div>
                                        <script>
                                            $(function () {
                                                var _token = $('input[name="_token"]').val();
                                                $(".WMain1 .tab a").click(function () {
                                                    $(this).addClass('on').siblings().removeClass('on');
                                                    var index = $(this).index();
                                                    number = index;
                                                    $('.WMain1 .WMain2 li').hide();
                                                    $('.WMain1 .WMain2 li:eq(' + index + ')').show();
                                                });

                                                var auto = 1;  //等于1则自动切换，其他任意数字则不自动切换
                                                if (auto == 1) {
                                                    var number = 0;
                                                    var maxNumber = $('.WMain1 .tab a').length;

                                                    function autotab() {
                                                        number++;
                                                        number == maxNumber ? number = 0 : number;
                                                        $('.WMain1 .tab a:eq(' + number + ')').addClass('on').siblings().removeClass('on');
                                                        $('.WMain1 .WMain2 ul li:eq(' + number + ')').show().siblings().hide();
                                                    }

                                                }
                                            });
                                        </script>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                var ue = UE.getEditor('container');
            </script>
            <script type="text/javascript">
                var _token = $('input[name="_token"]').val();
                /*	日历	*/
                var picker1 = new Pikaday({
                    field: document.getElementById('datepicker1'),
                    firstDay: 1,
                    minDate: new Date('2000-01-01'),
                    maxDate: new Date('2020-12-31'),
                    yearRange: [2000, 2020]
                });
                var picker2 = new Pikaday({
                    field: document.getElementById('datepicker2'),
                    firstDay: 1,
                    minDate: new Date('2000-01-01'),
                    maxDate: new Date('2020-12-31'),
                    yearRange: [2000, 2020]
                });

                $(".sbox_1_item .m ul li a").click(function () {
                    $(this).addClass("cur").parent("li").siblings("li").find("a").removeClass("cur");
                    var option = $(this).parents(".m").prev("span").attr("data");
                    var li = "<li data='" + option + "'><a href=''>" + value + "</a></li>";
                    var value = $.trim($(this).html());
                    if (value == "不限") {
                        $(".sbox_2 .m li[data='" + option + "']").remove();
                    } else if ($(".sbox_2 .m li[data='" + option + "']").length > 0) {
                        //$(".sbox_2 .m li[data='"+option+"']").remove();
                        $(".sbox_2 .m li[data='" + option + "']").find("a").html(value);
                    } else {
                        $(".sbox_2 .m").append(li);
                    }
                    var opt = getDataArr();
                    //请求数据，加载页面
                    $.ajax({
                        url: '{{route('media.release')}}',
                        data: {
                            'keyword': "category_id",
                            'data': [
                                {"category_id": opt[0]["category_id"], "data_id": opt[0]["data_id"]},
                                {"category_id": opt[1]["category_id"], "data_id": opt[1]["data_id"]},
                                {"category_id": opt[2]["category_id"], "data_id": opt[2]["data_id"]},
                                {"category_id": opt[3]["category_id"], "data_id": opt[3]["data_id"]},
                                {"category_id": opt[4]["category_id"], "data_id": opt[4]["data_id"]},
                                {"category_id": opt[5]["category_id"], "data_id": opt[5]["data_id"]}
                            ],
                            '_token': _token
                        },
                        type: 'post',
                        dataType: "json",
                        stopAllStart: true,
                        success: function (data) {
                            var sum = data.data.data.length;
                            var get_data = data.data.data;
                            var result='';
                            if (data.sta == '0') {
                                //页面渲染
                                for(var i=0; i< sum; i++){
                                    result += '<tr>' +
                                            '<td>4</td>' +
                                            '<td class="sbox_3_t1">' +
                                            '<img src="'+get_data[i].media_md5+'"  style="width: 100px;height:30px">'+get_data[i].media_name+'</td>' +
                                            '<td class="sbox_3_t2">'+get_data[i].Entrance_form[0].name+'</td>' +
                                            '<td class="sbox_3_t3">'+get_data[i].Entrance_level[0].name+'</td>' +
                                            '<td>'+get_data[i].standard[0].name+'</td>' +
                                            '<td class="sbox_3_t5"><img src="'+get_data[i].diagram_img+'" style="width:50px;height:20px"></td>' +
                                            '<td class="sbox_3_t6">'+get_data[i].pf_price+'</td>' +
                                            '<td class="sbox_3_t7">'+get_data[i].px_price+'</td>' +
                                            '<td class="sbox_3_t8">'+get_data[i].mb_price+'</td>' +
                                            '</tr>';
                                }
                                $('#wrapper_i').html("");
                                $('#wrapper_i').append(result);
                               // layer.msg(data.msg || '请求成功');
                            } else {
                                layer.msg(data.msg || '请求失败');
                            }
                        },
                        error: function () {
                            layer.msg(data.msg || '网络发生错误');
                        }
                    });

                    return false;
                });
                function getDataArr() {
                    var opt_1 = [];
                    $(".sbox_1_item").each(function () {
                        var index = $(this).index(".sbox_1_item");
                        opt_1[index] = [];
                        var category_id = $(this).find(".m>ul").attr("category_id");
                        if ($(this).find(".m>ul").find("a.cur").parent().attr("data_id")) {
                            var data_id = $(this).find(".m>ul").find("a.cur").parent().attr("data_id");
                        } else {
                            var data_id = "";
                        }
                        opt_1[index]["category_id"] = category_id;
                        opt_1[index]["data_id"] = data_id;
                    });
                    return opt_1;
                }
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

