<?php
/*
 *@ author Conor Prunty
 *userupdate.php
 */
include("phpsession.php");
// Check connection

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$userarea  = $_POST['userarea'];
$userweek  = $_POST['userweek'];
$userday   = $_POST['userday'];
$usertime  = $_POST['usertime'];
$uservalue = $_POST['uservalue'];
  
$weektwo = $userarea . "week2";
$weekthree = $userarea . "week3";

if($userweek == "weekone"){
    $sql .= "UPDATE `$userarea` SET `$userday`='$uservalue' WHERE `Time` = '$usertime'";
}
if($userweek == "weektwo"){
    $sql .= "UPDATE `$weektwo` SET `$userday`='$uservalue' WHERE `Time` = '$usertime'";
}
if($userweek == "weekthree"){
    $sql .= "UPDATE `$weekthree` SET `$userday`='$uservalue' WHERE `Time` = '$usertime'";
}
if($userweek == "all"){
    $sql .= "UPDATE `$userarea` SET `$userday`='$uservalue' WHERE `Time` = '$usertime';";
    $sql .= "UPDATE `$weektwo` SET `$userday`='$uservalue' WHERE `Time` = '$usertime';";
    $sql .= "UPDATE `$weekthree` SET `$userday`='$uservalue' WHERE `Time` = '$usertime'";
}

//mysql commands

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