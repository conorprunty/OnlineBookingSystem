<?php
/*
 *@ author Conor Prunty
 *setup.php
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
    //selecting all areas from the areas list which are not chosen
    $query = " 
            SELECT id, allAreas
            FROM areas
            WHERE `Chosen` = 'No'
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

//takes name from logged in username
$name = htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');
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
		<script src="js/valForm.js" type="text/javascript"></script>
		<script src="js/banner.js" type="text/javascript"></script>
		<!-- forces user to not allow use spaces -->
		<script src="js/nospaces.js" type="text/javascript"></script>
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
						<li class="active"><a href="setup.php">Setup</a></li>
						<li><a href="admin.php">Admin</a></li>
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
			Setup
		</div>
		<div class="row">
			<div class="col-6 col-md-4">
				<div class="addNew" align="left">
					<br>
					<form action="addNew.php" name="add" method="post" onsubmit="return validateForm()">
						<p><b>Don't see your area?</b> <br><b>Enter new area here:</b></p>
						<input type="text" name="area" id="entry" placeholder="Enter a new area..." />
						<input type="submit" class="btn btn-info" name="submit" value="Enter" />
					</form>
				</div>
			</div>
			<div class="col-6 col-md-4">
				<form action="userSelect.php" name="userChoice" method="post" class="setupForm">
					<br>
					<div class="styled-select select" align="center">
						<p><b>Choose area required for your club:</b></p>
						<?php
							//partially taken from:
							//http://stackoverflow.com/questions/8022353/how-to-populate-html-dropdown-list-with-values-from-database
							if($row != null){
							    echo "<select name='userOption'>";
							    do{
                                    //puts all options from query above into select dropdown
							        unset($id, $name);
							        $id = $row['allAreas'];
							        $allAreas = $row['allAreas']; 
							        echo '<option value="'.$allAreas.'">'.$allAreas.'</option>';
							    }
							    while ($row = $stmt->fetch()) ;
							    echo "</select>";
							    ?>   
						<br>
						<br>
						<input type="submit" class="btn btn-info" name="submit" value="Submit" />
						<?php
							}
							else{
                            //I'd imagine this shouldn't be reached but here just in case...
							echo "Somehow you have selected every area!";
							?>
						<br>
						<br>
						<p><b> Click here to return to the admin page</b></p>
						<input type="button" class="btn btn-info" onclick="location.href='admin.php';" value="Submit" />
						<?php
							}
							?>
					</div>
				</form>
			</div>
			<div class="col-6 col-md-4">
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