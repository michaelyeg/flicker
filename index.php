<?php
require_once('config.php');
if($login) {
	header('location:home.php');
}
else {
	$smarty->display('index.tpl');
}
?>