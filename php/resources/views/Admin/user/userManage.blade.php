@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
@endsection
@section('content')
    <div class="content"><div class="Invoice">
            <div class="INa1dd"><div class="ndt" style="margin-top:40px;padding-bottom:0;">

                    <div class="hdorder radius1">
                        <h3 class="title1"><strong><a href="#">用户管理</a></strong>

                            <div class="search_1">

                                <form action="{{url('Admin/search_user')}}" method="get" name="">

                                    <div class="l">
                                        <input type="hidden" value="web" name="type">
                                        <input type="text" class="txt5" name="username" placeholder="用户名称">
                                        <input type="submit" name="keyword" class="sub4" value="查询">
                                    </div>
                                </form>

                            </div>

                            <div class="clr"></div>
                        </h3>
                        <div class="dhorder_m">

                            <div class="tab1" style="height:30px;">
                            </div>

                            <div class="tab1_body" style="min-height:580px;">
                                <table class="table_in1 cur">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>用户名</th>
                                        <th>管理分组</th>
                                        <th>创建时间</th>
                                        <th>账户余额</th>
                                        <th>创建人</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->username}}</td>
                                            <td>{{$user->acl_name}}</td>
                                            <td>{{$user->created_at}}</td>
                                            <td>{{$user->wealth}}</td>
                                            <td>{{$user->created_by}}</td>
                                            <td>
                                                @if($user->lock==0)
                                                    启用
                                                    @else
                                                    停用
                                                    @endif
                                            </td>
                                            <td><a href="{{url('Admin/addUser')."?id=".$user->id}}">修改</a>|<a  onclick="ajaxdata('delete',{{$user->id}})">删除</a></td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                {{$users->render()}}
                            </div>
                        </div>

                    </div>

                </div></div>
        </div></div>
    <script type="text/javascript">




        function ajaxdata(type,id) {
            var data = {
                "type":type,
                'id':id
            }
//            console.log(data);
            $.ajax({
                type: "POST",
                url: "{{url('Admin/modify_info')}}",
                data: data,
                dataType: "json",
                success: function (data) {
                    if (data.sta == 1) {
                        layer.msg(data.msg);
                    } else {
                        layer.msg(data.msg);
//                        window.location.reload();
                    }
                }
            });

        }


    </script>
@endsection
