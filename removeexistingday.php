<?php
/*
 *@ author Conor Prunty
 *removeexistingday.php
 */
include("phpsession.php");
// Check connection

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

session_start();
//takes the required session variables
$name      = $_SESSION['name'];
$day       = $_SESSION['day'];
$time      = $_SESSION['time'];
$weektwo   = $name . "week2";
$weekthree = $name . "week3";

//mysql commands for removing a day - must remove from each week
$sql = "UPDATE `daysUsed` SET `$name`='' WHERE `days` = '" . $_POST['userOption'] . "';";
$sql .= "UPDATE `$name` SET `" . $_POST['userOption'] . "`='Unavailable';";
$sql .= "UPDATE `$weektwo` SET `" . $_POST['userOption'] . "`='Unavailable';";
$sql .= "UPDATE `$weekthree` SET `" . $_POST['userOption'] . "`='Unavailable'";
if (!$mysqli->multi_query($sql)) {
    echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

do {
    if ($res = $mysqli->store_result()) {
        var_dump($res->fetch_all(MYSQLI_ASSOC));
        $res->free();
    }
} while ($mysqli->more_results() && $mysqli->next_result());

//redirect after script has ran
header("Location: booking.php");
// this statement is needed 
die("Redirecting to booking.php");

$mysqli->close();
?>