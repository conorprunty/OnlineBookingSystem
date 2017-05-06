<?php
/*
 *addNew.php
 *@ author Conor Prunty
 */
include("phpsession.php");

$newarea = $_POST['area'];

//this is to prevent MySQL injections by users entering malicious data
//http://www.wikihow.com/Prevent-SQL-Injection-in-PHP
if ($stmt = $mysqli->prepare("INSERT INTO areas (allAreas) VALUES (?)")) {
 
    // Bind the variables to the parameter as strings. 
    $stmt->bind_param("s", $newarea);
 
    // Execute the statement.
    $stmt->execute();
 
    // Close the prepared statement.
    $stmt->close();
 
}

header("Location: setup.php");
// this statement is needed 
die("Redirecting to setup.php");

$mysqli->close();
?>