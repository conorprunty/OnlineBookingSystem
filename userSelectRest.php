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

session_start();
//takes variable of the user's selected area
$name = $_SESSION['name'];


if (isset($_POST['monday'])){
        $sql = "UPDATE $name SET `Used`='True' WHERE `id` = 1;";
}
if (isset($_POST['tuesday'])){
        $sql .= "UPDATE $name SET `Used`='True' WHERE `id` = 2;";
}
if (isset($_POST['wednesday'])){
        $sql .= "UPDATE $name SET `Used`='True' WHERE `id` = 3;";
}
if (isset($_POST['thursday'])){
        $sql .= "UPDATE $name SET `Used`='True' WHERE `id` = 4;";
}
if (isset($_POST['friday'])){
        $sql .= "UPDATE $name SET `Used`='True' WHERE `id` = 5;";
}
if (isset($_POST['saturday'])){
        $sql .= "UPDATE $name SET `Used`='True' WHERE `id` = 6;";
}
if (isset($_POST['sunday'])){
        $sql .= "UPDATE $name SET `Used`='True' WHERE `id` = 7;";
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

unset($_SESSION['name']);
header("Location: setup.php");
		// this statement is needed 
		die("Redirecting to setup.php");    

	$mysqli->close();
	?>