<?php
/*
 * custDeletedEmail.php
 *@ author Conor Prunty
 *
 */
// connect to DB
require("session.php");

//session variables for the email
session_start();
$email = "conorprunty@hotmail.com";
$emailTBD = $_SESSION['emailTBD'];
$subject  = "Cancellation";

$bookingref = "Hi, \n\n";
$bookingref .= "Your booking under reference " . $_SESSION['bookingref'] . " was cancelled. \n\n";
$bookingref .= "If you did not request this, please contact the site admin. \n\n";
$bookingref .= "Thanks.";

//send email - To, Subject, Message, From (etc)
mail("$emailTBD", "$subject", $bookingref, "From:" . $email);

//JS to let user know the mail has been sent

?>
           <script type="text/javascript">
            alert("Booking cancelled. Please check your email.");
            window.location.href = "welcome.php";
            </script>
        <?php
?>