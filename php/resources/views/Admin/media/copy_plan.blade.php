@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
@endsection
@section('content')
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="ndt">

                    <!--	添加方案策划任务	-->
                    <div class="radius1">
                        <h3 class="title1"><strong><a href="#">内容代写</a></strong></h3>

                        <div class="sbox_5">

                            <div class="WMain1" style="border:none;">
                                <div class="WMain2 WMain2_weixin">
                                    <ul>
                                        <li style="display:block;">

                                            <div class="WMain3 WMain3_2"><p><i class="LGntas"></i>类型:</p>
                                                <div id="radio_a1">
                                                    @if(isset($ghostwrite) && !empty($ghostwrite))
                                                        @foreach($ghostwrite as $ky =>$vl)
                                                            <label
                                                            @if($ky==0)
                                                                 class="cur"
                                                                @endif
                                                                    write_id="{{$vl->id}}"
                                                            ><input type="radio" name="type" value=""
                                                                                      checked/>{{$vl->name}}</label>
                                                            @endforeach
                                                        @else
                                                        <label class="cur"><input type="radio" name="type" value=""
                                                                                  checked/>常规新闻稿</label>
                                                        <label><input type="radio" name="type" value=""/>偏软文新闻稿</label>
                                                       {{-- <label><input type="radio" name="type" value=""/>企业介绍</label>
                                                        <label><input type="radio" name="type" value=""/>产品介绍</label>
                                                        <label><input type="radio" name="type" value=""/>人物介绍</label>
                                                        <label><input type="radio" name="type" value=""/>活动宣传</label>
                                                        <label><input type="radio" name="type" value=""/>百科撰写</label>
                                                        <label><input type="radio" name="type" value=""/>问答策划</label>--}}
                                                        @endif

                                                </div>
                                                <script type="text/javascript">
                                                    $("#radio_a1 label").click(function () {
                                                        $(this).addClass("cur").siblings("label").removeClass("cur");
                                                    });
                                                </script>
                                            </div>
                                            <div class="WMain3"><p><i class="LGntas">*</i>标题:</p>
                                                <input type="text" name="textfield" id="textfield"
                                                       placeholder="请输入标题" class="WIFN1"/>
                                            </div>
                                            <div class="WMain3 WMain3_2"><p><i class="LGntas"></i>需求:</p>
                                                <div class="editor_w">
                                                    <script id="editor" name="zw" type="text/plain"></script>
                                                </div>
                                            </div>
                                            <div class="WMain3"><p><i class="LGntas"></i>字数:</p>
                                                <label><input type="radio" name="number" value=""/>1000字</label>
                                                <label><input type="radio" name="number" value=""/>2000字</label>
                                                <label><input type="radio" name="number" value=""/>3000字</label>
                                            </div>
                                            <div class="WMain3 WMain3_2"><p><i class="LGntas"></i>编辑:</p>
                                                <div>
                                                    <label><input type="radio" name="cycle" value=""/>专业手写
                                                        ￥100/千字1个工作日</label>
                                                    <label><input type="radio" name="cycle" value=""/>专业编辑
                                                        ￥200/千字1个工作日</label>
                                                    <label><input type="radio" name="cycle" value=""/>专业作者
                                                        ￥300/千字1个工作日</label>
                                                </div>
                                            </div>
                                            <div class="WMain3"><p><i class="LGntas"></i>篇数:</p>
                                                <select id="" name="" class="sel2">
                                                    <option value="">代写一篇</option>
                                                    <option value="">代写二篇</option>
                                                    <option value="">代写三篇</option>
                                                    <option value="5">更多</option>
                                                </select>
                                                <input type="text" name="article_price" id="article_price" class="txt6"  style="width:130px;" />&nbsp;篇
                                            </div>
                                            <div class="WMain3"><p><i class="LGntas"></i>总额:</p>
                                                <input type="text" name="article_price" id="article_price" class="txt6"
                                                       style="width:130px;"/>&nbsp; 元
                                            </div>
                                            <div class="WMain3 Wmain3_2">
                                                <p><i class="LGntas"></i></p>
                                                <div class="info_1">
                                                    <h3>我们能为您提供什么？</h3>
                                                    <ul>
                                                        <li>1、快速撰写：       1-2个工作日撰写完成 </li>
                                                        <li>2、各种类型：       新闻稿件、报纸杂志稿件、产品宣传稿件、微信微博稿等 </li>
                                                        <li>3、各种行业：       IT科技、财经商业、酒店旅游、教育培训、生活消费、房产家居、汽车、体育运动、女性时尚等 
                                                        </li>
                                                        <li>4、量身甄选编辑： 根据您的稿件要求、发布媒体、所属行业，为您提供内容策划服务，不满意可以更换写手编辑 </li>
                                                        <li>5、不满意可退款： 多次修改后仍不满意可以退款，不收取任何费用（要求无大范围改动，修改不超过3次，拒绝骗稿）</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="WMain3 WMain3_2" style="amargin-top:45px;">
                                                <input type="submit" value="提交" class="sub5"/>
                                                <span style="margin-left:30px;">账户余额不足，<a href="">点此充值</a></span>
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
    <script type="text/javascript">
        $(function () {
            var mb="";
               mb +='<input type="text" name="article_price" id="article_price"' +
                'class="txt6"  style="width:130px; placeholder="" />&nbsp;篇'
        });
    </script>
    <script type="text/javascript">

        //实例化编辑器
        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
        var ue = UE.getEditor('editor');
        function isFocus(e){
            alert(UE.getEditor('editor').isFocus());
            UE.dom.domUtils.preventDefault(e)
        }
        function setblur(e){
            UE.getEditor('editor').blur();
            UE.dom.domUtils.preventDefault(e)
        }
        function insertHtml() {
            var value = prompt('插入html代码', '');
            UE.getEditor('editor').execCommand('insertHtml', value)
        }
        function createEditor() {
            enableBtn();
            UE.getEditor('editor');
        }
        function getAllHtml() {
            alert(UE.getEditor('editor').getAllHtml())
        }
        function getContent() {
            var arr = [];
            arr.push("使用editor.getContent()方法可以获得编辑器的内容");
            arr.push("内容为：");
            arr.push(UE.getEditor('editor').getContent());
            alert(arr.join("\n"));
        }
        function getPlainTxt() {
            var arr = [];
            arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
            arr.push("内容为：");
            arr.push(UE.getEditor('editor').getPlainTxt());
            alert(arr.join('\n'))
        }
        function setContent(isAppendTo) {
            var arr = [];
            arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
            UE.getEditor('editor').setContent('欢迎使用ueditor', isAppendTo);
            alert(arr.join("\n"));
        }
        function setDisabled() {
            UE.getEditor('editor').setDisabled('fullscreen');
            disableBtn("enable");
        }

        function setEnabled() {
            UE.getEditor('editor').setEnabled();
            enableBtn();
        }

        function getText() {
            //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
            var range = UE.getEditor('editor').selection.getRange();
            range.select();
            var txt = UE.getEditor('editor').selection.getText();
            alert(txt)
        }

        function getContentTxt() {
            var arr = [];
            arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
            arr.push("编辑器的纯文本内容为：");
            arr.push(UE.getEditor('editor').getContentTxt());
            alert(arr.join("\n"));
        }
        function hasContent() {
            var arr = [];
            arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
            arr.push("判断结果为：");
            arr.push(UE.getEditor('editor').hasContents());
            alert(arr.join("\n"));
        }
        function setFocus() {
            UE.getEditor('editor').focus();
        }
        function deleteEditor() {
            disableBtn();
            UE.getEditor('editor').destroy();
        }
        function disableBtn(str) {
            var div = document.getElementById('btns');
            var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
            for (var i = 0, btn; btn = btns[i++];) {
                if (btn.id == str) {
                    UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
                } else {
                    btn.setAttribute("disabled", "true");
                }
            }
        }
        function enableBtn() {
            var div = document.getElementById('btns');
            var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
            for (var i = 0, btn; btn = btns[i++];) {
                UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
            }
        }

        function getLocalData () {
            alert(UE.getEditor('editor').execCommand( "getlocaldata" ));
        }

        function clearLocalData () {
            UE.getEditor('editor').execCommand( "clearlocaldata" );
            alert("已清空草稿箱")
        }
    </script>
@endsection

