@extends('Admin.layout.main')
@section('title', '文案策划')
@section('header_related')
	<link rel="stylesheet" href="{{url('Admin/js/layui/css/layui.css')}}"  media="all">
	<script src="{{url('Admin/js/layui/layui.js')}}" charset="utf-8"></script>
	<script src="{{url('Admin/js/jquery.validate.min.js')}}" charset="utf-8"></script>
	<script src="{{url('Admin/js/messages_zh.min.js')}}" charset="utf-8"></script>
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
<form id="form1" method="post" action="/index.php">
	{{ csrf_field() }}
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
                                                            >{{$vl->name}}</label>
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
                                                <input type="text" name="title" id="title"
                                                       placeholder="请输入标题" class="WIFN1"/>
                                            </div>
                                            <div class="WMain3 WMain3_2"><p><i class="LGntas"></i>需求:</p>
                                                <div class="editor_w">
                                                    <script id="editor" name="zw" type="text/plain"></script>
                                                </div>
                                            </div>
                                            <div class="WMain3"><p><i class="LGntas"></i>字数:</p>
                                                <label><input type="radio" name="number" value="1" checked />1000字</label>
                                                <label><input type="radio" name="number" value="2" />2000字</label>
                                                <label><input type="radio" name="number" value="3" />3000字</label>
                                            </div>
                                            <div class="WMain3 WMain3_2"><p><i class="LGntas"></i>编辑:</p>
                                                <div>
                                                    <label><input type="radio" name="cycle" value="100" checked />专业手写
                                                        ￥100/千字1个工作日</label>
                                                    <label><input type="radio" name="cycle" value="200" />专业编辑
                                                        ￥200/千字1个工作日</label>
                                                    <label><input type="radio" name="cycle" value="300" />专业作者
                                                        ￥300/千字1个工作日</label>
                                                </div>
                                            </div>
                                            <div class="WMain3"><p><i class="LGntas"></i>篇数:</p>
                                                <select id="articles_num1" name="articles_num1" class="sel2">
                                                    <option value="1">代写一篇</option>
                                                    <option value="2">代写二篇</option>
                                                    <option value="3">代写三篇</option>
                                                    <option value="else">更多</option>
                                                </select>
                                                <span id="articles_num2_w" style="display:none;">
													<input type="text" name="articles_num2" id="articles_num2" class="txt6"  style="width:130px;margin:0 0 0 10px;" />&nbsp;篇
												</span>
                                            </div>
                                            <div class="WMain3"><p><i class="LGntas"></i>总额:</p>
                                                <input type="text" name="article_price" id="article_price" class="txt6" readonly="readonly" 
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
                                                <input type="submit" value="提交" class="sub5" id="submit" />
                                                <span style="margin-left:30px;">账户余额不足，<a href="">点此充值</a></span>
                                            </div>

                                        </li>
                                    </ul>
                                </div>
                            </div>
</form>
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
	/*	百度编辑器	*/
	var ue = UE.getEditor('editor');
	var formdata = [];
	var _token = $('input[name="_token"]').val();
	
	function countPrice(){
		var number = $("[name=number]:checked").val();					//字数
		var cycle = $("[name=cycle]:checked").val();					//编辑
		var articles_num = $("#articles_num1").val() == 'else' ? $("#articles_num2").val() : $("#articles_num1").val();			//篇数
		var article_price = number * cycle * articles_num;
		$("#article_price").val(article_price);
		return article_price;
	}
	$("[name=number],[name=cycle],[name=articles_num2]").change(function(){
		countPrice();
	});
	$("[name=articles_num1]").change(function(){
		if( $("#articles_num1").val() == 'else' ){
			$("#articles_num2_w").show();
		}else{
			$("#articles_num2_w").hide();			
		}
		countPrice();
	});	
	$("[name=articles_num2]").keyup(function(){
		countPrice();
	});
	countPrice();
	
	$("#submit").click(function(){
		formdata['type'] = $("#radio_a1 label.cur").attr("write_id");			//类型
		formdata['title'] = $("#title").val();									//标题
		formdata['zw'] = ue.getContent();										//需求
		formdata['number'] = $("[name=number]:checked").val();						//字数
		formdata['cycle'] = $("[name=cycle]:checked").val();						//编辑
		formdata['articles_num'] = $("#articles_num1").val() == 'else' ? $("#articles_num2").val() : $("#articles_num1").val();			//篇数
		formdata['article_price'] = $("#article_price").val();						//总金额
		
		console.log("click:");
		console.log(formdata);
	});
		
	$.validator.setDefaults({
		submitHandler: function() {
			
			console.log("表单提交");
			var flag = 0;
			if( formdata['zw'] == "" ){
				flag = 1;
				layer.msg("需求不能为空");
				ue.focus();
				return false;
			}
			
			console.log("继续提交");
			var key = "test1";
			$.ajax({
				url: "{{route('media.Copy_plan')}}",
				data: {
					'keyword' : key
					,'formdata' : {
						"type": formdata["type"],
						"title": formdata["title"],
						"zw": formdata["zw"],
						"number": formdata["number"],
						"cycle": formdata["cycle"],
						"articles_num": formdata["articles_num"],
						"article_price": formdata["article_price"]
					}
					,'_token' : _token
				},
				type: 'post',
				dataType: "json",
				stopAllStart: true,
				success: function (data) {
					console.log(data);
					if (data.sta == '0') {
						layer.msg(data.msg || '提交成功');
					} else {
						layer.msg(data.msg || '提交失败');
					}
				},
				error: function (data) {
					console.log(data);
					layer.msg(data.msg || '网络发生错误');
					return false;
				}
			});
		}
	});
	
	$("#form1").validate({
		ignore: "",
		rules: {
			title: { required: true, minlength: 2, maxlength: 25 }
			,number: "required"
			,cycle: "required"
			,articles_num1: "required"
			,articles_num2: { required: function(){ return $("#articles_num1").val() == 'else' }, digits: true, min: 1, max: 1000000 }
			,article_price: { required: true, number: true, min: 0 }
		},
		errorElement: "em",
		messages: {
			articles_num2: { digits: "只能输入整数" },
			article_price: { number: "金额错误" }
		}
	});
		
</script>
@endsection

