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
				<li><a href="viewcomplaint.php">Complaints</li>
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
                <h2>COMPLAINANTS</h2>
              </div>
              
              <div class="panel-body">
              <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row">
                  <div class="col-xs-12">
                  <table id="example" class="table table-striped table-bordered" cellspacing="1" width="500%">
                      <thead >
                        <tr> 
                            <td>First Name</td>
                            <td>Last Name</td>
                            <td>Email Address</td>
                            <td></td>
                        </tr>

                    </thead>
             
                    
                        <?php
                            $query = "SELECT fname,lname,email FROM complainant1";
                            $select_result = mysqli_query($conn,$query);
                            while($row = mysqli_fetch_assoc($select_result)){
                             
                              echo "<tr>";
                              echo "<td>".$row['fname']."</td>";
                              echo "<td>".$row['lname']."</td>";
                              echo "<td>".$row['email']."></td>";     
                              echo "<td><a href='https://mail.google.com'><image src='images/email.jpg'></i></td>";                               
                             echo "</tr>";
                            }
                            
                        ?>
                   

                </table>
              </div>
              </div>


              </div>
              </div>
		 
	</div>
</body>
</html>