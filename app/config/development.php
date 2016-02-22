<?php

return [
	'app' => [
		'name' => '#appname',
		'url' => 'http://localhost/slimTemplate',
		'hash' => [
			'algo' => PASSWORD_BCRYPT,
			'cost' => 10
		],
	],
	'maintenance' => [
		'enabled' => false,
		'allowed_ips' => ['192.168.0.1','192.168.0.5','::1'],
	],
	'db' => [
		'driver' => 'mysql',
		'host' => '',
		'name' => '',
		'username' => '',
		'password' => '',
		'charset' => 'utf8',
		'collation' => 'utf8_unicode_ci',
		'prefix' => ''
	],
	'auth' => [
		'enabled' => true,
		'session' => 'user_id',
		'remember' => 'user_rmb'
	],
	'mail' => [
		'smtp_auth' => true,
		'smtp_secure' => '',
		'host' => '',
		'username' => '',
		'password' => '',
		'port' => '',
		'html' => true
	],
	'twig' => [
		'debug' => false
	],
	'csrf' => [
		'key' => 'csrf_token'
	]
];
