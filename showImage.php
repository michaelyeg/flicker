<?php

require_once('config.php');

if($login) {
	$photoId = $_GET['id'];
	$type = $_GET['type'];
	$arrPhotoData = $databaseQuery->getImage($photoId);
	if($type=="thumb") {
		header("Content-type: image/jpg");
		echo $arrPhotoData['thumbnail'];
	}
	else if ($type=="full") {
		header("Content-type: image/jpg");
		echo $arrPhotoData['photo'];	
	}
}
else {
	header('location:index.php');
}                                                                                                                                