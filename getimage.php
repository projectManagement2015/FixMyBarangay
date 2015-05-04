<?php
	$complainID = $_REQUEST['complainID'];
	require_once('db.php');
	$image_query = "SELECT * from complain where complainID = $complainID";
	$image_query_result = mysqli_query($conn,$image_query);
	while ($row = mysqli_fetch_assoc($image_query_result)){
		$image = $row['image'];
	}
	

	//change the format of this page

	
	if ($image !=  null) {
		header('Content-type:image/jpeg');
		echo $image;
	}
	else{
		echo "http://placehold.it/800x500";
	}
	


	

?>