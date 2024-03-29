<?php
/*
 *@ author Conor Prunty
 *userSelectTime.php
 */
include("phpsession.php");
// Check connection

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

session_start();
//takes variable of the user's selected area and day
$name = $_SESSION['name'];
$day  = $_SESSION['day'];
$time = $_SESSION['time'];

//updates each time
foreach ($_SESSION['time'] as $time) {
    $sql = "UPDATE $name SET `Used`='Yes' WHERE `Time` = '$time'";
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

header("Location: userSelectUpdate.php");
// this statement is needed 
die("Redirecting to userSelectUpdate.php");

$mysqli->close();
?>