<?php 
require_once('../db.php');
session_start();
$found=false;
if (isset($_SESSION['login'])) {
  if ($_SESSION['login']==1) {
    header('location: home.php');
  }
}
if(isset($_POST['submit'])){
  $rid = $_POST['rid'];

  if (!is_numeric($rid)) {
    echo "<script>alert('ID must be numbers.');</script>"; 
  }
  else{
    $conn=mysqli_connect("localhost","root","");
    mysqli_select_db($conn,"fmb")or die(mysqli_error());

    $sql = "SELECT * FROM resident where rid = $rid";
    $result = mysqli_query ($conn, $sql);
    if (mysqli_num_rows($result)> 0) {
      while($row = mysqli_fetch_assoc($result)) {
        if ($row['active']==1) {
          echo "<script>alert('You are already registered. Please login to your account.');</script>";
        }else{
          $found = true;
          echo "<script>alert('Your ID is : " . $row["rid"] .'\n'." Please provide your username and password to register.".'\n'." Thank You!');</script>";
        }  
      }
    }  
    else {
        echo "<script>alert('You are not yet register in your baranagay');</script>";
    }
  }
}


 if(isset($_POST['register'])) {
  $rid = $_POST['rid'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password = hash("SHA512", $password);
  $conn=mysqli_connect("localhost","root","");
  mysqli_select_db($conn,"fmb")or die(mysqli_error());
  if(!$conn) 
   { die('Error : '.mysqli_error());}
 $sql = "UPDATE resident SET email='$email',username='$username',password='$password', active = 1 WHERE rid='$rid'";
  if(mysqli_query($conn,$sql)){
      $conn=mysqli_connect("localhost","root","");
  mysqli_select_db($conn,"fmb")or die(mysqli_error());
    $sql = "UPDATE resident SET email='$email',username='$username',password='$password', active = 1 WHERE rid='$rid'";
// //check db
//     $con=mysqli_connect("localhost","root","");
//      mysqli_select_db($con,"fmb")or die(mysqli_error());
//     $sqll= "SELECT * FROM resident WHERE $rid = rid";
//     $resultt = mysqli_query($con,$sqll);
//     if($_POST['rid'] == $rid)
//       {
//         while($row = mysqli_fetch_array($resultt)){
//           $firstname = $row['firstname'];
//           $lastname = $row['lastname'];
//           $bday = $row['birthdate'];}
//         }
// //mailer
// require '../phpmailer/PHPMailerAutoload.php';

// $mail = new PHPMailer;

// // $mail->SMTPDebug = 2;                               // Enable verbose debug output

// $mail->isSMTP();                                      // Set mailer to use SMTP
// $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
// $mail->SMTPAuth = true;                               // Enable SMTP authentication
// $mail->Username = 'fmybarangay@gmail.com';                 // SMTP username
// $mail->Password = 'gobones1234';                           // SMTP password
// $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
// $mail->Port = 465;                                    // TCP port to connect to

// $mail->From = 'fmybarangay@gmail.com';
// $mail->FromName = 'FixMyBarangay';
// $mail->addAddress($email, $firstname);     // Add a recipient
// // $mail->addAddress('ellen@example.com');               // Name is optional
// $mail->addReplyTo('fmybarangay@gmail.com', 'FMB');

// // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
// $mail->isHTML(true);                                  // Set email format to HTML

// $mail->Subject = 'Complain Status';
// $mail->Body = '<html><body>';
// $mail->Body .= '<p style="font-size: 19px;">Thank you for registering in Fix My Barangay. Below is your information.</p>';
// // $mail->Body .= '<img src="http://i.memeful.com/media/post/0MxGVwL_700w_0.jpg" alt="FixMyBarangay" />';
// $mail->Body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
// $mail->Body .= "<tr><td><strong>Username:</strong> </td><td>$username</td></tr>";  
// $mail->Body .= "<tr style='background: #eee;'><td><strong>Complainant Name:</strong> </td><td>$firstname $lastname</td></tr>";
// $mail->Body .= "<tr><td><strong>Email:</strong> </td><td>$email</td></tr>";  
// $mail->Body .= "<tr style='background: #eee;'><td><strong>Birthdate:</strong> </td><td>$bday</td></tr>";
// $mail->Body .= "<tr><td>If the following information is wrong please edit it on site.</td></tr>";
// $mail->Body .= "</table>";
// $mail->Body .= "</body></html>";
// // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

// if(!$mail->send()) {
//     echo "<script>alert('Message could not be sent.')</script>";
//     echo 'Mailer Error: ' . $mail->ErrorInfo;
// } else {
//     echo "<script>alert('An Email has been sent to your registered mail.')</script>";
//     header("location:../index.php?register=1");
// }
    header("location:../index.php?register=1");
  }
  else {
    header("location:home.php?register=2");
  }

  mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Register</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" href="../style.css">
</head>
<body>
<form id="slick-register" action="../index.php">
<input type="submit" value="Log In"></a>
</form>
<br><br><br>
  <h1 class="register-title">Fix My Barangay</h1>
  <form class="register" action="" method="post">
    
    <input type = "text" name="rid" class="register-input" placeholder = "id number" required autofocus> 
    <input type="submit" name="submit" value="Search ID" class="register-button">
 </form>

 <br><br><br>
 <?php
 if($found){
    $con=mysqli_connect("localhost","root","");
     mysqli_select_db($con,"fmb")or die(mysqli_error());
    $sqll= "SELECT * FROM resident WHERE $rid = rid";
    $resultt = mysqli_query($con,$sqll);
    if($_POST['rid'] == $rid)
      {
        while($row = mysqli_fetch_array($resultt)){
 ?>
    <form class="register" action="" method="post">
    <input type="text" name="rid" class="register-input" value="<?php echo $row['rid'] ?>"  readonly>
    <input type="text" name="firstname" class="register-input" value="<?php echo $row['firstname'] ?>" placeholder= "First Name" readonly>
    <input type="text" name="lastname" class="register-input" value="<?php echo $row['lastname'] ?>" placeholder= "Last Name" readonly>
    <input type="text" name="birthdate" class="register-input" value="<?php echo $row['birthdate'] ?>" placeholder = "Birthdate" readonly>
    <select name="purok" class="purok">
      <option value="1"disable>Purok 1</option>
      <option value="2"disable>Purok 2</option>
      <option value="3"disable>Purok 3</option>
      <option value="4"disable>Purok 4</option>
      <option value="5"disable>Purok 5</option>
      <option value="6"disable>Purok 6</option>
      <option value="7"disable>Purok 7</option>
      <option value="8"disable>Purok 8</option>
    </select>
    <input type="email" name="email" class="register-input" value = "" placeholder="Email" required>
    <input type="text" name="username" class="register-input" value="" placeholder="Username" required>
    <input type="password" name="password" class="register-input" value="" placeholder="Password" required> 
<!--     <input type="submit" name="register" value="Edit" class="register-button"> -->

 <input type="submit" name="register" value="Register" class="register-button">
<?php }}}?>
  <div class="about">
    
    <p class="about-author">
      <b>&copy; 2015 GoBones</b>

    </p>
</div>  </form>  


</body>
</html>