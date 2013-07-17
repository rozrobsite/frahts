<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	//Язык по умолчанию
	'language' => 'ru',
	//Имя приложения
	'name' => 'Мир грузоперевозок',
	// preloading 'log' component
	'preload' => array('log'),
	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
		'ext.mail.YiiMailMessage',
//		'ext.eajaxupload.EAjaxUpload',
	),
	'modules' => array(
		// uncomment the following to enable the Gii tool

		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => '123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array('127.0.0.1', '::1'),
			'generatorPaths' => array(
				'bootstrap.gii'
			),
		),
		'admin' => array(
			'layout' => 'application.modules.admin.views.layouts.main',
			'preload' => array('bootstrap'),
			'components' => array(
				'bootstrap' => array(
					'class' => 'ext.bootstrap.components.Bootstrap',
				),
			),
		),
	),
	// application components
	'components' => array(
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'loginUrl' => 'main/login',
		),
		// uncomment the following to enable URLs in path-format

		'urlManager' => array(
			'showScriptName' => false,
			'urlFormat' => 'path',
			'rules' => array(
				'' => 'main/index',
				'user/messages/*' => 'user/messages',
				'user/messages' => 'user/messages',
				'user/searchUsers/*' => 'user/searchUsers',
				'user/searchUsers' => 'user/searchUsers',
				'vehicle/update/<id:\d+>' => 'vehicle/update',
				'vehicle/update/<slug:[a-zA-Z0-9-]+>' => 'vehicle/update',
				'vehicle/search/location/*' => 'vehicleSearch/location',
				'vehicle/search/*' => 'vehicleSearch',
				'vehicle/search' => 'vehicleSearch',
				'vehicle/view/<slug:[a-zA-Z0-9-]+>' => 'vehicle/view',
				'goods/update/<id:\d+>' => 'goodsSearch/update',
				'goods/update/<slug:[a-zA-Z0-9-]+>' => 'goodsSearch/update',
				'goods/delete/<id:\d+>' => 'goodsSearch/delete',
				'goods/search/*' => 'goodsSearch',
				'goods/search' => 'goodsSearch',
				'goods/view/<slug:[a-zA-Z0-9-]+>' => 'goods/view',
				'goods/new' => 'goodsSearch/new',
				'goods' => 'goodsSearch/index',
				'user/view/<id:\d+>' => 'user/view',
				'docs/view/<slug:[a-zA-Z0-9-]+>' => 'docs/view',
				// Admin main page
				'<module:(admin)>' => '<module>/default/index',
				// Remove 'index' action from url
				// Default admin actions rules
				'<module:(admin)>/<controller:\w+>' => '<module>/<controller>/index',
				'<module:(admin)>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
//				'<module:\w+>/<controller:\w+>/<action:\w+>/<slug:[a-zA-Z0-9-]+>' => '<module>/<controller>/<action>',
				'<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/code/<code:\w+>' => '<controller>/code/',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
		/* 'db'=>array(
		  'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		  ), */
		// uncomment the following to use a MySQL database

		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=host5841_gruz',
			'emulatePrepare' => true,
			'username' => 'host5841_ckjy',
			'password' => 'JlytCkjytyznrj2012',
			'charset' => 'utf8',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			// uncomment the following to show log messages on web pages
			/*
			  array(
			  'class'=>'CWebLogRoute',
			  ),
			 */
			),
		),
		'mail' => array(
			'class' => 'ext.mail.YiiMail',
			'transportType' => 'php',
			'viewPath' => 'application.views.mail',
			'logging' => true,
			'dryRun' => false
		),
		'image' => array(
			'class' => 'application.extensions.image.CImageComponent',
			// GD or ImageMagick
			'driver' => 'GD',
			// ImageMagick setup path
			'params' => array('directory' => '/imagemagick'),
		),
		'curl' => array(
			'class' => 'application.extensions.curl.Curl',
			'options' => array(
				'timeout' => 0,
			),
		),
//		'clientScript' => array(
//			'scriptMap' => array(
//				'jquery.js' => '/js/'
//			),
//		),
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		// this is used in contact page
		'adminEmail' => 'support@frahts.com',
		'siteName' => 'frahts.com',
		'imagesPath' => '/images/',
		'files' => array(
			'files' => 'uploads/files/',
			'photos' => 'uploads/photos/',
			'images' => 'uploads/images/',
			'avatars' => 'uploads/images/avatars/',
			'tmp' => 'uploads/tmp/'
		),
		// Params for image file processing
		'images' => array(
			'small' => array(
				'height' => 36,
				'width' => 37,
			),
			'middle' => array(
				'height' => 80,
				'width' => 80,
			),
			'big' => array(
				'height' => 250,
				'width' => 500,
			),
			'superbig' => array(
				'height' => 800,
				'width' => 600,
			),
			'avatar' => array(
				'height' => 110,
				'width' => 108,
				'small_height' => 37,
				'small_width' => 36,
			),
			'allowedExtensions' => array('jpg', 'jpeg', 'png'), // allowed file extensions

			'sizeLimit' => 1 * 1024 * 1024,
			'sizeAvatarLimit' => 500 * 1024,
			'defaultAvatar' => 'userLogin2.png',
		),
		'pages' => array(
			'goodsCount' => 30,
			'searchCount' => 10,
			'pageNumbers' => 5,
		),
		'radius' => array(
			'10' => 10,
			'20' => 20,
			'30' => 30,
			'40' => 40,
			'50' => 50,
			'60' => 60,
			'70' => 70,
			'80' => 80,
			'90' => 90,
			'100' => 100,
			'120' => 120,
			'150' => 150,
			'180' => 180,
			'200' => 200
		),
		'defaultRadius' => 15,
		'timer' => array(
			'5' => '5 секунд',
			'30' => '30 секунд',
			'60' => '1 минуту',
			'90' => '1 минуту 30 секунд',
			'120' => '2 минуты',
			'180' => '3 минуты',
			'240' => '4 минуты',
			'300' => '5 минут',
		),
		'incidients_goods' => 30,
		'messages_by_page' => 10,
	),
);