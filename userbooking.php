<?php
/*
 *@ author Conor Prunty
 *userbooking.php
 */
// connect to DB
require("session.php");
require("registersession.php");

//selecting all options available which have been chosen
$query = " 
            SELECT id, allAreas, cost
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

//required for the banner
$icon         = mysqli_query($connect, "SELECT icon FROM banner");
$bannerresult = mysqli_fetch_array($icon);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Online Booking System</title>
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
		<div id="pageheader" align="center">
			Booking
		</div>
		<form action="usertable.php" name="userChoice" method="post" id="userSubmit">
			<div class="container">
				<div class="row">
					<div align="center">
						<br>
						<div class="styled-select select">
							<p><b>Select from the list of areas available:</b></p>
							<?php
								//partially taken from:
								//http://stackoverflow.com/questions/8022353/how-to-populate-html-dropdown-list-with-values-from-database
								if($row != null){
								    echo "<select name='userOption' id='allOptions'>";
								    do{
                                        //puts all values from query above into a select dropdown
								        unset($id, $name, $cost);
								        $id = $row['allAreas'];
								        $allAreas = $row['allAreas']; 
								        $cost = $row['cost']; 
								        echo '<option value="'.$allAreas.'">'.$allAreas.' - '.$cost.' p/h</option>';
								    }
								    while ($row = $stmt->fetch()) ;
								    echo "</select>"; 
								    ?>
							<br>
							<br>
							<br>
							<input type="submit" class="btn btn-info" name="Submit" value="Submit"/>
							<?php
								}  
								
								else{
								echo "The admin user has not set up any areas!";
								?>
							<br>
							<br>
							<p><b> Please contact the admin of the site. </b></p>
							<?php
								}
								?>     
						</div>
						<br>
					</div>
				</div>
			</div>
		</form>
	</body>
	<div>
		<!-- need an empty div here due to issue with the webhost account -->
		<br>
		<br>
		<br>
	</div>
</html>
