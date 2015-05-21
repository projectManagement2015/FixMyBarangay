<?php 
	require_once("../db.php");
	session_start();

	function getComplaints($purok){
		global $conn;
		$query = "SELECT location, cdate, category, description, status, rid FROM complaints WHERE location = '$purok' ORDER BY cdate DESC;";
		$result = mysqli_query($conn, $query);
		return $result;

	}

	function getResident($rid){
		global $conn;
		$query = "SELECT firstname, lastname FROM resident WHERE rid = $rid;";
		$result = mysqli_query($conn,$query);
		return $result;
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Map View</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<?php 
		include("nav.php");
	 ?>

	<div id="profile">
	<div class="space"></div>
	<h1 style="font-size:28px;"><center><b>Ward 4 Minglanilla Cebu</b></center></h1>
		<div id="formap">
			<img src="../images/ward4.png" id="map">
			<span id="purok1" class="pin"><div class="purokname">purok 1</div><a href="javascript:void()"><img src="../images/location.png"></a></span>
		 	<span id="purok2" class="pin"><div class="purokname">purok 2</div><a href="javascript:void()"><img src="../images/location.png"></a></span>
		 	<span id="purok3" class="pin"><div class="purokname">purok 3</div><a href="javascript:void()"><img src="../images/location.png"></a></span>
		 	<span id="purok4" class="pin"><div class="purokname">purok 4</div><a href="javascript:void()"><img src="../images/location.png"></a></span>
		 	<span id="purok5" class="pin"><div class="purokname">purok 5</div><a href="javascript:void()"><img src="../images/location.png"></a></span>
		 	<span id="purok6" class="pin"><div class="purokname">purok 6</div><a href="javascript:void()"><img src="../images/location.png"></a></span>
		 	<span id="purok7" class="pin"><div class="purokname">purok 7</div><a href="javascript:void()"><img src="../images/location.png"></a></span>
		 	<span id="purok8" class="pin"><div class="purokname">purok 8</div><a href="javascript:void()"><img src="../images/location.png"></a></span>

		 	<div id="showcomplaint1" class="showcomplaint">
		 		<table class="table">
		 			<tr><td>Date</td><td>Category</td><td>Purok</td><td>Complaint</td><td>Complainant</td></tr>
		 			<?php 
		 				$result = getComplaints("Purok 1");
		 				if (!$row = mysqli_fetch_assoc($result)) {
		 					echo "<tr><td colspan='5' align='center'>No Complaints yet.</td></tr>";
		 				}else{
			 				do {
			 					$rid = $row['rid'];
			 					$resident = mysqli_fetch_assoc(getResident($rid));
			 					echo "<tr><td>".date("F d, Y",strtotime($row['cdate']))."</td><td>".$row['category']."</td><td>".$row['location']."</td><td>".$row['description']."</td><td>".$resident['firstname']." ".$resident['lastname']."</td></tr>";
			 				}while ($row = mysqli_fetch_assoc($result));
		 				}
		 			 ?>
		 		</table>
		 	</div>
		 	<div id="showcomplaint2" class="showcomplaint">
		 		<table class="table">
		 			<tr><td>Date</td><td>Category</td><td>Purok</td><td>Complaint</td><td>Complainant</td></tr>
		 			<?php 
		 				$result = getComplaints("Purok 2");
		 				if (!$row = mysqli_fetch_assoc($result)) {
		 					echo "<tr><td colspan='5' align='center'>No Complaints yet.</td></tr>";
		 				}else{
			 				do {
			 					$rid = $row['rid'];
			 					$resident = mysqli_fetch_assoc(getResident($rid));
			 					echo "<tr><td>".date("F d, Y",strtotime($row['cdate']))."</td><td>".$row['category']."</td><td>".$row['location']."</td><td>".$row['description']."</td><td>".$resident['firstname']." ".$resident['lastname']."</td></tr>";
			 				}while ($row = mysqli_fetch_assoc($result));
		 				}
		 			 ?>
		 		</table>
		 	</div>
		 	<div id="showcomplaint3" class="showcomplaint">
		 		<table class="table">
		 			<tr><td>Date</td><td>Category</td><td>Purok</td><td>Complaint</td><td>Complainant</td></tr>
		 			<?php 
		 				$result = getComplaints("Purok 3");
		 				if (!$row = mysqli_fetch_assoc($result)) {
		 					echo "<tr><td colspan='5' align='center'>No Complaints yet.</td></tr>";
		 				}else{
			 				do {
			 					$rid = $row['rid'];
			 					$resident = mysqli_fetch_assoc(getResident($rid));
			 					echo "<tr><td>".date("F d, Y",strtotime($row['cdate']))."</td><td>".$row['category']."</td><td>".$row['location']."</td><td>".$row['description']."</td><td>".$resident['firstname']." ".$resident['lastname']."</td></tr>";
			 				}while ($row = mysqli_fetch_assoc($result));
		 				}
		 			 ?>
		 		</table>
		 	</div>
		 	<div id="showcomplaint4" class="showcomplaint">
		 		<table class="table">
		 			<tr><td>Date</td><td>Category</td><td>Purok</td><td>Complaint</td><td>Complainant</td></tr>
		 			<?php 
		 				$result = getComplaints("Purok 4");
		 				if (!$row = mysqli_fetch_assoc($result)) {
		 					echo "<tr><td colspan='5' align='center'>No Complaints yet.</td></tr>";
		 				}else{
			 				do {
			 					$rid = $row['rid'];
			 					$resident = mysqli_fetch_assoc(getResident($rid));
			 					echo "<tr><td>".date("F d, Y",strtotime($row['cdate']))."</td><td>".$row['category']."</td><td>".$row['location']."</td><td>".$row['description']."</td><td>".$resident['firstname']." ".$resident['lastname']."</td></tr>";
			 				}while ($row = mysqli_fetch_assoc($result));
		 				}
		 			 ?>
		 		</table>
		 	</div>
		 	<div id="showcomplaint5" class="showcomplaint">
		 		<table class="table">
		 			<tr><td>Date</td><td>Category</td><td>Purok</td><td>Complaint</td><td>Complainant</td></tr>
		 			<?php 
		 				$result = getComplaints("Purok 5");
		 				if (!$row = mysqli_fetch_assoc($result)) {
		 					echo "<tr><td colspan='5' align='center'>No Complaints yet.</td></tr>";
		 				}else{
			 				do {
			 					$rid = $row['rid'];
			 					$resident = mysqli_fetch_assoc(getResident($rid));
			 					echo "<tr><td>".date("F d, Y",strtotime($row['cdate']))."</td><td>".$row['category']."</td><td>".$row['location']."</td><td>".$row['description']."</td><td>".$resident['firstname']." ".$resident['lastname']."</td></tr>";
			 				}while ($row = mysqli_fetch_assoc($result));
		 				}
		 			 ?>
		 		</table>
		 	</div>
		 	<div id="showcomplaint6" class="showcomplaint">
		 		<table class="table">
		 			<tr><td>Date</td><td>Category</td><td>Purok</td><td>Complaint</td><td>Complainant</td></tr>
		 			<?php 
		 				$result = getComplaints("Purok 6");
		 				if (!$row = mysqli_fetch_assoc($result)) {
		 					echo "<tr><td colspan='5' align='center'>No Complaints yet.</td></tr>";
		 				}else{
			 				do {
			 					$rid = $row['rid'];
			 					$resident = mysqli_fetch_assoc(getResident($rid));
			 					echo "<tr><td>".date("F d, Y",strtotime($row['cdate']))."</td><td>".$row['category']."</td><td>".$row['location']."</td><td>".$row['description']."</td><td>".$resident['firstname']." ".$resident['lastname']."</td></tr>";
			 				}while ($row = mysqli_fetch_assoc($result));
		 				}
		 			 ?>
		 		</table>
		 	</div>
		 	<div id="showcomplaint7" class="showcomplaint">
		 		<table class="table">
		 			<tr><td>Date</td><td>Category</td><td>Purok</td><td>Complaint</td><td>Complainant</td></tr>
		 			<?php 
		 				$result = getComplaints("Purok 7");
		 				if (!$row = mysqli_fetch_assoc($result)) {
		 					echo "<tr><td colspan='5' align='center'>No Complaints yet.</td></tr>";
		 				}else{
			 				do {
			 					$rid = $row['rid'];
			 					$resident = mysqli_fetch_assoc(getResident($rid));
			 					echo "<tr><td>".date("F d, Y",strtotime($row['cdate']))."</td><td>".$row['category']."</td><td>".$row['location']."</td><td>".$row['description']."</td><td>".$resident['firstname']." ".$resident['lastname']."</td></tr>";
			 				}while ($row = mysqli_fetch_assoc($result));
		 				}
		 			 ?>
		 		</table>
		 	</div>
		 	<div id="showcomplaint8" class="showcomplaint">
		 		<table class="table">
		 			<tr><td>Date</td><td>Category</td><td>Purok</td><td>Complaint</td><td>Complainant</td></tr>
		 			<?php 
		 				$result = getComplaints("Purok 8");
		 				if (!$row = mysqli_fetch_assoc($result)) {
		 					echo "<tr ><td colspan='5' align='center'>No Complaints yet.</td></tr>";
		 				}else{
			 				do {
			 					$rid = $row['rid'];
			 					$resident = mysqli_fetch_assoc(getResident($rid));
			 					echo "<tr><td>".date("F d, Y",strtotime($row['cdate']))."</td><td>".$row['category']."</td><td>".$row['location']."</td><td>".$row['description']."</td><td>".$resident['firstname']." ".$resident['lastname']."</td></tr>";
			 				}while ($row = mysqli_fetch_assoc($result));
		 				}
		 			 ?>
		 		</table>
		 	</div>
		</div>
		
		
	<div class="space"></div>
	</div>
	<script type="text/javascript" src="../js/jquery-2.0.3.min.js"></script>
	<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>