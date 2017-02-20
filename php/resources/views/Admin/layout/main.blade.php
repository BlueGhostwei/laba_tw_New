<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title')- 亚媒社</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="{{url('Admin/css/reset.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('Admin/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('Admin/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('Admin/css/style2.css')}}" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="{{url('Admin/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('Admin/js/plugins.js')}}"></script>
    <script src="{{url('Admin/js/jquery.touchslider.min.js')}}"  type="text/javascript"></script>
    <script type="text/javascript" src="{{url('Admin/js/jquery.SuperSlide.2.1.1.js')}}"></script>
    <script type="text/javascript" src="{{url('Admin/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('Admin/js/echarts.min.js')}}"></script>
    <script type="text/javascript" src="{{url('Admin/js/date.js')}}"></script>
    <script type="text/javascript" src="{{url('Admin/js/main2.js')}}"></script>
    <script type="text/javascript" src="{{url('Admin/js/jquery.tools.min.js')}}"></script>

    @yield('header_related')
</head>
<body>
@include('Admin.layout.leftbar')
@yield('content')
@include('Admin.layout.bottom')
</body>
</html>