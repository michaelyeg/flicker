<?php

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Private Area"');
    header('HTTP/1.0 401 Unauthorized');
    echo "You are not authorised to visit this page";
} else {
	if (($_SERVER['PHP_AUTH_USER'] == 'admin') && ($_SERVER['PHP_AUTH_PW'] == 'admin')) {
		include('config.php');
		$res = $databaseQuery->setupDatabase();
		$smarty->assign('msg', $res);
		$smarty->display('setup.tpl');
	} else {
    	header("WWW-Authenticate: Basic realm='Private Area'");
    	header("HTTP/1.0 401 Unauthorized");
    	echo "Sorry - you need valid credentials to be granted access!\n";
	}
}
