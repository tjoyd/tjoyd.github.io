<?php
require 'core.inc.php';

if (!loggedin()) {
	//header('Location: register.php');
	include 'sign.inc.php';
	die();
}
require 'connect.inc.php';
$a = $b = $c = $d = $e = '';
require 'totallist.inc.php';
$title = $details = '';
$done = true;
$message = 'No Message';
//Checking get value and fetching the title and content 
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$_SESSION['task_id'] = $id;
	if (!empty($id)) {
		$message = " All Ok.<br>";
	}
	$todo = 'todo_'.$id;
	$query1 = "SELECT $todo FROM title where id = ".$_SESSION['user_id'];
	$query2 = "SELECT $todo FROM todolist where id = ".$_SESSION['user_id'];
	$stmt = $dbh->prepare($query1);
	if ($stmt->execute()) {
		$title = $stmt->fetch();
	}
	$stmt = $dbh->prepare($query2);
	if ($stmt->execute()) {
		$details = $stmt->fetch();
	}
} else {
	//header('Location: index.php');
	//$message ="Error";
}

//Update to the database

if (isset($_POST['title']) && isset($_POST['details'])) {
	$title = $_POST['title'];
	$details = $_POST['details'];
	$done = true;
	if (empty($details)) {
		$details = ' ';
	}
	if (!isset($id)) {
		$id = $_SESSION['task_id'];
	}
	$todo = 'todo_'.$id;
	if (!empty($title)) {
		// Adding to title database
		$i = $_SESSION['user_id'] ;
		$query = "UPDATE title SET $todo =	:me  WHERE title.id = $i";
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(':me',$title);
		if (($stmt->execute())) {

		} else {
			$done =false ;
		}
		//Adding to todolist database
		$query = "UPDATE todolist SET $todo =	:me  WHERE todolist.id = $i";
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(':me',$details);
		if (($stmt->execute())) {

		} else {
			$done = false ;
		}
		
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewpoint" content="width=device-width,initial-scale=1.0" >
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title> Edit Task </title>
	<link rel="stylesheet" href="bulma.css">
	<style>
	body {
		height:1000px;
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
	<div class="block">.</div>
	<div class="block">
		<nav class="navbar is-primary is-fixed-top" >
			<div class="navbar-left">
				<h1 class="navbar-item title" style="margin-left:3 px;margin-top:5px;" > <a href="index.php" class="button is-info is-large" style="margin-right:15px" >To Do List</a> | <?php echo $_SESSION['username'].'[id='.($_SESSION['user_id']).']'; ?> Add a Task</h1>
			</div>
			<div class="navbar-end">
				<a href="logout.php" style="margin:20px;" class="navbar-item button is-warning"> Log Out</a>
			</div>
		</nav>
	</div>
	<div style="margin-top:80px;"></div>
	<div class="container">
	<section class="hero is-info" id="content">
		<h1 class="title"> Your Tasks  <span style="padding:100px;"></span></h1>
		<?php 
			if (isset($dbh)) {
				//echo 'Sucessfully connected    [ ';
				//echo $total_list.' / 5 ] |';
				if (isset($_POST['title'])) {
					if ($done) {
						echo $title ;
						echo ' Successfully Updated | ';
					} else {
						echo 'Sorry , Some error happens. Try again later.';
					}
				}
				echo 'Message : '.$message;
				
				//echo $details;
			}	
			
		?>
		<div style="margin-top:5px;">
		<article class="message">
			<div class="message-header">
				<p>Task No. <?php echo $id; ?></p> <?php if ($done) {echo '<a href="index.php" class="button is-info is-small is-pulled-right">Return</a>'; }?>
			</div>
			<div class="message-body">
				<form action="editing.php" method="post">
					<div class="field">
						<label class="label">Title : </label>
						<input type="text" class="input is-info" name="title" placeholder="Enter title" value="<?php if (isset($_POST['title'])) { echo $title; } else { echo $title[0];} ?>" required>
					</div>
					<div class="field">
						<label class="label">Details </label>
						<textarea class="textarea is-info" name="details" placeholder="Enter details ( optional )"><?php if (isset($_POST['title'])) { echo $details; } else { echo $details[0];} ?></textarea>
					</div>
					
					<input type="submit" class="button is-success" value="Submit"> <a href="index.php" class="button is-danger">Cancel</a>
				</form>
			</div>
		</article>
	</section>
	</div>
	<div style="margin-top:20px"> .</div>
	

</body>
</html>