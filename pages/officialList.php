<?php 
	session_start();
	require_once('../db.php');
	// error_reporting(E_ALL ^ E_NOTICE);
	
	if ($_SESSION['login']!=1) {
		header('location: ../index.php');
		
	}

	$query = "SELECT * FROM barangay_official;";
	$result = mysqli_query($conn, $query);

 ?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>List of Officials</title>

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css" type="text/css">
</head>
<body>
	<?php
		include("nav.php");
	 ?>

	<div class="formtable">

		<br>
		<br>

		<center><h2>List of Officials</h2></center>
		<br>
		<br>
			<table class="table1">

			<?php

				$query = "SELECT * FROM barangay_official ORDER BY name ASC;";

				$result = mysqli_query($conn, $query);

				while ($row = mysqli_fetch_assoc($result)) {

				
					$official_id = $row['official_id'];
					$name = $row['name'];
				

					echo '<tr><td><a href="?official_id='.$official_id.'">'.$name.'</td></tr></a>';
				}

			?>
			</table>
</div>

<?php 

	if (isset($_GET['official_id'])) {
		
	
	$official_id = $_GET['official_id'];
	
 	$result = mysqli_query($conn,"SELECT * FROM barangay_official WHERE official_id = $official_id;");
	
	$row = mysqli_fetch_assoc($result);

	$name = $row['name'];
	$position = $row['position'];

	$query = "SELECT * FROM barangay_official";
 	$result = mysqli_query($conn,$query);
 	$row = mysqli_fetch_assoc($result);
	?>

	<div id="profile">
		<div id="prof">
			
			<div class="profdetails">
				<div id="det"> 
					<?php 
						echo "<h2>".$name."</h2>";
						echo " ".$row['position']."<br>";
						
					 ?>
				</div>	
			</div>
			<!-- <span id="editprof"><a href="editprofile.php?rid=<?php echo $rid; ?>"><img src="../images/edit.png" width="20px" height="20px"></a></span> -->
			<div id="complains">
			<h2><center><b>Assigned Complains</b></center></h2>
			<div class="table-responsive">
		    <table id="example" class="table">
		        <thead>
		        <tr>
		        	<th>Image</th>
		        	<th>Category</th>
		        	<th>Description</th>
			        <th id="date">Complain Date</th>
					<th>Location</th>
			        <th>Status</th>

		        	<!-- <th></th> -->
		      </tr>
		      </thead>   

		      <tbody>
		        <?php 
		          $query = "SELECT * FROM complaints WHERE official_id = $official_id;";
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
		       
		          $time = strtotime($row['cdate']);
		          $date =  date("F d Y",$time);
		          echo "<td>".$date."</td>";
		                              
		          echo "<td>".$row['location']."</td>"; 
		          echo "<td>".$row['status']."</td>"; 
		                                        
		          echo "</tr>";
		        }                  
		        ?>
		        </tbody>
		        </table>
		        </div>
			</div>
		</div>
	</div>

<?php } ?>
		
</body>
</html>