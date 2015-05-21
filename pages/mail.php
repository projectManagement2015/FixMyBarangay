<?php 

//mailer
require 'phpmailer/PHPMailerAutoload.php';
	function sendWorking($complaintID,$status,$official_id,$edate) {
		$edate = date('F d, Y', strtotime($edate));
		$conn = mysqli_connect('localhost','root','') or die(mysqli_connect_error());
		$usedb = mysqli_select_db($conn,'fmb') or die(mysqli_error($conn));
		$query = "SELECT * FROM complaints WHERE complaintID = $complaintID";
        $select_result = mysqli_query($conn,$query);
        while($row = mysqli_fetch_assoc($select_result)){
          $rid = $row['rid'];
          $cdate = $row['cdate'];
          $cdate = date('F d, Y', strtotime($cdate));
		$cat = $row['category'];
		$desc = $row['description'];
		$loc = $row['location'];
      }
      //get Person-in-charge name
      $result = mysqli_query($conn, "SELECT * FROM barangay_official WHERE official_id = $official_id");
      $resrow = mysqli_fetch_assoc($result);
      $official = $resrow['name'];
      //resident ID
		$result = mysqli_query($conn, "SELECT * FROM resident WHERE rid = $rid");
		$resrow = mysqli_fetch_assoc($result);

		$mail = new PHPMailer;

	// $mail->SMTPDebug = 2;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'fmybarangay@gmail.com';                 // SMTP username
	$mail->Password = 'gobones1234';                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to

	$mail->From = 'fmybarangay@gmail.com';
	$mail->FromName = 'FixMyBarangay';
	// $mail->addAddress('ellen@example.com');               // Name is optional
	$mail->addReplyTo('fmybarangay@gmail.com', 'FMB');

	// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML
					//credentials
		$firstname = $resrow['firstname'];
		$lastname = $resrow['lastname'];
		$email = $resrow['email'];
						//e compare ang complaintID sa change status then query sa $row
		// $cdate = $row['cdate'];
		// $cat = $row['category'];
		// $desc = $row['description'];
		// $loc = $row['location'];
		// $status = $row['status'];
					$mail->addAddress($email, $firstname);     // Add a recipient
					$mail->Subject = 'Complain Status';
					$mail->Body = '<html><body>';
					$mail->Body .= '<p style="font-size: 19px;">Thank you for informing and making our barangay more environtment-friendly, secure and fun. This is to inform you the progress of your complaint.</p>';
					// $mail->Body .= '<img src="http://i.memeful.com/media/post/0MxGVwL_700w_0.jpg" alt="FixMyBarangay" />';
					$mail->Body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
					$mail->Body .= "<tr><td><strong>Complaint Date:</strong> </td><td>$cdate</td></tr>";  
					$mail->Body .= "<tr style='background: #eee;'><td><strong>Complainant Name:</strong> </td><td>$firstname $lastname</td></tr>";
					$mail->Body .= "<tr><td><strong>Category:</strong> </td><td>$cat</td></tr>";  
					$mail->Body .= "<tr style='background: #eee;'><td><strong>Description:</strong> </td><td>$desc</td></tr>";
					$mail->Body .= "<tr><td><strong>Location:</strong> </td><td>$loc</td></tr>";
					$mail->Body .= "<tr style='background: #eee;'><td><strong>Status:</strong> </td><td>$status</td></tr>";
					$mail->Body .= "<tr><td><strong>Date to fix:</strong> </td><td>$edate</td></tr>";
					$mail->Body .= "<tr style='background: #eee;'><td><strong>Person-In-Charge:</strong> </td><td>$official</td></tr>";  
					$mail->Body .= "</table>";
					$mail->Body .= "<p style='font-size: 25px;'>Please make our Barangay more environment-friendly,secure and fun by reporting again the issues you're encountering within our area. Thank you!</p>";
					$mail->Body .= "</body></html>";
					// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					if(!$mail->send()) {
						echo "<script>alert('Message could not be sent.')</script>";
						echo 'Mailer Error: ' . $mail->ErrorInfo;
					} else {
						echo "<script>alert('Success! An Email has been sent.')</script>";
						// header("location: adminhome.php");
					}
				}
	function sendDone($complaintID,$status,$official_id,$edate) {
		$edate = date('F d, Y', strtotime($edate));
		$conn = mysqli_connect('localhost','root','') or die(mysqli_connect_error());
		$usedb = mysqli_select_db($conn,'fmb') or die(mysqli_error($conn));
		$query = "SELECT * FROM complaints WHERE complaintID = $complaintID";
        $select_result = mysqli_query($conn,$query);
        while($row = mysqli_fetch_assoc($select_result)){
          $rid = $row['rid'];
          $cdate = $row['cdate'];
          $cdate = date('F d, Y', strtotime($cdate));
		$cat = $row['category'];
		$desc = $row['description'];
		$loc = $row['location'];
      }
      //get Person-in-charge name
      $result = mysqli_query($conn, "SELECT * FROM barangay_official WHERE official_id = $official_id");
      $resrow = mysqli_fetch_assoc($result);
      $official = $resrow['name'];
      //resident ID
		$result = mysqli_query($conn, "SELECT * FROM resident WHERE rid = $rid");
		$resrow = mysqli_fetch_assoc($result);

		$mail = new PHPMailer;

	// $mail->SMTPDebug = 2;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'fmybarangay@gmail.com';                 // SMTP username
	$mail->Password = 'gobones1234';                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to

	$mail->From = 'fmybarangay@gmail.com';
	$mail->FromName = 'FixMyBarangay';
	// $mail->addAddress('ellen@example.com');               // Name is optional
	$mail->addReplyTo('fmybarangay@gmail.com', 'FMB');

	// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML
					//credentials
		$firstname = $resrow['firstname'];
		$lastname = $resrow['lastname'];
		$email = $resrow['email'];
						//e compare ang complaintID sa change status then query sa $row
		// $cdate = $row['cdate'];
		// $cat = $row['category'];
		// $desc = $row['description'];
		// $loc = $row['location'];
		// $status = $row['status'];
					$mail->addAddress($email, $firstname);     // Add a recipient
					$mail->Subject = 'Complain Status';
					$mail->Body = '<html><body>';
					$mail->Body .= '<p style="font-size: 19px;">Thank you for informing and making our barangay more environtment-friendly, secure and fun. This is to inform you the progress of your complaint.</p>';
					// $mail->Body .= '<img src="http://i.memeful.com/media/post/0MxGVwL_700w_0.jpg" alt="FixMyBarangay" />';
					$mail->Body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
					$mail->Body .= "<tr><td><strong>Complaint Date:</strong> </td><td>$cdate</td></tr>";  
					$mail->Body .= "<tr style='background: #eee;'><td><strong>Complainant Name:</strong> </td><td>$firstname $lastname</td></tr>";
					$mail->Body .= "<tr><td><strong>Category:</strong> </td><td>$cat</td></tr>";  
					$mail->Body .= "<tr style='background: #eee;'><td><strong>Description:</strong> </td><td>$desc</td></tr>";
					$mail->Body .= "<tr><td><strong>Location:</strong> </td><td>$loc</td></tr>";
					$mail->Body .= "<tr style='background: #eee;'><td><strong>Status:</strong> </td><td>$status</td></tr>";
					$mail->Body .= "<tr><td><strong>Date fixed:</strong> </td><td>$edate</td></tr>";
					$mail->Body .= "<tr style='background: #eee;'><td><strong>Person-In-Charge:</strong> </td><td>$official</td></tr>";  
					$mail->Body .= "</table>";
					$mail->Body .= "<p style='font-size: 25px;'>Please make our Barangay more environment-friendly,secure and fun by reporting again the issues you're encountering within our area. Thank you!</p>";
					$mail->Body .= "</body></html>";
					// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					if(!$mail->send()) {
						echo "<script>alert('Message could not be sent.')</script>";
						echo 'Mailer Error: ' . $mail->ErrorInfo;
					} else {
						echo "<script>alert('Success! An Email has been sent.')</script>";
						// header("location: adminhome.php");
					}
				}



				?>