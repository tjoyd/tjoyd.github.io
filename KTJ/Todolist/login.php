<?php 
require 'core.inc.php';
require 'connect.inc.php';

if (loggedin()) {
	header('Location: index.php');
	//include 'index.php';
	//die();
} 
if (isset($_POST['username']) && isset($_POST['password'])) {
	$username = strtolower($_POST['username']);
	$password = strtolower($_POST['password']);
	$password_hash = md5($password);
	if (!empty($username) && !empty($password)) {
		//echo 'All ok<br>';
		$query = "SELECT * FROM users where username = ? And password = ?";
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(1,$username);
		$stmt->bindParam(2,$password_hash);
		$found = false;
		if ($stmt->execute()) {
			//echo 'Enter<br>';
			while ($row = $stmt->fetch()) {
				//print_r($row);
				$user_id = $row[0] ;
				$firstname = $row[3];
				$lastname = $row[4];
				$email = $row[5];
				$found = true;
				
			}
		}
		if ($found) {
			echo 'Logged in.<br>id = '.$user_id.'<br>';
			$_SESSION['user_id'] = $user_id;
			$_SESSION['username'] = $username;
			$_SESSION['firstname'] = $firstname;
			$_SESSION['lastname'] = $lastname;
			$_SESSION['email'] = $email;
			header('Location: index.php');
		} else {
			echo 'Invalid id or password';
		} 
	}
}

//echo $current_file;


?>
<head>
	<meta charset="UTF-8">
	<meta name="viewpoint" content="width=device-width,initial-scale=1.0" >
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title> Home Page </title>
	<link rel="stylesheet" href="bulma.css">
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
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="block">H</div>
	<div class="block">
		<nav class="navbar is-primary is-fixed-top" >
			<div class="navbar-left">
				<h1 class="navbar-item title" style="margin-top:10px;" ><a href="" class="button is-info is-large" > To Do List </a><span style="padding-left:100px;">Welcome Please Log In<span>  </h1>
				<h1 class="navbar-item subtitle"></h1>
			</div>
		</nav>
	</div>
	<div style="margin-top:100px;"></div>
	<div class="login" >
		<section class="hero is-info" style="padding:20px;border-radius:5px;">
				Note : Username and passwords are not case sensetive .
		</section>
		<div style="margin:20px;"></div>
		<form action="login.php" method="POST">
			<label class="label">Username :</label>		<br> 
			<input type="text" class="input" name="username" value="Admin" required><br><br>
			
			<label class="label">Password :</label>	 <br> 
			<input type="password" class="input" name="password" value="Admin123" required><br><br><br>
			<input type="submit" class="button is-info" value="Log In">
			
		</form>
		<span style="padding-left:10px;"></span><label class="label" > <span style="padding-left:150px;"></span>Don't have a account ? <a href="register.php" class="button is-info">Register</a></label>
	</div>
</body>
	