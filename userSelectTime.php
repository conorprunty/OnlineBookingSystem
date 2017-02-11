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


        foreach($_SESSION['day'] as $day)
        {
            $sql = "UPDATE $name SET `Used`='Yes' WHERE `Time` = '$day'";
            	if (!$mysqli->multi_query($sql)) {
                echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
            }

            do {
                if ($res = $mysqli->store_result()) {
                    var_dump($res->fetch_all(MYSQLI_ASSOC));
                    $res->free();
                }
            } while ($mysqli->more_results() && $mysqli->next_result());
        }

header("Location: setup.php");
		// this statement is needed 
		die("Redirecting to setup.php");    

	$mysqli->close();
	?>