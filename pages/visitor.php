<?php 
require_once('../db.php');
session_start();
if (
	$_SESSION['login']!=1) {
	header('location: ../index.php');
}
if(!isset($_SESSION['fmb'])){
	// header('location :index.php ');
}
if(isset($_POST['submit'])){
	$rid = $_SESSION['rid'];
	$purok = $_POST['purok'];
	$cdate = date('Y-m-d');
	$category = $_POST['category'];
	$description = $_POST['description'];

	$newDate = date("Y-m-d", strtotime($cdate));
      
	$uploaddir = "\images\uploads/";
	$uploadfile = $uploaddir . basename($_FILES['image']['name']);
	$filename = basename($_FILES['image']['name']);
	// echo __DIR__;
      if ($uploadfile != null) {
          // $image = addslashes(file_get_contents($file));
          // $image_name = addslashes($_FILES['image']['name']);
          // $image_size = getimagesize($file);
      		move_uploaded_file($_FILES['image']['tmp_name'], __DIR__.$uploadfile);
      }
      // else{
      //   $image = null;
      // }  

        if (!empty($filename)) {
            $insert_complain = "INSERT INTO complaints(location,cdate,category,description,image, status, rid) values ('$purok','$newDate','$category','$description','$filename', 'Pending','$rid');";
            }
        else{
            $insert_complain = "INSERT INTO complaints(location,cdate,category,description,status,rid) values ('$purok','$newDate','$category','$description','Pending', '$rid');";
          }
            $insert_complain_result = mysqli_query($conn,$insert_complain);
            if ($insert_complain_result > 0) {
            	echo "<script>alert('Complain submitted succesfully!')</script>";
            } 
            else{
            	echo "<script>alert('Failed to submit complaint.')</script>";
            }
           // header("location:viewcomplaint.php");
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Visitors Page</title>
	<link rel="stylesheet" href="../style.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<?php 
		include("nav.php");
	 ?>
	<div id="contents">
		<div>
			<div class="body" id="contact">
				<div id="main">
					<h1><center>Visitor's Counter</center></h1>
					<p>
						<center>This page allows the complainants to post and upload photos of their barangay's problems.</center>
					</p>
					<form action="" method="post" enctype="multipart/form-data" class="vcounter">
                  		
						<select name="category" class ="register-input" id="category">
						<option value="category">Category</option>
							<option value="Road">Road</option>
							<option value="Garbage">Garbage</option>
							<option value="Public Disturbance">Public Disturbance</option>
							<option value="Others">Others</option>
						</select><br>
						<select name="purok" class ="register-input" id="category">
						<option value="">Purok</option>
							<option value="Purok 1">1</option>
							<option value="Purok 2">2</option>
							<option value="Purok 3">3</option>
							<option value="Purok 4">4</option>
							<option value="Purok 5">5</option>
							<option value="Purok 6">6</option>
							<option value="Purok 7">7</option>
							<option value="Purok 8">8</option>
						</select><br>
						
						<textarea type="text" class ="register-input" name="description" id="description" required placeholder = "Complaint Description"></textarea><br>
						
						<input type="file" class ="register-input" name="image" id="image" required placeholder = "Image">
						<br><br>
						<center><input type="submit" name="submit" id="submit" value="File Complaint" class="btn1"></center>

					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>