@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
@endsection
@section('content')
    <div class="content"><div class="Invoice"><div class="INa1dd">
                <div class="main" style="margin-top:40px;">

                    <!--	最新消息-->
                    <div class="hdorder radius1">
                        <h3 class="title1"><strong><a href="#">系统消息</a></strong>

                        </h3>
                        <div class="dhorder_m">
                            <div class="FLnt1">
                                <p>最新消息</p>
                                <span>当前位置：<a href="#">首页</a>> 系统消息  > 阅读消息 </span>
                            </div>
                            <div class="XTread">
                                <div class="XTxiaoxi">
                                    <h1>{{$data['title']}}</h1>
                                    <span>发布时间：{{$data['created_at']}}  作者：{{$data['author']}}</span>
                                    <p>{{$data['message']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clr"></div>
                </div>
            </div></div></div>

@endsection