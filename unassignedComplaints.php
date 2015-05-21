<?php 
    session_start();
	require_once('db.php');
	include_once('pages/mail.php');
	$sql = "SELECT * FROM complaints";
	$user_query = mysqli_query($conn,$sql);
	$official_id = $_SESSION['officialid'];
	$position = $_SESSION['position'];
	
	if($_POST) {
		if(isset($_POST['insert'])){
			//echo $_POST['status'];
			$complaintID = $_POST['hide'];
			$status = $_POST['status'];
			$official_id = $_POST['official_id'];
			$edate = $_POST['datedone'];
			$dateend=  date("Y-m-d", strtotime($edate));
			// if ($status == 'Working') {
			// 	sendWorking();
			// }
			// elseif($status == 'Done') {
			// 	sendDone();
			// }
			$query1 = "UPDATE complaints SET status='$status',official_id=$official_id,dateend='$dateend' WHERE complaintID=$complaintID;";
			
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
					<a href="pages/logout.php">Log out</a>
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
						<a href="pages/public.php">Public Disturbance</a>
					</li>
				</ul>
				<h1>Gallery</h1>
						
						
					
						<?php
						if ($position == 'Counselor') {
						 $query = "SELECT * FROM complaints WHERE status != 'Done' AND official_id = $official_id";
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
								
									if ($row['status'] == 'Pending') {
										echo "<input type='radio' name='status'  value='Pending' checked>Pending";
										echo "<input type='radio' name='status'  value='Working'>Working";
										echo "<input type='radio' name='status'  value='Done'>Done";
									}
									elseif ($row['status'] == 'Working') {
										echo "<input type='radio' name='status'  value='Pending' >Pending";
										echo "<input type='radio' name='status'  value='Working' checked>Working";
										echo "<input type='radio' name='status'  value='Done'>Done";
									}
									else 
									{
										echo "<input type='radio' name='status'  value='Pending' >Pending";
										echo "<input type='radio' name='status'  value='Working' >Working";
										echo "<input type='radio' name='status'  value='Done' checked>Done";
									}
							if ($position == 'Captain') {
								echo "<h4>Person in Charge:  ";
								echo "<select name='official_id' id='official_id'";
									$query1 ="SELECT * from barangay_official ";
									$res = mysqli_query($conn,$query1);
									var_dump($res);
									// win32_pause_service();	
									while($offrow = mysqli_fetch_assoc($res)){
										if ($offrow['official_id'] == $official_id) {
											echo "<option selected value='".$offrow['official_id']."'>".$offrow['name']."</option>";
										}
										else
										echo "<option value='".$offrow['official_id']."'>".$offrow['name']."</option>";
									}
									echo"</select>";
							}
								echo "<h4>Date End:</h4>";
								
									if ($row['status'] == 'Done') {
										echo "<input type='date' value=".$row['dateend']."name='datedone' id='datedone' placeHolder='Year-Month-Day' readonly>";
										echo "<input type='hidden' value='".$row['complaintID']."' name='hide'/>";
										echo "<input type='submit' value='UPDATE' name='insert' id='insert'>";
									}
									else {
										echo "<input type='date' name='datedone' id='datedone' placeHolder='Year-Month-Day' required>";
										echo "<input type='hidden' value='".$row['complaintID']."' name='hide'/>";
										echo "<input type='submit' value='In Charge' name='insert' id='insert'>";
									}
								// echo "<input type='hidden' value='".$row['complaintID']."' name='hide'/>";
								// echo "<input type='submit' value='In Charge' name='insert' id='insert'>";
								echo "</form>";

						
								
								echo '<div class="details">';
								echo '<h3>Details</h3>';
								echo 'Category:'.$row['category'];
								echo '<br>Location:'.$row['location'];
								echo '<br>Desciption:'.$row['description'];
								echo '<div>';
						
								 echo "</div>	";

								
								
								}

                            } else{




                            $query = "SELECT * FROM complaints WHERE status != 'Done'";
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
								
									if ($row['status'] == 'Pending') {
										echo "<input type='radio' name='status'  value='Pending' checked>Pending";
										echo "<input type='radio' name='status'  value='Working'>Working";
										echo "<input type='radio' name='status'  value='Done'>Done";
									}
									elseif ($row['status'] == 'Working') {
										echo "<input type='radio' name='status'  value='Pending' >Pending";
										echo "<input type='radio' name='status'  value='Working' checked>Working";
										echo "<input type='radio' name='status'  value='Done'>Done";
									}
									else 
									{
										echo "<input type='radio' name='status'  value='Pending' >Pending";
										echo "<input type='radio' name='status'  value='Working' >Working";
										echo "<input type='radio' name='status'  value='Done' checked>Done";
									}
							if ($position == 'Captain') {
								echo "<h4>Person in Charge:  ";
								echo "<select name='official_id' id='official_id'";
									$query1 ="SELECT * from barangay_official ";
									$res = mysqli_query($conn,$query1);
									var_dump($res);
									// win32_pause_service();	
									while($offrow = mysqli_fetch_assoc($res)){
										if ($offrow['official_id'] == $official_id) {
											echo "<option selected value='".$offrow['official_id']."'>".$offrow['name']."</option>";
										}
										else
										echo "<option value='".$offrow['official_id']."'>".$offrow['name']."</option>";
									}
									echo"</select>";
							}
								echo "<h4>Date End:</h4>";
								
									if ($row['status'] == 'Done') {
										echo "<input type='date' value=".$row['dateend']."name='datedone' id='datedone' placeHolder='Year-Month-Day' readonly>";
										echo "<input type='hidden' value='".$row['complaintID']."' name='hide'/>";
										echo "<input type='submit' value='UPDATE' name='insert' id='insert'>";
									}
									else {
										echo "<input type='date' name='datedone' id='datedone' placeHolder='Year-Month-Day' required>";
										echo "<input type='hidden' value='".$row['complaintID']."' name='hide'/>";
										echo "<input type='submit' value='In Charge' name='insert' id='insert'>";
									}
								// echo "<input type='hidden' value='".$row['complaintID']."' name='hide'/>";
								// echo "<input type='submit' value='In Charge' name='insert' id='insert'>";
								echo "</form>";

						
								
								echo '<div class="details">';
								echo '<h3>Details</h3>';
								echo 'Category:'.$row['category'];
								echo '<br>Location:'.$row['location'];
								echo '<br>Desciption:'.$row['description'];
								echo '<div>';
						
								 echo "</div>	";

								
								
								}

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
