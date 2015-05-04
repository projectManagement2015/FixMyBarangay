<?php
error_reporting(0);
session_start();
require_once('db.php');

if(isset($_POST['login'])){
	$username = $_POST['uname'];
	$password = $_POST['password'];

	// echo $username." ".$password;
	// win32_pause_service();

	$sql = "SELECT * FROM admin  WHERE uname = '$username' AND password = '$password'";
	$retval = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($retval);

	// var_dump($row);
	// win32_pause_service();	
	if(count($row)==1){
		echo "<script>alert('Incorrect username or password');</script>";

	}
	elseif(count($row)>1){
		$_SESSION['aid'] = $row[0];
		$_SESSION['fname'] = $row[1];

		header("location:adminhome.php");
	}
}


?>






<!DOCTYPE HTML>
<html>
	<head>
		<title>FMB</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">

	</head>
	<body>
		<div id="contents">
			<div class="body" id="contact">
				<div id="sidebar">
					<div class="body">
						<!-- <img src="" alt=""> -->
						<div class="contact">
							<p>
								<h3>FIX MY BARANGAY</h3>
							</p>
						
				
				<div id="main">
					<h1>Login</h1>
					<form action="" method="post">
						<label>Username:</label>
						<input type="text" value="" name="uname" id="uname">
						<label>Password:</label>
						<input type="password" value="" name="password" id="password">
						<input type="submit" name="login" value="Login" class="btn1">

					</form>
				</div>
			</div>
			</div>
			</div>
		</div>
	</div>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</body>
</html>

