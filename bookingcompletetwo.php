<?php
	/*
* bookingcomplete.php *
*
*@ author Conor Prunty
*/
	// connect to DB
	require("session.php");
    require("registersession.php");

 //this prevents direct access to this page - can only come from the redirect on setup.php
    if (strstr($_SERVER['HTTP_REFERER'],"userchoiceformtwo.php")){
        //you came from the right page
    }
    else{
        // returns to setup.php page
        header("Location: welcome.php");
		// this kills the php script
		die("Redirecting to welcome.php");
    }
    
    $icon = mysqli_query($connect, "SELECT icon FROM banner");
    $bannerresult = mysqli_fetch_array($icon);
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
      <br>
    <div align="center">
        <h2><b>Booking Complete! Share with your friends below!</b></h2>
      <br>
      <br>
          <!-- @reference http://stackoverflow.com/questions/14829040/facebook-sharer-popup-window/14829742#14829742 -->
        <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fonlinebookingsystem.000webhostapp.com%2Fwelcome.php&picture=&title=&caption=Online+Booking+System&quote=I+just+made+a+booking+online%21&description=" target="_blank">
            <img src="images/facebook.png" width="60" height="60" border="0">
        </a>
        <br>
        <br>
       <a href="https://twitter.com/intent/tweet?button_hashtag=obs" class="twitter-hashtag-button" data-size="large" data-text="I just made a booking online!" data-show-count="false">Tweet #obs</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>
      <br>
      <br>
      <div align="center">
            <p><b>Re-enter your email address here if you need to resend your booking.</b></p>
            <form action="resend.php" name="resend" method="post">
                <input type="text" name="resend" id="resend" placeholder="Enter email address..." />
                <input type="submit" class="btn btn-info" name="submit" value="Enter" />
            </form>
        </div>
      
      <br>
      <br>
      
      <div align="center">
            <p><b>Click here to return to the home page.</b></p>
            <form action="welcome.php" name="add" method="post">
                <input type="submit" class="btn btn-info" name="submit" value="Enter" />
            </form>
        </div>
      
      

</body>
</html>