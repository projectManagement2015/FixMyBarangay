<?php
require_once('db.php');
session_start();

if (isset($_SESSION['login'])) {
	header('location:pages/home.php');
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

if(isset($_POST['login'])){
	$username=$_POST['username'];
	$password=$_POST['password'];

	$sql = "SELECT * FROM barangay_official WHERE username='$username' AND password='$password'";
	$query = mysqli_query($conn,$sql);
	if($row = mysqli_fetch_assoc($query)){
		// echo $rows['rid'];
		// win32_pause_service();
		$_SESSION['officialid'] = $row['official_id'];
		$_SESSION['login']=1;
		$_SESSION['username'] = $row['username'];
		$_SESSION['password'] = $row['password'];
		$_SESSION['name']=$row['name'];
		$_SESSION['position'] = $row['position'];
		header("location:adminhome.php");
		// mysqli_close($conn);
}
}

if (isset($_POST['login'])) {
	$username=$_POST['username'];
	$password=$_POST['password'];
	$password = hash("SHA512", $password);
	$sql = "SELECT * FROM resident WHERE username='$username' AND password='$password'";
	$query = mysqli_query($conn,$sql);
	if($rows = mysqli_fetch_assoc($query)){
		// echo $rows['rid'];
		// win32_pause_service();
		$_SESSION['rid'] = $rows['rid'];
		$_SESSION['login']=1;
		$_SESSION['firstname'] = $rows['firstname'];
		$_SESSION['lastname'] = $rows['lastname'];
		$_SESSION['email']=$rows['email'];
		header("location:pages/home.php");
		// mysqli_close($conn);
	}
	else {
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
<link rel="stylesheet" type="text/css" href="css/style.css">
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
<input type="text" name="username" class="placeholder" placeholder="Username" autofocus required>
<input type="password" name="password" class="placeholder" placeholder="Password" required>
<input type="submit" name="login" id="login"value="Log In">
</form>

<form id="slick-register" action="pages/register.php">
<input type="submit" value="Sign Up"></a>
</form>

</body>
</html>