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
$i = 1;
$title = $details = '';
$done = false;
$message ='Ok';
if (isset($_POST['title']) && isset($_POST['details']) ) {
	$title = $_POST['title'];
	$details = $_POST['details'];
	$message ='All Ok.<br>';
	if (empty($details)) {
		$details = ' ';
	}
	
	if (!empty($title)) {
		// Adding to title database
		$id = $_SESSION['user_id'] ;
		$query = "UPDATE title SET $a =	:me  WHERE title.id = $id";
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(':me',$title);
		$done = true;
		if (($stmt->execute())) {

		} else {
			$done =false ;
		}
		//Adding to todolist database
		$id = $_SESSION['user_id'] ;
		$query = "UPDATE todolist SET $a =	:me  WHERE todolist.id = $id";
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(':me',$details);
		if (($stmt->execute())) {

		} else {
			$done =false ;
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
	<title> Add a Task </title>
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
	<div class="block">H</div>
	<div class="block">
		<nav class="navbar is-primary is-fixed-top" >
			<div class="navbar-left">
				<h1 class="navbar-item title" style="margin-left:3 px;margin-top:5px;" > <a href="index.php" class="button is-info is-large" style="margin-right:15px" >To Do List</a> | <?php echo $_SESSION['username'].'[id='.($_SESSION['user_id']).']'; ?> Add a Task</h1>
				
			</div>
			<div class="navbar-end">
			    <a href="" class="navbar-item button is-info" style="margin:5px;diaplay:inline-block;"><?php echo $_SESSION['firstname']; ?></a>
				<a href="logout.php" style="margin:5px;diaplay:inline-block;" class="navbar-item button is-warning"> Log Out</a>
			</div>
		</nav>
	</div>
	<div style="margin-top:100px;"></div>
	<div class="container">
	<section class="hero is-info" id="content">
		<h1 class="title"> Your Tasks  <span style="padding:60px;"></span></h1>
		<section class="hero is-primary" style="padding:1px;padding-left:10px;border-radius:3px;">
		<?php 
			if (isset($dbh)) {
				echo 'Sucessfully connected    [ ';
				echo $total_list.' / 5 ] |';
				echo $title ;
				if (isset($_POST['title'])) {
					if ($done) {
						echo ' Successfully Added ';
					} else {
						echo 'Sorry , Some error happens. Try again later.<br> Enter valid data.';
					}
				}
				
				//echo $details;
			}	
			
		?>
		</section>
		<div style="margin-top:5px;">
		<article class="message">
			<div class="message-header">
				<p>Task No. <?php echo $to = $total_list + 1 ; ?></p>
			</div>
			<div class="message-body">
				<?php echo $message; ?>
				<form action="adding.php" method="post" enctype="multipart/form-data">
					<div class="field">
						<label class="label">Title : </label>
						<input type="text" class="input is-info" name="title" placeholder="Enter title" value="<?php echo $title; ?>" >
					</div>
					<div class="field">
						<label class="label">Details :</label>
						<textarea class="textarea is-info" name="details" value="" placeholder="Enter details ( optional )"><?php echo $details; ?></textarea>
					</div>
					<div class="field">
						<label class="label">Image (Optional ) : </label>
						<input type="file" name="image" accept="image/*" disabled> Image adding still is not activated.
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