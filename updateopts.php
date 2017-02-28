<?php
	/*
*@ author Conor Prunty
*/
	// connect to DB
    require("session.php");
	include("sessions.php");
	// Check whether user is logged in
	
	if(empty($_SESSION['user']))     {
		// If they are not, redirect to the login page. 
		header("Location: index.php");
		// this statement is needed 
		die("Redirecting to index.php");
    }

    //this prevents direct access to this page - can only come from the redirect on updatebookings.php
    //this also helps display the table based on the input from the selection menu
    if (strstr($_SERVER['HTTP_REFERER'],"updatebookings.php")){
        //you came from the right page
    }
    else{
        // returns to setup.php page
        header("Location: updatebookings.php");
		// this kills the php script
		die("Redirecting to updatebookings.php");
    }

	//takes name from logged in username
	$name = htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');

    session_start();
    //takes variable of the user's selections
    $name = $_SESSION['name'];

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
                    Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>
      <div id="pageheader" align="center">
        Update
    </div>
    <form onSubmit="return checkAnswer();" name="userChoice" method="post" class="setupForm">
          <div class="container">
              <div class="row">      
                  <div align="center">
                      <br>
                      <!--http://stackoverflow.com/questions/7562095/redirect-on-select-option-in-select-box-->
                      <div class="styled-select select">
                          <p><b>Choose option required:</b></p>
                            <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                <option value="">Select...</option>
                                <option value="addday.php">Add a new day</option>
                                <option value="addtime.php">Add a new time</option>
                                <option value="removeday.php">Remove an existing day</option>
                                <option value="removetime.php">Remove an existing time</option>
                            </select>
                      </div>
                      <br>
                  </div>
               </div>
          </div>
      </form> 
      
      <div align='center'>
            <?php

            $name = $_SESSION['name'];

            $query = mysql_query(" 
            SELECT *
            FROM $name
            WHERE Used = 'Yes'
            ORDER BY id asc;
        ");
        ?>
        <h4>Here is the current <?= $name ?> table:</h4>
        <div class="floater">
            <table class="striped" align='center'>
                <tr class="header">
                    <td><h4>Time</h4></td>
                    <td><h4>Monday</h4></td>
                    <td><h4>Tuesday</h4></td>
                    <td><h4>Wednesday</h4></td>
                    <td><h4>Thursday</h4></td>
                    <td><h4>Friday</h4></td>
                    <td><h4>Saturday</h4></td>
                    <td><h4>Sunday</h4></td>
                </tr>
                <?php
                   while ($row = mysql_fetch_array($query)) {
                       echo "<tr>";
                       echo "<td>".$row[Time]."</td>";
                       echo "<td>".$row[Monday]."</td>";
                       echo "<td>".$row[Tuesday]."</td>";
                       echo "<td>".$row[Wednesday]."</td>";
                       echo "<td>".$row[Thursday]."</td>";
                       echo "<td>".$row[Friday]."</td>";
                       echo "<td>".$row[Saturday]."</td>";
                       echo "<td>".$row[Sunday]."</td>";
                       echo "</tr>";
                   }
                ?>
            </table>
        </div>
      </div>
</body>
</html>