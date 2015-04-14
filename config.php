<?php

//error_reporting(E_ERROR);
$rootDir = dirname('__FILE__');

define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'flickr');
define('DSN', 'mysql:host='.DB_SERVER.';dbname='.DB_NAME);

require($rootDir.'/databaseQuery.php');
$databaseQuery = new databaseQuery();
require($rootDir.'/plugins/Smarty.class.php');
$smarty = new Smarty();
$smarty->setTemplateDir($rootDir.'/display/templates');
$smarty->setCompileDir($rootDir.'/display/templates_c');
$smarty->setCacheDir($rootDir.'/display/cache');
$smarty->setConfigDir($rootDir.'/display/configs');

$login = false;
$username = '';
$username = $_COOKIE['login'];

if($username!='') {
	$login = true;
	setcookie("login", $username, time()+3600);
}

$smarty->assign('login', $login);
?>