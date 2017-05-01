<?php
/*
 *@ author Conor Prunty
 *userchoiceform.php
 */
// connect to DB

require("registersession.php");

//required for the banner
$icon         = mysqli_query($connect, "SELECT icon FROM banner");
$bannerresult = mysqli_fetch_array($icon);
require("session.php");

//takes all required session variables
session_start();
$userTable = $_SESSION['userTable'];
$userDay   = $_SESSION['userDay'];
$userTime  = $_REQUEST['userOption'];
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
    
    //take date of next Sunday
    $nextSunday = date('Y-m-d', strtotime('next sunday'));
    //Email information
    
    //takes user's email address
    $admin_email = $_REQUEST['email'];
    
    //need a valid 'from' address - will use my own for now
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
            window.location.href = "addUserOption.php";
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
		<div id="hidepaypal" align="center">
            <a href="https://www.paypal.com/uk/signin" target="_blank" onclick="show()">
                <img src="images/paypalimage.gif">
            </a>
            <!-- this is the paypal button -->
            <!-- there is an issue with the developer paypal button currently
                 I have emailed them but for now, I'm putting in just a link 
                 to the paypal login page -->
<!--
			<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" align="center">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIHiQYJKoZIhvcNAQcEoIIHejCCB3YCAQExggE6MIIBNgIBADCBnjCBmDELMAkGA1UEBhMCVVMxEzARBgNVBAgTCkNhbGlmb3JuaWExETAPBgNVBAcTCFNhbiBKb3NlMRUwEwYDVQQKEwxQYXlQYWwsIEluYy4xFjAUBgNVBAsUDXNhbmRib3hfY2VydHMxFDASBgNVBAMUC3NhbmRib3hfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tAgEAMA0GCSqGSIb3DQEBAQUABIGAF90Lf16D9oSQ4aIgKsOjhtLN3lb/YFtUGCGkgsYHCJWHAGy9ZFkRltXRUWIcgSaawGP5XxbFDDwMFA82tgP6K8+sQ8cqekOKaeJjZc9rHx6QBQKpObZb+zjhuF2YhSXe/ebE+uTKgBwlFXlGRcVXdlKGbL/UfNHIBtdQuTSNZqYxCzAJBgUrDgMCGgUAMIHUBgkqhkiG9w0BBwEwFAYIKoZIhvcNAwcECGsl4qyzberkgIGwZEmjO9aUopA1QVI9oQVssgEqQMltrTX7wl2P1pIpwOHDVP6ANvQJj1zDxaFN6UN53xH+fqI/igw3k+Sinpe3CRIbwxvlX8nXugICZBDyBRC9OSaLMOJl9/y92pzisr1JvzX6tR33hQFXYjVZbfv8SgGUv3R92douRETgcQ8T2UBqvn8e4fR4CdGnDDoqQsFsLcKV7C2Yu735s4GMsDJ9w7tlvOiFYzU0f9NL1DV0jO+gggOlMIIDoTCCAwqgAwIBAgIBADANBgkqhkiG9w0BAQUFADCBmDELMAkGA1UEBhMCVVMxEzARBgNVBAgTCkNhbGlmb3JuaWExETAPBgNVBAcTCFNhbiBKb3NlMRUwEwYDVQQKEwxQYXlQYWwsIEluYy4xFjAUBgNVBAsUDXNhbmRib3hfY2VydHMxFDASBgNVBAMUC3NhbmRib3hfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tMB4XDTA0MDQxOTA3MDI1NFoXDTM1MDQxOTA3MDI1NFowgZgxCzAJBgNVBAYTAlVTMRMwEQYDVQQIEwpDYWxpZm9ybmlhMREwDwYDVQQHEwhTYW4gSm9zZTEVMBMGA1UEChMMUGF5UGFsLCBJbmMuMRYwFAYDVQQLFA1zYW5kYm94X2NlcnRzMRQwEgYDVQQDFAtzYW5kYm94X2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbTCBnzANBgkqhkiG9w0BAQEFAAOBjQAwgYkCgYEAt5bjv/0N0qN3TiBL+1+L/EjpO1jeqPaJC1fDi+cC6t6tTbQ55Od4poT8xjSzNH5S48iHdZh0C7EqfE1MPCc2coJqCSpDqxmOrO+9QXsjHWAnx6sb6foHHpsPm7WgQyUmDsNwTWT3OGR398ERmBzzcoL5owf3zBSpRP0NlTWonPMCAwEAAaOB+DCB9TAdBgNVHQ4EFgQUgy4i2asqiC1rp5Ms81Dx8nfVqdIwgcUGA1UdIwSBvTCBuoAUgy4i2asqiC1rp5Ms81Dx8nfVqdKhgZ6kgZswgZgxCzAJBgNVBAYTAlVTMRMwEQYDVQQIEwpDYWxpZm9ybmlhMREwDwYDVQQHEwhTYW4gSm9zZTEVMBMGA1UEChMMUGF5UGFsLCBJbmMuMRYwFAYDVQQLFA1zYW5kYm94X2NlcnRzMRQwEgYDVQQDFAtzYW5kYm94X2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbYIBADAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBBQUAA4GBAFc288DYGX+GX2+WP/dwdXwficf+rlG+0V9GBPJZYKZJQ069W/ZRkUuWFQ+Opd2yhPpneGezmw3aU222CGrdKhOrBJRRcpoO3FjHHmXWkqgbQqDWdG7S+/l8n1QfDPp+jpULOrcnGEUY41ImjZJTylbJQ1b5PBBjGiP0PpK48cdFMYIBpDCCAaACAQEwgZ4wgZgxCzAJBgNVBAYTAlVTMRMwEQYDVQQIEwpDYWxpZm9ybmlhMREwDwYDVQQHEwhTYW4gSm9zZTEVMBMGA1UEChMMUGF5UGFsLCBJbmMuMRYwFAYDVQQLFA1zYW5kYm94X2NlcnRzMRQwEgYDVQQDFAtzYW5kYm94X2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbQIBADAJBgUrDgMCGgUAoF0wGAYJKoZIhvcNAQkDMQsGCSqGSIb3DQEHATAcBgkqhkiG9w0BCQUxDxcNMTcwNDAzMjA1MTIxWjAjBgkqhkiG9w0BCQQxFgQULXvHGhGZovsyZAFILlM+5RuyEkwwDQYJKoZIhvcNAQEBBQAEgYBJnJlWBgBresd/YsjMwLSZGDcygV4XYqwj1l/+eVespN1OcjrveeS0SfEoSAFHy7g1LcE6+8WXFWfv43CbJ1R8c9ofwJGV9y5lnt7yXS+nNcQwT8yjubWdobw9/807jtnZM5Hbzl1hvPvxvOc1fRZsKysazg9rfMm8ye2rJxgHFg==-----END PKCS7-----
					">
				<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_paynow_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" onclick="show()">
				<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
-->
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
