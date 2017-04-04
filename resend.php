<?php
/*
* contact.php
*@ author Conor Prunty
*
*/
    // connect to DB
    require("session.php"); 

    session_start();
    $userTable = $_SESSION['userTable'];
    $userDay = $_SESSION['userDay'];
    $userTime = $_SESSION['userTime']; session_start(); $_SESSION['userTime'] = $userTime;
    $ranNum = $_SESSION['ranNum']; session_start(); $_SESSION['ranNum'] = $ranNum;
    $userName = $_SESSION['userName']; session_start(); $_SESSION['userName'] = $userName;    
    $email = $_POST["resend"]; session_start(); $_SESSION['resend'] = $email;

  $subject = "Booking Request";


  $body = "Hi ".$_SESSION['userName'].",\n\n";
  $body .= "Your booking for ";
  $body .= $userTable;
  $body .= " on ";
  $body .= $userDay;
  $body .= " at ";
  $body .= $userTime;
  $body .= " has been confirmed.\n\n";
  $body .= "Your unique booking reference is ";
  $body .= $_SESSION['ranNum'];
  $body .= ".\n\nPlease use this when arriving or in the event of a cancellation.\n\nIf there are any issues with this, or you did not request a booking, please contact conorprunty@hotmail.com\n\nThanks.";
  
  //send email - To, Subject, Message, From (etc)
  mail("$email", "$subject", $body, "From:" . $email);
  
  //JS to let user know the mail has been sent

        ?>
            <script type="text/javascript">
            alert("Booking confirmed. Please check your email!");
            window.location.href = "bookingcomplete.php";
            </script>
        <?php
?>