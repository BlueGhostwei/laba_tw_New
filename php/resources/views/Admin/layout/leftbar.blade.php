<div class="frame">
    <div class="logo"><a href="{{route('admin.dashboard')}}"><img src="{{url('Admin/img/logolaba.png')}}"/></a></div>
    <a href="#" class="sidebar-open-button"></a>
    <div class="menuntda"></div>
    <div class="ITuser">
        <div class="Hlogo">
            @if(isset(Auth::user()->user_avatar) && Auth::user()->user_avatar!=null)
                <img src="{{ md52url(Auth::user()->user_avatar, false, '') }}" alt="image"/>
            @else
                <img src="{{url('Admin/img/bn66.png')}}"/>
            @endif
            <div class="Hltext">{{get_message_num()}}</div>
        </div>
        <div class="IName">
            <p class="name">@if(isset(Auth::user()->username) && Auth::user()->username!=null){{Auth::user()->username}}@endif</p>
            <p class="account">认证账户</p>
            {{--<a href="{{route('user.logout')}}"
               style="line-height:20px; font-size:10px;  color: #cbc631; padding: 0 10px;">退出</a>--}}
        </div>
        <div class="sidepanel-open-button"></div>
    </div>
</div>
<!--右边会员中心入口弹窗-->
<div class="HYrukou">
    <li><a href="" class="nd2">会员信息</a></li>
    <li><a href="" class="nd2">会员信息</a></li>
    <li><a href="{{route('user.logout')}}" class="nd2">退出</a></li>
</div>
<!--右弹购物车-->
<div role="tabpanel" class="sidepanel" style="display:none">
    <div style="background:#204186; float:left; width:260px; height:auto;">
        <div class="Hlogo"><img src="{{url('Admin/img/bn66.png')}}"/></div>
        <div class="IName">
            <p class="name">@if(isset(Auth::user()->username) && Auth::user()->username!=null){{Auth::user()->username}}@endif</p>
            <p class="account">认证账户</p>
        </div>
        <div class="sidepanel-open-button"></div>
        <div style="width:260px; float:left; height:auto;">
            <div class="IT_nt1" onclick="window.open('{{url('Admin/message')}}')">
                <div class="Hltext" >{{get_message_num()}}</div>
            </div>
            <div class="IT_nt2">
                <div class="Hltext">5</div>
            </div>
            <div class="IT_nt3"><img src="{{url('Admin/img/IT_nt3.png')}}"/></div>
            <div class="IT_nt4"><img src="{{url('Admin/img/IT_nt4.png')}}"/></div>
        </div>
    </div>
    <div style="background:#1d3a78; float:left; width:260px; height:auto;">
        <div class="IIO_nt">购物车共：<span> @if(!empty(get_order())){{count(get_order())}} @else 0 @endif</span>个</div>
        <ul class="ITorder" id="apDiv1">
            @if(!empty(get_order()))
                @foreach(get_order() as $key =>$vel)
                    {{ csrf_field() }}
                <li><a href="" data_id="{{$vel['id']}}" >
						<div class="GWxuanxiang"><input type="checkbox" name="checkItem" ></div>
                        <div class="IOimg"><img src="{{get_media_img($vel['media_id'])}}"/>
                            <div class="IOweixin"><img src="{{url('Admin/img/1atn.jpg')}}"/></div>
                        </div>
                        <div class="IOtext">
                            <h3>{{$vel['title']}}</h3>
                            <p>{{Auth::user()->username}}</p>
                        </div>
                    </a>
                </li>
                @endforeach
          @endif
        </ul>
        <div class="IObu"><input type="submit" name="button" id="button" value="下一步" class="TOUbutton"/></div>
    </div>
</div>
{{--左边导航--}}
<div class="sidebar clearfix">
    <ul class="sidebar-panel nav">

        <li>
			<div class="header inactive">
                <span class="label" id="sd1">网络媒体</span>
			</div>
            <ul class="menu">
                    <li><a href="{{route('media.release')}}">
                            <div class="nd1n">新闻发布</div>
                        </a></li>
                    <li><a href="{{route('media.market')}}">
                            <div class="nd2n">百科营销</div>
                        </a></li>
                    <li><a href="{{route('media.Short_video')}}">
                            <div class="nd3n">短视频</div>
                        </a></li>
                    <li><a href="{{route('media.Public_Wechat')}}">
                            <div class="nd4n">公众号</div>
                        </a></li>
                    <li><a href="{{route('media.forum')}}">
                            <div class="nd5n">论坛</div>
                        </a></li>
                    <li><a href="{{route('media.Second_shot')}}">
                            <div class="nd6n">秒拍</div>
                        </a></li>
                    <li><a href="{{route('media.Copy_plan')}}">
                            <div class="nd7n">文案策划</div>
                        </a></li>
                    <li><a href="">
                            <div class="nd8n">微博大号</div>
                        </a></li>
                    <li><a href="{{route('media.Wechat_market')}}">
                            <div class="nd9n">微信营销</div>
                        </a></li>
                    <li><a href="">
                            <div class="nd10n">问答营销</div>
                        </a></li>
            </ul>
        </li>
        <li>
			<div class="header inactive">
                <span class="label" id="sd3">户外媒体</span>
			</div>
            <ul class="menu">
                <li><a href=""><div class="nd1">地标媒体</div></a></li>
                <li><a href=""><div class="nd2">户外大牌</div></a></li>
                <li><a href=""><div class="nd3">户外频媒</div></a></li>
                <li><a href=""><div class="nd4">公交媒体</div></a></li>
                <li><a href=""><div class="nd5">地铁媒体</div></a></li>
                <li><a href=""><div class="nd6">楼宇媒体</div></a></li>
                <li><a href=""><div class="nd7">机场媒体</div></a></li>
                <li><a href=""><div class="nd8">高铁媒体</div></a></li>
                <li><a href=""><div class="nd9">影院媒体</div></a></li>
                <li><a href=""><div class="nd10">高速媒体</div></a></li>
            </ul>
        </li>
        <li>
			<div class="header inactive">
                <span class="label" id="sd1">权限管理</span>
			</div>
            <ul class="menu">
                <li><a href="{{route('acl.role.index')}}"><div class="nd1">角色列表</div></a></li>
            </ul>
        </li>
        <li>
			<div class="header inactive">
                <span class="label" id="sd1">会员中心</span>
			</div>
            <ul class="menu">
                <li><a href="{{route('member.info')}}">
                        <div class="nd1n">会员信息</div>
                    </a></li>
                <li><a href="{{route('member.Onlnetop_up')}}">
                        <div class="nd2n">在线充值</div>
                    </a></li>
                <li><a href="{{route('admin.withdraw')}}">
                        <div class="nd2n">账户提现</div>
                    </a></li>
                <li><a href="{{route('admin.withdrawlist')}}">
                        <div class="nd2n">提现列表</div>
                    </a></li>
            </ul>
        </li>

        <li>
            <div class="header">
                <span class="label" id="sd4">平面媒体</span>					</div>
        </li>
        <li>
            <div class="header">
                <span class="label" id="sd5">电视媒体</span>					</div>
        </li>
        <li>
            <div class="header">
                <span class="label" id="sd6">广播媒体</span>					</div>
        </li>
        <li>
            <div class="header">
                <span class="label" id="sd2">记者预约</span>					</div>
        </li>
        <li>
            <div class="header">
                <span class="label" id="sd7">内容代写</span>					</div>
        </li>
        <li>
            <div class="header">
                <span class="label" id="sd8">宣传定制</span>					</div>
        </li>
        <li>
			<div class="header inactive">
                <span class="label" id="sd1">平台管理</span>
			</div>
            <ul class="menu">
                <li><a href="{{route('category.index')}}">
                        <div class="nd1n">分类管理</div>
                    </a></li>
                <li><a href="{{route('category.media_from')}}">
                        <div class="nd2n">新增媒体</div>
                    </a></li>
                <li><a href="{{route('category.media_List')}}">
                        <div class="nd3n">媒体列表</div>
                    </a></li>
                <li><a href="{{route('admin.adduser')}}">
                        <div class="nd3n">新增用户</div>
                    </a></li>
                <li><a href="{{route('admin.userlist')}}">
                        <div class="nd3n">用户管理</div>
                    </a></li>
            </ul>
        </li>
        <li>
			<div class="header inactive">
                <span class="label" id="sd1">媒体供应商</span>
			</div>
            <ul class="menu">
                <li><a href="{{route('vider.Event_list')}}"><div class="nd1">活动订单</div></a></li>
            </ul>
        </li>
    </ul>
</div>
<div id="current_url" style="display:none;">{{url()->current()}}</div>
<script type="text/javascript">
    var t1=TouchScroll('apDiv1',{vOffset:0,mouseWheel:true,keyPress:false})
    $(function(){
		
/*         $(".menu a").each(function(){
            var href1 = $(this).attr("href");
            var href2 = window.location.href;
            if( href1 != "" && href1 != "#" && href2 == href1 ){
                $(this).parents(".menu").prev(".header").trigger("click");
                $(this).parent("li").addClass("cur");
            }
        }); */

 		var current_url = $.trim($("#current_url").html());
		if( current_url != "" && current_url != "#" ){
			$(".sidebar .menu li a").each(function(){
				var url = $.trim($(this).attr("href"));
				if( url == current_url ){
					$(this).parent().addClass("cur")
						.closest(".menu").prev(".header").trigger("click");
				}
			});
		}

        $(".ITuser").click(function(){
            $(".HYrukou").toggle();
        });

		$("#button").click(function(){
			var id = "";
			var _token = $("input[name=_token]").val();
			if( $("#apDiv1 li input[name=checkItem]:checked").length>0 ){
				$("#apDiv1 li input[name=checkItem]:checked").each(function(){
					var data_id = $(this).closest("a").attr("data_id");
					if( id == "" ){
						id += data_id;
					}else{
						id += "," + data_id;
					}
				});
               var url="{{route('user.order_list')}}"+"?order="+id;
                window.location.href=url;
				/*$.ajax({
					url: '{{route('user.order_list')}}',
					data: {
						'order_id' : id,
						'_token' : _token
					},
					type: 'post',
					dataType: "json",
					success: function (data) {
						if (data.sta == '0') {
                            window.location.href=url;
						} else {
							layer.msg(data.msg || '提交失败');
						}
					},
					error: function (data) {
						console.log(data);
						layer.msg(data.msg || '网络发生错误');
						return false;
					}
				});*/
			}else{
				layer.msg('已选商品不能为空');
			}
		});
		
	});
</script>
