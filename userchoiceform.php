<?php
	/*
*@ author Conor Prunty
*/
	// connect to DB
	require("session.php");

    session_start();
    $userTable = $_SESSION['userTable'];
    $userDay = $_SESSION['userDay'];
    $userTime = $_POST["userOption"]; session_start(); $_SESSION['userTime'] = $userTime;
    

//if "email" variable is filled out, send email
  if (isset($_REQUEST['email']))  {
  
  //Email information
      
  //takes user's email address
  $admin_email = $_REQUEST['email'];
      
  //need a valid 'from' address - will use old one for now
  $email = "admin@swapsies.netai.net";
      
  //create a default subject
  $subject = "Booking Confirmation";

  //$comment = $_REQUEST['comment'];
  //$name = $_REQUEST['name'];
  //$userarea = $_REQUEST['userarea'];
  $body = "Hi ".$_POST["name"].",\n\n";
  $body .= "Your booking for ";
  $body .= $userTable;
  $body .= " on ";
  $body .= $userDay;
  $body .= " at ";
  $body .= $userTime;
  $body .= " has been confirmed.";
  
  //send email - To, Subject, Message, From (etc)
  mail("$admin_email", "$subject", $body, "From:" . $email);
  
  //JS to let user know the mail has been sent

        ?>
            <script type="text/javascript">
            alert("Mail sent!");
            window.location.href = "index.php";
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
      
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">Online Booking System</a>
            </div>
            <ul class="nav navbar-nav">
              <li class="active"><a href="setup.php">Setup</a></li>
              <li><a href="admin.php">Admin</a></li>
              <li><a href="updatebookings.php">Bookings</a></li>
              <li><a href="#">About</a></li>
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
          <input type="text" name="userarea" id="userarea" value="<?php echo $userTable; ?>" disabled><br>
          Day entered:<br>
          <input type="text" name="userday" id="userday" value="<?php echo $userDay; ?>" disabled><br>
          Time entered:<br>
          <input type="text" name="usertime" id="usertime" value="<?php echo $userTime; ?>" disabled><br>
          Please enter your name:<br>
          <input type="text" name="name" id="name"><br>
          Please enter your email address:<br>
          <input type="email" name="email" id="email"><br>
          <!--the random number-->
          <input type="text" name="ranNum" id="ranNum" /><br>
          <button type="submit" value="Submit" class="homepageSubmit">Submit</button>
        </form>
    </div>
    

    </body>
</html>
<?php
      
  }
?>
