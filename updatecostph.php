<?php
/*
 *@ author Conor Prunty
 *updatecostph.php
 */
include("phpsession.php");
// Check connection

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

session_start();
//takes variable of the user's selected area
$name = $_SESSION['name'];

$sql .= "UPDATE `areas` SET `cost`='" . $_POST['cost'] . "' WHERE `allAreas` = '$name';";
if (!$mysqli->multi_query($sql)) {
    echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

do {
    if ($res = $mysqli->store_result()) {
        var_dump($res->fetch_all(MYSQLI_ASSOC));
        $res->free();
    }
} while ($mysqli->more_results() && $mysqli->next_result());

header("Location: updateopts.php");
// this statement is needed 
die("Redirecting to updateopts.php");

$mysqli->close();
?>