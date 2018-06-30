<?php
require 'core.inc.php';
if (!loggedin()) {

	$username = $password = $password_again = $firstname = $lastname = $email = '';

	if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_again']) &&
	isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['email'])) {
		$username = strtolower($_POST['username']);
		$password = strtolower($_POST['password']);
		$password_again = strtolower($_POST['password_again']);
		$firstname = $_POST['first-name'];
		$lastname = $_POST['last-name'];
		$email = $_POST['email'];
		if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password_again']) && !empty($_POST['first-name']) &&
		!empty($_POST['last-name']) && !empty($email)) {
			
			if ($password == $password_again) {
				echo 'ok password <br>';
				include 'connect.inc.php';
				$password_hash = md5($password);
				
				$query = "SELECT username FROM users where username = ?";
				$stmt = $dbh->prepare($query);
				$already = false;
				if ($stmt->execute(array($username))) {
					while ($row = $stmt->fetch()) {
						$already = true;
					}
				}
				if ($already == true) {
					echo 'username already exists';
				} else {
					$null = 'NULL';
					$query = "INSERT INTO USERS () VALUES ( :id , :username , :password ,:firstname ,:lastname ,:email)";
					$stmt = $dbh->prepare($query);
					$stmt->bindParam(':id',$null);
					$stmt->bindParam(':username',$username);
					$stmt->bindParam(':password',$password_hash);
					$stmt->bindParam(':firstname',$firstname);
					$stmt->bindParam(':lastname',$lastname);
					$stmt->bindParam(':email',$email);
					
					$done = true;
					if (($stmt->execute())) {
						echo " Registration successfully completed.<br>";
					} else {
						echo "Some error happen at the time of registration";
						$done = false;
					}
					$query = "INSERT INTO todolist () VALUES ( $null , '', '' ,'' ,'' ,'')";
					$stmt = $dbh->prepare($query);
					if (($stmt->execute())) {
						echo " TO DO LIST created.<br>";
					} else {
						echo "Some error happen at the time of creation";
						$done = false;
					}
					$query = "INSERT INTO title () VALUES ( $null , '', '' ,'' ,'' ,'')";
					$stmt = $dbh->prepare($query);
					if (($stmt->execute())) {
						echo " TO DO LIST created.<br>";
					} else {
						echo "Some error happen at the time of creation";
						$done = false;
					}
					if ($done) {
						header('Location : login.php');
					}
				}
				$dbh = NULL;
				
				
			} else {
				echo 'passwords don\'t match';
			}
			
		} else {
			echo 'Fill up all the fields.<br>';
		}
	} else {
		//echo '$_POST not set <br>';
	}
?>

<head>
	<meta charset="UTF-8">
	<meta name="viewpoint" content="width=device-width,initial-scale=1.0" >
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Registration </title>
	<link rel="stylesheet" href="bulma.css">
	<style>
	.registration {
		width:400px;
		margin:auto;
	}
	.hero {
		border-radius:5px;
	}
	.register {
		padding:20px;
		border-radius:5px;
		margin:20px;
		margin-top:0px;
	}
	.red {
		color:red;
	}
	</style>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="block">H</div>
	<div class="block">
		<nav class="navbar is-primary is-fixed-top" >
			<div class="navbar-left">
				<h1 class="navbar-item title" style="margin-left:10px;" > To Do List<span style="padding-left:100px; padding-right:100px;">Please Register</span> 
				<a href="login.php" style="margin:20px;" class="button is-warning"> Log In</a> </h1>
				<h1 class="navbar-item subtitle"></h1>
			</div>
		</nav>
	</div>
	<div style="margin-top:100px;"></div>
	<div class="registration">
	<section class="hero is-info">
		<div class="register">
		<h1 class="title" style="text-align:center;color:black"><u>Registration Form</u></h1>
		<form action="register.php" method="POST">
			<p style="text-align:center"><span class="red">* </span> fields are necessary </p>
			<label class="label" ><span class="red">* </span> Username : </label><input type="text" class="input is-rounded" name="username" value="<?php echo $username; ?>" required><br><br>
			<label class="label"><span class="red">* </span>Email Address : </label><input type="text" class="input is-rounded"name="email" value="<?php echo $email; ?>" required><br><br>
			<label class="label"><span class="red">* </span>Password : </label><input type="text" class="input is-rounded" name="password"required><br><br>
			<label class="label"><span class="red">* </span>Password Again : </label><input type="text" class="input is-rounded" name="password_again"required><br><br>
			<label class="label">First Name : </label> <input type="text" class="input is-rounded" name="first-name" value="<?php echo $firstname; ?>"><br><br>
			<label class="label">Last Name : </label> <input type="text" class="input is-rounded" name="last-name" value="<?php echo $lastname; ?>"><br><br>
			<label ><p>By registering ,<br>You are accepting our <a href="" ><u>Terms & Conditions</u></a> .</p></label>
			<input class="button is-success is-rounded" type="submit" value="Register"><br><br>
			
			<label class="label"> Already registered ? Log In </label>
		</form>
		</div>
	</section>
	</div>
	<div style="margin-top:20px"> .</div>
	
</body>
<?php
} else if (loggedin()) {
	
	//echo '<br>loggedin<br>';
	header('Location: index.php');

}

?>