<?php



defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);


$autoload = dirname(__FILE__) . '/protected/vendor/autoload.php';
// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';


require_once($autoload);
require_once($yii);
Yii::createWebApplication($config)->run();
