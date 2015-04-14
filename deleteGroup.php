<?php

require_once('config.php');

if($login) {
	$groupId = $_GET['id'];
	$groupName = $databaseQuery->getGroupName($groupId, $username);
	if($groupName) {
		$databaseQuery->deleteGroupMembers($groupId);
		$databaseQuery->deleteGroup($groupId);
		header('location:home.php?msg=dsuccess');
	}
	else {
		header('location:error.php');
	}
}
else {
	header('location:index.php');
}                                                                                                                                