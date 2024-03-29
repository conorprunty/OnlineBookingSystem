<?php
/*
 *@ author Conor Prunty
 *adminopts.php
 */
include("phpsession.php");
// Check connection

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$name = $_POST["userOption"];
session_start();
$_SESSION['name'] = $name;
$weektwo          = $_POST["userOption"] . "week2";
$weekthree        = $_POST["userOption"] . "week3";

if (isset($_POST['Update'])) {
    //if update chosen, redirect - will use the session variables above too
    header("Location: updateopts.php");
    die("Redirecting to updateopts.php");
    //else all the mysql commands required for deleting the options
} else if (isset($_POST['Delete'])) {
    //delete action
    $sql = "UPDATE areas SET `Chosen` = 'No', `used` = '' WHERE `allAreas` = '" . $_POST['userOption'] . "';";
    $sql .= "ALTER TABLE `daysUsed` DROP " . $_POST["userOption"] . ";";
    $sql .= "DELETE FROM `areas` WHERE `allAreas` = '" . $_POST['userOption'] . "' AND `newentry` = 'yes';";
    $sql .= "DROP table " . $_POST["userOption"] . ";";
    $sql .= "DROP table $weektwo;";
    $sql .= "DROP table $weekthree;";
    $sql .= "DELETE FROM `bookings` WHERE `userTable` = '" . $_POST['userOption'] . "';";
    $sql .= "DELETE FROM `bookings` WHERE `userTable` = '$weektwo';";
    $sql .= "DELETE FROM `bookings` WHERE `userTable` = '$weekthree';";
    $sql .= "UPDATE areas SET `cost` = '0' WHERE `allAreas` = '" . $_POST['userOption'] . "'";
} else {
    //no button pressed
    
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

//required for a redirect when php script complete
header("Location: admin.php");
// this statement is needed 
die("Redirecting to admin.php");

$mysqli->close();
?>