@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
@endsection
@section('content')
    <div class="content"><div class="Invoice">
            <div class="INa1dd"><div class="ndt" style="margin-top:40px;padding-bottom:0;">

                    <div class="hdorder radius1">
                        <h3 class="title1"><strong><a href="#">搜索关键词：@if(empty($keyword))所有@else {{$keyword}}@endif <i>（{{count($data)}}）</i></a></strong></h3>
                        <div class="dhorder_m">

                            <div class="tab1" style="height:30px;">
                            </div>

                            <div class="tab1_body" style="min-height:515px;">
                                <table class="table_in1 cur">
                                    <thead>
                                    <tr>
                                        <th>ID </th>
                                        <th>媒体名称</th>
                                        <th>媒体类型</th>
                                        <th>入口形式</th>
                                        <th>入口级别</th>
                                        <th>覆盖区域</th>
                                        <th>平台价格</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->media_name}}</td>
                                        <td>{{$data->media_type}}</td>
                                        <td>{{$data->Entrance_form}}</td>
                                        <td>{{$data->Entrance_level}}</td>
                                        <td>{{$data->coverage}}</td>
                                        <td>￥{{$data->pf_price}}</td>
                                        <td><a href="{{url('Admin/media/release?id=')}}{{$data->id}}">新闻发布</a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>

                    </div>

                </div></div>
        </div></div>
@endsection