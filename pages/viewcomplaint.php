<?php 
  require_once('../db.php');
  session_start();
  if ($_SESSION['login']!=1) {
    header('location: ../index.php');
  }
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>FMB</title>
  <link rel="stylesheet" href="../css/style.css" type="text/css">
  <link rel="stylesheet" href="../css/bootstrap.min.css.css" type="text/css">
  

</head>
<body>
  <?php 
    include("nav.php");
   ?>
  <div id="contents">
  <h2><center>Complaints</center></h2>
  <div class="panel-body" id="forcomplainttable">
    <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row">
      <div class="table-responsive">
      <table id="example" class="table">
      <thead>
      <tr>
        <th> </th>
        <!--  <th>ID</th> -->
        <th>Category</th>
        <th>Description</th>
        <th>Complainant</th>
        <th id="date">Date</th>
        <th>Location</th>
        <th>Status</th>
        <!--  <th>Person In-Charged</th> -->
        <th></th>
      </tr>
      </thead>   
      <tbody>
        <?php
          $query = "SELECT * FROM complaints ORDER BY cdate DESC;";
          $select_result = mysqli_query($conn,$query);
          while($row = mysqli_fetch_assoc($select_result)){
          $complaintID = $row['complaintID'];
          $rid = $row['rid'];
          $res = mysqli_query($conn, "SELECT firstname, lastname FROM resident WHERE rid=$rid");
          $complainant = mysqli_fetch_assoc($res);
          echo "<tr>";
          if ($row['image'] != null) {
              echo "<td><img alt='' width='100px' height='100px' src='images/uploads/".$row['image']."'></td>";
            }
            else{
              echo "<td><img src='http://placehold.it/800x500' alt='' width='100px' height='100px'></td>";
            }                              
                               // echo "<td>".$row['complaintID']."</td>";

          echo "<td>".$row['category']."</td>";
          echo "<td>".$row['description']."</td>";
          echo "<td>".$complainant['firstname']." ".$complainant['lastname']."</td>";
          // echo "<td>".$row['email']."</td>";
          // echo "<td>".$row['contact']."</td>";
          $time = strtotime($row['cdate']);
          $date =  date("F d Y",$time);
          echo "<td>".$date."</td>";
                              
          echo "<td>".$row['location']."</td>"; 
          echo "<td>".$row['status']."</td>"; 
          // echo "<td>".$row['person']."</td>";
          // echo "<td><a href='comment.php?complaintID=".$complaintID."'><image src='../images/i.jpg'></i></td>";
          // echo "<td><a href='editcomplaint.php?complaintID=".$complaintID."'><image src='images/edit.png' width='20px' height='20px'></i></td>";                             
          echo "</tr>";
        }                  
        ?>
        </tbody>
        </table>
        </div>
        </div>
      </div>
    </div>
</body>
</html>