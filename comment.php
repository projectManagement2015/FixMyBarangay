<?php 
require_once('db.php');
session_start();
if(!isset($_SESSION['fmb'])){
	// header('location :index.php ');
}

if (isset($_GET['complainID'])) {
	$_SESSION['complainID'] = $_GET['complainID'];
}
if(isset($_POST['comment'])){
	$cname = $_POST['cname'];
	$comments = $_POST['comments']; 

       
            $insert_complain = "INSERT INTO comment VALUES (NULL, '$cname', '$comments', ".$_SESSION['complainID'].");";
  
            $insert_complain_result = mysqli_query($conn,$insert_complain);
   //          echo mysqli_error($conn);
			// var_dump($insert_complain);

            var_dump($insert_complain_result);
            // win32_pause_service();
            if ($insert_complain_result > 0) {
              echo "<div class = 'container'><div class='alert alert-success alert-dismissable'>
                 <button type='button' class='close' data-dismiss='alert' 
                 aria-hidden='true'>&times;</button> Comment is added.</div></div>";
            } 
            else{
            	 echo "<div class = 'container'><div class='alert alert-danger alert-dismissable'>
                 <button type='button' class='close' data-dismiss='alert' 
                 aria-hidden='true'>&times;</button> Comment not added.</div></div>";
            }
            header("location:viewcomplaint.php");
	}

 ?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>FMB</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="header1">
		<div>
			<div id="logo">
				<a href="index.php"><img src="" alt=""></a>
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
					<h1>Comment/Suggestion</h1>
					<p>
						This page allows the complainants to comment or suggest solution to the other complaints.
					</p>
					<form action="" method="post" enctype="multipart/form-data">
						<label>Name</label>
						<input type="text" name="cname" id="cname" required>
						<label>Comment</label>
						<textarea name="comments" id="comments"></textarea>
						
						<input type="submit" name="comment" id="comment" value="Comment" class="btn1">

					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>