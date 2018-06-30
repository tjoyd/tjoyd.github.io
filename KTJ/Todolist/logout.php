<?php
if (isset($current_file)) {
	//echo 'ok<br>';
} else {
	//echo 'try<br>';
	require 'core.inc.php';
}

session_destroy();
include 'sign.inc.php';

?>