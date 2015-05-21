<?php 
require_once('../db.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>FMB</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css">
  <link rel="stylesheet" href="../css/bootstrap.min.css.css" type="text/css">
  
<style>
th{
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    text-align: left; 
}
</style>
</head>
<body>
	<div id="header1">
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
          <a href="../yourcomplaints.php">Your Task</a>
        </li>
        <li>
          <a href="assignedComplaints.php">Assigned Complaints</a>
        </li> 
        <li>
          <a href="unassignedComplaints.php">Unassigned Complaints</a>
        </li>
        <li>
          <a href="index.php">Log Out</a>
        </li>
      </ul>
		</div>
	</div>
	<div id="contents">
  <div class="panel-heading">
  <center><h1>COMPLAINANTS</h1></center>
  </div> 
                   
 <?php
 $sql= "SELECT * FROM complaints ORDER BY rid ASC";
 $select_result = mysqli_query($conn,$sql);
 while($row = mysqli_fetch_assoc($select_result)){
 $complainID = $row['complaintID'];
 $rid = $row['rid'];
 $official_id = $row['official_id'];
 if(!empty($row['rid'])){
 $result = mysqli_query($conn, "SELECT * FROM resident  WHERE rid = $rid");
 $resrow = mysqli_fetch_assoc($result);
 $result1 = mysqli_query($conn, "SELECT * FROM barangay_official WHERE official_id = $official_id");
 $offrow = mysqli_fetch_assoc($result1);
  
  ?><?php echo '<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$resrow['firstname']." ".$resrow['lastname'].'</h1>'; ?>
<!--   <h3>Details</h3> -->
  <table style="width:70%;margin-left:15%;height:120%">
  <tr>
    <th rowspan="6" width="30%">
      <div style="height: auto"><div>
  <?php echo '<img src="./images/uploads/'.$row['image'].'" width="300px" height="300px" float="right"></div>'; ?>
    </th>
    <td>
      <h3>&nbsp;&nbsp;&nbsp;&nbsp;Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="status" value="<?php echo $row['status']; ?>" style="width:50%" readonly></h3>
    </td>
  </tr>
  <tr>
    <td>
  <h3>&nbsp;&nbsp;&nbsp;&nbsp;Person In-Charged: <input type="text" value="<?php echo $offrow['name']; ?>" style="width:50%" readonly>
  </td>
  </tr>
  <tr>
    <td><h3>&nbsp;&nbsp;&nbsp;&nbsp;Date End:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="<?php echo $row['dateEnd'];?>" style="width:50%" readonly>
  </td>
</tr>
  <tr><td>
    <h3>&nbsp;&nbsp;&nbsp;&nbsp;Purok:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="<?php echo $row['location'];?>" style="width:50%" readonly>
  </td></tr>
  <tr><td>
  <h3>&nbsp;&nbsp;&nbsp;&nbsp;Category:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="<?php echo $row['category'];?>" style="width:50%" readonly>
  </td></tr>
  <tr><td>
    <h3>&nbsp;&nbsp;&nbsp;&nbsp;Description:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="<?php echo $row['description'];?>" style="width:50%" readonly>
  </td></tr></table>
<br><br>
 <?php }
 }
 ?>
	</div>
</body>
</html>