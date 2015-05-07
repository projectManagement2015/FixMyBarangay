<?php 
require_once('db.php');
session_start();

if(isset($_POST['submit'])){
  $rid = $_POST['rid'];
  $conn=mysqli_connect("localhost","root","");
  mysqli_select_db($conn,"fmb")or die(mysqli_error());

  $sql = "SELECT rid FROM residence where $rid = rid";
  $result = mysqli_query ($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
         echo "<script>alert('Your ID is : " . $row["rid"] .'\n'." Please provide your username and password to register.".'\n'." Thank You!');</script>";
    }
}  
else {
    echo "<script>alert('You are not yet register in your baranagay');</script>";
}
}


 if(isset($_POST['register'])) {
  $rid = $_POST['rid'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $conn=mysqli_connect("localhost","root","");
  mysqli_select_db($conn,"fmb")or die(mysqli_error());
  if(!$conn) 
   { die('Error : '.mysqli_error());}
 $sql = "UPDATE residence SET email='$email',username='$username',password='$password' WHERE rid='$rid'";
  if(mysqli_query($conn,$sql)){
      $conn=mysqli_connect("localhost","root","");
  mysqli_select_db($conn,"fmb")or die(mysqli_error());
    $sql = "UPDATE residence SET email='$email',username='$username',password='$password' WHERE rid='$rid'";
    header("location:index.php?register=1");
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
  <title>Registration Form</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1 class="register-title">Fix My Barangay</h1>
  <form class="register" action="" method="post">
    
    <input type = "text" name="rid" class="register-input" placeholder = "id number"> 
    <input type="submit" name="submit" value="Search ID" class="register-button">
 </form>

 <br><br><br>
 <?php
 if(isset($_POST['submit'])){
    $con=mysqli_connect("localhost","root","");
     mysqli_select_db($con,"fmb")or die(mysqli_error());
    $sqll= "SELECT * FROM residence WHERE $rid = rid";
    $resultt = mysqli_query($con,$sqll);
    if($_POST['rid'] == $rid)
      {
        while($row = mysqli_fetch_array($resultt)){
 ?>
    <form class="register" action="" method="post">
    <input type="text" name="rid" class="register-input" value="<?php echo $row['rid'] ?>" placeholder= "Last Name" readonly>
    <input type="text" name="firstname" class="register-input" value="<?php echo $row['firstname'] ?>" placeholder= "Last Name" readonly>
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
    <input type="email" name="email" class="register-input" value = "" placeholder="Email">
    <input type="text" name="username" class="register-input" value="" placeholder="Username">
    <input type="password" name="password" class="register-input" value="" placeholder="Password"> 
    <input type="submit" name="register" value="Edit" class="register-button">

 <?php  if(empty($row)) { ?> 
 <input type="submit" name="register" value="Register" class="register-button">
<?php }}}}?>
  <div class="about">
    
    <p class="about-author">
      <b>&copy; 2015 GoBones</b>

    </p>
</div>  </form>  
</body>
</html>