<?php

include_once('config.php');

if($_SERVER['REQUEST_METHOD'] == "POST" && $login) {
	$groupname = stripslashes(strip_tags($_POST['groupname']));
	$arrUserName = $_POST['frnd'];
	$groupId = $_POST['groupId'];

	$data = $databaseQuery->isGroupNameUnique($username, $groupname);
	if(!$data) {
		$databaseQuery->updateGroup($groupname, $groupId);
		$databaseQuery->deleteGroupMembers($groupId);
		foreach ($arrUserName as $user_name) {
			$databaseQuery->insertGroupUserMapping($groupId, $user_name);
		}
		header('location:home.php?msg=gsuccess');
	}
	else {
		header('location:home.php?msg=gerror');
	}
}
else {
	header('location:index.php');
}