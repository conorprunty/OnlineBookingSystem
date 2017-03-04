<?php
/*
*@ author Conor Prunty
*/
	include("phpsession.php");
	// Check connection
	
	if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}
    $name = $_POST["userOption"]; session_start(); $_SESSION['name'] = $name;

    if (isset($_POST['Update'])) {
        header("Location: updateopts.php");
		die("Redirecting to updateopts.php");    
    } else if (isset($_POST['Delete'])) {
        //delete action
        $sql = "UPDATE areas SET `Chosen` = 'No', `used` = '' WHERE `allAreas` = '".$_POST['userOption']."';";
        $sql .= "ALTER TABLE `daysUsed` DROP ".$_POST["userOption"].";";
        $sql .= "DELETE FROM `areas` WHERE `allAreas` = '".$_POST['userOption']."' AND `newentry` = 'yes';";
        $sql .= "DROP table ".$_POST["userOption"].";";
        $sql .= "UPDATE areas SET `cost` = '' WHERE `allAreas` = '".$_POST['userOption']."'";
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