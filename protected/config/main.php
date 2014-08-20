<?php
 
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');


return array(
    'sourceLanguage' => 'ru',
    'language' => 'ru',
	'charset' => 'utf-8',
	
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'homeUrl' => 'http://' . $_SERVER['HTTP_HOST'] . '/',
	
    'name' => 'NordSite',
	
	'preload' => array('log', 'bootstrap'),

    'import' => array(
		'application.models.*',
		'application.models.forms.*',
		'application.components.*',
    ),
	
	'modules' => array(
        'gii' => array(
            'generatorPaths' => array(
                //'bootstrap.gii', 
				'bootstrap.gii2',
            ),
			'class'=>'system.gii.GiiModule',
            'password'=>'meteorit',
            'ipFilters'=>array('*'), //192.168.7.14
        ),
	'admin'=>array(   ),
        'rights'=>array(
            'userNameColumn'=>'login',
            'flashSuccessKey'=>'success',
            'flashErrorKey'=>'error',
            //'superuserName'=>'Админ',
          
             
        ),
            'VsChat'=>array(),
    ),
    
    'components' => array(
		'errorHandler' => array(
			'errorAction' => '/site/error',
		),
		
		'session' => array (
			'sessionName' => 'corp-crm',
            'autoStart' => true
		),
	
		'user' => array(
			'class' => 'WebUser',
			'allowAutoLogin' => true,
		),
		
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
				array(
					'class' => 'CWebLogRoute',
					'levels' => 'warning, error',
					//'levels' => 'warning, trace, info, profile, warning, error',
				),
				
			),
		),
		
		'authManager' => array(
			'class' => 'RDbAuthManager',
			'defaultRoles' => array('guest'), // по-умолчанию все с ролью гость
		),
				
		'bootstrap' => array(
			'class' => 'bootstrap.components.Bootstrap',
		),
		
		 
		'db' => array(
			'connectionString' => 'mysql:host=localhost;port=3306;dbname=corp',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => '',
			'enableParamLogging' => true,
            'enableProfiling' => true, 
		),
    ),
	
	'params' => array(
		'postsPerPage' => 10,
		'phpDateFormat' => 'd.m.Y',
		'jsDateFormat' =>' dd.mm.yyyy',
		'dirUploads' => 'uploads',
		'priceFormat'=>'#,##0.00',
		'extensions' => array(
			'images' => 'jpg, jpeg, gif, bmp, png, tiff',
			'documents' => 'pdf, xls, xlsx, doc, docx, txt, rtf, html, htm, ppt, pptx, jpg, jpeg, gif, bmp, png, tiff',
		),
    ),
); 

?>
