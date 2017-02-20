@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
@endsection
@section('content')
    <div class="content"><div class="Invoice"><div class="INa1dd">
                <div class="main" style="margin-top:20px;">

                    <!--	媒体资源管理	-->
                    <div class="hdorder radius1">
                        <h3 class="title1"><strong><a href="#">媒体资源管理</a></strong>
                        </h3>
                        <div class="dhorder_m">
                            <div class="FLnt1">
                                <p>修改</p>
                                <span>当前位置：<a href="fenlei.php">媒体资源管理</a> > <a href="fenlei.php">网络媒体</a>  > 新闻发布</span>
                            </div>
                            <div class="IF1">
                                <div class="xinzengfenlei">
                                    <div class="XZFL"><p>媒体类型:</p>
                                        <select name="select" id="select">
                                            <option>网络媒体</option>
                                            <option>户外媒体</option>
                                            <option>平面媒体</option>
                                            <option>电视媒体</option>
                                            <option>广播媒体</option>
                                            <option>记者媒体</option>
                                        </select>
                                    </div>
                                    <div class="IF3"><p>资源名称:</p>
                                        <input type="text" name="textfield2" id="FLnome"  class="IFN2"/>
                                    </div>
                                    <div class="IF3"><p>是否发布:</p>
                                        <input type="radio" name="radio" id="radio1" value="radio1"/>
                                        &nbsp;是&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="radio" id="radio2" value="radio2" />
                                        &nbsp;否
                                    </div>
                                    <div class="IF3"><p>排序:</p>
                                        <input type="text" name="textfield2" id="FLsorting"  class="FLn1"/>
                                    </div>
                                    <div class="IF3"><input type="submit" name="button" id="button" value="提  交" class="LGButton3" style="margin-top:15%;" /></div>
                                    <p>&nbsp;</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div></div></div>
@endsection
