<?php

// defined('YII_DEBUG') or define('YII_DEBUG',true);

// change the following paths if necessary
$yiic=dirname(__FILE__).'/framework/yiic.php';
$config=dirname(__FILE__).'/config/console.php';
if (defined('YII_DEBUG')) {
	$config=dirname(__FILE__).'/config/console_dev.php';
}
require_once($yiic);