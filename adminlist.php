<?php 
	session_start();
	require_once('db.php');
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
	<link rel="stylesheet" href="../css/style.css" type="text/css">
</head>
<body>
	

	
		<!-- </div>
	</div> -->
	<br>
	<br>
	<br>

	<div class="formtable">

		<br>
		<br>

		<h2 class="title">List of Officials</h2>
		<br>
		<br>
			<table class="table">

			<?php
				while ($row = mysqli_fetch_assoc($result)) {

					$official_id = $row['official_id'];
					$name = $row['name'];

					echo '<tr><td><a href="adminofficials.php?official_id='.$official_id.'">'.$name.'</td></tr></a>';
				}
				
				
			
			?>
			</table>



</div>



</body>
</html>