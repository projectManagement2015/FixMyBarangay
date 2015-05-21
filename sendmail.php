<?php
require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->SMTPDebug = 2;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'fmybarangay@gmail.com';                 // SMTP username
$mail->Password = 'gobones1234';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->From = 'fmybarangay@gmail.com';
$mail->FromName = 'FixMyBarangay';
$mail->addAddress('unknown_hbroker@yahoo.com', 'Joe User');     // Add a recipient
// $mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('fmybarangay@gmail.com', 'FMB');

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Complain Status';
$mail->Body = '<html><body>';
$mail->Body .= '<img src="http://i.memeful.com/media/post/0MxGVwL_700w_0.jpg" alt="FixMyBarangay" />';
$mail->Body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$mail->Body .= "<tr style='background: #eee;'><td><strong>Complainant Name:</strong> </td><td>Camilo</td></tr>";
$mail->Body .= "<tr><td><strong>Email:</strong> </td><td>gcjr005@gmail.com</td></tr>";
$mail->Body .= "<tr style='background: #eee;'><td><strong>Complaint Category:</strong> </td><td>Garbage</td></tr>";
$mail->Body .= "<tr><td><strong>Status:</strong> </td><td>Fixed</td></tr>";
$mail->Body .= "</table>";
$mail->Body .= "</body></html>";
// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>