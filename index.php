<?php
/**
 * @version 1.05
 */
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Europe/Moscow');
error_reporting(E_ALL);

$yii = dirname(__FILE__) . '/framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';

/**/
defined('YII_DEBUG') or define('YII_DEBUG', true); 


require_once($yii);

Yii::createWebApplication($config)->run();


$db = Yii::app()->db;


?>
