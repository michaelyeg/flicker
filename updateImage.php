<?php

include_once('config.php');

if($_SERVER['REQUEST_METHOD'] == "POST" && $login) {
	$subject = stripslashes(strip_tags($_POST['subject']));
	$place = stripslashes(strip_tags($_POST['place']));
	$date = stripslashes(strip_tags($_POST['date']));
	$description = stripslashes(strip_tags($_POST['description']));
	$permission = stripslashes(strip_tags($_POST['permission']));
    $photoId = stripslashes(strip_tags($_POST['photoId']));
	$databaseQuery->updatePhotoDetails($photoId, $username, $permission, $subject, $place, $date, $description);
	header('location:home.php?msg=upsuccess');
}
else {
	header('location:index.php');
}