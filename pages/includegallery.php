<?php 
	if ($row = mysqli_fetch_assoc($complaintsRes)) {
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
								

				include('includecomment.php');
                 } while ($row = mysqli_fetch_assoc($complaintsRes));
	        }else{
	        	// echo "<script>alert('No result found!')</script>";
	        }  
 ?>