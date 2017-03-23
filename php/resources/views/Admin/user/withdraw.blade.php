@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
@endsection
@section('content')
    <div class="content"><div class="Invoice">
            <div class="INa1dd"><div class="ndt">
                    <div class="Ifapiao"><h2>账户提现</h2></div>
                    <div style=" width: 50%; margin: auto; padding-top: 5%;">
                        <div class="IF3"><p>可提现金额:</p>
                            <input type="text" name="textfield" readonly value="{{$wealth}}" id="textfield"  class="IFN1"/>
                            <span>元</span>
                            {{csrf_field()}}
                        </div>
                        <div class="IF3"><p>提现金额:</p>
                            <input type="text" name="textfield" id="money"  class="IFN1"/>
                            <span>元</span>
                        </div>
                        <div class="IF3"><p>提现方式:</p>
                            <select name="select" id="select">
                                @foreach($types as $type)
                                <option value="{{$type['id']}}">{{$type['name']}}</option>
                                @endforeach
                                <!-- <option>微信</option>
                                 <option>银联</option>-->
                            </select>
                        </div>
                        <div class="IF3"><p>提现账户:</p>
                            <input type="text" name="textfield" id="payment"  class="IFN1"/>
                        </div>
                        <div class="IF3" style="margin-top:20px;">
                            <p>&nbsp;</p>
                            <input type="submit" name="button" id="tixian_at" value="立即提现" class="Button" />
                        </div>
                    </div>
                </div></div>
        </div></div>
    <!--    支付弹窗    -->
    <div class="pay_info">
        <h3>提现金额</h3>
        <h4 class="sum" id="sum2">￥<b id="money2">0.00</b></h4>
        <p>尊敬的用户，您的提现金额将会在24小时后到账。</p>
            <div class="item">
                <input type="password" id="pass" placeholder="请输入您的支付密码" class="pass" />
            </div>
            <div class="item">
                <button type="submit" id="withdraw" class="sub">确 定</button>
            </div>
    </div>

    <script type="text/javascript">
        /*  点击结算弹出支付    */
        $("#tixian_at").click(function(){
            var regu = /^[0-9]+(.[0-9]{2})?$/;
            var re = new RegExp(regu);
            var money = $("#money").val();
            var payment = $("#payment").val();
            console.log(payment);
            if(payment==''){
                layer.msg("请输入提现账户！");
            }else{
                if (re.test(money)){
                    $("#money2").html(money);
                    event.preventDefault();
                    layer.open({
                        type: 1,
                        title: " ",
                        shadeClose: true, //开启遮罩关闭
                        skin: 'pay_info_w', //加上class设置样式
                        area: ['430px'], //宽高
                        content: $(".pay_info")
                    });
                }else{
                    layer.msg('请输入正确的金额');
                }
            }
        });
        $("#withdraw").click(function () {
            var data = {
                '_token':$('input[name="_token"]').val(),
                'money':$("#money").val(),
                'payment':$("#payment").val(),
                'type':$("#select").val(),
                'password':$("#pass").val()
            }
            $.ajax({
                type:"POST",
                url:"{{url('Admin/withdraw')}}",
                data:data,
                dataType:"json",
                success:function (data) {
                    if (data.sta == 1) {
                        layer.msg(data.msg);
                    } else {
                        layer.closeAll();

                        layer.msg(data.msg);
                    }
                }
            })
            console.log(data);
//            layer.msg('jajajfdaofjaso')
        })

    </script>
@endsection

















