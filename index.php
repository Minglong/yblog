<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii-sae/framework/yii.php';
if(is_writable('assets')){
    $config=dirname(__FILE__).'/protected/config/main.php';
}else{
    $config=dirname(__FILE__).'/protected/config/main_sae.php';
}

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
//defined('YII_DEBUG') or define('YII_DEBUG',false);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
if(is_writable('assets')){
    Yii::createWebApplication($config)->run();
}else{
    Yii::createMyWebApplication($config)->run();
}
