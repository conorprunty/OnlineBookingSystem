<?php
/*
* @reference http://forums.devshed.com/php-faqs-stickies-167/program-basic-secure-login-system-using-php-mysql-891201.html *
*/ 

//session.php accesses the mySQL database

$username = "root";
$password = "root";
$host = "localhost";
$dbname = "obsadmintest";

try{
    $db = new PDO("mysql:host={$host}; port=8889; dbname={$dbname};charset=UTF8", $username, $password);
} catch (PDOException $ex) {
    die("Failed to connect to the database: " . $ex->getMessage()); 
}
//configure PDO to throw exception if error encountered
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//return db rows using associative array - will have string indexes where string value
//represents the column name
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
//initialise session which stores information about visitors. Info is stored on server side.
session_start(); 
?>