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

    if (isset($_POST['Update'])) {
        //update action
    } else if (isset($_POST['Delete'])) {
        //delete action
        //$sql = "DROP table ".$_POST["userOption"]."";
        $sql = "UPDATE areas SET `Chosen` = 'No', `used` = '' WHERE `allAreas` = '".$_POST['userOption']."';";
        $sql .= "DROP table ".$_POST["userOption"]."";
    } else {
        //no button pressed
        
    }

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