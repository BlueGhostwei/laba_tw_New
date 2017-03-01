@extends('Admin.layout.main')
@section('title', '亚媒社-媒体列表')
@section('header_related')
@endsection
@section('content')
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="main" style="margin-top:20px;">
                    <!--	分类管理	-->
                    <div class="hdorder radius1">
                        <h3 class="title1"><strong><a href="#">媒体资源管理</a></strong>
                        </h3>
                        <div class="dhorder_m">
                            <div class="FLnt1">
                                <span>当前位置：<a href="{{route('admin.dashboard')}}">首页</a> > <a href="">资源管理</a> > 媒体列表</span>
                            </div>
                            <div class="tab1_body">
                                <!--网络媒体-->
                                <table class="table_in1 cur">
                                    <thead>
                                    <tr>
                                        <th>序号</th>
                                        <th>媒体名称</th>
                                        <th>媒体LOGO</th>
                                        <th>网站类型</th>
                                        <th>入口形式</th>
                                        <th>入口级别</th>
                                        <th>频道类型</th>
                                        <th>正文链接</th>
                                        <th>覆盖区域</th>
                                        <th>代理价</th>
                                        <th>平台价</th>
                                        <th>会员价</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($data_list) && !empty($data_list))
                                        @foreach($data_list as $key =>$vel)
                                            <tr>
                                                <td>1</td>
                                                <td>{{$vel->media_name}}</td>
                                                <td style="max-width: 60px;">
                                                    <img src="{{md52url($vel->media_md5)}}"/>
                                                </td>
                                                @if(empty($vel->network))
                                                    <td>不限</td>
                                                @else
                                                    @foreach($vel->network as $ky =>$vl)
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
                                                @if(empty($vel->Entrance_form))
                                                    <td>不限</td>
                                                @else
                                                    @foreach($vel->Entrance_form as $ky =>$vl)
                                                        <td>{{$vl->name}}</td>
                                                    @endforeach
                                                @endif
                                                @if(empty($vel->channel))
                                                    <td>不限</td>
                                                @else
                                                    @foreach($vel->channel as $ky =>$vl)
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
                                                @if(empty($vel->coverage))
                                                    <td>不限</td>
                                                @else
                                                    @foreach($vel->coverage as $ky =>$vl)
                                                        <td>{{$vl->name}}</td>
                                                    @endforeach
                                                @endif
                                                <td style="color: #ff0000">{{$vel->pf_price}}</td>
                                                <td style="color: #ff0000">{{$vel->px_price}}</td>
                                                <td style="color: #ff0000">{{$vel->mb_price}}</td>
                                                <td style="max-width: 70px;">
                                                    <a href="{{route('category.media_List_update',$vel->id)}}">修改</a>|
                                                    <a href="{{route('category.media_List_dele')}}">删除</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>新浪</td>
                                            <td style="max-width: 60px;"><img src="{{url('Admin/img/bn66.png')}}"/></td>
                                            <td>全国门户</td>
                                            <td>文字标题</td>
                                            <td>网站首页</td>
                                            <td style="max-width: 90px;">带图片、文字、网网址网址址链接</td>
                                            <td>广东</td>
                                            <td>娱乐</td>
                                            <td style="color: #ff0000">￥100</td>
                                            <td style="color: #ff0000">￥200</td>
                                            <td style="color: #ff0000">￥150</td>
                                            <td style="max-width: 70px;">
                                                <a href="xinzengshaixuanfenlei.php">修改</a>|
                                                <a href="#">删除</a>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                @if(isset($data_list))
                                    {{ $data_list->links()}}
                                @else
                                    <div class="page_1 page_1_2" style="padding-bottom: 50px;">
                                        <span class="pages">
                                        <a href="" class="prev">上一页</a>
                                        <a href="" class="">1</a>
                                        <a href="" class="cur">2</a>
                                        <a href="">3</a>
                                        <a href="">4</a>
                                        <a href="">5</a>
                                        <span class="sus">...</span>
                                        <a href="" class="">248</a>
                                        <a href="" class="next">下一页</a>
                                    </span>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
