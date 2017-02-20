@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
@endsection
@section('content')
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="ndt">

                    <!--	发布公众号任务	-->
                    <div class="radius1">
                        <h3 class="title1"><strong><a href="#">微营销类</a></strong></h3>

                        <div class="sbox_5">

                            <div class="WMain1" style="border:none;">
                                <div class="WMain2 WMain2_weixin">
                                    <ul>
                                        <li style="display:block;">
                                            <div class="WMain3 WMain3_2"><p><i class="LGntas"></i>发布类型:</p>
                                                <div id="radio_a1">
                                                    <label><input type="radio" name="type" value=""/>快速加粉</label>
                                                    <label class="cur"><input type="radio" name="type" value=""
                                                                              checked/>图文阅读</label>
                                                    <label><input type="radio" name="type" value=""/>分享转发</label>
                                                    <label><input type="radio" name="type" value=""/>原文阅读</label>
                                                    <label><input type="radio" name="type" value=""/>图文点赞</label>
                                                    <label><input type="radio" name="type" value=""/>朋友圈点赞</label>
                                                    <label><input type="radio" name="type" value=""/>官方投票</label>
                                                    <label><input type="radio" name="type" value=""/>第三方投票</label>
                                                </div>
                                                <script type="text/javascript">
                                                    $("#radio_a1 label").click(function () {
                                                        $(this).addClass("cur").siblings("label").removeClass("cur");
                                                    });
                                                </script>
                                            </div>
                                            <div class="WMain3 WMain3_2 w50"><p><i class="LGntas"></i>微信原始ID:</p>
                                                <input type="text" name="textfield" id="textfield" class="txt6"/>
                                                <div class="warm">
                                                    <span>请准确填写，否则数据不一致后果自负</span>
                                                </div>
                                            </div>
                                            <div class="WMain3 WMain3_2 w50"><p><i class="LGntas"></i>每天数量:</p>
                                                <input type="text" name="textfield" id="textfield" class="txt6"/>
                                            </div>

                                            <div class="WMain3 WMain3_2"><p><i class="LGntas"></i>开始执行时间:</p>
                                                <input type="text" name="textfield" id="datepicker1"
                                                       class="txt2 txt2_2"/> &nbsp;至&nbsp;
                                                <input type="text" name="textfield" id="datepicker2"
                                                       class="txt2 txt2_2"/>
                                            </div>
                                            <div class="WMain3 WMain3_2"><p><i class="LGntas"></i>间隔时间:</p>
                                                <select class="sel_2 options_s">
                                                    <option value="">60</option>
                                                    <option value="">120</option>
                                                    <option value="">240</option>
                                                    <option value="">600</option>
                                                    <option value="">3600</option>
                                                </select> 秒
                                                <div class="warm">
                                                    <span>请准确填写，否则数据不一致后果自负</span>
                                                </div>
                                            </div>
                                            <div class="WMain3 WMain3_2"><p><i class="LGntas"></i>回复消息:</p>
                                                <div><textarea name="" class="tarea_1"></textarea></div>
                                                <div class="warm">
                                                    <span>请准确填写，否则数据不一致后果自负</span>
                                                </div>
                                            </div>
                                            <div class="WMain3 WMain3_2"><p><i class="LGntas"></i>我的备注:</p>
                                                <input type="text" name="textfield" id="textfield" class="txt6"/>
                                            </div>
                                            <div class="WMain3 WMain3_2" style="margin-top:35px;">
                                                <p><i class="LGntas"></i></p>
                                                <div class="info_1">
                                                    <h3>发任务前必读</h3>
                                                    <ul>
                                                        <li>标题作为含有哪些关键词要写清楚，关键词最好不要超过2个</li>
                                                        <li>文章要求：关键词有哪些一定要写清楚，关键词文章内要出现几次，是否带连接、联系方式、图片等，如需带请自行准备</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="WMain3 WMain3_2" style="margin-top:35px;">
                                                <input type="submit" value="提交" class="sub5"/>
                                            </div>

                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
