<?php 
    session_start();
    date_default_timezone_set('Asia/Manila');
	require_once('../db.php');
	if ($_SESSION['login']!=1) {
		header('location: ../index.php');
	}
	$sql = "SELECT * FROM complaints";
	$user_query = mysqli_query($conn,$sql);
	// var_dump($_SESSION);
	$sql1 = "SELECT * FROM stats";
	$user_query = mysqli_query($conn,$sql1);

	$name = $_SESSION['firstname']." ".$_SESSION['lastname'];
	if(isset($_POST['comment'])) {
		// var_dump($_POST);
		// win32_pause_service();
		$rid = $_SESSION['rid'];
		$body1 = $_POST['body'];
		$complaintID = $_POST['hidden'];
		$date = date('Y-m-d H:i:s', time());
		if ($body1 != " ") {
		$query = "INSERT INTO comment(body,cdate, rid,complaintID) VALUES ( '$body1', '$date', '$rid', $complaintID );";
		$insert_comment = mysqli_query($conn,$query);

		// echo $query;
		// win32_pause_service();

		if ($insert_comment>0) {
			
		}else{
			echo "<script>alert('Failed to post comment.');</script>";
		}
			
		}
		else {
			echo "<script>alert('Please enter a comment.');</script>";
		}
		// echo mysqli_error($conn);
		// echo $query;
	}
 ?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>FMB</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css">
</head>
<body>
	<?php 
		include('nav.php');
	 ?>
	<div id="contents">
		<div>
			<div class="body"  id="gallery">
				<ul class="tabs">
				<li>
					<a href = "gallery.php">Search</a>
				</li>
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
                            $query = "SELECT * FROM complaints WHERE category ='Road'";
                            $select_result = mysqli_query($conn,$query);
                            while($row = mysqli_fetch_assoc($select_result)){
                              $official_id = $row['official_id'];
                              $rid = $row['rid'];

                              $sql = "SELECT * FROM barangay_official WHERE official_id = $official_id";
                              $res = mysqli_query($conn, $sql);
                              if (is_bool($res)) {
                              	$official = "'Not yet assigned'";
                              }
                              else{
                              	$offrow = mysqli_fetch_assoc($res);
                              	$official = $offrow['name'];	
                              }
                              

                              $result = mysqli_query($conn, "SELECT * FROM resident WHERE rid = $rid");
                              $resrow = mysqli_fetch_assoc($result);

                             	echo '<div style="height: auto"><div class="frame">';
								echo '<img src="./images/uploads/'.$row['image'].'" width="400px" height="250px"></div><br>';
								echo "<h3>Status:".$row['status'];
								echo "<h3>Person In-Charged:".$offrow['name'];

								echo '<br><br><br><br><br><h1>'.$resrow['firstname']." ".$resrow['lastname'].'</h1>';

								
								echo '<div class="details">';
								echo '<h3>Details</h3>';
								// ako gi sulod ug table huehuehue 
								echo "<table>";
								echo "<tr><td>Category</td><td>: </td><td>".$row['category']."</td></tr>";
								echo "<tr><td>Location</td><td>: </td><td>".$row['location']."</td></tr>";
								echo "<tr><td>Desciption</td><td>: </td><td>".$row['description']."</td></tr>";
								echo "</table>";
								
								include('includecomment.php');

                            }
                            
                        ?>
				
				<div id="pagination">
					<a href="../gallery.html" class="previous">Previous</a>
					<a href="../gallery.html" class="next">Next</a>
					<ul>
						<li>
							Pages:
						</li>
						<li class="selected">
							<a href="road.php">1</a>
						</li>
						<li>
							<a href="public.php">2</a>
						</li>
						<li>
							<a href="garbage.php">3</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</body>
</html>