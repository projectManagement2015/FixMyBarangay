<?php 
require_once('db.php');
 ?>

<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
  <meta charset="UTF-8">
  <title>FMB</title>
  <link rel="stylesheet" href="css/style.css" type="text/css">
  <link rel="stylesheet" href="css/bootstrap.min.css.css" type="text/css">
  

</head>
<body>
  <div id="header1">
    <div>
      <div id="logo">
        <a href="index.html"><img src="" alt=""></a>
      </div>
      <ul id="navigation">
        <li>
          <a href="adminhome.php">Home</a>
        </li>
        <li>
          <a href="complainants.php">Complainants</a>
        </li>
        <li><a href="viewcomplaints.php">Complaints</li>
        <li>
          <a href="gallery1.php">Gallery</a>
        </li>
        <li >
          <a href="adminlogin.php">Log Out</a>
        </li>
        <!-- <li>
          <a href="contact.html">Contact</a>
        </li> -->
      </ul>
    </div>
  </div>
  <div id="contents">
    <div class="panel panel-default">
              <div class="panel-heading">
                <h2>Complaints</h2>
              </div>
              
              <div class="panel-body">
              <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row">
                  <div class="col-xs-12">
                  <table id="example" class="table table-striped table-bordered" cellspacing="0" width="800%">
                      <thead>

                        <tr>
                            <th> </th>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Complainant</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Person In-Charged</th>
                            <th></th>
                               
                        </tr>
                   
                    </thead>
             
                    <tbody>
                        <?php
                            $query = "SELECT * FROM complain";
                            $select_result = mysqli_query($conn,$query);
                            while($row = mysqli_fetch_assoc($select_result)){
                              $complainID = $row['complainID'];

                              $sql = "SELECT * FROM stats  WHERE complainID= $complainID";
                              $retval = mysqli_query($conn, $sql);
                              $statrow = mysqli_fetch_assoc($retval);

                              echo "<tr>";
                              if ($row['image'] != null) {
                                  echo "<td><img alt='' width='100px' height='100px' src='./images/uploads/".$row['image']."'></td>";
                                }
                                else{
                                  echo "<td><img src='http://placehold.it/800x500' alt='' width='100px' height='100px'></td>";
                                }                              
                               echo "<td>".$row['complainID']."</td>";

                              echo "<td>".$row['category']."</td>";
                              echo "<td>".$row['description']."</td>";
                              echo "<td>".$row['cname']."</td>";
                              echo "<td>".$row['email']."</td>";
                              echo "<td>".$row['contact']."</td>";
                              echo "<td>".$row['cdate']."</td>";
                              echo "<td>".$row['location']."</td>";
                              echo "<td>".$statrow['status']."</td>"; 
                              echo "<td>".$statrow['person']."</td>";       
                              echo "<td><a href='comment.php?complainID=".$complainID."'><image src='images/i.jpg'></i></td>";                               
                             echo "</tr>";
                            }
                            
                        ?>
                    </tbody>

                </table>
              </div>
              </div>


              </div>
              </div>
     
  </div>
</body>
</html>