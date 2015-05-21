<?php 
	session_start();
	require_once("../db.php");
	if ($_SESSION['login']!=1) {
		header('location: ../index.php');
	}

	if (isset($_GET['edit'])) {
		if ($_GET['edit']==1) {
			echo "<script>alert('Profile has been modified.');</script>";
		}
	}
	if (isset($_GET['edit'])) {
		if ($_GET['edit']==0) {
			echo "<script>alert('Failed to update profile.');</script>";
		}
	}

	$rid = $_SESSION['rid'];

	$query = "SELECT * FROM resident WHERE rid = $rid;";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$name = $row['firstname']." ".$row['lastname'];
	$purok = "Purok ".$row['purok'];
	$time = strtotime($row['birthdate']);
    $bdate =  date("F d Y",$time);
    $occupation = $row['occupation'];
    $email = $row['email'];
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css" type="text/css">
</head>
<body>
	<?php
		include("nav.php");
	 ?>
	<div id="profile">
		<div id="prof">
			<div class="profdetails">
				<div id="img">
					<img src="../images/1.jpg" alt="..." class="img-circle">
				</div>
			</div>
			<div class="profdetails">
				<div id="det"> 
					<?php 
						echo "<h2>$name</h2>";
						echo "$email<br>";
						echo "$bdate<br>";
						echo "$purok<br>";
						echo "$occupation<br>";
					 ?>
				</div>	
			</div>
			<span id="editprof"><a href="editprofile.php?rid=<?php echo $rid; ?>"><img src="../images/edit.png" width="20px" height="20px"></a></span>
			<div id="complains">
			<h2><center><b>My Complains</b></center></h2>
			<div class="table-responsive">
		    <table id="example" class="table">
		        <thead>
		        <tr>
		        	<th>Image</th>
			        <th>Category</th>
			        <th>Description</th>
			        <th id="date">Date</th>
			        <th>Location</th>
			        <th>Status</th>
		        	<!-- <th></th> -->
		      </tr>
		      </thead>   
		      <tbody>
		        <?php
		          $query = "SELECT * FROM complaints WHERE rid = $rid;";
		          $select_result = mysqli_query($conn,$query);
		          while($row = mysqli_fetch_assoc($select_result)){
		          $complaintID = $row['complaintID'];

		          echo "<tr>";
		          if ($row['image'] != null) {
		              echo "<td><img alt='' width='100px' height='100px' src='../images/uploads/".$row['image']."'></td>";
		          }
		          else{
		              echo "<td><img src='http://placehold.it/800x500' alt='' width='100px' height='100px'></td>";
		          }                              
		          echo "<td>".$row['category']."</td>";
		          echo "<td>".$row['description']."</td>";
		          // echo "<td>".$row['email']."</td>";
		          // echo "<td>".$row['contact']."</td>";
		          $time = strtotime($row['cdate']);
		          $date =  date("F d Y",$time);
		          echo "<td>".$date."</td>";
		                              
		          echo "<td>".$row['location']."</td>"; 
		          echo "<td>".$row['status']."</td>"; 
		          // echo "<td>".$row['person']."</td>";
		          // echo "<td><a href='comment.php?complaintID=".$complaintID."'><image src='../images/i.jpg'></i></td>";                               
		          echo "</tr>";
		        }                  
		        ?>
		        </tbody>
		        </table>
		        </div>
			</div>
		</div>
	</div>
</html>