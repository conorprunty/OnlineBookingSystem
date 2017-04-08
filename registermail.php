<?php
/*
 * registermail.php
 *@ author Conor Prunty
 *
 */
// connect to DB
require("session.php");
include("registersession.php");


$usermail = mysqli_query($connect, "SELECT * FROM `users` ORDER BY id DESC LIMIT 1");
$result = mysqli_fetch_array($usermail);

if (false === $result) {
        die(mysql_error());
}

$username = $result['username'];
$email = $result['email'];
$subject = "Booking Request";

//this stores the body of the email
$body = "Hi ";
$body .= $username;
$body .= ",\n\n";
$body .= "Thank you for registering with the Online Booking System!\n\n";
$body .= "If you have any queries, please contact the site admin at conorprunty@hotmail.com.\n\n";
$body .= "Thanks.";

//send email - To, Subject, Message, From (etc)
mail("$email", "$subject", $body, "From:" . $email);

//JS to let user know the mail has been sent

?>
           <script type="text/javascript">
            window.location.href = "index.php";
            </script>
        <?php
?>