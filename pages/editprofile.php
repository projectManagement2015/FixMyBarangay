<?php 
	session_start();
	require_once('../db.php');
	$rid = $_SESSION['rid'];
	$result = mysqli_query($conn, "SELECT * FROM resident WHERE rid = $rid");
	$row = mysqli_fetch_assoc($result);

	$lastname = $row['lastname'];
	$firstname = $row['firstname'];
	$birthdate = $row['birthdate'];
	$purok = $row['purok'];
	$email = $row['email'];
	$username = $row['username'];
	$occupation = $row['occupation'];

	if (isset($_POST['edit'])) {
		$rid = $_SESSION['rid'];
		$lastname = $_POST['lastname'];
		$firstname = $_POST['firstname'];
		$birthdate = $_POST['birthdate'];
		$purok = $_POST['purok'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$occupation = $_POST['occupation'];

		$query = "UPDATE resident SET lastname = '$lastname', firstname = '$firstname', birthdate = '$birthdate', occupation = '$occupation', purok = $purok, email = '$email', username = '$username' WHERE rid = $rid;";
		$result = mysqli_query($conn, $query);

		if ($result>0) {
			header("location:profile.php?edit=1");
		}
		else{
			header("location:profile.php?edit=0");
		}
	}


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" href="../style.css">
</head>
<body>
	<?php
		include("nav.php");
	?>
	<div id="profile">
	<div class="space"></div>
	<h1 class="register-title" id="editprofileheader">Edit Profile</h1>

	 <form class="register" action="" method="post">
	    <input type="text" name="firstname" class="register-input" value="<?php echo $firstname; ?>" placeholder= "Last Name" >
	    <input type="text" name="lastname" class="register-input" value="<?php echo $lastname ?>" placeholder= "Last Name" >
	    <input type="text" name="birthdate" class="register-input" value="<?php echo $birthdate ?>" placeholder = "Birthdate" >
	    <select name="purok" class="purok">
	      <option value="1"disable>Purok 1</option>
	      <option value="2"disable>Purok 2</option>
	      <option value="3"disable>Purok 3</option>
	      <option value="4"disable>Purok 4</option>
	      <option value="5"disable>Purok 5</option>
	      <option value="6"disable>Purok 6</option>
	      <option value="7"disable>Purok 7</option>
	      <option value="8"disable>Purok 8</option>
	    </select>
	    <input type="text" name="occupation" class="register-input" value="<?php echo $occupation ?>" placeholder = "Occupation" >
	    <input type="email" name="email" class="register-input" value = "<?php echo $email ?>" placeholder="Email">
	    <input type="text" name="username" class="register-input" value="<?php echo $username ?>" placeholder="Username">
	    <input type="submit" name="edit" value="Edit" class="register-button">

	 </form>  
	 <div class="space"></div>
	</div>
</body>
</html>