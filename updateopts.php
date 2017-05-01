<?php
/*
 *@ author Conor Prunty
 *updateopts.php
 */
// connect to DB
require("session.php");
include("sessions.php");
// Check whether user is logged in

if (empty($_SESSION['user'])) {
    // If they are not, redirect to the login page. 
    header("Location: index.php");
    // this statement is needed 
    die("Redirecting to index.php");
}

if (strstr($_SERVER['HTTP_REFERER'], "updateopts.php")){
    //this just displays an alert to say the cost was updated
    //only works if coming from this page
    ?>
        <script type="text/javascript">
            alert("Cost updated.");
        </script>
    <?php
}
//this prevents direct access to this page - can only come from the redirect on updatebookings.php
//this also helps display the table based on the input from the selection menu
else if (strstr($_SERVER['HTTP_REFERER'], "updatebookings.php")) {
    //you came from the right page
} 
else {
    // returns to updatebookings.php page
    header("Location: updatebookings.php");
    // this kills the php script
    die("Redirecting to updatebookings.php");
}



//takes name from logged in username
$name = htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');

session_start();
//takes variable of the user's selections
$name = $_SESSION['name'];

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
        <script src="js/numsonly.js" type="text/javascript"></script>
        <script src="js/valForm.js" type="text/javascript"></script>
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
		<div id="pageheader" align="center">
			Update
		</div>
        
        <div class="row">
            <?php
				$name = $_SESSION['name'];
				
				$query = mysqli_query($db," 
				SELECT cost
				FROM areas
				WHERE allAreas = '$name';
				");
                $res = mysqli_fetch_row($query);
				?>
			<div class="col-6 col-md-4" align="center">
				<!-- currently empty but leaving for potential future use -->
			</div>
			<div class="col-6 col-md-4" align="center">
				<div class="styled-select select">
							<p><b>Choose option required:</b></p>
                            <!-- http://stackoverflow.com/questions/7562095/redirect-on-select-option-in-select-box -->
                            <!-- values change dynamically, i.e. without clicking a submit button etc -->
							<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
								<option value="">Select...</option>
								<option value="addday.php">Add a new day</option>
								<option value="addtime.php">Add a new time</option>
								<option value="removeday.php">Remove an existing day</option>
								<option value="removetime.php">Remove an existing time</option>
							</select>
						</div>
			</div>
			<div class="col-6 col-md-4, styled-select select" align="center">
				<p><b>Update cost per hour:</b></p>
                <form action="updatecostph.php" name="userChoice" method="post" onsubmit="return notEmpty()">
                    <div id="staticParent">
				        <input id="child" name="cost" type="textarea" cols="5" placeholder=" Current cost: <?php echo $res[0]; ?> p/h" />
                        <input type="submit" class="btn btn-info" name="submit" value="Enter" />
				    </div>
                </form>
			</div>
		</div>
		<div align='center'>
			<?php
				$name = $_SESSION['name'];
				
				$query = mysqli_query($db," 
				SELECT *
				FROM $name
				WHERE Used = 'Yes'
				ORDER BY id asc;
				");
				?>
			<h4>Here is the current <?= $name ?> table:</h4>
			<div class="floater">
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
                        //puts all values from query above into a table
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
		</div>
		<div>
			<!-- need an empty div here due to issue with the webhost account -->
			<br>
			<br>
			<br>
		</div>
	</body>
</html>