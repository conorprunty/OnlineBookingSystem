<?php
/*
 *@ author Conor Prunty
 *userchoiceformtwo.php
 */
// connect to DB

require("registersession.php");

//required for the banner
$icon         = mysqli_query($connect, "SELECT icon FROM banner");
$bannerresult = mysqli_fetch_array($icon);
require("session.php");

//takes all required session variables
session_start();
$userTable    = $_SESSION['userTable'];
$userTableTwo = $userTable . "week2";
$userDay      = $_SESSION['userDay'];
$userTime     = $_REQUEST['userOption'];
session_start();
$_SESSION['userOption'] = $userTime;
$ranNum                 = $_REQUEST['ranNum'];
session_start();
$_SESSION['ranNum'] = $ranNum;
$userName           = $_POST["userName"];
session_start();
$_SESSION['userName'] = $userName;
$email                = $_REQUEST['email'];
session_start();
$_SESSION['email'] = $email;


//if "email" variable is filled out, send email
if (isset($_REQUEST['email'])) {
    
    //overwrite the userTime variable  
    $userTime = $_POST['userTime'];
    session_start();
    $_SESSION['userTime'] = $userTime;
    
    //ensure valid email entered
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
?>
           <script type="text/javascript">
                alert("Please enter a valid email address.");
                window.history.back();
            </script>
    <?php
        die();
    }
    
    if (empty($_POST['userName'])) {
?>
           <script type="text/javascript">
                alert("Please enter your name.");
                window.history.back();
            </script>
    <?php
        die();
    }
    
    //take date of sunday next week
    $nextSunday = date('Y-m-d', strtotime('sunday next week'));
    
    //Email information
    
    //takes user's email address
    $admin_email = $_REQUEST['email'];
    
    //need a valid 'from' address - will use old one for now
    $email = "conorprunty@hotmail.com";
    
    //create a default subject
    $subject = "Booking Confirmation";
    
    //body is broken down into different parts
    //makes the code readable and easier to change
    $body = "Hi " . $_POST["userName"] . ",\n\n";
    $body .= "Your booking for ";
    $body .= $userTable;
    $body .= " on ";
    $body .= $userDay;
    $body .= " at ";
    $body .= $userTime;
    $body .= " has been confirmed for the week ending ";
    $body .= $nextSunday;
    $body .= ".\n\n";
    $body .= "Your unique booking reference is ";
    $body .= $_REQUEST['ranNum'];
    $body .= ".\n\nPlease use this when arriving or in the event of a cancellation.\n\nIf there are any issues with this, or you did not request a booking, please contact conorprunty@hotmail.com\n\nThanks.";
    
    //send email - To, Subject, Message, From (etc)
    mail("$admin_email", "$subject", $body, "From:" . $email);
    
    //JS to let user know the mail has been sent
    
?>
           <script type="text/javascript">
            alert("Booking confirmed, please check your email!");
            window.location.href = "addUserOptionTwo.php";
            </script>
        <?php
    
}
//if "email" variable is not filled out, display the form
else{
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
		<script src="js/ran.js" type="text/javascript"></script>
		<script type="text/javascript">
			var icon = <?php echo $bannerresult["icon"];?>;
		</script>
		<script src="js/showhide.js" type="text/javascript"></script>
	</head>
	<body onload="setBanner(), createRan(), hide()">
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
		<div id="hidediv" align="center">
			<b>You must pay before you can continue!</b>
		</div>
		<br>
        <!-- the paypal button -->
		<div id="hidepaypal">
			<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" align="center">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_paynow_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
		</div>
		<br>
		<div align='center'>
			<div class="col-md-offset-4 col-md-4">
				<div class="panel-default">
					<div class="contactform">
						<div class="panel-body">
							<form method="post">
                                <!-- this puts the user values chosen into a form -->
								<b>Area chosen:</b><br>
								<input type="text" class="form-control" name="userArea" id="userArea" value="<?php echo $userTable; ?>" readonly><br>
								<b>Day chosen:</b><br>
								<input type="text" class="form-control" name="userDay" id="userDay" value="<?php echo $userDay; ?>" readonly><br>
								<b>Time chosen:</b><br>
								<input type="text" class="form-control" name="userTime" id="userTime" value="<?php echo $userTime; ?>" readonly><br>
								Please enter your name:<br>
								<input type="text" class="form-control" name="userName" id="userName"><br>
								Please enter your email address:<br>
								<input type="email" class="form-control" name="email" id="email"><br>
								<!--the random number-->
								<input type="hidden" name="ranNum" id="ranNum" /><br>
								<button type="submit" id="submitButton" value="Submit" class="btn btn-info">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
		<br>
		<div>
            <!-- used when no banner is selected -->
            <div id="iconRemoved" style="display:none"></div>
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
