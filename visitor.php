<?php 
require_once('db.php');
session_start();
if(!isset($_SESSION['fmb'])){
	// header('location :index.php ');
}
if(isset($_POST['submit'])){
	$cname = $_POST['complainant'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$location = $_POST['location'];
	$cdate = $_POST['date'];
	$category = $_POST['category'];
	$description = $_POST['description'];
	// $image = $_POST['image'];
	$newDate = date("Y-m-d", strtotime($cdate));
      
	$uploaddir = '\images\uploads/';
	$uploadfile = $uploaddir . basename($_FILES['image']['name']);
	$filename = basename($_FILES['image']['name']);
	echo __DIR__;
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
            $insert_complain = "INSERT INTO complain(cname,email,contact,location,cdate,category,description,image) values ('$cname','$email','$contact','$location','$newDate','$category','$description','$filename');";
                  }
        else{
            $insert_complain = "INSERT INTO complain(cname,email,contact,location,cdate,category,description) values ('$cname','$email','$contact','$location','$newDate','$category','$description');";
          }
            $insert_complain_result = mysqli_query($conn,$insert_complain);
            var_dump($insert_complain_result);
            if ($insert_complain_result > 0) {
              echo "<div class = 'container'><div class='alert alert-success alert-dismissable'>
                 <button type='button' class='close' data-dismiss='alert' 
                 aria-hidden='true'>&times;</button> File is added.</div></div>";
            } 
            else{
            	 echo "<div class = 'container'><div class='alert alert-danger alert-dismissable'>
                 <button type='button' class='close' data-dismiss='alert' 
                 aria-hidden='true'>&times;</button> File not added.</div></div>";
            }
           header("location:viewcomplaint.php");
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
					<a href="gallery.php">Search Complaint</a>
				</li>
				<li>
					<a href="index.php">Log Out</a>
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
						
						<!-- <input type="text" name="complainant" class ="register-input" required placeholder = "Full Name"><br>
						<input type="text" class ="register-input" name="email" id="email" required placeholder = "Email Address"><br>
						
						<input type="text" class ="register-input" name="contact" required Placeholder ="Contact Number"><br> -->
						
						<!-- <input type="text" class ="register-input" name="location" id="location" required placeholder = "Location"><br> -->
                  		<input type="date"  class ="register-input" name="date" required placeholder = "Date"><br>
                  		
						<select name="category" class ="register-input" id="category">
						<option value="category">Category</option>
							<option value="road">Road</option>
							<option value="garbage">Garbage</option>
							<option value="public">Public Disturbance</option>
						</select><br>
						<select name="category" class ="register-input" id="category">
						<option value="category">Purok</option>
							<option value="road">1</option>
							<option value="garbage">2</option>
							<option value="public">3</option>
							<option value="public">4</option>
							<option value="public">5</option>
							<option value="public">6</option>
							<option value="public">7</option>
							<option value="public">8</option>
						</select><br>
						
						<input type="text" class ="register-input" name="description" id="description" required placeholder = "Complaint Description"></textarea><br>
						
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