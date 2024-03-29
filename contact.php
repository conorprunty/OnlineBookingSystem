<?php
/*
 * contact.php
 *@ author Conor Prunty
 *
 */
// connect to DB
require("session.php");
require("registersession.php");

//required for the banner
$icon         = mysqli_query($connect, "SELECT icon FROM banner");
$bannerresult = mysqli_fetch_array($icon);


//checks all combinations of invalid entries and ends the script with an alert
if (!empty($_POST)) {
    if (empty($_POST['email'])) {
?>
           <script type="text/javascript">
                alert("Please enter an email address.");
                window.location.href = "contact.php";
            </script>
    <?php
        die();
    }
    
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
?>
           <script type="text/javascript">
                alert("Please enter a valid email address.");
                window.location.href = "contact.php";
            </script>
    <?php
        die();
    }
    
    if (empty($_POST['subject'])) {
?>
           <script type="text/javascript">
                alert("Please enter a subject.");
                window.location.href = "contact.php";
            </script>
    <?php
        die();
    }
    
    if (empty($_POST['comment'])) {
?>
           <script type="text/javascript">
                alert("Please enter a comment.");
                window.location.href = "contact.php";
            </script>
    <?php
        die();
    }
}
//if "email" variable is filled out, send email
if (isset($_REQUEST['email'])) {
    
    //Email information
    $admin_email = "conorprunty1@gmail.com";
    $email       = $_REQUEST['email'];
    $subject     = $_REQUEST['subject'];
    $comment     = $_REQUEST['comment'];
    
    //send email - To, Subject, Message, From (etc)
    mail("$admin_email", "$subject", $comment, "From:" . $email);
    
    //JS to let user know the mail has been sent
    
?>
           <script type="text/javascript">
            alert("Mail sent to admin");
            window.location.href = "welcome.php";
            </script>
        <?php
}
  
  //if "email" variable is not filled out, display the form
else{
?>

<!DOCTYPE html>
<html>
	<head>
		<title>
			Online Booking System
		</title>
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
	</head>
	<body onload="setBanner()">
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
						<li><a href="userbooking.php">New Booking</a></li>
						<li><a href="cancel.php">Cancel Booking</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="active"><a href="contact.php">
							<span class="glyphicon glyphicon-comment"></span>
							Contact
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<br>
		<br>
		<div align='center'>
			<div class="col-md-offset-4 col-md-4">
				<div class="panel-default">
					<div class="contactform">
						<div class="panel-body">
							<form method="post">
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" class="form-control" name="email" id="email" placeholder="Email">
								</div>
								<label for="subject">Subject</label>
								<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
						</div>
						<label for="comment">Comment(s)</label>
						<textarea class="form-control" name="comment" maxlength="250" placeholder="Enter comment(s) here" rows="3" id="comment"></textarea>
						<br>
						<button type="submit" value="Submit" class="btn btn-default">Submit</button>
					</div>
				</div>
			</div>
		</div>
		</form>
	</body>
</html>

<?php   
}
?>