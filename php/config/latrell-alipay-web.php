<?php
return [

	// 安全检验码，以数字和字母组成的32位字符。
	'key' => 'rp3p5ld3w6jx5qnnbycvnfwb2q2fhsfm',

	//签名方式
	'sign_type' => 'MD5',

	// 服务器异步通知页面路径。
	'notify_url' =>__DIR__.'/alipay/webnotify',

	// 页面跳转同步通知页面路径。
	'return_url' =>__DIR__.'/alipay/webreturn'
];
