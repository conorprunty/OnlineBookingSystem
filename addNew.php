<?php
/*
 *addNew.php
 *@ author Conor Prunty
 */
include("phpsession.php");
{
    if (isset($_POST['area'])) {
        $sql = "INSERT INTO areas (allAreas)
          VALUES   ('" . $_POST["area"] . "')";
    }
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

header("Location: setup.php");
// this statement is needed 
die("Redirecting to setup.php");

$mysqli->close();
?>