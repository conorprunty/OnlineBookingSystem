<?php
/*
 *@ author Conor Prunty
 *cancelopt.php
 */
include("phpsession.php");
// Check connection

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

//deletes the booking
$sql = "DELETE FROM `bookings` WHERE `ranNum` = '" . $_POST['cancelref'] . "'";
if (!$mysqli->multi_query($sql)) {
    echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

do {
    if ($res = $mysqli->store_result()) {
        var_dump($res->fetch_all(MYSQLI_ASSOC));
        $res->free();
    }
} while ($mysqli->more_results() && $mysqli->next_result());

//redirects after the script has ran
header("Location: cancel.php");
// this statement is needed 
die("Redirecting to cancel.php");

$mysqli->close();
?>