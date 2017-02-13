<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="美邻美家管理登陆">
    <meta name="author" content="udpower">
    <title>注册 - 美邻美家注册</title>
    <link rel="stylesheet" href="{{ url('/css/main.css') }}" type="text/css">
    <style>
       .main-container{
           padding: 0px 10% ;
       }
       .ImgPreView-item img,.imgPreView-item img {
           width: 100px;
           height: 100px;

       }
       .ImgPreViewImgs img:last-child{
           margin-right: 0;
       }
       .ImgPreView-item,.imgPreView-item{
           position: relative;
           float: left;
           margin-bottom: 10px;
           margin-right: 10px;
           width: 100px;
           height: 100px;
       }
       .ImgPreViewi-close,.imgPreViewi-close{
           position: absolute;
           top: 5px;
           right: 5px;
           -webkit-text-stroke: .2px #fff;
           color: #a94442;
           cursor: pointer;
       }
    </style>
</head>
<body class="login-page reg-page">
<div class="main-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-container">
                    <div class="login-branding">
                        <a href="{{ url('/') }}"><img src="/images/logo-large.png" alt="logo"></a>
                    </div>
                    <div class="box-widget widget-module">
                        <div class="widget-container " >
                            <div class="widget-block">

                                <form id="reg_form" method="POST" class="form-horizontal bv-form" action="{{ url('/user/register') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">用户名</label>
                                        <div class="col-md-8">
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="请输入用户名" required minlength="3">
                                            @if ($errors->has('name'))
                                            <label class="error">
                                                <span class="error">{{ $errors->first('name') }}</span>
                                            </label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">密码</label>
                                        <div class="col-md-8">
                                            <input type="password" name="password" value="" class="form-control" placeholder="请输入密码" required minlength="6">
                                            @if ($errors->has('password'))
                                                <label class="error">
                                                    <span class="error">{{ $errors->first('password') }}</span>
                                                </label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">确认密码</label>
                                        <div class="col-md-8">
                                            <input type="password" name="password_confirmation" value="" class="form-control" placeholder="请再次输入密码" required minlength="6">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">邮箱</label>
                                        <div class="col-md-8">
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="请输入邮箱" required>
                                            @if ($errors->has('email'))
                                                <label class="error">
                                                    <span class="error">{{ $errors->first('email') }}</span>
                                                </label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">头像</label>
                                        <div class="col-md-8 ImgPreViewBox">
                                            <div class="ImgPreViewVals"></div>
                                            <div class="ImgPreViewImgs"></div>
                                            <input type="file" name="avatar" value="{{ old('avatar') }}" class="form-control ImgPrevViewInp" placeholder="请输入邮箱" id="avatar_file" required>
                                            @if ($errors->has('avatar'))
                                                <label class="error">
                                                    <span class="error">{{ $errors->first('avatar') }}</span>
                                                </label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">真实姓名</label>
                                        <div class="col-md-8">
                                            <input type="text" name="real_name" value="{{ old('real_name') }}" class="form-control" placeholder="请输入姓名" required minlength="2">
                                            @if ($errors->has('real_name'))
                                                <label class="error">
                                                    <span class="error">{{ $errors->first('real_name') }}</span>
                                                </label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">性别</label>
                                        <div class="col-md-8" style="display: -webkit-box">
                                            <div class="radio" style="margin-right: 10px;">
                                                <label><input type="radio" value="男" name="gender" checked> 男</label>
                                            </div>

                                            <div class="radio">
                                                <label><input type="radio" value="女" name="gender"> 女</label>
                                            </div>
                                            @if ($errors->has('gender'))
                                                <label class="error">
                                                    <span class="error">{{ $errors->first('gender') }}</span>
                                                </label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">身份证号</label>
                                        <div class="col-md-8">
                                            <input type="text" name="identity_card" value="{{ old('identity_card') }}" class="form-control " placeholder="请输入身份证号" required minlength="18">
                                            @if ($errors->has('identity_card'))
                                                <label class="error">
                                                    <span class="error">{{ $errors->first('identity_card') }}</span>
                                                </label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">身份证扫照片</label>
                                        <div class="col-lg-8">
                                            <div class="imgPreViewBox col-lg-cover">
                                                @if (isset($user))
                                                    @foreach($user->identity_card_file as $k=> $v)
                                                        <div class="imgPreView-item">
                                                            <div class="glyphicon glyphicon-remove imgPreViewi-close"></div>
                                                            <img src="{{ md52url($v, false, '') }}" class="imgPreViewi-img">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="imgPreViewVal">
                                                @if (isset($user))
                                                    @foreach($user->identity_card_file as $k=> $v)
                                                        <input type="hidden" name="identity_card_file[]" value="{{$v}}" >
                                                    @endforeach

                                                @endif
                                            </div>
                                            <input required type="file" multiple="" class="form-control ImgsPrevViewInp" name="card_pic" data-bv-field="card_pic" id="card_id">
                                            <p class="input-instruction">
                                                身份证扫扫照片，正反面2张，照片不能大于5M
                                            </p>

                                            @if(isset($user))
                                            @else
                                                @if ($errors->has('identity_card_file'))
                                                    <label class="error">
                                                        <span class="error">{{ $errors->first('identity_card_file') }}</span>
                                                    </label>
                                                @endif
                                            @endif

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">电话</label>
                                        <div class="col-md-8">
                                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="请输入电话" required>
                                            @if ($errors->has('phone'))
                                                <label class="error">
                                                    <span class="error">{{ $errors->first('phone') }}</span>
                                                </label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">微信号</label>
                                        <div class="col-md-8">
                                            <input type="text" name="wechat" value="{{ old('wechat') }}" class="form-control" placeholder="请输入微信号">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">QQ</label>
                                        <div class="col-md-8">
                                            <input type="text" name="qq" value="{{ old('qq') }}" class="form-control" placeholder="请输入QQ号">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">住址</label>
                                        <div class="col-md-8">
                                            <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="请输入住址" required>
                                            @if ($errors->has('address'))
                                                <label class="error">
                                                    <span class="error">{{ $errors->first('address') }}</span>
                                                </label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">
                                            &nbsp;
                                        </label>
                                        <div class="col-lg-8">
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">提交</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>



                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<script src="/js/jquery-1.11.2.min.js"></script>
<script src="/js/jquery.validate.js"></script>
<script src="/js/sea.js"></script>
<script src="/js/common.js"></script>
<script>
    define('app',function(require, exports, module){
        'use strict';
        var $ = jQuery;
        var common = require('common');
        window._token = "{{csrf_token()}}";

        $('#reg_form').validate();
        new common.ImgPrevView('#reg_form');

        var $proImgs = $('#product-inp');
        $proImgs.change(function (){
            common.uploadImg(this,{inp_name:'avatar_file',max:1});
        })

        var $cardImgs = $('#card_id');
        $cardImgs.change(function (){
            common.uploadImg(this,{inp_name:'identity_card_file[]',max:2});
        })
    })

    seajs.use('app');

</script>

</body>
</html>

