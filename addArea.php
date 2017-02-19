<?php
/*
*@ author Conor Prunty
*/
	include("phpsession.php");
	// Check connection
	
	if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}

session_start();
//takes variable of the user's selection
$name = $_SESSION['name'];

            $sql ="UPDATE areas SET `used` = 'Yes', `Chosen` = 'Yes' WHERE allAreas = '$name';";
            $sql .="ALTER TABLE `daysUsed` ADD COLUMN $name VARCHAR(50) NOT NULL";

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