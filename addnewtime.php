<?php
/*
 *@ author Conor Prunty
 *addnewtime.php
 */
include("phpsession.php");
// Check connection

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

session_start();
//takes variable of the user's selections
$name      = $_SESSION['name'];
$name      = $_SESSION['name'];
$day       = $_SESSION['day'];
$time      = $_SESSION['time'];
$weektwo   = $name . "week2";
$weekthree = $name . "week3";

//mysql commands
$sql = "UPDATE $name SET `Used`='Yes' WHERE `Time` = '" . $_POST['userOption'] . "';";
$sql .= "UPDATE $weektwo SET `Used`='Yes' WHERE `Time` = '" . $_POST['userOption'] . "';";
$sql .= "UPDATE $weekthree SET `Used`='Yes' WHERE `Time` = '" . $_POST['userOption'] . "'";
if (!$mysqli->multi_query($sql)) {
    echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

do {
    if ($res = $mysqli->store_result()) {
        var_dump($res->fetch_all(MYSQLI_ASSOC));
        $res->free();
    }
} while ($mysqli->more_results() && $mysqli->next_result());

header("Location: booking.php");
// this statement is needed 
die("Redirecting to booking.php");

$mysqli->close();
?>
 