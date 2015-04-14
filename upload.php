<?php

require_once('config.php');

if($login) {
	if(isset($_GET['msg'])) {
		$msg = $_GET['msg'];
	}
	else {
		$msg = '';
	}
	$arrProfileData = $databaseQuery->getProfileData($username);
	$arrGroupData = $databaseQuery->getGroupData($username);
	$smarty->assign('fname', $arrProfileData['first_name']);
	$smarty->assign('lname', $arrProfileData['last_name']);
	$smarty->assign('username', $username);
	$smarty->assign('arrGroupData', $arrGroupData);
	$smarty->assign('msg', $msg);
	$smarty->display('upload.tpl');
}
else {
	header('location:index.php');
}