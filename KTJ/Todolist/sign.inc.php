<?php 

if (isset($current_file)) {
	//echo 'ok<br>';
} else {
	//echo 'try<br>';
	require 'core.inc.php';
}
if (loggedin()) {
	header('Location: index.php');
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewpoint" content="width=device-width,initial-scale=1.0" >
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title> Home Page </title>
	<link rel="stylesheet" href="bulma.css">
	<link rel="stylesheet" href="style.css">
	<style>
	body {
		height:700px;
	}
	#sign {
		margin:auto;
	}
	a {
		margin-left:50px;
		margin-right:50px;
	}
	</style>
</head>
<body>
	<div class="block">H</div>
	<div class="block">
		<nav class="navbar is-primary is-fixed-top" >
			<div class="navbar-left">
				<h1 class="navbar-item title"> To Do List | Welcome , User </h1>
				<h1 class="navbar-item subtitle"></h1>
			</div>
			<div class="navbar-end">
				<a href="logout.php" style="margin:20px;" class="navbar-item button is-warning"> Log Out</a>
			</div>
		</nav>
	</div>
	<div style="margin-top:150px;"></div>
	<div class="container">
	<section class="hero is-info" id="content">
		<h1 class="title" id="sign">
			<a href="register.php" class="button is-primary is-medium">Register</a>
			<a href="login.php" class="button is-primary is-medium">Log In</a>
		
		</h1>
	</section>
	</div>
</body>
</html>

