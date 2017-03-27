@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
@endsection
@section('content')
    <div class="content"><div class="Invoice"><div class="INa1dd">
                <div class="main" style="margin-top:40px;">

                    <!--	最新消息-->
                    <div class="hdorder radius1">
                        <h3 class="title1"><strong><a href="#">最新消息</a></strong>

                        </h3>
                        <div class="dhorder_m">
                            <div class="tab1">
                                <ul>
                                    <li class="cur"><a href="#">未读消息</a></li>
                                    <li><a href="#">已读消息</a></li>
                                </ul>
                            </div>
                            <div class="tab1_body">
                                <table class="table_in1 cur">
                                    <tbody>
                                    @foreach($unread as $unread)
                                    <tr>
                                        <td><a href="{{url('Admin/message/detail?id='.$unread->id)}}"><div class="XTnews_list">{{$unread->title}}</div><div class="XTRnews_list">{{$unread->created_at}}</div></a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <table class="table_in1">
                                    <tbody>
                                    @foreach($read as $read)
                                        <tr>
                                            <td><a href="{{url('Admin/message/detail?id='.$read->id)}}"><div class="XTnews_list">{{$read->title}}</div><div class="XTRnews_list">{{$read->created_at}}</div></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="page_1" style="margin-top:15px;padding-bottom:30px;">
                                <span class="info">显示第 0 至 0 项结果，共 0 项</span>
                                <span class="pages">
<a href="" class="prev">上一页</a>
<a href="" class="cur">1</a>
<a href="">2</a>
<a href="">3</a>
<a href="">4</a>
<a href="">5</a>
<span class="sus">...</span>
<a href="">248</a>
<a href="" class="next">下一页</a>
				</span>
                            </div>


                        </div>

                    </div>


                    <div class="clr"></div>
                </div>
            </div></div></div>
@endsection