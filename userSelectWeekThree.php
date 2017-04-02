<?php
/*
*@ author Conor Prunty
*/
	// get connection to DB
	include("phpsession.php");
	// Check connection
	
	if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}

//used to store user area choice as variable to pass to next page
session_start(); 
$name = $_SESSION['name'];
$weekthree = $name."week3";

// sql to create table
$sql = "CREATE TABLE $weekthree (
    id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Time varchar(100) NOT NULL,
    Monday varchar(100) NOT NULL,
    Tuesday varchar(100) NOT NULL,
    Wednesday varchar(100) NOT NULL,
    Thursday varchar(100) NOT NULL,
    Friday varchar(100) NOT NULL,
    Saturday varchar(100) NOT NULL,
    Sunday varchar(100) NOT NULL,
    Used varchar(100) NOT NULL
    );";


	if (!$mysqli->multi_query($sql)) {
    echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

do {
    if ($res = $mysqli->store_result()) {
        var_dump($res->fetch_all(MYSQLI_ASSOC));
        $res->free();
    }
} while ($mysqli->more_results() && $mysqli->next_result());

header("Location: addArea.php");
		// this statement is needed 
		die("Redirecting to addArea.php");    

	$mysqli->close();
	?>