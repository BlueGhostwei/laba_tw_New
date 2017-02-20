@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
@endsection
@section('content')
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="main" style="margin-top:20px;">

                    <!--	媒体资源管理	-->
                    <div class="hdorder radius1">
                        <h3 class="title1"><strong><a href="#">媒体资源管理</a></strong>
                        </h3>
                        <div class="dhorder_m">
                            <div class="FLnt1">
                                <p>查看资源分类</p>
                                <span>当前位置：<a href="fenlei.php">媒体资源管理</a> > <a href="fenlei.php">网络媒体</a>  > <a
                                            href="fenleiziyuan1.php">新闻发布</a> > 网站类型</span>
                            </div>
                            <div class="tab1_body">
                                <!--网站类型-->
                                <table class="table_in1 cur">
                                    <thead>
                                    <tr>

                                        <th style="width: 40%;text-align:left;text-indent:50px;">分类名称</th>
                                        <th style="width: 15%;text-align:center;text-indent:20px;">状态</th>
                                        <th style="width: 8%;text-align:center;text-indent:20px;">排序</th>
                                        <th style="width: 37%;text-align:center;text-indent:20px;">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td style="width: 40%;text-align:left;text-indent:50px;">全国门户</td>
                                        <td style="width: 15%;text-align:center;text-indent:20px;">发布</td>
                                        <td style="width: 8%;text-align:center;text-indent:20px;">1</td>
                                        <td style="width: 37%;text-align:center;text-indent:20px;">
                                            <a href="fenleixiugai2.php">查看分类</a>|
                                            <a href="#">删除</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--入口级别-->
                                <table class="table_in1" id="jibie">
                                    <thead>
                                    <tr>
                                        <th>排序</th>
                                        <th>资源类型</th>
                                        <th>资源名称</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>入口级别</td>
                                        <td>网站首页</td>
                                        <td>发布</td>
                                        <td><select>
                                                <option>修改</option>
                                                <option>删除</option>
                                            </select></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--入口形式-->
                                <table class="table_in1" id="xingshi">
                                    <thead>
                                    <tr>
                                        <th>排序</th>
                                        <th>资源类型</th>
                                        <th>资源名称</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>入口形式</td>
                                        <td>网站首页</td>
                                        <td>发布</td>
                                        <td><select>
                                                <option>修改</option>
                                                <option>删除</option>
                                            </select></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--正文链接-->
                                <table class="table_in1" id="lianjie">
                                    <thead>
                                    <tr>
                                        <th>排序</th>
                                        <th>资源类型</th>
                                        <th>资源名称</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>正文链接</td>
                                        <td>网站首页</td>
                                        <td>发布</td>
                                        <td><select>
                                                <option>修改</option>
                                                <option>删除</option>
                                            </select></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--覆盖区域-->
                                <table class="table_in1" id="quyu">
                                    <thead>
                                    <tr>
                                        <th>排序</th>
                                        <th>资源类型</th>
                                        <th>资源名称</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>覆盖区域</td>
                                        <td>网站首页</td>
                                        <td>发布</td>
                                        <td><select>
                                                <option>修改</option>
                                                <option>删除</option>
                                            </select></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--频道类型-->
                                <table class="table_in1" id="pindao">
                                    <thead>
                                    <tr>
                                        <th>排序</th>
                                        <th>资源类型</th>
                                        <th>资源名称</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>频道类型</td>
                                        <td>网站首页</td>
                                        <td>发布</td>
                                        <td><select>
                                                <option>修改</option>
                                                <option>删除</option>
                                            </select></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="page_1 page_1_2" style="padding-bottom: 50px;">
					<span class="pages">
						<a href="" class="prev">上一页</a>
						<a href="" class="">1</a>
						<a href="" class="cur">2</a>
						<a href="">3</a>
						<a href="">4</a>
						<a href="">5</a>
						<span class="sus">...</span>
						<a href="" class="">248</a>
						<a href="" class="next">下一页</a>
					</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
