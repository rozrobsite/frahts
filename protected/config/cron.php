<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'frahts.com Cron',

	// preloading 'log' component
	'preload'=>array('log'),

	'import'=>array(
        'application.components.*',
        'application.models.*',
		'ext.mail.YiiMailMessage',
    ),

	// application components
	'components'=>array(
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=host5841_gruz',
			'emulatePrepare' => true,
			'username' => 'host5841_ckjy',
			'password' => 'JlytCkjytyznrj2012',
			'charset' => 'utf8',
		),

		'mail' => array(
			'class' => 'ext.mail.YiiMail',
			'transportType' => 'smtp',
			'transportOptions'=>array(
					'host'=>'de1.imhoster.net',
					'encryption'=>'tls',
					'username'=>'support@frahts.com',
					'password'=>'teacher1991',
					'port'=>465,
			  ),
			'viewPath' => 'application.views.mail',
			'logging' => false,
			'dryRun' => false
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'logFile'=>'cron.log',
					'levels'=>'error, warning',
				),
				array(
					'class'=>'CFileLogRoute',
					'logFile'=>'cron_trace.log',
					'levels'=>'trace',
				),
				array(
					'class'=>'CFileLogRoute',
					'logFile'=>'cron_info.log',
					'levels'=>'info',
				),
			),
		),
	),
	'params' => array(
		'adminEmail' => array('support@frahts.com' => 'Фрахты.com - Мир грузоперевозок'),
//		'host' => 'http://www.frahts.com',
//		'host' => 'http://frahts.local',
		'host' => 'http://gruz2.host5841.de1.dp10.ru',
	),
);
