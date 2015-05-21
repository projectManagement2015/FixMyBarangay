<?php 
    session_start();
    date_default_timezone_set('Asia/Manila');
	require_once('db.php');
 
  	$official_id = $_SESSION['officialid'];
  	$position = $_SESSION['position'];


	if(isset($_POST['comment'])) {
		// var_dump($_POST);
		// win32_pause_service();
		$rid = $_SESSION['rid'];
		$body1 = $_POST['body'];
		$complaintID = $_POST['hidden'];
		$date = date('Y-m-d H:i:s ', time());
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
	<!-- <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> -->
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

<ul id="navigation">

		
				<li >
					<a href="adminhome.php">Home</a>
				</li>
				<li>
					<a href="complainants.php">List Of Complainants</a>
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
	<div class="body"  id="gallery">	
 	<form class = "searchname" action = "" method = "post">
		<input type = "text" name = "search" id = "search" placeholder required = "Search....">
		<select class = "select" name = "type">
			<option value = "description">Description</option>
			<option value = "Person In Charge">Person In Charge</option>
			<option value = "Complainant">Complainant</option>
		</select>
		<input type = "submit" name = "subsearch" id = "subsearch" value = "Submit">
	</form>
			<ul class="tabs">
				<li>
					<a href="roadcomments.php">Road </a>
				</li>
				<li>
					<a href="garbagecomments.php">Garbage</a>
				</li>
				<li>
					<a href="publiccomments.php">Public Disturbance</a>
				</li>
			</ul>
			<h1 style="color: #FFC947">View Complaints</h1>
						<?php 
                     
   if(isset($_POST['subsearch'])){
        $search_name = $_POST['search'];
        $option = $_POST['type'];
        if ($option=="Person In Charge") {

        	$query = "SELECT official_id FROM barangay_official WHERE name LIKE '%".$search_name."%'";
        	$result = mysqli_query($conn, $query);
        	$getResult = mysqli_fetch_assoc($result);

        	$official_id = $getResult['official_id'];
        	$query = "SELECT * FROM complaints WHERE official_id = $official_id;" ;
    		$result = mysqli_query($conn,$query);

        }elseif($option == "Complainant"){

        	$query = "SELECT rid FROM resident WHERE firstname LIKE '%".$search_name."%'";
        	$result = mysqli_query($conn, $query);
        	$getResult = mysqli_fetch_assoc($result);

        	$rid = $getResult['rid'];
        	$query = "SELECT * FROM complaints WHERE rid = $rid;" ;
    		$result = mysqli_query($conn,$query);

        }else{
        	$query = "SELECT * FROM complaints WHERE $option LIKE '%".$search_name."%'" ;
    		$result = mysqli_query($conn,$query);

        }
            if($row = mysqli_fetch_assoc($result)){
            	do {
            		// $query = "SELECT * FROM complaints";
                // $select_result = mysqli_query($conn,$query);
                // while($row = mysqli_fetch_assoc($select_result)){
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
                              

                  $residentResult = mysqli_query($conn, "SELECT * FROM resident WHERE rid = $rid");
                  $resrow = mysqli_fetch_assoc($residentResult);



     

                echo '<div style="height: auto"><div class="frame">';
				echo '<img src="./images/uploads/'.$row['image'].'" width="400px" height="250px"></div><br>';
				echo "<h3>Status:".$row['status'];
				// if ($row['status'] == 'Completed') {
				// 	echo "<h3>Date End:".$statrow['dateend'];
				// }
				echo "<h3>Person In-Charged:".$official;
				echo '<br><br><br><br><br><h1>'.$resrow['firstname']." ".$resrow['lastname'].'</h1>';

				echo '<div class="details">';
				echo '<h3>Details</h3>';
				// ako gi sulod ug table huehuehue 
				echo "<table>";
				echo "<tr><td>Category</td><td>: </td><td>".$row['category']."</td></tr>";
				echo "<tr><td>Location</td><td>: </td><td>".$row['location']."</td></tr>";
				echo "<tr><td>Desciption</td><td>: </td><td>".$row['description']."</td></tr>";
				echo "</table>";
				include('./pages/includecomment.php');
            	} while ($row = mysqli_fetch_assoc($result));
            }else{
            	echo "<script>alert('No results found');</script>";
            }
			               
            }?>
				<!-- <div id="pagination">
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
				</div> -->
			</div>
		</div>
	</div>
</body>
</html>