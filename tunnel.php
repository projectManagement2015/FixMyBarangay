<?php
// error_reporting(0);
require_once('db.php');
// header("location:home.php");

if(!empty($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM complainant1  WHERE uname = '$username' AND password = '$password'";
	$retval = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($retval);
	if(count($row)==1){
		echo "<script>alert('Incorrect username or password');</script>";
		echo "error";
		win32_pause_service();

	}
	elseif(count($row)>1){
		$_SESSION['cid'] = $row['cid'];
		$_SESSION['fname'] = $row['fname'];

		var_dump($_SESSION);
		echo "ok";
		win32_pause_service();

		header("location:home.php");
	}
}else{
	echo "di kasud";
}

?>
