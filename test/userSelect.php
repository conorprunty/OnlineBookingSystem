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
    (1, '00-01', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (2, '01-02', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (3, '02-03', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (4, '03-04', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (5, '04-05', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (6, '05-06', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (7, '06-07', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (8, '07-08', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (9, '08-09', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (10, '09-10', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (11, '10-11', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (12, '11-12', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (13, '12-13', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (14, '13-14', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (15, '14-15', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (16, '15-16', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (17, '16-17', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (18, '17-18', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (19, '18-19', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (20, '19-20', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (21, '20-21', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (22, '21-22', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (23, '22-23', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', ''),
    (24, '23-00', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', 'Unavailable', '')";


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