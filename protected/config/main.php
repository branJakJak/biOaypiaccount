<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'VOIP Account Creator',
    'theme' => 'abound',
    // preloading 'log' component
    'preload' => array('log'),
    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'), // change this if necessary
        'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels'),
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'bootstrap.helpers.TbHtml',
        'bootstrap.helpers.TbArray',
        'bootstrap.behaviors.TbWidget',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
    ),
    'modules' => array(
        'rest',
        'user'=>array(
            'tableUsers' => 'users',
            'tableProfiles' => 'profiles',
            'tableProfileFields' => 'profiles_fields',
            'hash' => 'md5',
            'sendActivationMail' => true,
            'loginNotActiv' => false,
            'activeAfterRegister' => false,
            'autoLogin' => true,
            'registrationUrl' => array('/user/registration'),
            'recoveryUrl' => array('/user/recovery'),
            'loginUrl' => array('/user/login'),
            'returnUrl' => array('/home'),
            'returnLogoutUrl' => array('/user/login'),
        ),
        'rights'=>array(
           'superuserName'=>'admin',
           'authenticatedName'=>'Authenticated',
           'userIdColumn'=>'id',
           'userNameColumn'=>'username',
           'enableBizRule'=>true, 
           'enableBizRuleData'=>true, 
           'displayDescription'=>true, 
           'flashSuccessKey'=>'RightsSuccess',
           'flashErrorKey'=>'RightsError',
           'baseUrl'=>'/rights',
           'layout'=>'rights.views.layouts.main',
           'appLayout'=>'application.views.layouts.main',
           'cssFile'=>'rights.css',
           'install'=>false,
           'debug'=>false, 
        ),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'password',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'user'=>array(
                'class'=>'RWebUser',
                'rightsReturnUrl'=>array('authItem/roles'),
                // enable cookie-based authentication
                'allowAutoLogin'=>true,
                'loginUrl'=>array('/user/login'),
        ),
        'authManager'=>array(
                'class'=>'RDbAuthManager',
                'connectionID'=>'db',
                'defaultRoles'=>array('Authenticated', 'Guest'),
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
        'yiiwheels' => array(
            'class' => 'ext.yiiwheels.YiiWheels',
        ),

        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '/home'=>'site/index',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=dncsyste_acct',
            'emulatePrepare' => true,
            'username' => 'dncsyste_acct',
            'password' => 'hitman052529',
            'charset' => 'utf8',  
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CWebLogRoute',
                    // 'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
              array(
              'class'=>'CEmailLogRoute',
              'levels'=>'error',
              'emails'=>'hellsing357@gmail.com',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);
