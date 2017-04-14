<?php
/*
 *@ author Conor Prunty
 *addUserOptionThree.php
 */
include("phpsession.php");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

//get all variables to store in database
session_start();
$userTable = $_SESSION['userTable'];
$userDay   = $_SESSION['userDay'];
$userTime  = $_SESSION['userTime'];
$userName  = $_SESSION['userName'];
$email     = $_SESSION['email'];
$ranNum    = $_SESSION['ranNum'];
$nextSunday = date('Y-m-d', strtotime('sunday +2 weeks'));
$weekthree = $userTable . "week3";

$sql = "INSERT INTO `bookings` (`userName`, `userTable`, `userDay`, `userTime`, `email`, `ranNum`, `week`) VALUES
    ('$userName', '$userTable', '$userDay', '$userTime', '$email', '$ranNum', '$nextSunday');";
$sql .= "UPDATE `$weekthree` SET `$userDay`='Booked' WHERE `Time`='$userTime'";


if (!$mysqli->multi_query($sql)) {
    echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

do {
    if ($res = $mysqli->store_result()) {
        var_dump($res->fetch_all(MYSQLI_ASSOC));
        $res->free();
    }
} while ($mysqli->more_results() && $mysqli->next_result());

//required to relocate after php script complete
header("Location: bookingcomplete.php");
// this statement is needed 
die("Redirecting to bookingcomplete.php");

$mysqli->close();
?>