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
				'vehicle/search' => 'vehicleSearch',
				'goods/search' => 'goodsSearch',
				'goods/new' => 'goodsSearch/new',
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
		'files' => array(
			'files' => '/uploads/files/',
			'photos' => 'uploads/photos/',
			'images' => '/uploads/images/',
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
			'allowedExtensions' => array('jpg', 'jpeg', 'png'), // allowed file extensions

			'sizeLimit' => 1 * 1024 * 1024,
		),
		'pages' => array(
			'goodsCount' => 30
		),
	),
);