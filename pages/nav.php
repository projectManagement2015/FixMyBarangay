<div id="header">
		<div>
			<div id="logo">
				<a href="home.html">
				<!-- <img src=""> --></a>
			</div>
			<ul id="navigation">
				<li >
					<a href="home.php">Home</a>
				</li>
				<li >
					<a href="visitor.php">Visitor's Counter</a>
				</li>
				<li>
					<a href="officialList.php">Barangay Officials</a>
				</li>
				<li>
					<a href="viewcomplaint.php">Complaints</a>
				</li>
				<li>
					<a href="gallery.php">Search Complaint</a>
				</li>
				<li>
					<a href="mapview.php">Map</a>
				</li>
				<li>
					<a href="profile.php"><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></a>
				</li>
				<li>
					<a href="logout.php">Log Out</a>
				</li>
				<li>
					<a href="login.html"></a>
				</li>
			</ul>
		</div>
	</div>