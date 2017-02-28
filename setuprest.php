<?php
	/*
*@ author Conor Prunty
*/
	// connect to DB
	require("session.php");
	// Check whether user is logged in
	
	if(empty($_SESSION['user']))     {
		// If they are not, redirect to the login page. 
		header("Location: index.php");
		// this statement is needed 
		die("Redirecting to index.php");
	}

    //this prevents direct access to this page - can only come from the redirect on setup.php
    if (strstr($_SERVER['HTTP_REFERER'],"setup.php")){
        //you came from the right page
    }
    else{
        // returns to setup.php page
        header("Location: setup.php");
		// this kills the php script
		die("Redirecting to setup.php");
    }

	//takes name from logged in username
	$name = htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');

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
    <script type="text/javascript">
    function validateForm()
        {
        var entry=document.forms["add"]["area"].value;
        if (entry==null || entry=="")
          {
          alert("Please enter an area");
          return false;
          }
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
                    Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>
      
      <div id="pageheader" align="center">
        Setup
      </div>
      
      <form action="userSelectRest.php" name="userChoice" method="post" class="setupForm">
      
      <div class="container">
          <div class="row">       
              <div class="col-6 col-md-3">
                  <p><b>Choose days required:</b></p>
                        <input type="checkbox" checked="true" name="day[]" value="Monday" class="dayselect">Monday<br>
                        <input type="checkbox" checked="true" name="day[]" value="Tuesday" class="dayselect">Tuesday<br>
                        <input type="checkbox" checked="true" name="day[]" value="Wednesday" class="dayselect">Wednesday<br>
                        <input type="checkbox" checked="true" name="day[]" value="Thursday" class="dayselect">Thursday<br>
                        <input type="checkbox" checked="true" name="day[]" value="Friday" class="dayselect">Friday<br>
                        <input type="checkbox" checked="true" name="day[]" value="Saturday" class="dayselect">Saturday<br>
                        <input type="checkbox" checked="true" name="day[]" value="Sunday" class="dayselect">Sunday<br>          
              </div>
              <div class="col-6 col-md-4">
                  <p><b>Choose times required:</b></p>
                       <div class="col-6 col-md-3">
                      <input type="checkbox" name="time[]" value="00-01" class="timeselect">00-01<br>
                      <input type="checkbox" name="time[]" value="01-02" class="timeselect">01-02<br>
                      <input type="checkbox" name="time[]" value="02-03" class="timeselect">02-03<br>
                      <input type="checkbox" name="time[]" value="03-04" class="timeselect">03-04<br>
                      <input type="checkbox" name="time[]" value="04-05" class="timeselect">04-05<br>
                      <input type="checkbox" name="time[]" value="05-06" class="timeselect">05-06<br>
                  </div>
                  <div class="col-6 col-md-3">
                      <input type="checkbox" name="time[]" value="06-07" class="timeselect">06-07<br>
                      <input type="checkbox" name="time[]" value="07-08" class="timeselect">07-08<br>
                      <input type="checkbox" name="time[]" value="08-09" class="timeselect">08-09<br>
                      <input type="checkbox" checked="true" name="time[]" value="09-10" class="timeselect">09-10<br>
                      <input type="checkbox" checked="true" name="time[]" value="10-11" class="timeselect">10-11<br>
                      <input type="checkbox" checked="true" name="time[]" value="11-12" class="timeselect">11-12<br>
                  </div>
                  <div class="col-6 col-md-3">
                      <input type="checkbox" checked="true" name="time[]" value="12-13" class="timeselect">12-13<br>
                      <input type="checkbox" checked="true" name="time[]" value="13-14" class="timeselect">13-14<br>
                      <input type="checkbox" checked="true" name="time[]" value="14-15" class="timeselect">14-15<br>
                      <input type="checkbox" checked="true" name="time[]" value="15-16" class="timeselect">15-16<br>
                      <input type="checkbox" checked="true" name="time[]" value="16-17" class="timeselect">16-17<br>
                      <input type="checkbox" checked="true" name="time[]" value="17-18" class="timeselect">17-18<br>
                  </div>
                  <div class="col-6 col-md-3">
                      <input type="checkbox" checked="true" name="time[]" value="18-19" class="timeselect">18-19<br>
                      <input type="checkbox" checked="true" name="time[]" value="19-20" class="timeselect">19-20<br>
                      <input type="checkbox" checked="true" name="time[]" value="20-21" class="timeselect">20-21<br>
                      <input type="checkbox" name="time[]" value="21-22" class="timeselect">21-22<br>
                      <input type="checkbox" name="time[]" value="22-23" class="timeselect">22-23<br>
                      <input type="checkbox" name="time[]" value="23-00" class="timeselect">23-00<br>
                  </div>
              </div>
              <div class="col-6 col-md-3">
                  <p><b>Choose cost of rent:</b></p>
                        <input type="number" min="0" step="5" name="cost" id="cost" placeholder="Enter cost..." class="costselect"><br>      
              </div>
          </div>
      </div>
          <input align="center" type="submit" class="homepageSubmit" name="submit" value="Submit" />
          </form> 
</body>
</html>