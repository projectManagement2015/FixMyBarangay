<?php 
require_once('db.php');
session_start();
if (
	$_SESSION['login']!=1) {
	header('location: index.php');
}
if(!isset($_SESSION['fmb'])){
	// header('location :index.php ');
}
if(isset($_POST['submit'])){
	$cid = $_SESSION['cid'];
	$purok = $_POST['purok'];
	$cdate = date('Y-m-d');
	$category = $_POST['category'];
	$description = $_POST['description'];


	$newDate = date("Y-m-d", strtotime($cdate));
      
	$uploaddir = '\images\uploads/';
	$uploadfile = $uploaddir . basename($_FILES['image']['name']);
	$filename = basename($_FILES['image']['name']);
	// echo __DIR__;
      if ($uploadfile != null) {
          // $image = addslashes(file_get_contents($file));
          // $image_name = addslashes($_FILES['image']['name']);
          // $image_size = getimagesize($file);
      		move_uploaded_file($_FILES['image']['tmp_name'], __DIR__.$uploadfile);

          // if ($image_size == false) {
          //   $image = null;
          //    echo "<div class = 'container'><div class='alert alert-danger alert-dismissable'>
          //        <button type='button' class='close' data-dismiss='alert' 
          //        aria-hidden='true'>&times;</button> The is not an image.</div></div>";

          // }
      }
      // else{
      //   $image = null;
      // }  

        if (!empty($filename)) {
            $insert_complain = "INSERT INTO complain(purok,cdate,category,description,image, cid) values ('$purok','$newDate','$category','$description','$filename',$cid);";
            }
        else{
            $insert_complain = "INSERT INTO complain(purok,cdate,category,description) values ('$purok','$newDate','$category','$description',null, $cid);";
          }
            $insert_complain_result = mysqli_query($conn,$insert_complain);
            // var_dump($insert_complain_result);
            if ($insert_complain_result > 0) {
              // echo "<div class = 'container'><div class='alert alert-success alert-dismissable'>
              //    <button type='button' class='close' data-dismiss='alert' 
              //    aria-hidden='true'>&times;</button> File is added.</div></div>";
            	echo "<script>alert('Complain submitted succesfully!')</script>";
            } 
            else{
            	 // echo "<div class = 'container'><div class='alert alert-danger alert-dismissable'>
              //    <button type='button' class='close' data-dismiss='alert' 
              //    aria-hidden='true'>&times;</button> File not added.</div></div>";
            	echo "Failed to submit complain!";
            }
           // header("location:viewcomplaint.php");
	}

 ?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Visitors Page</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
	<div id="header1">
		<div>
			<div id="logo">
				<a href="index.html"><img src="" alt=""></a>
			</div>
			<ul id="navigation">
				<li>
					<a href="index.php">Home</a>
				</li>
				<li class="selected">
					<a href="#">Visitor's Counter</a>
				</li>
				<li>
					<a href="javascript:void()">Complaints</a>
				</li>
				<li>
					<a href="javascript:void()">Gallery</a>
				</li>
				<li>
					<a href="logout.php">Log Out</a>
				</li>
			<!-- 	<li class="selected">
					<a href="contact.html">Contact</a>
				</li> -->
			</ul>
		</div>
	</div>
	<div id="contents">
		<div>
			<div class="body" id="contact">
				<!-- <div id="sidebar">
					<div class="body">
						<img src="" alt="">
						<div class="contact">
							<p>
								
							</p>
						</div>
					</div>
				</div> -->
				<div id="main">
					<h1>Visitor's Counter</h1>
					<p>
						This page allows the complainants to post and upload photos of their barangay's problems.
					</p>
					<form action="" method="post" enctype="multipart/form-data" class="vcounter">
                  		
						<select name="category" class ="register-input" id="category">
						<option value="category">Category</option>
							<option value="road">Road</option>
							<option value="garbage">Garbage</option>
							<option value="public">Public Disturbance</option>
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
						<input type="submit" name="submit" id="submit" value="File Complaint" class="btn1">

					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>