<?php
/*
 *@ author Conor Prunty
 *userSelectUpdate.php
 */
include("phpsession.php");
// Create connection
$mysqli = new mysqli($host, $username, $password, $dbname);
// Check connection

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

session_start();
//takes variable of the user's selected area, day and time
$name = $_SESSION['name'];
$day  = $_SESSION['day'];
$time = $_SESSION['time'];

//updates each day
foreach ($_SESSION['day'] as $day) {
    $sql .= "UPDATE `daysUsed` SET `$name`='Yes' WHERE `days` = '$day';";
    if (!$mysqli->multi_query($sql)) {
        echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    
    do {
        if ($res = $mysqli->store_result()) {
            var_dump($res->fetch_all(MYSQLI_ASSOC));
            $res->free();
        }
    } while ($mysqli->more_results() && $mysqli->next_result());
}

header("Location: userSelectCost.php");
// this statement is needed 
die("Redirecting to userSelectCost.php");

$mysqli->close();
?>