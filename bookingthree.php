<?php
/*
 *@ author Conor Prunty
 */
// connect to DB
require("session.php");
// Check whether user is logged in

if (empty($_SESSION['user'])) {
    // If they are not, redirect to the login page. 
    header("Location: index.php");
    // this statement is needed 
    die("Redirecting to index.php");
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>
			Online Booking System
		</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="style/style.css" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="js/goback.js" type="text/javascript"></script>
	</head>
	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand">Online Booking System</a>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar">
					</span>
					<span class="icon-bar">
					</span>
					<span class="icon-bar">
					</span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li><a href="setup.php">Setup</a></li>
						<li><a href="admin.php">Admin</a></li>
						<li class="dropdown active">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Bookings
							<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="allBookings.php">View All</a></li>
								<li><a href="updatebookings.php">Edit</a></li>
							</ul>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="logout.php" onclick="return confirm('Are you sure you want to logout?');">
							<span class="glyphicon glyphicon-log-in"></span>
							Logout
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div align='center'>
		<?php
			include("sessions.php");
			session_start();
			$name = $_SESSION['name'];
			$weekthree = $name."week3";
			
			$query = mysqli_query($db, " 
			SELECT *
			FROM $weekthree
			WHERE Used = 'Yes'
			ORDER BY id asc;");
			?>
		<h1><?= $name ?> table:</h1>
		<div class="row">
			<div class="col-6 col-md-4">
				<p><b>Click here to return to the admin page.</b></p>
				<form action="admin.php" name="add" method="post">
					<input type="submit" class="btn btn-info" name="submit" value="Enter" />
				</form>
				<br>
			</div>
			<div class="col-6 col-md-4">
			</div>
			<div class="col-6 col-md-4">
				<form>
					<div class="styled-select select" align="center" >
						<p><b>Choose your week:</b></p>
						<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
							<option id="date" value="booking.php"></option>
							<option id="datetwo" value="bookingtwo.php"></option>
							<option id="datethree" selected="true" value="bookingthree.php"></option>
						</select>
					</div>
				</form>
			</div>
		</div>
		<div class="floater">
			<script src="js/date.js" type="text/javascript"></script>
			<script src="js/datetwo.js" type="text/javascript"></script>
			<script src="js/datethree.js" type="text/javascript"></script>
			<table class="table table-hover table-bordered table-responsive fulltable" align='center'>
				<thead>
					<tr>
						<th>Time</th>
						<th>Monday</th>
						<th>Tuesday</th>
						<th>Wednesday</th>
						<th>Thursday</th>
						<th>Friday</th>
						<th>Saturday</th>
						<th>Sunday</th>
					</tr>
				</thead>
				<?php
					if (false === $query) {
					    die(mysql_error()); 
					}
					while ($row = mysqli_fetch_array($query)) {
					   echo "<tr>";
					   echo "<td>".$row[Time]."</td>";
					   echo "<td>".$row[Monday]."</td>";
					   echo "<td>".$row[Tuesday]."</td>";
					   echo "<td>".$row[Wednesday]."</td>";
					   echo "<td>".$row[Thursday]."</td>";
					   echo "<td>".$row[Friday]."</td>";
					   echo "<td>".$row[Saturday]."</td>";
					   echo "<td>".$row[Sunday]."</td>";
					   echo "</tr>";
					}
					?>
			</table>
		</div>
		<div>
			<!-- need an empty div here due to issue with the webhost account -->
			<br>
			<br>
			<br>
		</div>
	</body>
</html>