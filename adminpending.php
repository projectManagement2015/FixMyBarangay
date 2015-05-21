<?php 

	session_start();
	require_once("db.php");
 
  	$official_id = $_SESSION['officialid'];
  	$position = $_SESSION['position'];
 ?>


<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>Officials</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css" type="text/css">
<body>
	<div id="header">
		<div>
			<div id="logo">
				<a href="index.html">
				<!-- <img src=""> --></a>
			</div>
			<ul id="navigation">

<ul id="navigation">

		
				<li >
					<a href="adminhome.php">Home</a>
				</li>
				<li>
					<a href="complainants.php">List Of Complainants</a>
				</li>
				<li >
					<a href="../FixMyBarangay/pages/adminofficials.php">Task</a>
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
			<div class="body"  id="gallery">
				<ul class="tabs">
					<li >
						<a href="adminworking.php">Working </a>
					</li>
					<li class="selected">
						<a href="adminpending.php">Pending</a>
					</li>
					<li >
						<a href="admindone.php">Done</a>
					</li>
				</ul>
	



<br><br><br>
	
	
		<div id="prof">
			<div class="profdetails">
				<div id="img">
					<img src="../images/1.jpg" alt="" class="img-circle">
				</div>
			</div>
			<div class="profdetails">
				<div id="det">
				<?php 
						echo "<h2>".$_SESSION['name']."</h2>";
						echo $_SESSION['position'];
				?> 
				</div>	
			</div>
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



		        
		      $query = "SELECT * FROM complaints WHERE status = 'Pending' AND official_id = '$official_id'";
		      	

		          $select_result = mysqli_query($conn,$query);
				  while($row = mysqli_fetch_assoc($select_result)){
		          
		          $complaintID = $row['complaintID'];




 echo "<tr>";
                              if ($row['image'] != null) {
                                  echo "<td><img alt='' width='100px' height='100px' src='./images/uploads/".$row['image']."'></td>";
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

	<br>
	<br>
	<br>
	<br>
	<br>


</div>
</div>
</div>


</body>
</html>