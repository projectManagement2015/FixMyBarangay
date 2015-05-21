<?php 
error_reporting(0);
 date_default_timezone_set('Asia/Manila');
//COMMENTS
								echo '<div id="commentsection">';
								echo '<h3><center>Comment Section</center></h3>';
								$query = "SELECT * FROM comment WHERE complaintID = ".$row['complaintID'];
                            	$result = mysqli_query($conn,$query);
                            	if (mysqli_num_rows($result) == 0) {
                            		echo "<h3>Be the first to comment!</h3>";
                            	}
                            	else {
                            		echo "<table class='table' id='commentTable'>";
								// echo '<tr><th>Name</th><th>Comment</th></tr>';
                            		while($rowc = mysqli_fetch_assoc($result)) {
                            			$rid = $rowc['rid'];
                            			$official_id = $rowc['official_id'];


                            			//retrieve the officials comments
                            			if ($official_id == 0) {
                            				$commentor = mysqli_query($conn, "SELECT CONCAT(CONCAT(`firstname`, ' '), `lastname`) FROM resident WHERE rid = ".$rowc['rid'].";");
                            				$comName = mysqli_fetch_row($commentor);
                            			}
                            			//retrieve the resident's comments
                            			else{
                            				$commentor = mysqli_query($conn, "SELECT name FROM barangay_official WHERE official_id = $official_id;");
                            				$comName = mysqli_fetch_row($commentor);                           				
                            			}
   	  			
                            			//comment pagwapo
                            			$current = getdate(time());
										$postStamp = strtotime($rowc['cdate']);
										$postDate = getdate($postStamp);
											if($current['year'] != $postDate['year']) {
												$x = $current['year'] - $postDate['year'];
												if($x == 1)
													$dateString = $x.' year ago';
												else
													$dateString = $x.' years ago';
											}
											else if($current['mon'] != $postDate['mon']) {
												$x = $current['mon'] - $postDate['mon'];
												if($x == 1)
													$dateString = $x.' month ago';
												else
													$dateString = $x.' months ago';
											}
											else if($current['mday'] != $postDate['mday']) {
												$x = $current['mday'] - $postDate['mday'];
												if($x == 1)
													$dateString = $x.' day ago';
												else
													$dateString = $x.' days ago';
											}
											else if($current['hours'] != $postDate['hours']) {
												$x =$current['hours'] - $postDate['hours'];
												if($x == 1)
													$dateString = $x.' hour ago';
												else
													$dateString = $x.' hours ago';
											}
											else if($current['minutes'] != $postDate['minutes']) {
												$x = $current['minutes'] - $postDate['minutes'] ;
												if($x == 1)
													$dateString = $x.' minute ago';
												else
													$dateString = $x.' minutes ago';
											}
											else {
												$dateString = 'just now';
											}

                            			echo " <tr style='background-color: E4F1FE; outline: thin solid;'><td style='font-weight: bold;'>".$comName[0]." <span style='font-size: 12px; color: #67809F; text-align: right; padding-left: 20px;'>Posted on  ".date("F d Y", strtotime($rowc['cdate']))."-<span style='color: #CF000F;'>".$dateString."</span></span></td><td style='font-size: 12px; position: relative; right: 440px; padding-top: 30px;'><br/><br /><i>".$rowc['body']."</i></td></tr>";
										// echo " <tr style='background-color: E4F1FE; outline: thin solid;'><td style='font-weight: bold;'>".$comName[0]." ".$comName[1]." <span style='font-size: 12px; color: #67809F; text-align: right; padding-left: 20px;'>Posted on  ".date("F d Y", strtotime($rowc['cdate']))."-<span style='color: #CF000F;'>".$dateString."</span></span></td><td style='font-size: 12px; position: relative; right: 440px; padding-top: 30px;'><br/><br /><i>".$rowc['body']."</i></td></tr>";
                            		}
								 echo "</table>";
                            	}

								if ($name != null) {
									echo "<form action='' method='post'id='commentform'>
									<h3>Add a comment</h3><br />
								<input type='hidden' value='".$row['complaintID']."' name='hidden'/>
								<textarea name='body' rows='5' style='width:100%; resize: none'> </textarea>
								";
									echo "<br /><input type='submit' class='btn btn-default' name='comment' value='Comment' style='float: right;'>
								</form>";
								}
								echo '</div></div></div>';

 ?>