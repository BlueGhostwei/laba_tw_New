@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
@endsection
@section('content')
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="ndt" style="margin-top:40px;padding-bottom:0;">

                    <div class="hdorder radius1">
                        <h3 class="title1"><strong><a href="#">全部定单<i>@if(isset($count)&&!empty($count)){{$count}}@endif</i></a></strong></h3>
                        <div class="dhorder_m">

                            <div class="tab1" style="height:30px;">
                            </div>

                            <div class="tab1_body" style="min-height:515px;">
                                <table class="table_in1 cur">
                                    <thead>
                                    <tr>
                                        <th>勾选</th>
                                        <th>定单类型</th>
                                        <th width="24%">活动标题</th>
                                        <th>时间</th>
                                        <th>价格</th>
                                        <th width="33%">备注</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{ csrf_field() }}
                                    @if(isset($user_order) && !empty($user_order))
                                        @foreach($user_order as $ky =>$vs)
                                            <tr order_id="{{$vs['id']}}">
                                                <td><label><input type="checkbox" name="check_Item" data-price="{{$vs['price']}}"/></label>
                                                </td>
                                                @if($vs['news_type']=="news")
                                                <td>新闻发布</td>
                                                @endif
                                                <td>{{$vs['title']}}</td>
                                                <td>{{$vs['created_at']}}</td>
                                                <td><span class="red price">￥{{$vs['price']}}</span></td>
                                                <td class="alignleft">{{$vs['remark']}}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                   {{-- <tr>
                                        <td><label><input type="checkbox" name="check_Item"
                                                          data-price="100000.00"/></label></td>
                                        <td>新闻发布</td>
                                        <td>活动标题</td>
                                        <td>2017-2-20</td>
                                        <td><span class="red">￥100000.00</span></td>
                                        <td class="alignleft">每天早上大概10点截稿，请早点提交，否则要排队到第二天</td>
                                    </tr>--}}
                                    </tbody>
                                </table>
                            </div>

                            <div class="info3 clearfix">
                                <label><input type="checkbox" id="checkall"/>全选</label>
                                <a href="#" class="delorder" id="delorder">删除失效定单</a>
                                <a href="#" class="settle" id="settle">结算</a>
                                <span class="sp1">结算总金额：<i class="red" id="sum">￥<b>0.00</b></i></span>
                                <span class="sp2">已选定单 <i class="red" id="rows_order">1</i> 条</span>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--	支付弹窗	-->
    <div class="pay_info">
        <h3>总金额</h3>
        <h4 class="sum" id="sum2">￥<b>0.00</b></h4>
        <p>任务将由所下单媒体审核，若资源审核成功后便会执行发布，稍后注意前往我的喇叭传媒平台查看</p>
        <form action="" method="post" id="form1">
            <div class="item">
                <input type="password" name="pass" placeholder="请输入您的平台密码" class="pass" />
            </div>
            <div class="item">
                <button type="submit" class="sub" id="pay">支付</button>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        /*	计算金额	*/
        function reset_total(){

            var total=0;
            var rows_order=0;
            $("input[name='check_Item']").each(function(){
                var price=parseFloat($(this).attr("data-price"));
                if( $(this).is(":checked") ){
                    total += price;
                    rows_order++;
                }
            });
            $("#rows_order").text(rows_order);
            $("#sum b").text(total);
            $("#sum2 b").text(total);
        }
        $(".table_in1 input:checkbox").change(function(){
            reset_total();
        });

        /*	全选	*/
        $("#checkall").on("click",function(){
            if( $(this).is(":checked") ) {
                $("input[name='check_Item']").prop("checked",true);
            }else{
                $("input[name='check_Item']").prop("checked",false);
            }
            reset_total();
        });

        /*	删除选中订单	*/
        $("#delorder").click(function(){
            event.preventDefault();
            layer.confirm("确定要删除选中的订单吗？",{
                btn:["确定2","取消1"]
            },function(){
                $("input[name='check_Item']").each(function(){
                    if( $(this).is(":checked") ){
                        $(this).closest("tr").remove();
                    }
                });
                layer.msg('删除成功', {icon: 1});
                reset_total();
            },function(){
                layer.msg('删除已取消', {icon: 1});
            });
        });
        /*	点击结算弹出支付	*/
		var orderdata = [];
        $("#settle").click(function(){
            event.preventDefault();
			if( $("input[name=check_Item]:checked").length>0 ){
				var _token = $("input[name=_token]").val();
				var order_id = "";
				var price = $.trim($("#sum b").html());
				$("input[name=check_Item]:checked").each(function(){
					var order_id2 = $(this).closest("tr").attr("order_id");
					if( order_id == "" ){
						order_id += order_id2;
					}else{
						order_id += "," + order_id2;
					}
				});
			
				orderdata["_token"] = _token;
				orderdata["order_id"] = order_id;
				orderdata["price"] = price;

				layer.open({
					type: 1,
					title: " ",
					shadeClose: true, //开启遮罩关闭
					skin: 'pay_info_w', //加上class设置样式
					area: ['430px'], //宽高
					content: $(".pay_info")
				});
			}else{
				layer.msg("请选择订单");
			}
        });
		/*	支付	*/
		$("#pay").click(function(){
			var pass = $("input[name=pass]").val();
			if( $.trim(pass) == "" || pass.length < 6 ){
				layer.msg("密码不能为空或者小于6位");
				return false;
			}
			$.ajax({
					url: "{{route('user.Settlement')}}",
					data: {
						'order_id' : orderdata["order_id"],
						'price' : orderdata["price"],
						'password' : pass,
						'_token' : orderdata["_token"]
					},
					type: 'post',
					dataType: "json",
					success: function (data) {
						/*layer.close(1);*/
						if (data.sta == '0') {
                            layer.msg(data.msg || '提交失败');
                            window.location.href='/';
						} else {
							layer.msg(data.msg || '提交失败');
						}
					},
					error: function (data) {
						layer.msg(data.msg || '网络发生错误');
						return false;
					}
				});
			
			return false;
		});
		
		
        reset_total();
    </script>
@endsection



