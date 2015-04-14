<?php

require_once('config.php');

if($login) {
	$arrProfileData = $databaseQuery->getProfileData($username);
	$arrAllUserData = $databaseQuery->getAllProfileData($username);
	if(isset($_GET['msg'])) {
		$msg = $_GET['msg'];
	}
	else {
		$msg = '';
	}
	$smarty->assign('fname', $arrProfileData['first_name']);
	$smarty->assign('lname', $arrProfileData['last_name']);
	$smarty->assign('username', $username);
	$smarty->assign('arrAllUserData', $arrAllUserData);
	$smarty->assign('msg', $msg);
	$smarty->display('createGroup.tpl');
}
else {
	header('location:index.php');
}                                                                                                                                