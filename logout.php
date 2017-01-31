<?php 
/*
* logout.php *
*
* @reference http://forums.devshed.com/php-faqs-stickies-167/program-basic-secure-login-system-using-php-mysql-891201.html *
*/ 
    // Required for all pages once logged in
    require("session.php"); 
     
    // Remove user's date in order to log out
    unset($_SESSION['user']); 
     
    // Redirect to index page
    header("Location: index.php"); 
    die("Redirecting to: index.php");
?>