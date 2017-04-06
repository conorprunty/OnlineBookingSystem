<?php
require("registersession.php");
$icon         = mysqli_query($connect, "SELECT icon FROM banner");
$bannerresult = mysqli_fetch_array($icon);
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
		<script src="js/banner.js" type="text/javascript"></script>
		<script type="text/javascript">
			var icon = <?php echo $bannerresult["icon"];?>;
		</script>
	</head>
	<body onload="setBanner()">
		<header>
			<div id="icon"></div>
		</header>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="welcome.php">Homepage</a>
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
						<li class="active"><a href="userbooking.php">New Booking</a></li>
						<li><a href="cancel.php">Cancel Booking</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="contact.php">
							<span class="glyphicon glyphicon-comment"></span>
							Contact
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div align='center'>
			<?php
				include("sessions.php");
				if(!empty($_POST['userOption'])){
				    $userTable = $_POST["userOption"]; session_start(); $_SESSION['userTable'] = $userTable;
				}
				else{
				    session_start();
				    $userTable = $_SESSION['userTable'];
				}
				$query = mysqli_query($db," 
				SELECT *
				FROM $userTable
				WHERE Used = 'Yes'
				ORDER BY id asc;
				");
				
				?>
			<h1><?= $userTable ?> table</h1>
			<br>
		</div>
		<div class="row">
			<div class="col-6 col-md-4" align="center">
				<p><b>Click here to select a different area:</b></p>
				<form action="userbooking.php" method="post">
					<input type="submit" class="btn btn-info" name="submit" value="Select" />
				</form>
			</div>
			<div class="col-6 col-md-4" align="center">
				<p><b>Click here to make a booking:</b></p>
				<form action="userchoice.php" method="post" class="form-inline">
					<input type="submit" class="btn btn-info" name="submit" value="Booking" />
				</form>
			</div>
			<div class="col-6 col-md-4, styled-select select" align="center">
				<p><b>Choose your week:</b></p>
				<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
					<option id="date" value="usertable.php"></option>
					<option id="datetwo" value="usertabletwo.php"></option>
					<option id="datethree" value="usertablethree.php"></option>
				</select>
			</div>
		</div>
		<br>
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
		<br>
		<div>
			<!-- need an empty div here due to issue with the webhost account -->
			<br>
			<br>
			<br>
		</div>
	</body>
</html>