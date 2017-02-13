<?php
header("Content-type: text/html; charset=utf8");
/*
　//初始化
　　$ch = curl_init();
　　//设置选项，包括URL
　　curl_setopt($ch, CURLOPT_URL, "http://www.jb51.net");
　　curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
　　curl_setopt($ch, CURLOPT_HEADER, 0);
　　//执行并获取HTML文档内容
　　$output = curl_exec($ch);
　　//释放curl句柄
　　curl_close($ch);
　　//打印获得的数据
　　print_r($output);
*/


$ch = curl_init();

/*
curl_setopt($ch, CURLOPT_URL, "http://43.227.99.117/phpMyAdmin_lzc/link_l.php");
$output =curl_exec($ch);
*/

$url = "http://www.bjxinwen.pw/Plugins/apps/CaiJiXia/cjx.js";
$refer = 'http://demo.zjmainstay.cn/';  //来路地址

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_REFERER, $refer);
$output =curl_exec($ch);

/*
curl_setopt($ch, CURLOPT_URL, "http://www.tjxinwen.pw");
$output =curl_exec($ch);

curl_setopt($ch, CURLOPT_URL, "http://www.zqxinwen.pw");
$output =curl_exec($ch);
/*
*/






curl_close($ch);
echo "ok?";
print_r($output);


















?>