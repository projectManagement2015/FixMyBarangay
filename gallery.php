<?php 
    session_start();
	require_once('db.php');
	$sql = "SELECT * FROM complain";
	$user_query = mysqli_query($conn,$sql);
	// var_dump($_SESSION);
	$sql1 = "SELECT * FROM stats";
	$user_query = mysqli_query($conn,$sql1);

	$name = $_SESSION['fname'];
	if($_POST) {
		// var_dump($_POST);

		$body1 = $_POST['comment'];
		$complainID = $_POST['hidden'];
		if ($body1 != " ") {
		$query = 'INSERT INTO comment VALUES (null, "'.$name.'", "'.$body1.'", '.$complainID.' , '.date("Y-m-d").')';
		$insert_comment = mysqli_query($conn,$query);
			
		}
		else {
			echo "<script>alert('Empty oi!');</script>";
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
	<link rel="stylesheet" href="css/style.css" type="text/css">

</head>
<body>
	<div id="header">
		<div>
			<div id="logo">
				<a href="index.html"><img src="" alt=""></a>
			</div>
			<ul id="navigation">
				<li>
					<a href="home.php">Home</a>
				</li>
				<li>
					<a href="visitor.php">Visitor's Counter</a>
				</li>
				<li class="selected">
					<a href="gallery.php">Gallery</a>
				</li>
				<?php 
				if ($_SESSION['fname'] != NULL) {
					echo "<li>
					<a href='index.php'>Log Out</a>
				</li>";
				}
				else {
					echo "<li>
					<a href='index.php'>Log In</a>
				</li>";
				}
				?>
				<!-- <li>
					<a href="index.php">Log Out</a>
				</li> -->
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
				<h1 style="color: #FFC947">Gallery</h1>
				
					
						<?php
                            $query = "SELECT * FROM complain";
                            $select_result = mysqli_query($conn,$query);
                            while($row = mysqli_fetch_assoc($select_result)){
                              $complainID = $row['complainID'];

                              	$sql = "SELECT * FROM stats  WHERE complainID= $complainID";
								$retval = mysqli_query($conn, $sql);
								$statrow = mysqli_fetch_assoc($retval);
								//$status = $row['status'];


                             

                             	echo '<div style="height: auto"><div class="frame">';
								echo '<img src="./images/uploads/'.$row['image'].'" width="400px" height="250px"></div><br>';
								echo "<h3>Status:".$statrow['status'];
								if ($statrow['status'] == 'Done') {
									echo "<h3>Date End:".$statrow['dateend'];
								}
								echo "<h3>Person In-Charged:".$statrow['person'];

								echo '<br><br><br><br><br><h1>'.$row['cname'].'</h1>';

								
								echo '<div class="details">';
								echo '<h3>Details</h3>';
								echo 'Category:'.$row['category'];
								echo '<br>Location:'.$row['location'];
								echo '<br>Desciption:'.$row['description'];
								echo '<div>';
								echo '<h3>Comment Section</h3>';
								$query = "SELECT * FROM comment WHERE complainID = ".$row['complainID'];
								// echo $query;	
                            	$result = mysqli_query($conn,$query);
                            	if (mysqli_num_rows($result) == 0) {
                            		echo "<h3>Be the first to comment!</h3>";
                            	}
                            	else {
                            		echo '<table class="table" border="0">';
								echo '<tr><th>Name</th><th>Comment</th></tr>';
                            		while($rowc = mysqli_fetch_assoc($result)) {
                            			echo " <tr align='center' style='background-color: E4F1FE;'><td>".$rowc['name']."</td><td> <i>".$rowc['comments']."</i><br /><p style='font-size: 12px; text-align: right; padding-right: 15px;'>Posted on  ".$rowc['date']."</p></td></tr>";
                            		}
								 echo "</table></div>";
                            	}
								if ($name != null) {
									echo "<form action='' method='post'	>
									<h3>Add a comment</h3><br />
								<input type='hidden' value='".$row['complainID']."' name='hidden'/>
								<textarea name='comment' rows='5' style='width:100%; resize: none'> </textarea>
								";
									echo "<br /><input type='submit' name='submit' value='Comment' style='float: right;'>
								</form>";
								}
								echo '</div></div>';
								

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