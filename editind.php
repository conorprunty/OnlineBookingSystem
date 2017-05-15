<?php
/*
 *@ author Conor Prunty
 *editind.php
 */
// connect to DB
require("session.php");
// Check whether user is logged in

if (empty($_SESSION['user'])) {
    // If they are not, redirect to the login page. 
    header("Location: index.php");
    // this statement is needed 
    die("Redirecting to index.php");
} else {
    //selecting all areas available
    $query = " 
            SELECT id, allAreas
            FROM areas
            WHERE `Chosen` = 'Yes'
            ORDER BY allAreas asc;
        ";
    
    try {
        // run query
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
        $row    = $stmt->fetch();
    }
    
    catch (PDOException $ex) {
        die("Failed to run query: " . $ex->getMessage());
    }
    
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
        <br>
        <br>
		<form action="userupdate.php" name="userChoice" method="post" id="userSubmit" onsubmit="return confirm('Are you sure you want to edit this?');">
			<div class="container">
				<div class="row">
					<div align="center">
						<div class="styled-select select">
							<p><b>Select area:</b></p>
							<?php
								//partially taken from:
								//http://stackoverflow.com/questions/8022353/how-to-populate-html-dropdown-list-with-values-from-database
								if($row != null){
								    echo "<select name='userarea' id='userarea'>";
								    do{
                                        //puts all values from query above into select dropdown
								        unset($id, $name);
								        $id = $row['allAreas'];
								        $allAreas = $row['allAreas']; 
								        echo '<option value="'.$allAreas.'">'.$allAreas.'</option>';
								    }
								    while ($row = $stmt->fetch()) ;
								    echo "</select>"; 
								    ?>
                        </div>
                        <div class="styled-select select">
							<br>
                            <br>
							<p><b>Select week:</b></p>
                            <select name="userweek">
					           <option id="date" value="weekone"></option>
					           <option id="datetwo" value="weektwo"></option>
					           <option id="datethree" value="weekthree"></option>
                               <option id="all" name="all" value="all">Select all weeks</option>
				            </select>
                            <script src="js/date.js" type="text/javascript"></script>
		                      <script src="js/datetwo.js" type="text/javascript"></script>
		                      <script src="js/datethree.js" type="text/javascript"></script>
                        </div>
                        <div class="styled-select select">
							<br>
                            <br>
							<p><b>Select day:</b></p>
                            <select name="userday">
					           <option id="monday">Monday</option>
					           <option id="tuesday">Tuesday</option>
					           <option id="wednesday">Wednesday</option>
                               <option id="thursday">Thursday</option>
					           <option id="friday">Friday</option>
					           <option id="saturday">Saturday</option>
                               <option id="sunday">Sunday</option>
				            </select>
                        </div>
                        <div class="styled-select select">
                            <br>
                            <br>
                            <p><b>Select time:</b></p>
                            <select name="usertime">
					           <option id="00-01">00-01</option>
					           <option id="01-02">01-02</option>
					           <option id="02-03">02-03</option>
                               <option id="03-04">03-04</option>
					           <option id="04-05">04-05</option>
					           <option id="05-06">05-06</option>
                               <option id="06-07">06-07</option>
                               <option id="07-08">07-08</option>
					           <option id="08-09">08-09</option>
					           <option id="09-10">09-10</option>
                               <option id="10-11">10-11</option>
					           <option id="11-12">11-12</option>
					           <option id="12-13">12-13</option>
                               <option id="13-14">13-14</option>
                               <option id="14-15">14-15</option>
					           <option id="15-16">15-16</option>
					           <option id="16-17">16-17</option>
                               <option id="17-18">17-18</option>
                               <option id="18-19">18-19</option>
					           <option id="19-20">19-20</option>
					           <option id="20-21">20-21</option>
                               <option id="21-22">21-22</option>
					           <option id="22-23">22-23</option>
					           <option id="23-00">23-00</option>
				            </select>
                        </div>
                        <div class="styled-select select">
                            <br>
                            <br>
                            <p><b>Select value:</b></p>
                            <select name="uservalue">
					           <option id="booked">Booked</option>
					           <option id="free">Free</option>
					           <option id="unavailable">Unavailable</option>
				            </select>
                        </div>
                            <br>
                            <br>
							<input type="submit" class="btn btn-info" name="Edit" value="Edit"/>
							<?php
								}  
								
								else{
								echo "No areas added!";
								?>
							<br>
							<br>
							<p><b> Click here to add an area </b></p>
							<input type="button" class="btn btn-info" onclick="location.href='setup.php';" value="Submit" />
							<?php
								}
								?>     
						</div>
						<br>
					</div>
				</div>
			</div>
		</form>
		<div>
			<!-- need an empty div here due to issue with the webhost account -->
			<br>
			<br>
			<br>
		</div>
	</body>
</html>