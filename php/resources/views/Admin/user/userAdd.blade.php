@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
@endsection
@section('content')
    <div class="content"><div class="Invoice"><div class="INa1dd">
                <div class="main" style="margin-top:20px;">

                    <!--	添加新用户	-->
                    @if(!empty($user))
                    <div class="hdorder radius1" style="float: left; margin-bottom: 50px;">
                        <h3 class="title1"><strong><a href="#">系统资源管理</a></strong>
                        </h3>
                        <div class="dhorder_m">
                            <div class="IF1">
                                <div class="Urole_home">
                                    <div class="IF3"><p>用户名:</p>
                                        <input type="text"  name="textfield2" value="{{$user['username']}}" id="userName"  class="LGnt2"/>
                                        <input type="hidden" id="id" value="{{$user->id}}">
                                    </div>
                                    <div class="IF3"><p>登录密码:</p>
                                        <input type="text" name="textfield2" id="pass"  class="LGnt2"/>
                                    </div>
                                    <div class="IF3"><p>确认密码:</p>
                                        <input type="text" name="textfield2" id="pass1"  class="LGnt2"/>
                                    </div>
                                    <div class="XZFL" style="margin: 10px 0; width: 100%;float: left;"><p>用户角色:</p>
                                        <select name="select" id="acluser">
                                            @foreach($aclusers as $acluser)
                                                <option value="{{$acluser['id']}}">{{$acluser['acl_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="IF3"><p>会员头像:</p>
                                        <form id="form1" method="post">
                                        <div class="LGnt11">
                                            <input id="user_avatar" name="file" type="file" style="display: none">
                                            <img id="user_pic_img" src="{{$user->pic}}" />
                                            <input type="hidden" id="filename" name="user_image" value="{{$user->user_avatar}}">
                                            <p id="user_pic">上传头像</p>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="IF3"><p>企业名称:</p>
                                        <input type="text" name="textfield" id="company" value="{{$user->company_name}}" class="LGnt2"/>
                                    </div>
                                    <div class="IF3"><p>联系人:</p>
                                        <input type="text" name="textfield" id="person" value="{{$user->contact_person}}"  class="LGnt2"/>
                                    </div>
                                    <div class="IF3"><p>QQ:</p>
                                        <input type="text" name="textfield" id="qq" value="{{$user->user_QQ}}"  class="LGnt2"/>
                                    </div>

                                    <div class="IF3"><p>邮箱:</p>
                                        <input type="text" name="textfield" id="mail" value="{{$user->user_Eail}}"  class="LGnt2"/>
                                    </div>
                                    <div class="IF3"><p>联系地址:</p>
                                        <input type="text" name="textfield2" id="address" value="{{$user->address}}"  class="LGnt2"/>
                                    </div>

                                    <div class="IF3"><p>是否禁用:</p>
                                        <input type="radio" checked name="radio" id="radio1" value="0"/>
                                        &nbsp;开启&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="radio" id="radio2" value="1" />
                                        &nbsp;禁用
                                    </div>
                                    <div class="IF3"><input type="submit" onclick="$.ajaxdata('update')" name="button" id="button" value="提  交" class="LGButton3" style="margin-top:7%;" /></div>
                                    <p>&nbsp;</p>
                                </div>
                            </div>
                        </div>
                    </div>
                        @else
                        <div class="hdorder radius1" style="float: left; margin-bottom: 50px;">
                            <h3 class="title1"><strong><a href="#">系统资源管理</a></strong>
                            </h3>
                            <div class="dhorder_m">
                                <div class="IF1">
                                    <div class="Urole_home">
                                        <div class="IF3"><p>用户名:</p>
                                            <input type="text" name="textfield2" id="userName"  class="LGnt2"/>
                                        </div>
                                        <div class="IF3"><p>登录密码:</p>
                                            <input type="text" name="textfield2" id="pass"  class="LGnt2"/>
                                        </div>
                                        <div class="IF3"><p>确认密码:</p>
                                            <input type="text" name="textfield2" id="pass1"  class="LGnt2"/>
                                        </div>
                                        <div class="XZFL" style="margin: 10px 0; width: 100%;float: left;"><p>用户角色:</p>
                                            <select name="select" id="acluser">
                                                @foreach($aclusers as $acluser)
                                                    <option value="{{$acluser['id']}}">{{$acluser['acl_name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="IF3"><p>会员头像:</p>
                                            <form id="form1" method="post">
                                                <div class="LGnt11">
                                                    <input id="user_avatar" name="file" type="file" style="display: none">
                                                    <img id="user_pic_img" src="img/bn66.png" />
                                                    <input type="hidden" id="filename" name="user_image" >
                                                    <p id="user_pic">上传头像</p>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="IF3"><p>企业名称:</p>
                                            <input type="text" name="textfield" id="company"  class="LGnt2"/>
                                        </div>
                                        <div class="IF3"><p>联系人:</p>
                                            <input type="text" name="textfield" id="person"  class="LGnt2"/>
                                        </div>
                                        <div class="IF3"><p>QQ:</p>
                                            <input type="text" name="textfield" id="qq"  class="LGnt2"/>
                                        </div>

                                        <div class="IF3"><p>邮箱:</p>
                                            <input type="text" name="textfield" id="mail"  class="LGnt2"/>
                                        </div>
                                        <div class="IF3"><p>联系地址:</p>
                                            <input type="text" name="textfield2" id="address"  class="LGnt2"/>
                                        </div>

                                        <div class="IF3"><p>是否禁用:</p>
                                            <input type="radio" checked name="radio" id="radio1" value="0"/>
                                            &nbsp;开启&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="radio" id="radio2" value="1" />
                                            &nbsp;禁用
                                        </div>
                                        <div class="IF3"><input type="submit" onclick="$.ajaxdata('add')" name="button" id="button" value="提  交" class="LGButton3" style="margin-top:7%;" /></div>
                                        <p>&nbsp;</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div></div></div>
    <script type="text/javascript">

        $.ajaxdata = function (type) {
            var id = $("#id").val();
            if(typeof(id)=="undefined"){
                id = null;
            }
            var pic =$('input[name="user_image"]').val();
            if(typeof(pic)=="undefined"){
                pic = null;
            }
            var data = {
                "username": $("#userName").val(),
                "pass":$("#pass").val(),
                "pass1":$("#pass1").val(),
                "role":$("#acluser").val(),
                "company":$("#company").val(),
                "qq":$("#qq").val(),
                "person":$("#person").val(),
                "mail":$("#mail").val(),
                "address":$("#address").val(),
                "lock":$('input:radio:checked').val(),
                "pic":pic,
                "type":type,
                'id':id
            }
//            console.log(data);
            $.ajax({
                type: "POST",
                url: "{{url('Admin/modify_info')}}",
                data: data,
                dataType: "json",
                success: function (data) {
                    if (data.sta == 1) {
                        layer.msg(data.msg);
                    } else {
                        layer.msg(data.msg);
                        window.location.reload();
                    }
                }
            });

        }
        $(function () {
            $("#user_pic").click(function () {
                $("#user_avatar").click(); //隐藏了input:file样式后，点击头像就可以本地上传
                $("#user_avatar").change(function () {
                    //创建FormData对象
                    var data = new FormData($('#form1')[0]);
                    $.ajax({
                        url: '{{url('upload')}}',
                        type: 'POST',
                        data: data,
                        dataType: 'JSON',
                        cache: false,
                        processData: false,
                        contentType: false
                    }).done(function(ret){

                        if(ret.sta == 1){
                            $("#user_pic_img").attr("src", ret.url ) ;
                            $('input[name="user_image"]').val(ret.md5);
                        }else{
                            layer.msg('头像上传失败');
                        }
                    });

                });
            });
        });

    </script>
@endsection
