<?php

$_main = include_once( 'main.php' );
// see http://www.yiiframework.com/forum/index.php/topic/32414-trick-share-config-cross-web-console-app/

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My PhotoAlbum Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	// application components
	'components'=>array(
    /*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
    */
		// uncomment the following to use a MySQL database
		
		'db'=>$_main['components']['db'],
		
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'trace, info, error, warning',
				),
			),
		),
  ),
  'params'=>$_main['params'],
);
