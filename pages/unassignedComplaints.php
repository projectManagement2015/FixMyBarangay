<?php 
    session_start();
	require_once('db.php');
	include_once('mail.php');
	$sql = "SELECT * FROM complaints";
	$user_query = mysqli_query($conn,$sql);
	
	if($_POST) {
		

		if(isset($_POST['insert'])){
			$complaintID = $_POST['hide'];
			$status = $_POST['status'];
			$official_id = $_POST['official_id'];
			$edate = $_POST['datedone'];
			$dateend=  date("Y-m-d", strtotime($edate));
			if ($status == 'Working') {
				sendWorking();
			}
			elseif($status == 'Done') {
				sendDone();
			}
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
	<title>Unassigned Complaints</title>
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
					<a href="yourcomplaints.php">Your Task</a>
				</li>
				<?php 
				$query1 ="SELECT * from barangay_official";
				$res = mysqli_query($conn,$query1);
				$or = mysqli_fetch_assoc($res);
				echo "<li>";
				if($or['position'] == 'Captain') {
					echo "<a href='unassignedComplaints.php'>Unassigned Complaints</a>";
				}
				else{
					echo "<a href ='unassignedComplaints.php'>Update Status</a>";
				}
				echo "</li>";
				?> 
				<li>
					<a href="index.php"></a>
				</li>
			</ul>
		</div>
	</div>
	<div id="contents">
		<div>
			<div class="body"  id="gallery">
				<ul class="tabs">
					<li class="selected">
						<a href="pages/road.php">Road </a>
					</li>
					<li>
						<a href="pages/garbage.php">Garbage</a>
					</li>
					<li>
						<a href="/pagespublic.php">Public Disturbance</a>
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
          

                             	echo '<div style="height: auto"><div class="frame">';
								echo '<img src="./images/uploads/'.$row['image'].'" width="400px" height="250px"></div><br>';
								$result = mysqli_query($conn, "SELECT * FROM resident WHERE rid = $rid");
                              	$resrow = mysqli_fetch_assoc($result);

								
								echo '<h1>'.$resrow['firstname']." ".$resrow['lastname'].'</h1>';
								echo "<form action='' method='post'	>";
								echo "<h4>STATUS:</h4>";
								echo "<input type='radio' name='status' id='status' value='Pending'>Pending";
								echo "<input type='radio' name='status' id='status' value='Working'>Working";
								echo "<input type='radio' name='status' id='status' value='Done'>Done";
								$query1 ="SELECT * from barangay_official";
								$res = mysqli_query($conn,$query1);
								$offrow = mysqli_fetch_assoc($res);
								if ($offrow['position'] == 'Captain') {
								echo "<h4>Person in Charge:  ";
								echo "<select name='official_id' id='official_id'";
									// $query1 ="SELECT * from barangay_official";
									// $res = mysqli_query($conn,$query1);
									var_dump($res);
									// win32_pause_service();	
									while($offrow = mysqli_fetch_assoc($res)){
										echo "<option value='".$offrow['official_id']."'>".$offrow['name']."</option>";
									}
									echo"</select>";
								}
								echo "<h4>Date End:</h4>";
								echo "<input type='date' name='datedone' id='datedone' placeHolder='Year-Month-Day'>";
								echo "<input type='hidden' value='".$row['complaintID']."' name='hide'/>";
								echo "<br><br><input type='submit' value='In Charge' name='insert' id='insert'>";
								echo "</form>";

						
								
								echo '<div class="details">';
								echo '<h3>Details</h3>';
								echo 'Category:'.$row['category'];
								echo '<br>Location:'.$row['location'];
								echo '<br>Desciption:'.$row['description'];
								echo '<div>';
						
								 echo "</div>	";

								
								


                            }
                            
                        ?>
				
				<div id="pagination">
					<a href="gallery.html" class="previous">Previous</a>
					<a href="gallery.html" class="next">Next</a>
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
