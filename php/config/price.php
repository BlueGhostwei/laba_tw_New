<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/21
 * Time: 17:28
 * 价格配置
 */
/*
return [
    array('id'=>'0','name'=>'50'),
    array('id'=>'1','name'=>'50-100'),
    array('id'=>'2','name'=>'100-200'),
    array('id'=>'3','name'=>'200-500'),
    array('id'=>'4','name'=>'500-1000'),
    array('id'=>'5','name'=>'1000'),
];
*/

return [
    array('id'=>'0','name'=>'50以下','sql'=>'pf_price <= 50'),
    array('id'=>'1','name'=>'50-100','sql'=>'pf_price between 50 and 100'),
    array('id'=>'2','name'=>'100-200','sql'=>'pf_price between 100 and 200'),
    array('id'=>'3','name'=>'200-500','sql'=>'pf_price between 200 and 500'),
    array('id'=>'4','name'=>'500-1000','sql'=>'pf_price between 500 and 1000'),
    array('id'=>'5','name'=>'1000以上','sql'=>'pf_price >= 1000'),
];