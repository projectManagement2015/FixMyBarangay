<?php
$conn = mysqli_connect('localhost','root','') or die(mysqli_connect_error());



$usedb = mysqli_select_db($conn,'fmb') or die(mysqli_error($conn));

?>	