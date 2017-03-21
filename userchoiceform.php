<?php
	/*
*@ author Conor Prunty
*/
	// connect to DB
	
    require("registersession.php");
    $icon = mysqli_query($connect, "SELECT icon FROM banner");
    $bannerresult = mysqli_fetch_array($icon);
    require("session.php"); 
    session_start();
    $userTable = $_SESSION['userTable'];
    $userDay = $_SESSION['userDay'];
    $userTime = $_REQUEST['userOption']; session_start(); $_SESSION['userOption'] = $userTime;
    $ranNum = $_REQUEST['ranNum']; session_start(); $_SESSION['ranNum'] = $ranNum;
    $userName = $_POST["userName"]; session_start(); $_SESSION['userName'] = $userName;
    $email = $_REQUEST['email']; session_start(); $_SESSION['email'] = $email;
  

//if "email" variable is filled out, send email
  if (isset($_REQUEST['email']))  {
      
  //overwrite the userTime variable  
  $userTime = $_POST['userTime']; session_start(); $_SESSION['userTime'] = $userTime;

  //ensure valid email entered
      if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))         {
			?>
			<script type="text/javascript">
                alert("Please enter a valid email address.");
                window.history.back();
            </script>
    <?php
            die();
		}
      
  //Email information
      
  //takes user's email address
  $admin_email = $_REQUEST['email'];
      
  //need a valid 'from' address - will use old one for now
  $email = "conorprunty@hotmail.com";
      
  //create a default subject
  $subject = "Booking Confirmation";

  //body is broken down into different parts
  //makes the code readable and easier to change
  $body = "Hi ".$_POST["userName"].",\n\n";
  $body .= "Your booking for ";
  $body .= $userTable;
  $body .= " on ";
  $body .= $userDay;
  $body .= " at ";
  $body .= $userTime;
  $body .= " has been confirmed.\n\n";
  $body .= "Your unique booking reference is ";
  $body .= $_REQUEST['ranNum'];
  $body .= ".\n\nPlease use this when arriving or in the event of a cancellation.\n\nIf there are any issues with this, or you did not request a booking, please contact conorprunty@hotmail.com\n\nThanks.";
  
  //send email - To, Subject, Message, From (etc)
  mail("$admin_email", "$subject", $body, "From:" . $email);
  
  //JS to let user know the mail has been sent

        ?>
            <script type="text/javascript">
            alert("Booking confirmed, please check your email!");
            window.location.href = "addUserOption.php";
            </script>
        <?php
      
  }
  
  //if "email" variable is not filled out, display the form
  else  {
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Online Booking System</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="style/style.css" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/banner.js" type="text/javascript"></script>
        <script type="text/javascript">
        var icon = <?php echo $bannerresult["icon"];?>;
        </script>
        <script type="text/javascript">
            window.onload = function createRan(){
                var test = Math.floor(Math.random() * 1000000);
                document.getElementById("ranNum").value = test;
            }        
        </script>
    </head>
<body>
    
    <header>
        <div id="icon"></div>
    </header>
      
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="welcome.php">Homepage</a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar">
                    </span>
                    <span class="icon-bar">
                    </span>
                    <span class="icon-bar">
                    </span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="userbooking.php">New Booking</a></li>
                  <li><a href="cancel.php">Cancel Booking</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="contact.php">
                        <span class="glyphicon glyphicon-comment"></span>
                        Contact
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
      
    <div id="pageheader" align="center">
        Booking
    </div>
    
    <div align="center">
        <form method="post">
          Area entered:<br>
          <input type="text" name="userArea" id="userArea" value="<?php echo $userTable; ?>" readonly><br>
          Day entered:<br>
          <input type="text" name="userDay" id="userDay" value="<?php echo $userDay; ?>" readonly><br>
          Time entered:<br>
          <input type="text" name="userTime" id="userTime" value="<?php echo $userTime; ?>" readonly><br>
          Please enter your name:<br>
          <input type="text" name="userName" id="userName"><br>
          Please enter your email address:<br>
          <input type="email" name="email" id="email"><br>
          <!--the random number-->
          <input type="hidden" name="ranNum" id="ranNum" /><br>
          <button type="submit" value="Submit" class="btn btn-info">Submit</button>
        </form>
    </div>
    <br>
    
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" align="center">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
    ">
            <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>
    <div>
          <!-- need an empty div here due to issue with the webhost account -->
          <br>
          <br>
          <br>
      </div>
    </body>
</html>
<?php
      
  }
?>
