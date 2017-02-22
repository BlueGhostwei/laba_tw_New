@extends('Admin.layout.main')
@section('title', '媒体供应商_活动订单 - 亚媒社')
@section('header_related')
@endsection
@section('content')
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="main" style="margin-top:20px;">

                    <!--	分类管理	-->
                    <div class="hdorder radius1" style=" float: left; margin-bottom:50px;">
                        <h3 class="title1"><strong><a href="#">媒体资源管理</a></strong>
                        </h3>
                        <div class="dhorder_m">
                            <div class="FLnt1">
                                <span>当前位置：<a href="fenlei.php">媒体资源管理</a> > <a href="fenlei.php">创建媒体</a> </span>
                            </div>
                            <div class="IF1">
                                <div class="FLmeiti1">* 媒体资源信息</div>
                                <div class="FLmeiti2">
                                    <div class="IF3"><p>媒体类型:</p>
                                        <select name="select" id="select">
                                            @if(isset($media_type) && !empty($media_type))
                                                @foreach($media_type as $Key =>$vel)
                                                    <option data_id="{{$vel['media_id']}}">{{$vel['media_name']}}</option>
                                                    @endforeach
                                                @else
                                                <option>新闻发布</option>
                                                <option>百度营销</option>
                                                <option>短视频</option>
                                                <option>公众号</option>
                                                @endif
                                        </select>
                                    </div>
                                    <div class="IF3"><p>媒体名称:</p>
                                        <input type="text" name="media_name" id="FLnome1" class="IFN2"/>
                                    </div>

                                    <div class="IF3"><p>媒体LOGO:</p>
                                        <div><img src="" alt=""> </div>
                                        <input type="file" name="media_file" id="FLnome2" placeholder="未选择任何文件"
                                               class="IFN2"/>
                                        <i style="font-size: 12px;color: #ccc; padding-left:10px;">(100KB以内)</i>
                                    </div>
                                    <div class="IFMeiTi">
                                        <table>
                                            <tr>
                                                <td valign="top"><p>网站类型:</p></td>
                                                <td>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="IFMeiTi">
                                        <table>
                                            <tr>
                                                <td valign="top"><p>入口级别:</p></td>
                                                <td>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="IFMeiTi">
                                        <table>
                                            <tr>
                                                <td valign="top"><p>入口形式:</p></td>
                                                <td>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="IFMeiTi">
                                        <table>
                                            <tr>
                                                <td valign="top"><p>正文链接:</p></td>
                                                <td>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="IFMeiTi">
                                        <table>
                                            <tr>
                                                <td valign="top"><p>覆盖区域:</p></td>
                                                <td>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                    <li><input type="checkbox" name="checkbox"/>全国门户</li>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="IF3"><p>平台价：</p>
                                        <input type="text" name="textfield2" id="FLsorting" class="FLn1"/><span>元</span>
                                    </div>
                                    <div class="IF3"><p>代理价：</p>
                                        <input type="text" name="textfield2" id="FLsorting" class="FLn1"/><span>元</span>
                                    </div>
                                    <div class="IF3"><p>会员价：</p>
                                        <input type="text" name="textfield2" id="FLsorting" class="FLn1"/><span>元</span>
                                    </div>
                                    <p>&nbsp;</p>
                                </div>
                                <div class="FLmeiti1">* 媒体负责人基本信息</div>
                                <div class="FLmeiti2">
                                    <div class="IF3"><p>媒体负责人:</p>
                                        <input type="text" name="principal" class="FLn3"/>
                                    </div>
                                    <div class="IF3"><p>联系电话:</p>
                                        <input type="text" name="mobile_number" class="FLn3"/>
                                    </div>
                                    <div class="XZFL"><p>邮箱:</p>
                                        <input type="text" name="user_Eail" class="FLn3"/>
                                    </div>
                                    <div class="IF3"><p>联系QQ:</p>
                                        <input type="text" name="user_QQ" class="FLn3"/>
                                    </div>
                                    <div class="IF3"><p>联系地址:</p>
                                        <input type="text" name="textfield2" class="IFN2"/>
                                    </div>
                                    <div class="IF3"><p>邮编:</p>
                                        <input type="text" name="Zip_code" class="FLn3"/>
                                    </div>
                                    <div class="IF3"><p>媒体认证:</p>
                                        <select name="certification" id="select">
                                            <option>营业执照</option>
                                            <option>身份证</option>
                                        </select>
                                        <input type="text" name="certificate" placeholder="未选择任何文件" class="FLn4"/><i
                                                style="font-size: 12px;color: #ccc; padding-left:10px;">(100KB以内)</i>
                                    </div>
                                    <div class="IF3"><p>媒体简介:</p>
                                        <textarea name="Website_Description" class="IFN3"></textarea>
                                    </div>
                                </div>
                                <input type="submit" name="button" value="提  交" class="LGButton3"
                                       style="margin: 5% 30%"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

    </script>
@endsection
