<?php

include_once('config.php');

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$username = stripslashes(strip_tags($_POST['username']));
	$password = stripslashes(strip_tags($_POST['password']));

	if($user_name = $databaseQuery->verifyUser($username,$password)) {
		setcookie("login", $user_name, time()+3600);
		header('location:home.php');
	}
	else {
		header('location:index.php?msg=err');
	}
}
else {
	header('location:index.php');
}