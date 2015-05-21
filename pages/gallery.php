<?php 
    session_start();
	require_once('../db.php');
	if ($_SESSION['login']!=1) {
		header('location: ../index.php');
	}
	$sql = "SELECT * FROM complaints";
	$user_query = mysqli_query($conn,$sql);
	// var_dump($_SESSION);
	$sql1 = "SELECT * FROM stats";
	$user_query = mysqli_query($conn,$sql1);

	$name = $_SESSION['firstname']." ".$_SESSION['lastname'];;
	if(isset($_POST['comment'])) {
		// var_dump($_POST);
		// win32_pause_service();
		$rid = $_SESSION['rid'];
		$body1 = $_POST['body'];
		$complaintID = $_POST['hidden'];
		$date = date('Y-m-d');
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
	<link rel="stylesheet" href="../css/style.css" type="text/css">
</head>
<body>
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
					<a href="road.php">Road </a>
				</li>
				<li>
					<a href="garbage.php">Garbage</a>
				</li>
				<li>
					<a href="public.php">Public Disturbance</a>
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
        	// print_r($result);
        	// win32_pause_service();

        	while ($getResult = mysqli_fetch_assoc($result)) {
	        	$official_id = $getResult['official_id'];
	        	$query = "SELECT * FROM complaints WHERE official_id = $official_id;" ;
	    		$complaintsRes = mysqli_query($conn,$query);
	    		include('includegallery.php');
			}
        }elseif($option == "Complainant"){

        	$query = "SELECT rid FROM resident WHERE firstname LIKE '%".$search_name."%'";
        	$result = mysqli_query($conn, $query);

        	while($getResult = mysqli_fetch_assoc($result)){
	        	$rid = $getResult['rid'];
	        	$query = "SELECT * FROM complaints WHERE rid = $rid;" ;
	    		$complaintsRes = mysqli_query($conn,$query);
	    		include('includegallery.php');
			}
        }else{
        	$query = "SELECT * FROM complaints WHERE $option LIKE '%".$search_name."%'" ;
    		$complaintsRes = mysqli_query($conn,$query);

    		include('includegallery.php');
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