<?php
/*
* contact.php
*@ author Conor Prunty
*
*/
    // connect to DB
    require("session.php"); 
  session_start();
  $emailTBD = $_SESSION['emailTBD'];
  //Email information
  $admin_email = "conorprunty@hotmail.com";
  //$email = "conorprunty@hotmail.com";
  $subject = $_REQUEST['subject'];
  $bookingref = $_SESSION['bookingref'];
  
  //send email - To, Subject, Message, From (etc)
  mail("$emailTBD", "$subject", $bookingref, "From:" . $email);
  
  //JS to let user know the mail has been sent

        ?>
            <script type="text/javascript">
            alert("Mail sent re: cancellation.");
            window.location.href = "welcome.php";
            </script>
        <?php
?>