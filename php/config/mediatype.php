<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/20
 * Time: 9:21
 */
/**
 * 配置网络媒体分类id，名称，对应数据库字段名称
 */
return [
    array(
        'media_id' => '0',
        'media_name' => '网络媒体',
        'classification' => array(
            array('category_id'=>'0',"name"=>'网络类型','set_name'=>"network"),
            array('category_id'=>'1',"name"=>'入口级别','set_name'=>"Entrance_level"),
            array('category_id'=>'2',"name"=>'入口形式' ,'set_name'=>"Entrance_form"),
            array('category_id'=>'3',"name"=>'覆盖区域','set_name'=>"coverage"),
            array('category_id'=>'4',"name"=>'频道类型','set_name'=>"channel"),
            array('category_id'=>'5',"name"=>'会员价','set_name'=>"member"),
            array('category_id'=>'6',"name"=>'正文带链接','set_name'=>"standard"),
        )
    ),
    array('media_id' => '1', 'media_name' => '户外媒体'),
    array('media_id' => '2', 'media_name' => '平面媒体'),
    array('media_id' => '3', 'media_name' => '电视媒体'),
    array('media_id' => '4', 'media_name' => '广播媒体'),
    array('media_id' => '5', 'media_name' => '记者媒体'),
];