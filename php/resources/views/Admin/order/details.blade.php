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
                                    <input type="hidden" name="order_id" value="@if(isset($news_data)){{$news_data->id?:""}}@endif">
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
                                <div class="IF3"><p>订单备注:</p>
                                    <div class="chakan">@if(isset($news_data)){{$news_data->remark?:""}}@endif</div>
                                </div>
                                <div class="IF3"><p>质量反馈:</p>
                                   <input type="radio" name="Evaluation" value="1" checked>优 &nbsp; &nbsp;
                                   <input type="radio" name="Evaluation" value="1">良&nbsp; &nbsp;
                                   <input type="radio" name="Evaluation" value="1">差
                                </div>
                                <div class="IF3"><p>订单状态:</p>
                                    <select name="select" id="select">
                                        <option>确认完成</option>
                                        <option>订单反馈</option>
                                    </select>
                                </div>
                                    <div class="IF3"><p>完成链接:</p>
                                        <input type="text" name="textfield2" id="FLnome" class="IFN2"/>
                                    </div>
                                    <div class="IF3"><p>完成截图:</p>
                                        <div class="LGnt11">
                                            <img src="{{url('Admin/img/bn66.png')}}"/>
                                            <p>上传图片</p>
                                        </div>
                                    </div>
                                    <div class="IF3"><p>供应商反馈:</p>
                                        <textarea name="textfield3" class="IFN3"></textarea>
                                    </div>
                                <div class="IF3"><p>会员反馈:</p>
                                    <textarea name="textfield3" class="IFN3"></textarea>
                                </div>
                            </div>

                            <input type="submit" name="button" value="确  认" class="LGButton3" style="margin: 5% 30%"/>
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
@endsection
