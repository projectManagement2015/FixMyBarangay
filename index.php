<?php
require_once('db.php');
session_start();
if (isset($_SESSION['freelec_project'])) {
	header('location:home.php');
}

if (isset($_GET['register'])) {
	if ($_GET['register']==1) {
		echo "<script>alert('You are now registered and ready to complain');</script>";
	}
}
if (isset($_GET['register'])) {
	if ($_GET['register']==2) {
		echo "<script>alert('Username already exist.');</script>";
	}
}

if (isset($_POST['login'])) {
	$username=$_POST['username'];
	$password=$_POST['password'];
	$sql = "SELECT username,password FROM residence WHERE username='$username' AND password='$password'";
	$query = mysqli_query($conn,$sql);
	if($rows = mysqli_fetch_assoc($query)){
		$_SESSION['freelec_project'] = $rows['rid'];
		header("location:home.php");
		mysqli_close($conn);
	} else {
		echo "<script>alert('Username/Password is invalid')</script>";
	}
	}
?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
<meta name="description" content="slick Login">
<meta name="author" content="Webdesigntuts+">
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://www.modernizr.com/downloads/modernizr-latest.js"></script>
<script type="text/javascript" src="placeholder.js"></script>
</head>
<body>

 <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>Fix My<span> Barangay</span></div>
		</div>
		<br>

<form  action="" method="post" id="slick-login"> 
<input type="text" name="username" class="placeholder" placeholder="Username" autofocus>
<input type="password" name="password" class="placeholder" placeholder="Password">
<input type="submit" name="login" id="login"value="Log In">
</form>


<form id="slick-register" action="register.php">
<input type="submit" value="Sign Up"></a>
</form>

</body>
</html>