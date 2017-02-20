<?php
return [

	// 安全检验码，以数字和字母组成的32位字符。
	'key' => 'rp3p5ld3w6jx5qnnbycvnfwb2q2fhsfm',

	// 签名方式
	'sign_type' => 'RSA',

	// 商户私钥。
	'private_key_path' => __DIR__ . '/key/private_key.pem',

	// 阿里公钥。
	'public_key_path' => __DIR__ . '/key/public_key.pem',

	// 异步通知连接。
	'notify_url' => url('/alipay/alipayNotify')
];
