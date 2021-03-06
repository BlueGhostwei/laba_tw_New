@extends('Admin.layout.main')
@section('title', '媒体供应商_活动订单 - 亚媒社')
@section('header_related')
    <script src="{{url('Admin/js/layer.js')}}"></script>
    <link rel="stylesheet" href="{{url('Admin/js/zoom/css/bootstrap-grid.min.css')}}">
@endsection
@section('content')
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="main" style="margin-top:20px;">

                    <!--	分类管理	-->
                    <div class="hdorder radius1" style=" float: left; margin-bottom:50px;">
                        <h3 class="title1"><strong><a href="#">媒体资源管理</a></strong>
                        </h3>
                        <div class="dhorder_m">
                            <div class="FLnt1">
                                <span>当前位置：<a href="">媒体资源管理</a> > <a href="">创建媒体</a> </span>
                            </div>
                            <form method="post">
                                <div class="IF1">
                                    <div class="FLmeiti1">* 媒体资源信息</div>
                                    <div class="FLmeiti2">
                                        <div class="IF3"><p>媒体类型:</p>
                                            <select name="select" id="media_select">
                                                @if(isset($media_type) && !empty($media_type))
                                                    @foreach($media_type as $Key =>$vel)
                                                        <option
                                                                @if(isset($update_media) && $update_media->media_type == $vel['media_id'])
                                                                selected="selected"
                                                                @endif
                                                                data_id="{{$vel['media_id']}}"

                                                        >{{$vel['media_name']}}</option>
                                                    @endforeach
                                                @else
                                                    <option>暂无类型</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="IF3"><p>媒体名称:</p>
                                            @if(isset($update_media->id))
                                               <input type="hidden" name="media_id" value="{{$update_media->id}}">
                                            @endif
                                            <input type="text" name="media_name" id="FLnome1" class="IFN2"
                                                   @if(isset($update_media->media_name))
                                                   value="{{$update_media->media_name}}"
                                                    @endif
                                            />
                                        </div>

                                        <div class="IF3"><p>媒体LOGO:</p>
                                            <form id="form_logo" method="post">
                                                {{ csrf_field() }}
                                                @if(isset($update_media))
                                                    <img id="media_logo" src="{{md52url($update_media->media_md5)}}"
                                                         style="width: 120px;height: 80px"/><br>
                                                    <input name="media_logo_md5" id="media_md5" type="hidden"
                                                           value="{{$update_media->media_md5}}"/>
                                                @else
                                                    <img id="media_logo" src="{{url('Admin/images/z_add.png')}}"
                                                         style="width: 120px;height: 80px"/><br>
                                                    <input name="media_logo_md5" id="media_md5" type="hidden" value=""/>
                                                @endif
                                                <input id="media_logo_img" name="file" accept="image/*" type="file"
                                                       style="display: none"/>
                                            </form>
                                        </div>

                                        <div class="IF3  sbox_1_w">
                                            @if(isset($media_info) && !empty($media_info))
                                                @foreach($media_info as $ky =>$vs)
                                                    @if($vs['category_id'] == 3)
                                                        <div class="sbox_1_item clearfix">
                                                  <span class="l" data="option_4"
                                                        style="color: #0c0c0c;padding-left: 0px;">
                                                <strong>{{$vs['name']}}</strong></span>
                                                            <div class="m">
                                                                <ul class="sortable"
                                                                    category_id="{{$vs['category_id']}}"
                                                                    set_name="{{$vs['set_name']}}">
                                                                    <li data_id="0"><a
                                                                                @if(isset($update_media) && $update_media->coverage ==0)
                                                                                class="cur"
                                                                                @else
                                                                                class=""
                                                                                @endif
                                                                                href="">不限</a></li>
                                                                    @if(isset($vs['data']) && !empty($vs['data']))
                                                                        @foreach($vs['data'] as $kst =>$rk)
                                                                            <li data_id="{{$rk->id}}">
                                                                                <a href=""
                                                                                   @if(isset($update_media->coverage) && $update_media->coverage == $rk->id)
                                                                                   class="cur"
                                                                                        @endif>{{$rk->name}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    @else
                                                                        <li data_id="0"><a class="cur" href="">暂无</a>
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                            <span class="r" style="color: #0c0c0c;padding-left: 0px;"><a
                                                                        href="">更多</a></span>
                                                        </div>
                                                    @elseif($vs['category_id']!= 5 && $vs['category_id']!= 3)
                                                        <div class="sbox_1_item clearfix">
                                                     <span class="l" data="option_4"
                                                           style="color: #0c0c0c;padding-left: 0px;">
                                                <strong>{{$vs['name']}}</strong></span>
                                                            <div class="m">
                                                                <ul class="sortable"
                                                                    category_id="{{$vs['category_id']}}"
                                                                    set_name="{{$vs['set_name']}}">
                                                                    <li data_id="0"><a
                                                                                @if($vs['category_id']==0 )
                                                                                @if(isset($update_media->network) && $update_media->network ==0)
                                                                                class="cur"
                                                                                @endif
                                                                                @elseif($vs['category_id']==1)
                                                                                @if(isset($update_media->Entrance_level) && $update_media->Entrance_level ==0)
                                                                                class="cur"
                                                                                @endif
                                                                                @elseif($vs['category_id']==2)
                                                                                @if(isset($update_media->Entrance_form) && $update_media->Entrance_form ==0)
                                                                                class="cur"
                                                                                @endif
                                                                                @elseif($vs['category_id']==4)
                                                                                @if(isset($update_media->channel) && $update_media->channel ==0)
                                                                                class="cur"
                                                                                @endif
                                                                                @endif
                                                                                href="">不限</a></li>
                                                                    @if(isset($vs['data']) && $vs['data'] !=null)
                                                                        @foreach($vs['data'] as $key =>$rsk)
                                                                            <li data_id="{{$rsk['id']}}">
                                                                                <a href=""
                                                                                   @if($vs['category_id']==0 )
                                                                                   @if(isset($update_media->network) && $update_media->network ==$rsk['id'])
                                                                                   class="cur"
                                                                                   @endif
                                                                                   @elseif($vs['category_id']==1)
                                                                                   @if(isset($update_media->Entrance_level) && $update_media->Entrance_level ==$rsk['id'])
                                                                                   class="cur"
                                                                                   @endif
                                                                                   @elseif($vs['category_id']==2)
                                                                                   @if(isset($update_media->Entrance_form) && $update_media->Entrance_form ==$rsk['id'])
                                                                                   class="cur"
                                                                                   @endif
                                                                                   @elseif($vs['category_id']==4)
                                                                                   @if(isset($update_media->channel) && $update_media->channel ==$rsk['id'])
                                                                                   class="cur"
                                                                                        @endif
                                                                                        @endif
                                                                                >{{$rsk['name']}}</a></li>
                                                                        @endforeach
                                                                    @else
                                                                        <li data_id="0"><a class="cur" href="">暂无</a>
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                            <span class="r" style="color: #0c0c0c;padding-left: 0px;"><a
                                                                        href="">更多</a></span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                            @endif
                                        </div>
                                        <div class="IF3"><p>平台价：</p>
                                            <input type="text" name="pf_price" id="pf_price"
                                                   class="FLn1"
                                                   @if(isset($update_media->pf_price))
                                                   value="{{$update_media->pf_price}}"
                                                    @endif
                                            ><span>元</span>
                                        </div>
                                        <div class="IF3"><p>代理价：</p>
                                            <input type="text" name="px_price" id="px_price"
                                                   class="FLn1"
                                                   @if(isset($update_media->px_price))
                                                   value="{{$update_media->px_price}}"
                                                    @endif
                                            /><span>元</span>
                                        </div>
                                        <div class="IF3"><p>会员价：</p>
                                            <input type="text" name="mb_price" id="mb_price"
                                                   class="FLn1"
                                                   @if(isset($update_media->mb_price))
                                                   value="{{$update_media->mb_price}}"
                                                    @endif
                                            ><span>元</span>
                                        </div>
                                        <p>&nbsp;</p>
                                    </div>
                                    <div class="FLmeiti1">* 媒体负责人基本信息</div>
                                    <div class="FLmeiti2">
                                        <div class="IF3"><p>媒体负责人:</p>
                                            <input type="text" name="principal" class="FLn3"
                                                   @if(isset($update_media->principal))
                                                   value="{{$update_media->principal}}"
                                                    @endif
                                            />

                                        </div>
                                        <div class="IF3"><p>联系电话:</p>
                                            <input type="text" name="mobile_number" class="FLn3"
                                                   @if(isset($update_media->mobile_number))
                                                   value="{{$update_media->mobile_number}}"
                                                    @endif
                                            />

                                        </div>
                                        <div class="XZFL"><p>邮箱
                                                :</p>
                                            <input type="text" name="user_Eail" class="FLn3"
                                                   @if(isset($update_media->user_Eail))
                                                   value="{{$update_media->user_Eail}}"
                                                    @endif/>
                                        </div>
                                        <div class="IF3"><p>联系QQ:</p>
                                            <input type="text" name="user_QQ" class="FLn3"
                                                   @if(isset($update_media->user_QQ))
                                                   value="{{$update_media->user_QQ}}"
                                                    @endif/>
                                        </div>
                                        <div class="IF3"><p>联系地址:</p>
                                            <input type="text" name="address" class="IFN2"
                                                   @if(isset($update_media->address))
                                                   value="{{$update_media->address}}"
                                                    @endif/>
                                        </div>
                                        <div class="IF3"><p>邮编:</p>
                                            <input type="text" name="Zip_code" class="FLn3"
                                                   @if(isset($update_media->Zip_code))
                                                   value="{{$update_media->Zip_code}}"
                                                    @endif/>
                                        </div>
                                        <div class="IF3"><p>媒体认证:</p>
                                            <select name="certification" id="documents_select">
                                                <option documents_id="0"
                                                        @if(isset($update_media->documents_type) && $update_media->documents_type==0)
                                                        selected="selected"
                                                        @endif>营业执照
                                                </option>
                                                <option documents_id="1"
                                                        @if(isset($update_media->documents_type) && $update_media->documents_type==1)
                                                        selected="selected"
                                                        @endif>身份证
                                                </option>
                                            </select><br>
                                            <form id="documents_upload">
                                                <img id="Documents_img"
                                                     @if(isset($update_media->documents_img))
                                                     src="{{md52url($update_media->documents_img)}}"
                                                     @else
                                                     src="{{url('Admin/images/z_add.png')}}"
                                                     @endif
                                                     style="width: 120px;height: 80px;margin-top: 10px"/><br>
                                                <input type="file" name="Documents" id="documents_upload_button"
                                                       placeholder="未选择任何文件" class="FLn4" accept="image/*"
                                                       style="display: none"/>
                                                <input type="hidden" name="documents_img"
                                                       @if(isset($update_media->documents_img))
                                                           value="{{$update_media->documents_img}}"
                                                        @endif>
                                                <i style="font-size: 12px;color: #ccc; padding-left:10px; margin-left: 8%;">(身份证正反面
                                                    100KB以内)</i>
                                            </form>
                                        </div>
                                        <div class="IF3"><p>媒体简介:</p>
                                            <textarea name="Website_Description" class="IFN3">@if(isset($update_media->Website_Description)){{$update_media->Website_Description}}@endif</textarea>
                                        </div>
                                    </div>
                                    <input type="button" name="button" id="button_submit" value="提  交" class="LGButton3"
                                           style="margin: 5% 30%"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{url('Admin/js/jquery-2.1.1.min.js')}}"></script>
    <script type="text/javascript">

        $(function () {
            //证件上传
            $('#Documents_img').click(function () {
                $("#documents_upload_button").click();  //隐藏了input:file样式后，点击头像就可以本地上传
                $("#documents_upload_button").change(function () {
                    //创建FormData对象
                    var data = new FormData();
                    $.each($('#documents_upload_button')[0].files, function (i, file) {
                        data.append('file', file);
                    });
                    $.ajax({
                        url: '{{url('upload')}}',
                        type: 'POST',
                        data: data,
                        dataType: 'JSON',
                        cache: false,
                        processData: false,
                        contentType: false
                    }).done(function (ret) {
                        if (ret.sta == 1) {
                            $('input[name="documents_img"]').val(ret.md5);
                            $("#Documents_img").attr("src", ret.url);
                            return false
                        } else {
                            //layer.msg('logo上传失败');
                            return false;
                        }
                    });

                });
            });

            //logo上传
            $("#media_logo").click(function () {
                $("#media_logo_img").click();  //隐藏了input:file样式后，点击头像就可以本地上传
                $("#media_logo_img").change(function () {
                    //创建FormData对象
                    var data = new FormData();
                    $.each($('#media_logo_img')[0].files, function (i, file) {
                        data.append('file', file);
                    });
                    $.ajax({
                        url: '{{url('upload')}}',
                        type: 'POST',
                        data: data,
                        dataType: 'JSON',
                        cache: false,
                        processData: false,
                        contentType: false
                    }).done(function (ret) {
                        if (ret.sta == 1) {
                            $("#media_logo").attr("src", ret.url);
                            $('#media_md5').val(ret.md5);
                        } else {
                            //layer.msg('logo上传失败');
                            return false;
                        }
                    });

                });
            });
        });
        //提交表单数据
        $('#button_submit').click(function () {
            //获取媒体类型
            var media_id = $('input[name="media_id"]').val();
            var media_type = $('#media_select option:selected').attr('data_id');//媒体类型
            var documents_type = $('#documents_select option:selected').attr('documents_id');//证件类型
            var media_name = $('input[name="media_name"]').val();
            var principal = $('input[name="principal"]').val();//负责人
            var mobile_number = $('input[name="mobile_number"]').val();//电话
            var user_Eail = $('input[name="user_Eail"]').val();//邮箱
            var user_QQ = $('input[name="user_QQ"]').val();//QQ
            var address = $('input[name="address"]').val();//地址
            var Zip_code = $('input[name="Zip_code"]').val();//邮编
            var documents_img = $('input[name="documents_img"]').val();//证件照
            var Website_Description = $('textarea[name="Website_Description"]').val();//媒体简介
            var media_md5 = $('#media_md5').val();
            var pf_price = $('#pf_price').val();
            var px_price = $('#px_price').val();
            var mb_price = $('#mb_price').val();
            var network = "";
            var Entrance_level = "";
            var Entrance_form = "";
            var coverage = "";
            var channel = "";
            //获取所有选中的分类信息
            $('.sbox_1_item ul li .cur').each(function (key, vel) {
                var set_name = $(this).closest('ul').attr('set_name');
                if (set_name == 'network') {
                    network = $(this).parent('li').attr('data_id');
                }
                if (set_name == 'Entrance_level') {
                    Entrance_level = $(this).parent('li').attr('data_id');
                }
                if (set_name == 'Entrance_form') {
                    Entrance_form = $(this).parent('li').attr('data_id');
                }
                if (set_name == 'coverage') {
                    coverage = $(this).parent('li').attr('data_id');
                }
                if (set_name == 'channel') {
                    channel = $(this).parent('li').attr('data_id');
                }
            });
            //ajax提交申请
            $.ajax({
                url: '{{route('category.media_save')}}',
                data: {
                    'media_id':media_id,
                    "media_type": media_type,
                    "documents_type": documents_type,
                    "media_name": media_name,
                    "principal": principal,
                    "mobile_number": mobile_number,
                    "user_Eail": user_Eail,
                    "user_QQ": user_QQ,
                    "address": address,
                    "Zip_code": Zip_code,
                    "documents_img": documents_img,
                    "Website_Description": Website_Description,
                    "media_md5": media_md5,
                    "pf_price": pf_price,
                    "px_price": px_price,
                    "mb_price": mb_price,
                    "network": network,
                    "Entrance_level": Entrance_level,
                    "Entrance_form": Entrance_form,
                    "coverage": coverage,
                    "channel": channel
                },
                type: 'post',
                dataType: "json",
                stopAllStart: true,
                success: function (data) {
                    if (data.sta == '0') {
                        if (data.msg == "保存成功") {
                            layer.msg('保存成功', {icon: 1});
                        } else {
                            layer.msg(data.msg);
                        }

                        //重定向到列表页
                        /* window.location.reload();*/
                    } else {
                        layer.msg(data.msg);
                    }
                },
                error: function () {
                    layer.msg('网络发生错误');
                }
            });
            return false
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
