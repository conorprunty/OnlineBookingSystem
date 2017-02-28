<?php
/*
*@ author Conor Prunty
*/
	$username = "root";
	$password = "root";
	$host = "localhost";
	$dbname = "obsadmin";
	// Create connection
	$mysqli = new mysqli($host, $username, $password, $dbname);
	// Check connection
	
	if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}

session_start();
//takes variable of the user's selected area and day
$name = $_SESSION['name'];
$day = $_SESSION['day'];
$cost = $_SESSION['cost'];

            $sql .= "UPDATE `areas` SET `cost`='$cost' WHERE `allAreas` = '$name';";
            	if (!$mysqli->multi_query($sql)) {
                echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
            }

            do {
                if ($res = $mysqli->store_result()) {
                    var_dump($res->fetch_all(MYSQLI_ASSOC));
                    $res->free();
                }
            } while ($mysqli->more_results() && $mysqli->next_result());

        header("Location: booking.php");
		// this statement is needed 
		die("Redirecting to booking.php");    

	$mysqli->close();
	?>