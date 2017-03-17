<?php
/*
*@ author Conor Prunty
*/
	include("phpsession.php");
	// Check connection
	
	if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}

            $sql = "DELETE FROM `bookings` WHERE `id` = '".$_POST['id']."';";
            $sql .= "UPDATE `".$_POST['table']."` SET `".$_POST['day']."`='Free' WHERE `Time` = '".$_POST['time']."'";
            	if (!$mysqli->multi_query($sql)) {
                echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
            }

            do {
                if ($res = $mysqli->store_result()) {
                    var_dump($res->fetch_all(MYSQLI_ASSOC));
                    $res->free();
                }
            } while ($mysqli->more_results() && $mysqli->next_result());

        header("Location: allBookings.php");
		// this statement is needed 
		die("Redirecting to allBookings.php");    

	$mysqli->close();
?>