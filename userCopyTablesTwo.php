<?php
/*
 *@ author Conor Prunty
 *userCopyTablesTwo.php
 */
include("phpsession.php");
// Check connection

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

session_start();
//takes session variable of area user chose
$name      = $_SESSION['name'];
$weekthree = $name . "week3";

//puts same initial values into second table
$sql .= "INSERT INTO $weekthree SELECT * FROM `$name`;";
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