<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
// Seteo el alias de la ruta de yiibooster

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Tickets Los Cortijos',
	'theme' => 'hebo',
	'defaultController' => 'tickets/admin',
	'language' => 'es',
	'sourceLanguage'=>'es',
	// preloading 'log' component
	'preload'=>array('log'),
	'catchAllRequest'=>file_exists(dirname(__FILE__).'/.maintenance') ? array('tickets/maintenance') : null,
	
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.giix-components.*',

	),

	'modules'=>array(
		//import csv
		'importcsv'=>array(
            'path'=>dirname(__FILE__).'/.upload/importCsv', // path to folder for saving csv file and file with import params
        ),

		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'generatorPaths' => array(
			'ext.giix-core',	
		),
			'password'=>'',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
//		'messages' => array (
		// Pending on core: http://code.google.com/p/yii/issues/detail?id=2624
		/*'extensionBasePaths' => array(
			'giix' => 'ext.giix.messages', // giix messages directory.
		),*/
		// uncomment the following to enable URLs in path-format
		
		/* 
		 'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		
	/*	'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'pgsql:host=172.18.0.2;port=5432;dbname=tuticket2',
			//'emulatePrepare' => true,
			'username' => 'postgres',
			'password' => 'postgres',
			'enableProfiling' =>YII_DEBUG_PROFILING,
			'enableParamLogging' => true,

			
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, info, trace',
					'filter'=>'CLogFilter',
				),
				// uncomment the following to show log messages on web pages
				
			/*	array(
					'class'=>'CWebLogRoute',
					'categories'=>'system.*',
 'enabled' =>YII_DEBUG_SHOW_PROFILER,
				),*/
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'maintenance' => false,

	),
);
