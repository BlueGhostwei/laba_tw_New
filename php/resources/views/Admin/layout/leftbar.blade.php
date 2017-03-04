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
            <div class="Hltext">5</div>
        </div>
        <div class="IName">
            <p class="name">@if(isset(Auth::user()->username) && Auth::user()->username!=null){{Auth::user()->username}}@endif</p>
            <p class="account">认证账户</p>
            <a href="{{route('user.logout')}}"
               style="line-height:20px; font-size:10px;  color: #cbc631; padding: 0 10px;">退出</a>
        </div>
        <div class="sidepanel-open-button"></div>
    </div>
</div>
<!--右边会员中心入口弹窗-->
<div class="HYrukou">
    <li><a href="" class="nd2">会员信息</a></li>
    <li><a href="" class="nd2">会员信息</a></li>
    <li><a href="" class="nd2">会员信息</a></li>
</div>
<!--右弹购物车-->
<div role="tabpanel" class="sidepanel" style="display:none">
    <div style="background:#204186; float:left; width:260px; height:auto;">
        <div class="Hlogo"><img src="{{url('Admin/img/bn66.png')}}"/></div>
        <div class="IName">
            <p class="name">1171801173@qq.com</p>
            <p class="account">认证账户</p>
        </div>
        <div class="sidepanel-open-button"></div>
        <div style="width:260px; float:left; height:auto;">
            <div class="IT_nt1">
                <div class="Hltext">5</div>
            </div>
            <div class="IT_nt2">
                <div class="Hltext">5</div>
            </div>
            <div class="IT_nt3"><img src="{{url('Admin/img/IT_nt3.png')}}"/></div>
            <div class="IT_nt4"><img src="{{url('Admin/img/IT_nt4.png')}}"/></div>
        </div>
    </div>
    <div style="background:#1d3a78; float:left; width:260px; height:auto;">
        <div class="IIO_nt">购物车共：<span>20</span>个</div>
        <ul class="ITorder" id="apDiv1">
            <li><a href="">
                    <div class="IOimg"><img src="{{url('Admin/img/bn66.png')}}"/>
                        <div class="IOweixin"><img src="{{url('Admin/img/1atn.jpg')}}"/></div>
                    </div>
                    <div class="IOtext">
                        <h3>定单标题</h3>
                        <p>微信号：123456</p>
                    </div>
                </a>
            </li>
            <li><a href="">
                    <div class="IOimg"><img src="{{url('Admin/img/bn66.png')}}"/>
                        <div class="IOweixin"><img src="{{url('Admin/img/1atn.jpg')}}"/></div>
                    </div>
                    <div class="IOtext">
                        <h3>定单标题</h3>
                        <p>微信号：123456</p>
                    </div>
                </a>
            </li>
            <li><a href="">
                    <div class="IOimg"><img src="{{url('Admin/img/bn66.png')}}"/>
                        <div class="IOweixin"><img src="{{url('Admin/img/1atn.jpg')}}"/></div>
                    </div>
                    <div class="IOtext">
                        <h3>定单标题</h3>
                        <p>微信号：123456</p>
                    </div>
                </a>
            </li>
            <li><a href="">
                    <div class="IOimg"><img src="{{url('Admin/img/bn66.png')}}"/>
                        <div class="IOweixin"><img src="{{url('Admin/img/1atn.jpg')}}"/></div>
                    </div>
                    <div class="IOtext">
                        <h3>定单标题</h3>
                        <p>微信号：123456</p>
                    </div>
                </a>
            </li>
            <li><a href="">
                    <div class="IOimg"><img src="{{url('Admin/img/bn66.png')}}"/>
                        <div class="IOweixin"><img src="{{url('Admin/img/1atn.jpg')}}"/></div>
                    </div>
                    <div class="IOtext">
                        <h3>定单标题</h3>
                        <p>微信号：123456</p>
                    </div>
                </a>
            </li>
            <li><a href="">
                    <div class="IOimg"><img src="{{url('Admin/img/bn66.png')}}"/>
                        <div class="IOweixin"><img src="{{url('Admin/img/1atn.jpg')}}"/></div>
                    </div>
                    <div class="IOtext">
                        <h3>定单标题</h3>
                        <p>微信号：123456</p>
                    </div>
                </a>
            </li>
            <li><a href="">
                    <div class="IOimg"><img src="{{url('Admin/img/bn66.png')}}"/>
                        <div class="IOweixin"><img src="{{url('Admin/img/1atn.jpg')}}"/></div>
                    </div>
                    <div class="IOtext">
                        <h3>定单标题</h3>
                        <p>微信号：123456</p>
                    </div>
                </a>
            </li>
            <li><a href="">
                    <div class="IOimg"><img src="{{url('Admin/img/bn66.png')}}"/>
                        <div class="IOweixin"><img src="{{url('Admin/img/1atn.jpg')}}"/></div>
                    </div>
                    <div class="IOtext">
                        <h3>定单标题</h3>
                        <p>微信号：123456</p>
                    </div>
                </a>
            </li>
            <li><a href="">
                    <div class="IOimg"><img src="{{url('Admin/img/bn66.png')}}"/>
                        <div class="IOweixin"><img src="{{url('Admin/img/1atn.jpg')}}"/></div>
                    </div>
                    <div class="IOtext">
                        <h3>定单标题</h3>
                        <p>微信号：123456</p>
                    </div>
                </a>
            </li>
        </ul>
        <div class="IObu"><input type="submit" name="button" id="button" value="下一步" class="TOUbutton"/></div>
    </div>
</div>
{{--左边导航--}}
<div class="sidebar clearfix">
    <ul class="sidebar-panel nav">

        <li>
            <div class="header">
                <span class="label" id="sd1">网络媒体</span>
                <span class="arrow up"></span>					</div>
            <ul class="menu">
                <ul class="menu  ">
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
            </ul>
        </li>
        <li>
            <div class="header">
                <span class="label" id="sd3">户外媒体</span>
                <span class="arrow up"></span>					</div>
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
            <div class="header">
                <span class="label" id="sd3">会员中心</span>
                <span class="arrow up"></span>
            </div>
            <ul class="menu">
                <li><a href="{{route('member.info')}}">
                        <div class="nd1n">会员信息</div>
                    </a></li>
                <li><a href="{{route('member.Onlnetop_up')}}">
                        <div class="nd2n">在线充值</div>
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
                <span class="label" id="sd2">记者报料</span>					</div>
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
            <div class="header">
                <span class="label" id="sd3">平台管理</span>
                <span class="arrow up"></span>
            </div>
            <ul class="menu">
                <li><a href="{{route('category.index')}}">
                        <div class="nd1n">新闻发布</div>
                    </a></li>
                <li><a href="{{route('category.media_from')}}">
                        <div class="nd2n">新增媒体</div>
                    </a></li>
                <li><a href="{{route('category.media_List')}}">
                        <div class="nd3n">媒体列表</div>
                    </a></li>
            </ul>
        </li>
    </ul>
</div>
<script type="text/javascript">
    var t1=TouchScroll('apDiv1',{vOffset:0,mouseWheel:true,keyPress:false})

    $(function(){
        $(".menu a").each(function(){
            var href1 = $(this).attr("href");
            var href2 = window.location.href;
            if( href2.indexOf(href1)>0 ){
                $(this).parents(".menu").prev(".header").trigger("click");
                $(this).parent("li").addClass("cur");
            }
        });
    });

    $(document).ready(function(){
        $(".ITuser").click(function(){
            $(".HYrukou").toggle();

        });


    });

</script>
