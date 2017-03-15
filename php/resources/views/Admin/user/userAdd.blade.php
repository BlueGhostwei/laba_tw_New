@extends('Admin.layout.main')
@section('title', '首页')
@section('header_related')
@endsection
@section('content')
    <div class="content"><div class="Invoice"><div class="INa1dd">
                <div class="main" style="margin-top:20px;">

                    <!--	添加新用户	-->
                    @if (empty($user))
                        <div class="hdorder radius1">
                            <h3 class="title1"><strong><a href="#">添加新用户</a></strong>
                            </h3>
                            <div class="dhorder_m">
                                <div class="IF1">
                                    <div class="Urole_home">
                                        <div class="IF3"><p>用户名:</p>
                                            <input type="text" name="textfield2"  id="userName"  class="LGnt2"/>

                                        </div>
                                        <div class="IF3"><p>登录密码:</p>
                                            <input type="text" name="textfield2" id="pass"  class="LGnt2"/>
                                        </div>
                                        <div class="IF3"><p>确认密码:</p>
                                            <input type="text" name="textfield2" id="pass1"  class="LGnt2"/>
                                        </div>
                                        <div class="XZFL"><p>用户角色:</p>
                                            <select name="acluser" id="acluser">
                                                @foreach($aclusers as $acluser)
                                                <option value="{{$acluser['id']}}">{{$acluser['acl_name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="IF3" style="padding-top: 1.5%"><p>联系人:</p>
                                            <input type="text" name="textfield2" id="person"  class="LGnt2"/>
                                        </div>
                                        <div class="IF3"><p>电子邮箱:</p>
                                            <input type="text" name="textfield2" id="mail"  class="LGnt2"/>
                                        </div>
                                        <div class="IF3"><p>联系电话:</p>
                                            <input type="text" name="textfield2" id="phone"  class="LGnt2"/>
                                        </div>
                                        <div class="IF3"><p>是否禁用:</p>
                                            <input type="radio" class="lock" name="lock" id="radio1" value="0"/>
                                            &nbsp;开启&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" class="lock" name="lock" id="radio2" value="1" />
                                            &nbsp;禁用
                                        </div>
                                        <div class="IF3"><input type="button" name="button" onclick="$.ajaxdata('add')"  id="button" value="提  交" class="LGButton3" style="margin-top:7%;" /></div>
                                        <p>&nbsp;</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="hdorder radius1">
                            <h3 class="title1"><strong><a href="#">添加新用户</a></strong>
                            </h3>
                            <div class="dhorder_m">
                                <div class="IF1">
                                    <div class="Urole_home">
                                        <div class="IF3"><p>用户名:</p>
                                            <input type="text" name="textfield2" value="{{$user->username}}" id="userName"  class="LGnt2"/>  <input type="hidden" value="{{$user->id}}" id="id">
                                        </div>
                                        <div class="IF3"><p>登录密码:</p>
                                            <input type="text" name="textfield2" id="pass"  class="LGnt2"/>
                                        </div>
                                        <div class="IF3"><p>确认密码:</p>
                                            <input type="text" name="textfield2" id="pass1"  class="LGnt2"/>
                                        </div>
                                        <div class="XZFL"><p>用户角色:</p>
                                            <select name="acluser" id="acluser">
                                                @foreach($aclusers as $acluser)
                                                    <option value="{{$acluser['id']}}">{{$acluser['acl_name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="IF3" style="padding-top: 1.5%"><p>联系人:</p>
                                            <input type="text" name="textfield2" id="person" value="{{$user->contact_person}}"  class="LGnt2"/>
                                        </div>
                                        <div class="IF3"><p>电子邮箱:</p>
                                            <input type="text" name="textfield2" value="{{$user->user_Eail}}" id="mail"  class="LGnt2"/>
                                        </div>
                                        <div class="IF3"><p>联系电话:</p>
                                            <input type="text" name="textfield2" id="phone" value="{{$user->user_phone}}"  class="LGnt2"/>
                                        </div>
                                        <div class="IF3"><p>是否禁用:</p>
                                            <input type="radio" class="lock" name="lock" id="radio1" value="0"/>
                                            &nbsp;开启&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" class="lock" name="lock" id="radio2" value="1" />
                                            &nbsp;禁用
                                        </div>
                                        <div class="IF3"><input type="button" name="button" id="button" onclick="$.ajaxdata('update')" value="提  交" class="LGButton3" style="margin-top:7%;" /></div>
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
            var data = {
                "username": $("#userName").val(),
                "pass":$("#pass").val(),
                "pass1":$("#pass1").val(),
                "role":$("#acluser").val(),
                "person":$("#person").val(),
                "mail":$("#mail").val(),
                "phone":$("#phone").val(),
                "lock":$('input:radio:checked').val(),
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


    </script>
@endsection
