@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
@endsection
@section('content')
<div class="content"><div class="Invoice">
        <div class="INa1dd"><div class="ndt" style="margin-top:40px;padding-bottom:230px;">

                <div class="hdorder radius1">
                    <h3 class="title1"><strong><a href="#">我的帐户</a></strong></h3>
                    <div class="w_success clearfix">
                        <div class="w_success_t clearfix">
                            <img src="/images/yes.png" />
                            <div>
                                <h3>交易失败</h3>
                                <p>感谢您使用喇叭传媒平台支付</p>
                            </div>
                        </div>
                        <div class="w_success_b">
                            <a href="{{url('/')}}" class="btn_a">返回首页</a>
                        </div>
                    </div>
                </div>

            </div></div>
    </div></div>
@endsection
