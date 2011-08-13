<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Super Like',
	'defaultController'=>'post',
	'sourceLanguage'=>'en_us',
	'language'=>'zh_cn',

	//'bymem'=>true, //for sae


	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'hl',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	// application components
	'components'=>array(
		//'myassetManager'=>array(  //for sae
			//'class'=>'MyAssetManager',
		//),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tags:.*?>'=>'post/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		//'db'=>array(
			//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/blog.db',
		//),
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=myblog',
			'emulatePrepare' => true,
			'username' => 'li',
			'password' => 'hl',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				//array(
					//'class'=>'CFileLogRoute',
					//'levels'=>'error, warning',
				//),
				// uncomment the following to show log messages on web pages
				//array(
					//'class'=>'CWebLogRoute',
				//),
				array(
					'class'=>'CDbLogRoute',
					'levels'=>'error, warning',
					'connectionID'=>'db',
				),
			),
		),
		'request'=>array(
            'enableCsrfValidation'=>true,
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);
