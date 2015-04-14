<?php

require_once('config.php');
if($login) {
	$photoId = $_GET['id'];
	if($photoId!='') {
		$arrPhotoData = $databaseQuery->getPhotoDetailsById($photoId);
		if(count($arrPhotoData)) {
			/* Check If user has seen the image previously */
			$data = 0;
			$data = $databaseQuery->isImageAlreadySeen($username, $photoId);
			/* If value of data is ZERO, it means user has not seen this image */
			if(!$data) {
				$databaseQuery->insertUniqueView($username, $photoId);
			}

			$arrProfileData = $databaseQuery->getProfileData($username);
			if($arrPhotoData['permitted'] == 1) {
				$arrPhotoData['permission'] = "Public";
			}
			elseif($arrPhotoData['permitted'] == 2) {
				$arrPhotoData['permission'] = "Private";
			}
			else {
				$arrPhotoData['permission'] = $databaseQuery->getGroupName($arrPhotoData['permitted'], $username);
			}
			$smarty->assign('fname', $arrProfileData['first_name']);
			$smarty->assign('lname', $arrProfileData['last_name']);
			$smarty->assign('username', $username);
			$smarty->assign('arrPhotoData', $arrPhotoData);
			$smarty->display('viewImage.tpl');
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