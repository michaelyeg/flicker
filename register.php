<?php

include_once('config.php');

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$username = stripslashes(strip_tags($_POST['username']));
	$email = stripslashes(strip_tags($_POST['email']));
	$password = stripslashes(strip_tags($_POST['password']));
	$fname = stripslashes(strip_tags($_POST['fname']));
	$lname = stripslashes(strip_tags($_POST['lname']));
	$address = stripslashes(strip_tags($_POST['address']));
	$contact = stripslashes(strip_tags($_POST['contact']));

	$data = $databaseQuery->isUsernameUnique($username);
	if(!$data) {
		$databaseQuery->insertDataUsers($username,$password);
		$databaseQuery->insertDataPersons($username,$fname,$lname,$address,$email,$contact);
		setcookie("login", $username, time()+3600);
		header('location:home.php');
	}
	else {
		$smarty->assign('email', $email);
		$smarty->assign('fname', $fname);
		$smarty->assign('lname', $lname);
		$smarty->assign('address', $address);
		$smarty->assign('contact', $contact);
		$smarty->assign('error', 'Username already Exists');
		$smarty->display('index.tpl');
	}
}
else {
	header('location:index.php');
}