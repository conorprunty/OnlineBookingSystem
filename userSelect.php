<?php
/*
*addNew.php
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

    {
        if(isset($_POST['userOption'])){
          $sql = "INSERT INTO areas (allAreas)
          VALUES   ('".$_POST["userOption"]."')";
        }
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

header("Location: setup.php");
		// this statement is needed 
		die("Redirecting to setup.php");    

	$mysqli->close();
	?>