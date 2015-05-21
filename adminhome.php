<?php 
	session_start();
	// if ($_SESSION['login']!=1) {
	// 	header('location: ../index.php');
	// }
	require 'db.php';
	$official_id = $_SESSION['officialid'];
	$position = $_SESSION['position'];	
 ?>
 
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Admin Home</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="header">
		<div>
			<div id="logo">
				<a href="index.html">
				<!-- <img src=""> --></a>
			</div>
			<ul id="navigation">
				<li >
					<a href="adminhome.php">Home</a>
				</li>
				<li>
					<a href="complainants.php">List Of Complainants</a>
				</li>
				<li>
					<a href="viewcomments.php">View Comments</a>
				</li>
				<li >
					<a href="adminofficials.php">Task</a>
				</li>
				<?php 
				echo "<li>";
				if($position == 'Captain') {
					echo "<a href='unassignedComplaints.php'>Unassigned Complaints</a>";
				}
				else{
					echo "<a href ='unassignedComplaints.php'>Update Status</a>";
				}
				echo "</li>";
				?> 
				<li>
					<a href="pages/logout.php">Log Out</a>
				</li>
				<!-- <li>
					<a href="index.php"></a>
				</li> -->
			</ul>
		</div>
	</div>
	<div id="contents">
		<div>
			<div class="body">
				<div id="adbox">
					<img src="images/captain.png" alt="Img" width="455px"> </a> </span>
					<div class="details">
						<h1>FIX_MY_BARANGAY<br></h1>
						<p>
							This will be an online system that will focus on providing the people the best way to fix their barangay.It is expected that through this system it will be possible to have a direct and effective way of helping the community.
						</p>
					</div>
				</div>
				<ul id="featured">
					<li>
						<div>
							<img src="images/mission.jpg" alt="Img"> <a href="index.html"></a>
						</div>
						<div class="details">
							<h4>Mission</h4>
							<p>
								Solving the needs of the general welfare through this management system.
							</p>
						</div>
					</li>
					<li class="bedroom">
						<div>
							<img src="images/vision.png" alt="Img"> <a href="index.html"></a>
						</div>
						<div class="details">
							<h4>Vision</h4>
							<p>
								Our vision is to put into action through programs all the complaints we received.
							</p>
						</div>
					</li>
					<li class="kitchen">
						<div>
							<img src="images/goal.jpg" alt="Img"> <a href="index.html"></a>
						</div>
						<div class="details">
							<h4>Goals</h4>
							<p>
								Goal of this system is to let everyone in the barangay be united.
							</p>
						</div>
					</li>
				</ul>
</body>
</html>