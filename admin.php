<?php
	/*
* mainmenu.php *
*
*@ author Conor Prunty
*/
	// connect to DB
	require("session.php");
    require("registersession.php");
	// Check whether user is logged in
	
	if(empty($_SESSION['user']))     {
		// If they are not, redirect to the login page. 
		header("Location: index.php");
		// this statement is needed 
		die("Redirecting to index.php");
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
              <a class="navbar-brand">Online Booking System</a>
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
                  <li><a href="setup.php">Setup</a></li>
                  <li class="active"><a href="admin.php">Admin</a></li>
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
                    <li><a href="logout.php" onclick="return confirm('Are you sure you want to logout?');">
                        <span class="glyphicon glyphicon-log-in"></span>
                        Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
      
      <div id="pageheader" align="center">
        Admin
      </div>
      
      <div class="container">
        <div class="row text-center">
            <div class="col-sm-3">
                <a href="setup.php" data-toggle="tooltip" data-placement="top" title="Setup your area(s) required">
                    <img src="images/setup.ico" height="200px" width="180px">
                </a>
                <h2>Setup Features</h2>
            </div>
            <div class="col-sm-3">
                <a href="updatebookings.php" data-toggle="tooltip" data-placement="top" title="Update or Delete areas or bookings">
                    <img src="images/booking.png" height="200px" width="180px">
                </a>
                <h2>Update Bookings</h2>
            </div>
            <div class="col-sm-3">
                <a href="edit_account.php" data-toggle="tooltip" data-placement="top" title="Update your own information">
                    <img src="images/profile.png" height="200px" width="180px">
                </a>
             <h2>Update Information</h2>
            </div>
            <div class="col-sm-3">
                <a href="addbanner.php" data-toggle="tooltip" data-placement="top" title="Add or remove a banner">
                    <img src="images/banner.png" height="200px" width="180px">
                </a>
                <h2>Add Banner</h2>
            </div>
        </div>
    </div>  
    <div>
          <!-- need an empty div here due to issue with the webhost account -->
          <br>
          <br>
          <br>
      </div>
</body>
</html>