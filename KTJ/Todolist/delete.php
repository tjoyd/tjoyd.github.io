<?php

require 'core.inc.php';

if (!loggedin()) {
	//header('Location: register.php');
	include 'sign.inc.php';
	die();
}
require 'connect.inc.php';
require 'totallist.inc.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
$get_id = $id;
$message = '';
if (isset($_GET['confirm'])) {
	//$message = '<span style="margin-left:45px" >Everything is Ok.<br><br>';
	
	
	$i = $_SESSION['user_id'] ;
	$count = $id ; 
	//$message = $id.'/'.$count;
	while ($count <= 6) {
		$count++;
		$todo = 'todo_'.$count;
		//Reading Data from database
		$query1 = "SELECT $todo FROM title where id = ".$i;
		$query2 = "SELECT $todo FROM todolist where id = ".$i;
		$stmt = $dbh->prepare($query1);
		if ($stmt->execute()) {
			$title = $stmt->fetch();
		}
		$stmt = $dbh->prepare($query2);
		if ($stmt->execute()) {
			$details = $stmt->fetch();
		}
		//$message = $title[0].$details[0];
		$todo = 'todo_'.$id;
		if ($count > 5 ) {
			$title[0] = '';
			$details[0] = '';
		}
		// Adding to title database
		$query = "UPDATE title SET $todo =	:me  WHERE title.id = $i";
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(':me',$title[0]);
		$done = true;
		if (($stmt->execute())) {
		
		} else {
			$done =false ;
		}
		//Adding to todolist database
		$query = "UPDATE todolist SET $todo =	:me  WHERE todolist.id = $i";
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(':me',$details[0]);
		if (($stmt->execute())) {

		} else {
			$done =false ;
		}
		$id++;
	}
	if ($count >= 5) {
		$done = true;
	}
	if (!$done) {
		$message = '<span style="margin-left:45px" >Some Error happens</span>.<br><br>';
	} else {
		header('Location: index.php');
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewpoint" content="width=device-width,initial-scale=1.0" >
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title> Delete Task </title>
	<link rel="stylesheet" href="bulma.css">
	<style>
	body {
		height:700px;
		background:#00c9d13b;
	}
	.text {
		border-right:1px solid grey;
		padding-right:10px;
	}
	.image {
		position: relative;
		left:450px;
		top:200px;
	}
	*:focus {
		outline:0;
	}
	
	</style>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="block">H</div>
	<div class="block">
		<nav class="navbar is-primary is-fixed-top" >
			<div class="navbar-left">
				<h1 class="navbar-item title" style="margin-left:3 px;margin-top:5px;" > <a href="index.php" class="button is-info is-large" style="margin-right:15px" >To Do List</a> | <?php echo $_SESSION['username'].'[id='.($_SESSION['user_id']).']'; ?> Delete Task</h1>
				
			</div>
			<div class="navbar-end">
				<a href="logout.php" style="margin:20px;" class="navbar-item button is-warning"> Log Out</a>
			</div>
		</nav>
	</div>
	<div style="margin-top:100px;"></div>
	<div class="container">
	<section class="hero is-info" id="content">
			<div class="message-header is-small">
				<label class="label is-medium"style="color:orange">Are you sure about deleting ?</label>
			</div>
			<div class="message-body" style="margin:5px auto;">
				<?php echo $message.'<br>'; ?>
				<a href="delete.php?id=<?php echo $get_id; ?>&confirm=true" class="button is-danger is-medium" style="margin-right:80px;">Yes</a>
				<a href="index.php" class="button is-primary is-medium">NO</a>
			<div>
		
	</section>
	</div>