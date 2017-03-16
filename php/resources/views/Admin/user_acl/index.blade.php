@extends('Admin.layout.main')
@section('title', '角色列表')
@section('header_related')
@endsection
@section('content')
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="ndt" style="margin-top:40px;padding-bottom:0;">

                    <div class="hdorder radius1">
                        <h3 class="title1"><strong><a href="#">用户角色分组列表</a></strong></h3>
                        <div class="dhorder_m">
                            <div class="Urole">
                                <input type="text" name="" placeholder="请输入角色名"/>
                                <input type="submit" value="创建新角色"/>
                            </div>
                            <div class="tab1" style="">
                            </div>

                            <div class="tab1_body" style="min-height:580px;">
                                <table class="table_in1 cur">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>组名称</th>
                                        <th>拥有权限（单位：个）</th>
                                       {{-- <th>状态</th>--}}
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($role as $item)
                                    <tr>
                                        <td>{{ $item -> id }}</td>
                                        <td>{{ $item -> acl_name }}</td>
                                        <td>{{ roleAccessCount($item->id) }}</td>
                                        <td><a href="{{ route('acl.role.edit', $item->id) }}">修改权限</a>{{--|<a href="">删除</a>--}}</td>
                                    </tr>
                                    @endforeach
                                   {{-- <tr>
                                        <td>2</td>
                                        <td>供应商</td>
                                        <td>10</td>
                                        <td>开启</td>
                                        <td><a href="">修改权限</a>|<a href="">删除</a></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>普通会员</td>
                                        <td>10</td>
                                        <td>开启</td>
                                        <td><a href="">修改权限</a>|<a href="">删除</a></td>
                                    </tr>--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
