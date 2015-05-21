<?php 
    session_start();
	require_once('db.php');
	if ($_SESSION['login']!=1) {
		header('location: index.php');
	}
	$sql = "SELECT * FROM complaints";
	$user_query = mysqli_query($conn,$sql);
	
	if($_POST) {
		

		if(isset($_POST['insert'])){
			$complaintID = $_POST['hide'];
			$status = $_POST['status'];
			$official_id = $_POST['official_id'];
			$edate = $_POST['datedone'];
			$dateend=  date("Y-m-d", strtotime($edate));
			$query1 = "UPDATE complaints set status='$status',official_id=$official_id,dateend='$dateend' WHERE complaintID=$complaintID;";
			//echo $complaintID;
			// win32_pause_service();
			$insert = mysqli_query($conn,$query1);
		}
		if ($insert ==1) {
			echo "<script>alert('Successfully Assigned Task');</script>";
		}
		
	}

 ?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>Assigned Complaints</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body1>	
	<div id="header">
		<div>
			<div id="logo">
				<a href="index.html"><img src="" alt=""></a>
			</div>
			<ul id="navigation">
				<li >
					<a href="adminhome.php">Home</a>
				</li>
				<li>
					<a href="complainants.php">List Of Complainants</a>
				</li>
				<li >
					<a href="">Task/a>
				</li>
				<li>
					<a href="assignedComplaints.php">Assigned Complaints</a>
				</li> 
				<li>
					<a href="unassignedComplaints.php">Unassigned Complaints</a>
				</li>
				<li>
					<a href="index.php">Log Out</a>
				</li>
				<!-- <li>
					<a href="index.php"></a>
				</li> -->
			</ul>
		</div>
	</div>
	<div id="contents">
		<div>
			<div class="body"  id="gallery">
				<ul class="tabs">
					<li class="selected">
						<a href="road.php">Road </a>
					</li>
					<li>
						<a href="garbage.php">Garbage</a>
					</li>
					<li>
						<a href="public.php">Public Disturbance</a>
					</li>
				</ul>
				<h1>Gallery</h1>
				
					
						<?php
                            $query = "SELECT * FROM complaints";
                            $select_result = mysqli_query($conn,$query);
                            while($row = mysqli_fetch_assoc($select_result)){
                              $complaintID = $row['complaintID'];
                              $rid = $row['rid'];
                              $official_id = $row['official_id'];
                              
                              if(!empty($row['official_id'])){

                              $result = mysqli_query($conn, "SELECT * FROM resident WHERE rid = $rid");
                              $resrow = mysqli_fetch_assoc($result);


							   $result1 = mysqli_query($conn, "SELECT * FROM barangay_official WHERE official_id = $official_id");
                               $offrow = mysqli_fetch_assoc($result1);
								
								echo '<div style="height: auto"><div class="frame">';
								echo '<img src="./images/uploads/'.$row['image'].'" width="400px" height="250px"></div><br>';
								echo "<h3>Status: ".$row['status'];
								
								echo "<h3>Person In-Charged: ".$offrow['name'];
								echo "<h3>Date End: ".$row['dateEnd'];
								echo '<br><br><br><br><br><h1>'.$resrow['firstname']." ".$resrow['lastname'].'</h1>';



								echo '<div class="details">';
								echo '<h3>Details</h3>';
							
								echo "<table>";
								echo "<tr><td>Category</td><td>: </td><td>".$row['category']."</td></tr>";
								echo "<tr><td>Location</td><td>: </td><td>".$row['location']."</td></tr>";
								echo "<tr><td>Desciption</td><td>: </td><td>".$row['description']."</td></tr>";
								echo "</table>";
								
								
								}


                            }
                            
                        ?>
				
				<div id="pagination">
					<a href="assignedComplaints.php" class="previous">Previous</a>
					<a href="assignedComplaints.php" class="next">Next</a>
					<ul>
						<li>
							Pages:
						</li>
						<li class="selected">
							<a href="pages/road.php">1</a>
						</li>
						<li>
							<a href="pages/public.php">2</a>
						</li>
						<li>
							<a href="pages/garbage.php">3</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
