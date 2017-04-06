<?php
/*
 *@ author Conor Prunty
 */
include("phpsession.php");
// Check connection

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

session_start();
$bookingref   = $_SESSION['bookingref'];
$userTableTBD = $_SESSION['userTableTBD'];
$userDayTBD   = $_SESSION['userDayTBD'];
$userTimeTBD  = $_SESSION['userTimeTBD'];

$sql = "UPDATE `$userTableTBD` SET `$userDayTBD`='Free' WHERE `Time` = '$userTimeTBD';";
$sql .= "DELETE FROM bookings WHERE ranNum = '$bookingref'";
if (!$mysqli->multi_query($sql)) {
    echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

do {
    if ($res = $mysqli->store_result()) {
        var_dump($res->fetch_all(MYSQLI_ASSOC));
        $res->free();
    }
} while ($mysqli->more_results() && $mysqli->next_result());

header("Location: custDeletedEmail.php");
// this statement is needed 
die("Redirecting to custDeletedEmail.php");

$mysqli->close();
?>