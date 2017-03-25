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
    <script src="js/numsonly.js" type="text/javascript"></script>
    <script src="js/selectall.js" type="text/javascript"></script>
  </head>
  <body>
      
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
              <div class="col-6 col-md-3">
                 <li>
<p><b>Choose times required:</b></p>
  <ul>
   <li><input type="checkbox" name="title" id="title_1" /> <label for="title_1"><strong>All Early</strong></label>
    <ul>
<li><input type="checkbox" name="time[]" class="timeselect" value="00-01" /> 00-01</li>
     <li><input type="checkbox" name="time[]" class="timeselect" value="01-02" /> 01-02</li>
     <li><input type="checkbox" name="time[]" class="timeselect" value="02-03" /> 02-03</li>
     <li><input type="checkbox" name="time[]" class="timeselect" value="03-04" /> 03-04</li>
                <li><input type="checkbox" name="time[]" class="timeselect" value="04-05" /> 04-05</li>
                <li><input type="checkbox" name="time[]" class="timeselect" value="05-06" /> 05-06</li>
                <li><input type="checkbox" name="time[]" class="timeselect" value="06-07" /> 06-07</li>
                <li><input type="checkbox" name="time[]" class="timeselect" value="07-08" /> 07-08</li>
                <li><input type="checkbox" name="time[]" class="timeselect" value="08-09" /> 08-09</li>
                <li><input type="checkbox" name="time[]" checked="true" class="timeselect" value="09-10" /> 09-10</li>
                <li><input type="checkbox" name="time[]" checked="true" class="timeselect" value="10-11" /> 10-11</li>
                <li><input type="checkbox" name="time[]" checked="true" class="timeselect" value="11-12" /> 11-12</li>
    </ul>
   </li>
  </ul>
  <ul>
      </div>
      <div class="col-6 col-md-3">
  <br>
    <br>
   <li><input type="checkbox" name="title" id="title_2" /> <label for="title_2"><strong>All Late</strong></label>
    <ul>
<li><input type="checkbox" name="time[]" checked="true" class="timeselect" value="12-13" /> 12-13</li>
                <li><input type="checkbox" name="time[]" checked="true" class="timeselect" value="13-14" /> 13-14</li>
     <li><input type="checkbox" name="time[]" checked="true" class="timeselect" value="14-15" /> 14-15</li>
     <li><input type="checkbox" name="time[]" checked="true" class="timeselect" value="15-16" /> 15-16</li>
     <li><input type="checkbox" name="time[]" checked="true" class="timeselect" value="16-17" /> 16-17</li>
                <li><input type="checkbox" name="time[]" checked="true" class="timeselect" value="17-18" /> 17-18</li>
                <li><input type="checkbox" name="time[]" checked="true" class="timeselect" value="18-19" /> 18-19</li>
     <li><input type="checkbox" name="time[]" checked="true" class="timeselect" value="19-20" /> 19-20</li>
     <li><input type="checkbox" name="time[]" checked="true" class="timeselect" value="20-21" /> 20-21</li>
     <li><input type="checkbox" name="time[]" class="timeselect" value="21-22" /> 21-22</li>
                <li><input type="checkbox" name="time[]" class="timeselect" value="22-23" /> 22-23</li>
     <li><input type="checkbox" name="time[]" class="timeselect" value="23-00" /> 23-00</li>
    </ul>
   </li>
  </ul>
</li>
              </div>
              <div class="col-6 col-md-3">
                  <p><b>Choose cost of rent:</b></p>
                        <div id="staticParent">
                            <input id="child" name="cost" type="textarea" />
                        </div><br>      
              </div>
          </div>
      </div>
          <input align="center" type="submit" class="btn btn-info" name="submit" value="Submit" />
          </form> 
      <div>
          <!-- need an empty div here due to issue with the webhost account -->
          <br>
          <br>
          <br>
      </div>
</body>
</html>