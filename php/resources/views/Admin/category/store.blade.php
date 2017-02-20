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
                                <span>当前位置：<a href="{{route('category.index')}}">媒体资源管理</a> > <a href="{{route('category.index')}}">网络媒体</a>  > 新闻发布</span>
                            </div>
                            <div class="IF1">
                                <div class="xinzengfenlei">
                                    <div class="XZFL"><p>媒体类型:</p>
                                        <select name="select" id="select">
                                            @if(isset($midia_type) && !empty($midia_type))
                                                @foreach($midia_type as $k=>$v)
                                                    <option  media_id="{{$v['media_id']}}">{{$v['media_name']}}</option>
                                                    @endforeach
                                                @else
                                                <option>网络媒体</option>
                                                <option>户外媒体</option>
                                                <option>平面媒体</option>
                                                <option>电视媒体</option>
                                                <option>广播媒体</option>
                                                <option>记者媒体</option>
                                                @endif
                                        </select>
                                    </div>
                                    <div class="IF3"><p>分类名称:</p>
                                        <input type="text" name="media_name" id="media_name"  class="IFN2"/>
                                    </div>
                                    <div class="IF3"><p>是否发布:</p>
                                        <input type="radio" name="radio_true" checked id="radio1" value="0"/>
                                        &nbsp;是&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="radio_false" id="radio2" value="1" />
                                        &nbsp;否
                                    </div>
                                    <div class="IF3"><p>排序:</p>
                                        <input type="text" name="Sorting" id="FLsorting"  class="FLn1" value=""/>
                                    </div>
                                    <div class="IF3">
                                        <input type="submit" name="media_button" id="media_button" value="提  交" class="LGButton3" style="margin-top:15%;" />
                                    </div>
                                    <p>&nbsp;</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div></div></div>
@endsection
