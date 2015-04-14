<?php

include_once('config.php');

if($_SERVER['REQUEST_METHOD'] == "POST" && $login) {
	$groupname = stripslashes(strip_tags($_POST['groupname']));
	$arrUserName = $_POST['frnd'];
	$groupId = time();

	$data = $databaseQuery->isGroupNameUnique($username, $groupname);
	if(!$data) {
		$databaseQuery->createGroup($username,$groupname, $groupId);
		foreach ($arrUserName as $user_name) {
			$databaseQuery->insertGroupUserMapping($groupId, $user_name);
		}
		header('location:createGroup.php?msg=success');
	}
	else {
		header('location:createGroup.php?msg=error');
	}
}
else {
	header('location:index.php');
}