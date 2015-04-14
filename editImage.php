<?php

require_once('config.php');
if($login) {
	$photoId = $_GET['id'];
	if($photoId!='') {
		$arrPhotoData = $databaseQuery->getPhotoDetailsById($photoId);
		if(count($arrPhotoData)) {
			$arrProfileData = $databaseQuery->getProfileData($username);
			$arrGroupData = $databaseQuery->getGroupData($username);
			$smarty->assign('fname', $arrProfileData['first_name']);
			$smarty->assign('lname', $arrProfileData['last_name']);
			$smarty->assign('username', $username);
			$smarty->assign('arrPhotoData', $arrPhotoData);
			$smarty->assign('arrGroupData', $arrGroupData);
			$smarty->display('editImage.tpl');
		}
		else {
			header('location:error.php');
		}
	}
	else {
		header('location:error.php');
	}
}
else {
	header('location:index.php');
}