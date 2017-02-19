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
//takes variable of the user's selections
$name = $_SESSION['name'];
$day = $_POST["day"]; session_start(); $_SESSION['day'] = $day;
//$day = $_SESSION['day'];
$time = $_POST["time"]; session_start(); $_SESSION['time'] = $time;


        foreach($_POST['day'] as $day)
        {
            $sql = "UPDATE $name SET `$day`='Free'";
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

header("Location: userSelectTime.php");
		// this statement is needed 
		die("Redirecting to userSelectTime.php");    

	$mysqli->close();
	?>