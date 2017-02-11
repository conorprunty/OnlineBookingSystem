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

//used to store user area choice as variable to pass to next page
$name = $_POST["userOption"]; session_start(); $_SESSION['name'] = $name;

// sql to create table
$sql = "CREATE TABLE ".$_POST["userOption"]." (
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

//create default values
$sql .= 
    "INSERT INTO ".$_POST["userOption"]." (`id`, `Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`, `Sunday`, `Used`) VALUES
    (1, '09-10', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (2, '10-11', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (3, '11-12', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (4, '12-13', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (5, '13-14', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (6, '14-15', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (7, '15-16', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (8, '16-17', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (9, '17-18', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (10, '18-19', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (11, '19-20', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (12, '20-21', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', '')";


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