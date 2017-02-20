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
                        <div class="IF3"><p>充值金额:</p>
                            <input type="text" name="textfield" id="textfield" class="IFN1"/>
                            <span>元</span>
                        </div>
                        <div class="LGnt8">
                            <li>500元</li>
                            <li>1000元</li>
                            <li>2000元</li>
                            <li>5000元</li>
                            <li>10000元</li>
                        </div>
                        <div class="IF3"><p>充值方式:</p>
                            <ul class="LGnt9">
                                <li><img src="{{url('Admin/img/LGnta1.jpg')}}"/></li>
                                <li><img src="{{url('Admin/img/LGnta2.jpg')}}"/></li>
                                <li><img src="{{url('Admin/img/LGnta3.jpg')}}"/></li>

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
                            <input type="submit" name="button" id="button" value="立即充值" class="Button"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
