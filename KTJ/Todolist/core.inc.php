<?php

ob_start();
session_start();

$current_file = $_SERVER['SCRIPT_NAME'];
if (isset($_SERVER['HTTP_REFERER'])) {
	$http_referer = $_SERVER['HTTP_REFERER'];
} else {
	$http_referer = 'index.php';
}
//echo $current_file.'<br>'.$http_referer.'<br>';
function loggedin() {
	if ((isset($_SESSION['user_id']))&&(!empty($_SESSION['user_id']))) {
		return true;
	} else {
		return false;
	}
}
$user_id = '';
$username = '';
$password = '';


?>