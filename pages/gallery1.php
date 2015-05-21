<?php 
    session_start();
	require_once('../db.php');
	if ($_SESSION['login']!=1) {
		header('location: ../index.php');
	}
	$sql = "SELECT * FROM complaints";
	$user_query = mysqli_query($conn,$sql);
	// var_dump($_SESSION);

	$name = $_SESSION['fname'];
	if($_POST) {
		// var_dump($_POST);

		if (isset($_POST['submitcomment'])) {
			$body = $_POST['comment'];
			$complainID = $_POST['hidden'];

			// echo $body;
			// win32_pause_service();

			$query = 'INSERT INTO comment VALUES (null, "'.$name.'", "'.$body.'", '.$complainID.')';
			$insert_comment = mysqli_query($conn,$query);
		}
		// echo mysqli_error($conn);
		// echo $query;

		if(isset($_POST['insert'])){
			$complainID = $_POST['hide'];
			$status = $_POST['status'];
			$person = $_POST['person'];
			$edate = $_POST['datedone'];
			$dateend=  date("Y-m-d", strtotime($edate));
			$query1 = "INSERT INTO stats(status,person,dateend, complainID) VALUES ('$status','$person','$dateend',$complainID);";
			echo $complainID;
			// win32_pause_service();
			$insert = mysqli_query($conn,$query1);
		}
		
		
	}

 ?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>FMB</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css">
</head>
<body1>	
	<div id="header">
		<div>
			<div id="logo">
				<a href="home.html"><img src="" alt=""></a>
			</div>
			<ul id="navigation">
				<li>
					<a href="adminhome.php">Home</a>
				</li>
				<li>
					<a href="viewcomplaints.php">Complaints</a>
				</li>
				<li>
					<a href="complainants.php">Complainants</a>
				</li>
				<li class="selected">
					<a href="gallery1.php">Gallery</a>
				</li>
				<li>
					<a href="adminlogin.php">Log Out</a>
				</li>
			<!-- 	<li>
					<a href="contact.html">Contact</a>
				</li> -->
			</ul>
		</div>
	</div>
	<div id="contents">
		<div>
			<div class="body"  id="gallery">
				<ul class="tabs">
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
                            $query = "SELECT * FROM complaints";
                            $select_result = mysqli_query($conn,$query);
                            while($row = mysqli_fetch_assoc($select_result)){
                              $complainID = $row['complainID'];
                              

                             	echo '<div style="height: auto"><div class="frame">';
								echo '<img src="./images/uploads/'.$row['image'].'" width="400px" height="250px"></div><br>';
								echo "<h4>STATUS:</h4>";
								echo "<form action='' method='post'	>";
								echo "<input type='radio' name='status' id='status' value='Pending'>Pending";
								echo "<input type='radio' name='status' id='status' value='Working'>Working";
								echo "<input type='radio' name='status' id='status' value='Done'>Done";
								echo "<h4>Person in Charge</h4>";
								echo "<input type='text' name='person' id='person'>";
								echo "<br><input type='date' name='datedone' id='datedone'>";
								echo "<input type='hidden' value='".$row['complainID']."' name='hide'/>";
								echo "<br><br><input type='submit' value='In Charge' name='insert' id='insert'>";
								echo "</form>";


								echo '<br><br><br><h2>'.$row['cname'].'</h2>';
								
								echo '<div class="details">';
								echo '<h3>Details</h3>';
								echo 'Category:'.$row['category'];
								echo '<br>Location:'.$row['location'];
								echo '<br>Desciption:'.$row['description'];
								echo '<div>';
								echo "<h3>Comments</h3>";
								$query = "SELECT * FROM comment WHERE complainID = ".$row['complainID'];
								// echo $query;
                            	$result = mysqli_query($conn,$query);
                            		while($rowc = mysqli_fetch_assoc($result)) {
                            			echo "<br> ".$rowc['name'].": ".$rowc['comments'];
                            		}
								 echo "</div>";

								echo "<form action='' method='post'>
								<input type='hidden' value='".$row['complainID']."' name='hidden'/>
								<textarea name='comment' rows='3'> </textarea>

								<input type='submit' name='submitcomment' value='Comment'>
								</form>";
									
								echo '</div></div>';
								

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