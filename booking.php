<?php
	/*
*@ author Conor Prunty
*/
	// connect to DB
	require("session.php");
	// Check whether user is logged in
	
	if(empty($_SESSION['user']))     {
		// If they are not, redirect to the login page. 
		header("Location: setup.php");
		// this statement is needed 
		die("Redirecting to setup.php");
	}
    else {
        
        session_start();
        $name = $_SESSION['name'];
			//selecting all areas available
			$query = " 
            SELECT *
            FROM $name
            WHERE Used = 'Yes'
            ORDER BY id asc;
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
  </head>
  <body>
      
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">Online Booking System</a>
            </div>
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#">Admin</a></li>
              <li><a href="#">Bookings</a></li>
              <li><a href="#">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">
                    <span class="glyphicon glyphicon-log-in"></span>
                    Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>
      
      <div id="pageheader" align="center">
        Booking
      </div>
         <div align='center'>
    <?php
	
	if ($row) {
		echo "<table class='fulltable'><tr><th>TIME</th><th>MONDAY</th><th>TUESDAY</th><th>WEDNESDAY</th><th>THURSDAY</th><th>FRIDAY</th><th>SATURDAY</th><th>SUNDAY</th></tr>";
		$count = 1;
		// output data of first row
		echo "<tr><td>" . $row["Time"] . "</td><td> " . $row["Monday"] . "</td><td> " . $row["Tuesday"] . "</td><td> " . $row["Wednesday"] . "</td><td>" . $row["Thursday"] . "</td><td> " . $row["Friday"] . "</td><td> " . $row["Saturday"] . "</td><td> " . $row["Sunday"] . "</td>";
		echo "</tr>";
		// output data of next rows
		while ($row = $stmt->fetch()) {
			$count++;
			echo "<tr><td>" . $row["Time"] . "</td><td> " . $row["Monday"] . "</td><td> " . $row["Tuesday"] . "</td><td> " . $row["Wednesday"] . "</td><td>" . $row["Thursday"] . "</td><td> " . $row["Friday"] . "</td><td> " . $row["Saturday"] . "</td><td> " . $row["Sunday"] . "</td>";
			echo "</tr>";
		}

		echo "</table>";
	} else {
		echo "Please go to setup page.";
	}

	?>
        </div>

     
</body>
</html>