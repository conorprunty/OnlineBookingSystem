<?php
/*
 *@ author Conor Prunty
 */

//connection required
include("phpsession.php");

//check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

//used to start session for session variables
session_start();
//takes variable of the user's selection
$name = $_SESSION['name'];

//two database calls involved in adding an area
$sql = "UPDATE areas SET `used` = 'Yes', `Chosen` = 'Yes' WHERE allAreas = '$name';";
$sql .= "ALTER TABLE `daysUsed` ADD COLUMN $name VARCHAR(50) NOT NULL";

if (!$mysqli->multi_query($sql)) {
    echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

do {
    if ($res = $mysqli->store_result()) {
        var_dump($res->fetch_all(MYSQLI_ASSOC));
        $res->free();
    }
} while ($mysqli->more_results() && $mysqli->next_result());

//required here to redirect once the php script has ran
header("Location: setuprest.php");
die("Redirecting to setuprest.php");

//close connection
$mysqli->close();

?>