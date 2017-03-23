@extends('Admin.layout.main')
@section('title', '提现列表')
@section('header_related')
@endsection
@section('content')
    <div class="content"><div class="Invoice">
            <div class="INa1dd"><div class="ndt" style="margin-top:40px;padding-bottom:0;">

                    <div class="hdorder radius1">
                        <h3 class="title1"><strong><a href="#">提现列表</a></strong>
                            <div class="search_1">
                                <form action="" method="" name="">
                                    <div class="l">
                                        <span>起止时间</span>
                                    </div>
                                    <div class="l">
                                        <input type="text" class="txt2" name="start" id="datepicker1" />-<input type="text" name="end" class="txt2" id="datepicker2" />
                                    </div>
                                    <div class="l">
                                        <input type="text" class="txt5" name="keyword" placeholder="用户名称" />
                                        <input type="submit" name="submit" class="sub4" value="查询" />
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
                                        <th>序号</th>
                                        <th>用户名</th>
                                        <th>账户余额</th>
                                        <th>提现金额</th>
                                        <th>提现账户</th>
                                        <th>提现方式</th>
                                        <th>提现时间</th>
                                        <th>提现状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lists as $list)
                                    <tr>
                                        <td>{{$list->id}}</td>
                                        <td>{{$list->username}}</td>
                                        <td>{{$list->money}}</td>
                                        <td>{{$list->price}}</td>
                                        <td>{{$list->payment}}</td>
                                        <td>{{$type[$list->paytype]}}</td>
                                        <td>{{$list->created_at}}</td>
                                        @if($list->state==0)
                                            <td>审核</td>
                                        @elseif($list->state==1)
                                            <td>完成</td>
                                        @else
                                            <td>错误</td>
                                        @endif
                                        <td><a href="javascript:void(0)" onclick="withdraw({{$list->id}})">完成</a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div></div>
        </div></div>
    <script type="text/javascript">

        function withdraw(id) {
            {{--$.ajax({--}}
                {{--type:"POST",--}}
                {{--url:"{{url('Admin/finish_withdraw')}}",--}}
                {{--data:{--}}
                    {{--id:id--}}
                {{--},--}}
                {{--success:function(data) {--}}

                    {{--layer.msg(data['msg']);--}}

                {{--}--}}

            {{--})--}}

        layer.confirm('确定操作么？', {
                btn: ['确定','放弃'] //按钮
            }, function(){
                $.ajax({
                    type:"POST",
                    url:"{{url('Admin/finish_withdraw')}}",
                    data:{
                        id:id
                    },
                    success:function (data) {

                            if(data.sta==0){
                                layer.msg(data.msg, {icon: 1});
                            }else{
                            layer.alert(data.msg, {icon: 2});
                        }


                    }

                })

            })

        }

    </script>
@endsection