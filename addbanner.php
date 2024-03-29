<?php
/*
 *@ author Conor Prunty
 * addbanner.php
 */

//database connection
require("session.php");

//check whether user is logged in
if (empty($_SESSION['user'])) {
    //if they are not, redirect to the index page. 
    header("Location: index.php");
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
		<script src="js/bannerdemo.js" type="text/javascript"></script>
	</head>
	<body>
		<!-- all properties of the navigation bar -->
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand">Online Booking System</a>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<!-- this is for a dropdown menu option when viewed on a smaller screen -->
						<span class="icon-bar">
						</span>
						<span class="icon-bar">
						</span>
						<span class="icon-bar">
						</span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<!-- these are the options on the navbar -->
					<ul class="nav navbar-nav">
						<li><a href="setup.php">Setup</a></li>
						<li class="active"><a href="admin.php">Admin</a></li>
						<li class="dropdown">
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
		<div id="pageheader" align="center">
			Banner
		</div>
		<div align="center" class="styled-select select">
            <!-- banner options -->
			<form action="updatebanner.php" name="bannerchoice" method="post" onSubmit="alert('The admin page will display what the customer will see.');">
				<select name="optionChoice" id="optionChoice" onChange="setIcon()">
					<option disabled selected value>Select an option...</option>
					<option name="one" id="one" value="1">Football</option>
					<option name="two" id="two" value="2">Swimming</option>
					<option name="three" id="three" value="3">Tennis</option>
					<option name="four" id="four" value="4">Basketball</option>
					<option name="five" id="five" value="0">No Banner</option>
				</select>
				<input type="submit" class="btn btn-info" name="Submit" value="Choose"/>
			</form>
			<br>
			<br>
			<div id="icon"></div>
		</div>
	</body>
</html>