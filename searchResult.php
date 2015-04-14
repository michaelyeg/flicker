<?php

include_once('config.php');

if($_SERVER['REQUEST_METHOD'] == "POST" && $login) {
	$keywords = stripslashes(strip_tags($_POST['keywords']));
	$condition = stripslashes(strip_tags($_POST['condition']));
	$from = stripslashes(strip_tags($_POST['from']));
	$to = stripslashes(strip_tags($_POST['to']));
	$sorting = stripslashes(strip_tags($_POST['sorting']));

	$arrGroupIds = $databaseQuery->findUsersGroup($username);
	// As we are using MYSQL so cant use CONTAINS function for querying so would query normally and apply algo in PHP
	$strGroupIds = implode(',', $arrGroupIds);
	if($strGroupIds!='') {
		$strGroupIds = $strGroupIds.",1";
	}
	else {
		$strGroupIds = '1';	
	}
	if($sorting == 'auto') {
		$arrImagesData = $databaseQuery->getSearchResult($strGroupIds, $keywords, $condition, $from, $to, $username, '');
	}
	else {
		$arrImagesData = $databaseQuery->getSearchResult($strGroupIds, $keywords, $condition, $from, $to, $username, $sorting);
	}
	$arrPhotoData = array();
	if($sorting == 'auto') {
		foreach($arrImagesData as $key=>$arrData) {
			$subFreq = getFrequencyCount($arrData['subject'], $keywords);
			$placeFreq = getFrequencyCount($arrData['place'], $keywords);
			$descFreq = getFrequencyCount($arrData['description'], $keywords);
			$rank = 6*$subFreq + 3*$placeFreq + $descFreq;
			$arrRank[$key] = $rank;
		}
		asort($arrRank);
		foreach($arrRank as $key=>$value) {
			$arrPhotoData[] = $arrImagesData[$key];
		}
	}
	else {
		foreach($arrImagesData as $key=>$arrData) {
			$arrPhotoData[] = $arrImagesData[$key];
		}
	}
	$arrProfileData = $databaseQuery->getProfileData($username);
	$smarty->assign('fname', $arrProfileData['first_name']);
	$smarty->assign('lname', $arrProfileData['last_name']);
	$smarty->assign('username', $username);
	$smarty->assign('arrPhotoData', $arrPhotoData);
	$smarty->display('searchResult.tpl');
}
else {
	header('location:index.php');
}

function getFrequencyCount($str, $keywords) {
	$wordArray = explode(' ', $str);
	$filteredArray = array_filter($wordArray, function($x){return !preg_match("/^(.|a|an|and|the|this|at|in|or|of|is|for|to)$/",$x);});
	$arrWordCount = array_count_values($filteredArray);
	$totalWordCount = count($filteredArray);
	$arrKeywords = explode(' ', $keywords);
	foreach ($arrKeywords as $value) {
		$count = $count + $arrWordCount[$value];
	}
	$frequency = $count/$totalWordCount;
	return $frequency;
}