@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
@endsection
@section('content')
        <!--	秒拍任务_搜索至顶	-->
<div class="w100 nav_hdorder clearfix clr" style="padding:20px 0 35px 0;">
    <div class="content"><div class="Invoice" style="background:#fff;"><div class="INa1dd">
                <div class="w100" style="width:85%;">
                    <form class="form1" method="" action="">
                        <input class="sub1 sub1_2" type="submit" name="submit" value="搜秒拍账号" />
                        <div class="w_txt1">
                            <input class="txt1" type="text" value="" />
                        </div>
                    </form>
                </div>
            </div></div></div>
</div>

<div class="content"><div class="Invoice">
        <div class="INa1dd"><div class="ndt ndt_mps">

                <div class="mps">
                    <div class="mps_t clearfix">
                        <label><input type="checkbox" id="checkall" /><b>全选</b></label>
                        <span class="info">共计63780个</span>
                        <label><input type="checkbox" name="" id="" />可原创</label>
                        <label><input type="checkbox" name="" id="" />我的收藏</label>
                        <label><input type="checkbox" name="" id="" />奥运帐号</label>
                        <label><input type="checkbox" name="" id="" />原创撰稿</label>
                        <div class="r">
                            <span class="sp1">执行类型 不限 需预约 无需预约</span>
                            <span class="sp2">报价展示</span>
                            <span class="sp1">SNBT指数</span>
                            <span class="sp1">多图文第一条阅读量</span>
                            <span class="sp2">默认排序</span>
                        </div>
                    </div>
                    <div class="mps_m">
                        <div class="mps_item clearfix">
                            <div class="l">
                                <label>
                                    <input type="checkbox" name="checkItem" value="3" data="" />
                                    <img src="{{url('Admin/images/pic4.jpg')}}" style="width:63px;height:63px;" />
                                </label>
                            </div>
                            <div class="m">
                                <table class="table_mps" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th class="info"><strong>天天炫拍</strong><img src="{{url('Admin/images/ico_qrcode.gif')}}" style="width:16px;height:16px;" /></th>
                                        <th>粉丝数</th>
                                        <th class="bg1">位置</th>
                                        <th class="bg1">参考报价</th>
                                        <th class="bg1">阅读量</th>
                                        <th>SNBT</th>
                                        <th>周更新</th>
                                        <th>配合度</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="info"><p><img src="{{url('Admin/images/ico_weixin.gif')}}" />
                                                <img src="{{url('Admin/images/ico_wx_renzheng.gif')}}" /></p>
                                            <p><a href=""><img src="{{url('Admin/images/ico_xiangqing.gif')}}" />帐号详情</a>
                                                <a href=""><img src="{{url('Admin/images/ico_soucang.gif')}}" />收藏</a>
                                                <a href=""><img src="{{url('Admin/images/ico_lahei.gif')}}" />拉黑</a></p>
                                        </td>
                                        <td>3,404万</td>
                                        <td class="bg1">多图文第一条<br/>
                                            多图文第二条<br/>
                                            单图文多图文3-N条<br/>
                                            原创撰稿</td>
                                        <td class="bg1">￥100430</td>
                                        <td class="bg1">100000+<br/>
                                            100000+</td>
                                        <td>95.0</td>
                                        <td>7次</td>
                                        <td>高</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>

            </div></div>
    </div></div>
@endsection
