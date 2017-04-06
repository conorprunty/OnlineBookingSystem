<?php
/*
 *@ author Conor Prunty
 *custDeleteButton.php
 */
include("registersession.php");

session_start();
$bookingref = $_SESSION['bookingref'];

$result = mysqli_query($connect, "SELECT userTable, userDay, userTime, email FROM `bookings` WHERE `ranNum` = '$bookingref'");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
$row          = mysqli_fetch_row($result);
//takes all the required session variables
$userTableTBD = $row[0];
session_start();
$_SESSION['userTableTBD'] = $userTableTBD;
$userDayTBD               = $row[1];
session_start();
$_SESSION['userDayTBD'] = $userDayTBD;
$userTimeTBD            = $row[2];
session_start();
$_SESSION['userTimeTBD'] = $userTimeTBD;
$emailTBD                = $row[3];
session_start();
$_SESSION['emailTBD'] = $emailTBD;

//redirect once script has ran
header("Location: custDeleted.php");
// this statement is needed 
die("Redirecting to custDeleted.php");

$mysqli->close();
?>