<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Tanks',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.actions.*',
		'application.models.*',
		'application.models.validators.*',
		'application.components.*',
		'application.filters.*',
		'application.validators.*',
	),

	'defaultController'=>'site/login',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'cache'=>array(
			'class'=>'system.caching.CDummyCache',
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:protected/data/blog.db',
			'tablePrefix' => 'tbl_',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'class'=>'system.db.CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=tanks',
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'ourwot_',
			'emulatePrepare' => true,
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
				),
				
			),
		),
	),
	
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
	/*
	'clientScript'=>array(
		'packages' => array(
		   // Уникальное имя пакета
		   'highcharts' => array(
				// Где искать подключаемые файлы JS и CSS
				'baseUrl' => '/js/highcharts/',
				// Если включен дебаг-режим, то подключает /js/highcharts/highcharts.src.js
				// Иначе /js/highcharts/highcharts.js
				'js'=>array(YII_DEBUG ? 'highcharts.src.js' : 'highcharts.js'),
				// Подключает файл /js/highcharts/highcharts.css
				'css' => array('highcharts.css'),
				// Зависимость от другого пакета
				'depends'=>array('jquery'),
			),
		)
	),
	*/
    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'1234567',
        ),
    ),
	
);