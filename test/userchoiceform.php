<?php
	/*
*@ author Conor Prunty
*/
	// connect to DB
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
  $body .= ".\n\nPlease use this when arriving or in the event of a cancellation.\n\nThanks.";
  
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
        <script>
            window.onload = function createRan(){
                var test = Math.floor(Math.random() * 1000000);
                document.getElementById("ranNum").value = test;
            }        
        </script>
    </head>
<body>
      
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">Online Booking System</a>
            </div>
            <ul class="nav navbar-nav">
              <li class="active"><a href="setup.php">Setup</a></li>
              <li><a href="admin.php">Admin</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Bookings
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="allBookings.php">View All</a></li>
                  <li><a href="updatebookings.php">Edit</a></li>
                </ul>
              </li> 
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">
                    <span class="glyphicon glyphicon-log-in"></span>
                    TBC
                    </a>
                </li>
            </ul>
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
          <button type="submit" value="Submit" class="homepageSubmit">Submit</button>
        </form>
    </div>
    

    </body>
</html>
<?php
      
  }
?>
