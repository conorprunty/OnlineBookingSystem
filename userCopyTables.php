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
//takes variable of the user's selected area and day
$name = $_SESSION['name'];
$weektwo = $name."week2";

            $sql .= "INSERT INTO $weektwo SELECT * FROM `$name`;";
            	if (!$mysqli->multi_query($sql)) {
                echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
            }

            do {
                if ($res = $mysqli->store_result()) {
                    var_dump($res->fetch_all(MYSQLI_ASSOC));
                    $res->free();
                }
            } while ($mysqli->more_results() && $mysqli->next_result());

        header("Location: userCopyTablesTwo.php");
		// this statement is needed 
		die("Redirecting to userCopyTablesTwo.php");    

	$mysqli->close();
	?>