<?php
/*
*@ author Conor Prunty
*/
	include("phpsession.php");
	// Check connection
	
	if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}


            $sql = "UPDATE banner SET `icon`='".$_POST['optionChoice']."' ;";
            //$sql = "UPDATE banner SET `icon`='1' ;";
            	if (!$mysqli->multi_query($sql)) {
                echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
            }

            do {
                if ($res = $mysqli->store_result()) {
                    var_dump($res->fetch_all(MYSQLI_ASSOC));
                    $res->free();
                }
            } while ($mysqli->more_results() && $mysqli->next_result());

        header("Location: admin.php");
		// this statement is needed 
		die("Redirecting to admin.php");    

	$mysqli->close();
	?>