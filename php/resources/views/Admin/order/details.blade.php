@extends('Admin.layout.main')
@section('title', '订单详情')
@section('header_related')
@section('content')
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="main" style="margin-top:20px;">
                    <!--	查看订单详情	-->
                    <div class="hdorder radius1" style="float: left; margin-bottom: 50px;">
                        <h3 class="title1"><strong><a href="#">查看详情</a></strong>
                        </h3>
                        <div class="IF1">
                            <div class="FLmeiti2">
                                <div class="IF3"><p>订单号:</p>
                                    <input type="hidden" id="order_id" value="@if(isset($news_data)){{$news_data->id?:""}}@endif">
                                    <input type="text" name="textfield2" id=" FLnome" class="LGnt2" disabled
                                    value="@if(isset($news_data)){{$news_data->order_code?:""}}@endif"
                                    />
                                </div>
                                <div class="IF3"><p>活动类型:</p>
                                    <input type="text" name="textfield2" id=" FLnome" class="LGnt2" value="@if(isset($news_data) && $news_data->news_type=="news")新闻发布@endif" disabled/>
                                </div>
                                <div class="IF3"><p>活动名称:</p>
                                    <input type="text" name="textfield2" id="FLnome" class="LGnt2" value=" @if(isset($news_data)){{$news_data->title?:""}}@endif" disabled/>
                                </div>
                                <div class="IF3"><p>开始时间:</p>
                                    <input type="text" name="textfield2" id=" FLnome" class="LGnt2"value="@if(isset($news_data)){{date('Y-m-d H:i',$news_data->start_time)?:""}}@endif" disabled/>
                                </div>
                                <div class="IF3"><p>结束时间:</p>
                                    <input type="text" name="textfield2" id=" FLnome" class="LGnt2" value="@if(isset($news_data)){{date('Y-m-d H:i',$news_data->end_time)?:""}}@endif" disabled/>
                                </div>
                                <div class="IF3"><p>价格：</p>
                                    <input type="text" name="textfield2" id="FLsorting" class="FLn1" value="@if(isset($news_data)){{$news_data->price?:""}}@endif" disabled/><span>元</span>
                                </div>
                                 @if(isset($news_data) && $news_data->Manuscripts_attr=="3")
                                    <div class=""><p>内容：</p>
                                        {!! $news_data->content?:"" !!}
                                    </div>
                                     @endif
                                @if(isset($news_data) && $news_data->Manuscripts_attr=="2")
                                <div class="IF3"><p>文件地址：</p>
                                    <input type="text" name="textfield2" id=" FLnome" class="LGnt2"  disabled
                                           value="@if(isset($news_data)){{$news_data->url_line?:""}}@endif"
                                    /><button onclick="file_down()">下载文件</button>
                                </div>
                                @endif
                                @if(isset($news_data) && $news_data->Manuscripts_attr=="1")
                                    <div class="IF3"><p>外部链接：</p>
                                        <input type="text" name="textfield2" id=" FLnome" class="LGnt2"
                                               value="@if(isset($news_data)){{$news_data->url_line?:""}}@endif"
                                        />
                                    </div>
                                @endif
                                <div class="IF3"><p>订单备注:</p>
                                    <div class="chakan">@if(isset($news_data)){{$news_data->remark?:""}}@endif</div>
                                </div>
                                <div class="IF3"><p>质量反馈:</p>
                                    @if($news_data->user_id==Auth::id())
                                        <select name="Evaluation" id="quality">
                                            <option value="{{$news_data->quality}}">当前：{{$news_data->qualitytext}}</option>
                                            <option value="1">优</option>
                                            <option value="2">良</option>
                                            <option value="3">差</option>
                                        </select>
                                    @else
                                        {{$news_data->quality}}
                                    @endif
                                </div>
                                <div class="IF3"><p>订单状态:</p>
                                    @if($news_data->release_sta==1)
                                        未发布
                                    @elseif($news_data->release_sta==2)
                                        退回
                                    @else
                                        已发布
                                    @endif

                                </div>
                                <div class="IF3"><p>修改状态:</p>
                                    <select name="select" id="select">
                                        <option>确认完成</option>
                                        <option>订单反馈</option>
                                    </select>
                                    <input type="radio" id="State" name="State" value="2" checked>默认
                                    <input type="radio" id="State" name="State" value="5">拒单&nbsp; &nbsp;
                                    <input type="radio" id="State" name="State" value="3">反馈
                                </div>
                                    <div class="IF3"><p>完成链接:</p>
                                        <input type="text" name="textfield2" id="finish_url" class="IFN2 {{mla('MediaProviderController@provider_feedback')}}" value="{{$news_data->f_url}}"/>
                                    </div>
                                    <div class="IF3"><p>完成截图:</p>
                                        <form id="form1" method="post">
                                        <div class="LGnt11">
                                            <input id="user_avatar" name="file" type="file" style="display: none">
                                            <img id="user_pic_img" src="@if(empty($news_data->picurl)){{url('Admin/img/bn66.png')}}@else{{md52url($news_data->picurl)}}@endif"/>
                                            <input type="hidden" id="img_url" name="user_image" >
                                            <p  id="user_pic">上传图片</p>
                                        </div></form>

                                    </div>

                                    <div class="IF3" ><p>供应商反馈:</p>
                                        @if($news_data->media_id==Auth::user()->media_id)
                                            <textarea id="p_feedback" name="textfield3" class="IFN3  {{mla('MediaProviderController@provider_feedback')}}">{{$news_data->ofeedback}}</textarea>
                                        @else
                                            <textarea id="p_feedback" name="textfield3" readonly class="IFN3  {{mla('MediaProviderController@provider_feedback')}}">{{$news_data->ofeedback}}</textarea>
                                        @endif
                                    </div>
                                <div class="IF3"><p>会员反馈:</p>
                                    @if($news_data->user_id == Auth::id())
                                    <textarea name="textfield3" id="c_feedback" class="IFN3 {{mla('MediaProviderController@customer_feedback')}}">{{$news_data->cfeedback}}</textarea>
                                    @else
                                        <textarea name="textfield3" id="c_feedback" readonly class="IFN3 {{mla('MediaProviderController@customer_feedback')}}">{{$news_data->cfeedback}}</textarea>
                                    @endif
                                </div>

                            </div>
                            @if($news_data->release_sta<4)
                            <input type="submit" name="button" value="确   认" id="provider_feedback" class="LGButton3 {{mla('MediaProviderController@provider_feedback')}}" style="margin: 5% 10% 5% 20%"/>
                            @else
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <script>
         function file_down(){
             window.location.href="@if(isset($news_data) &&$news_data->Manuscripts_attr==2 ){{$news_data->url_line?:""}}@endif";
         }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#provider_feedback').click(function () {
                var url = $("#finish_url").val()
                var data = {
                    id:$("#order_id").val(),
                    url:url,
                    feedback:$('#p_feedback').val(),
                    img:$('#img_url').val(),
                    state:$('input:radio[name="State"]:checked').val()
                }
                if(isURL(url)){
                    $.ajax({
                        type:"POST",
                        url:"{{url('Admin/provider_feedback')}}",
                        data:data,
                        success:function (data) {
                            layer.msg(data.msg)
                        },
                        error:function () {
                            layer.msg("请求超时！")
                        }
                    })
                }else{
                    layer.msg('非法的URL地址！')
                }
            })

            $("#customer_feedback").click(function () {
                var data = {
                    id:$("#order_id").val(),
                    feedback:$("#c_feedback").val(),
                    quality:$('input:radio[name="Evaluation"]:checked').val()
                }
//                console.log(data)
                $.ajax({
                    type:"POST",
                    url:"{{url('Admin/customer_feedback')}}",
                    data:data,
                    success:function (data) {
                        layer.msg(data.msg)
                    },
                    error:function () {
                        layer.msg("请求超时");
                    }
                })
            })
            
            $("#customer_confrim").click(function () {
                layer.confirm('确认完成？', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    $.ajax({
                        type:"POST",
                        url:"{{url('Admin/customer_confirm')}}",
                        data:{
                            id:$("#order_id").val(),
                            quality:$('input:radio[name="Evaluation"]:checked').val()
                        },
                        success:function (data) {
                            layer.msg(data.msg)
                        },
                        error:function () {
                            layer.msg("请求超时")
                        }
                    })
                }, function(){
                    layer.msg('取消操作');
                });
            })




            $("#user_pic").click(function () {
                $("#user_avatar").click(); //隐藏了input:file样式后，点击头像就可以本地上传
                $("#user_avatar").change(function () {
                    //创建FormData对象

                    var data = new FormData($('#form1')[0]);
                    $.ajax({
                        url: '{{url('upload')}}',
                        type: 'POST',
                        data: data,
                        dataType: 'JSON',
                        cache: false,
                        processData: false,
                        contentType: false
                    }).done(function(ret){
                        if(ret.sta == 1){
                            $("#user_pic_img").attr("src", ret.url ) ;
                            $('input[name="user_image"]').val(ret.md5);
                        }else{
                            layer.msg('头像上传失败');
                        }
                    });

                });
            });
        })

        function isURL(str){
            return !!str.match(/(((^https?:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)$/g);
        }
    </script>
@endsection
