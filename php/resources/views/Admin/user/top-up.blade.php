@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
@endsection
@section('content')
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="ndt">
                    <div class="Ifapiao"><h2>在线充值</h2></div>
                    <div class="IF1" style="padding:5% 4% 0 8%;">
                        {{--<form method="get" action="{{url('/pay')}}" name="payform">--}}
                        <div class="IF3"><p>充值金额:</p>
                            <input type="text"  id="recharge" value="" class="IFN1"/>
                            <span>元</span>
                        </div>
                        <div class="LGnt8">
                            @foreach($lists as $list)
                                <li class="rechargelist">{{$list}}</li>
                            @endforeach
                        </div>
                        <div class="IF3"><p>充值方式:</p>
                            <ul class="LGnt9">
                                {{--<li><img src="{{url('Admin/img/LGnta1.jpg')}}"/></li>--}}
                                <li><img src="{{url('Admin/img/LGnta2.jpg')}}"/></li>
                                {{--<li><img src="{{url('Admin/img/LGnta3.jpg')}}"/></li>--}}

                            </ul>
                        </div>
                        <div class="IF3">
                            <p>&nbsp;</p>
                            <div class="IFN4">
                                <span style="color:#000; font-weight:700">注意事项</span>
                                <span>每次10元起充，如果您有支付宝、网上银行账户，请使用在线充值，即时到账！如果您不方便在线充值，可联系客服代充。客服QQ：3315033406 电话：020-34206485</span>
                                <span></span>
                            </div>
                        </div>
                        <div class="IF3" style="margin-top:20px;">
                            <p>&nbsp;</p>
                            <input type="submit" name="button" id="paybutton" value="立即充值" class="Button"/>

                        </div>
                        {{--</form>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="application/javascript">
        $(function () {
            var type = 'alipay';
            $(".rechargelist").click(function () {
                $("#recharge").val($(this).html());
            })



            $("#paybutton").click(function () {
                var charge = $("#recharge").val();
                if(charge==""){
                    layer.msg('请先输入金额!');
                }else{
                    $.ajax({
                        type: "get",
                        url: "{{url('/pay')}}",
                        data: {
                            "money": charge
                        },
                        dataType: "json",
                        success: function (data) {
                            if (data.sta == 1) {
                                layer.msg(data.msg);
                            }else{
//                                console.log(data.data);
                                window.location.href = data.data;
                            }
                        }
                    });
                }
            })




        })
    </script>
@endsection
