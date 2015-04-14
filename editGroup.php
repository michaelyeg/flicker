<?php

require_once('config.php');

if($login) {
	$arrProfileData = $databaseQuery->getProfileData($username);
	$arrAllUserData = $databaseQuery->getAllProfileData($username);
	$groupId = $_GET['id'];
	$groupName = $databaseQuery->getGroupName($groupId, $username);
	if($groupName) {
		$arrGroupMembers = $databaseQuery->getGroupMembers($groupId);
	}
	else {
		header('location:error.php');
	}
	
	$smarty->assign('fname', $arrProfileData['first_name']);
	$smarty->assign('lname', $arrProfileData['last_name']);
	$smarty->assign('username', $username);
	$smarty->assign('groupName', $groupName);
	$smarty->assign('arrGroupMembers', $arrGroupMembers);
	$smarty->assign('arrAllUserData', $arrAllUserData);
	$smarty->assign('groupId', $groupId);
	$smarty->display('editGroup.tpl');
}
else {
	header('location:index.php');
}                                                                                                                                