<?php

require_once('config.php');

if($login) {
	$photoId = $_GET['id'];
	$databaseQuery->deletePhoto($photoId, $username);
	header('location:home.php?msg=dpsuccess');
}
else {
	header('location:index.php');
}                                                                                                                                