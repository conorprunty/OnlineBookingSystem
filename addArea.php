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
//takes variable of the user's selection
$name = $_SESSION['name'];

            $sql ="UPDATE areas SET `used` = 'Yes', `Chosen` = 'Yes' WHERE allAreas = '$name';";
            $sql .="ALTER TABLE `daysUsed` ADD COLUMN Basketball VARCHAR(50) NOT NULL";

            	if (!$mysqli->multi_query($sql)) {
                echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
            }

            do {
                if ($res = $mysqli->store_result()) {
                    var_dump($res->fetch_all(MYSQLI_ASSOC));
                    $res->free();
                }
            } while ($mysqli->more_results() && $mysqli->next_result());

header("Location: setuprest.php");
		// this statement is needed 
		die("Redirecting to setuprest.php");    

	$mysqli->close();
	?>