<?php
	/*
* welcome.php *
*
*@ author Conor Prunty
*/
	// connect to DB
	require("session.php");
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
  </head>
  <body>
      
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="index.php">Online Booking System</a>
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
        </div>
    </nav>
      
      <div id="pageheader" align="center">
        Welcome
      </div>
      
      <div class="container">
        <div class="row text-center">
            <div class="col-sm-4">
                <a href="userbooking.php">
                    <img src="images/test.png">
                </a>
                <h2>Create Booking</h2>
            </div>
            <div class="col-sm-4">
                <a href="cancel.php">
                    <img src="images/test.png">
                </a>
                <h2>Delete Booking</h2>
            </div>
         <div class="col-sm-4">
                <a href="contact.php">
                    <img src="images/test.png">
                </a>
             <h2>Contact Admin</h2>
            </div>
        </div>
    </div>  
    <footer>
      <p>Contact site owner: <a href="mailto:conorprunty@hotmail.com">
      conorprunty@hotmail.com</a></p>
    </footer>
</body>
</html>