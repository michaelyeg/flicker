<?php

require_once('config.php');

if($login) {
	$arrProfileData = $databaseQuery->getProfileData($username);
	$smarty->assign('fname', $arrProfileData['first_name']);
	$smarty->assign('lname', $arrProfileData['last_name']);
	$smarty->assign('username', $username);
	$smarty->display('search.tpl');
}
else {
	header('location:index.php');
}