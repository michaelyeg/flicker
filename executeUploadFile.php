<?php

include_once('config.php');

if($_SERVER['REQUEST_METHOD'] == "POST" && $login) {
	$subject = stripslashes(strip_tags($_POST['subject']));
	$place = stripslashes(strip_tags($_POST['place']));
	$date = stripslashes(strip_tags($_POST['date']));
	$description = stripslashes(strip_tags($_POST['description']));
	$permission = stripslashes(strip_tags($_POST['permission']));
	$arrFileId = $_POST['fileId'];

	foreach($arrFileId as $fileId) {
		$photoId = rand();
		$file = 'uploads/'.$fileId;
		$photoData = file_get_contents($file);
		$thumbnail_width = 150;
    	$thumbnail_height = 150;
    	$thumb_beforeword = "thumb";
    	$arr_image_details = getimagesize($file);
	    $original_width = $arr_image_details[0];
    	$original_height = $arr_image_details[1];
    	if ($original_width > $original_height) {
        	$new_width = $thumbnail_width;
        	$new_height = intval($original_height * $new_width / $original_width);
    	} else {
        	$new_height = $thumbnail_height;
        	$new_width = intval($original_width * $new_height / $original_height);
    	}
    	$dest_x = intval(($thumbnail_width - $new_width) / 2);
    	$dest_y = intval(($thumbnail_height - $new_height) / 2);
    	if ($arr_image_details[2] == 1) {
        	$imgt = "ImageGIF";
        	$imgcreatefrom = "ImageCreateFromGIF";
        	$thumbnail = "uploads/thumbnail.gif";
    	}
    	if ($arr_image_details[2] == 2) {
        	$imgt = "ImageJPEG";
        	$imgcreatefrom = "ImageCreateFromJPEG";
        	$thumbnail = "uploads/thumbnail.jpg";
    	}
    	if ($imgt) {
        	$old_image = $imgcreatefrom($file);
        	$new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
        	imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
        	$imgt($new_image, $thumbnail);
    	}
		$thumbnailData =  file_get_contents($thumbnail);
		$databaseQuery->insertPhotoDetails($photoId, $username, $permission, $subject, $place, $date, $description, $thumbnailData, $photoData);
	}
	header('location:home.php?msg=psuccess');
}
else {
	header('location:index.php');
}