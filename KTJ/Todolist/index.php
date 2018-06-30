<?php

require 'core.inc.php';

if (!loggedin()) {
	//header('Location: register.php');
	include 'sign.inc.php';
	die();
}
require 'connect.inc.php';
require 'totallist.inc.php';
$i = 1;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewpoint" content="width=device-width,initial-scale=1.0" >
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title> Home Page </title>
	
	<link rel="stylesheet" href="bulma.css">
	<style>

	.text {
		border-right:1px solid grey;
		padding-right:10px;
	}
.navbar.is-primary {
  background-color: #22fac1; /*Real one is #00d1b2*/
  color: #fff;
}
body {
	height:2400px;
	background:#20218f3d;
	width:100%;
}
@media screen and (max-width: 1008px) {
	.title {
		margin-bottom:0px;
		font-size:20px;
	}	
}
	</style>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="block">.</div>
	<div class="block">
		<nav class="navbar is-primary is-fixed-top" >
			<div class="navbar-left">
				<h1 class="navbar-item title is-capitalized" style="margin-left:10px;" > To Do List | Welcome <?php echo $_SESSION['username'].'[id='.($_SESSION['user_id']).']'; ?> </h1>
			
			</div>
			<div class="navbar-end">
				<a href="" class="button is-info" style="margin:5px;diaplay:inline-block;"><?php echo $_SESSION['firstname']; ?></a>
				<a href="logout.php" style="margin:5px;diaplay:inline-block;" class="button is-warning"> Log Out</a>
			</div>
		</nav>
	</div>
	<div style="margin-top:100px;"></div>
	<div class="container">
	<section class="hero is-info" id="content">
		<h1 class="title"> Your Tasks  <span style="padding:100px;"><span><a href="adding.php" class="button is-primary is-pulled-right">Add a Task</a></h1>
		<?php 
			if (isset($dbh)) {
				echo 'sucessfully connected   |  [ ';
				echo $total_list -1 ;
				echo ' / 5 ]';
			}	
			$query1 = "SELECT * FROM title where id = ".$_SESSION['user_id'];
			$query2 = "SELECT * FROM todolist where id = ".$_SESSION['user_id'];
			$stmt = $dbh->prepare($query1);
			if ($stmt->execute()) {
				$title = $stmt->fetch();
			}
			$stmt = $dbh->prepare($query2);
			if ($stmt->execute()) {
				$content = $stmt->fetch();
			}
		?>
		<div style="margin-top:5px;">
		<?php 
			while ($i < $total_list) {
			?>
			<article class="message" >
				
				<div class="message-header">
					<p><?php if (isset($title)) { echo $i.'.<span style="padding:10px;"><span>'.$title[$i];} ?></p> 
					<a href="editing.php?id=<?php echo $i; ?>" class="button is-info is-small">Edit</a>
					<a href="delete.php?id=<?php echo $i; ?>" class="button is-danger is-small">Delete</a>
				</div>
				<div class="message-body">
					<div class="text">
						<p><?php if (isset($content)) { echo $content[$i];} ?></p>
						
					</div>
					<div class="image">
						<p> No Image</p>
					</div>
				<div>
			</article>
		<?php
			$i++;
			}
			if ($i == 1 ) {
			?>
			<article class="message">
				<div class="message-body">
					You have no task.
				</div>
			</article>
			<?php
			}
			?>
		</div>
	</section>
	</div>
	<div style="margin-top:20px"> .</div>
	

</body>
</html>