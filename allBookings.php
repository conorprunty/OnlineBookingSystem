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
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.1/js/dataTables.select.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/filtertable.js" type="text/javascript"></script>
    <script src="js/sortTable.js" type="text/javascript"></script>
    
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
                  <li><a href="setup.php">Setup</a></li>
                  <li><a href="admin.php">Admin</a></li>
                  <li class="dropdown active">
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
        User Bookings
      </div>
      <p id="test"></p>
         <div align='center'>
            <?php
            $query = mysqli_query($db, " 
            SELECT *
            FROM bookings
            ORDER BY id asc;
        ");
        ?>
        <div class="floater">
            <div class="styled-select select" align="right">
                <select>
                    <option id="date"></option>
                </select>
            </div>
            <br>
            <script src="js/date.js" type="text/javascript"></script>
            <table id="tableFilter" class="table table-hover table-bordered table-responsive fulltable" align='center'>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Table</th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Email</th>
                        <th>Reference</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                
                <?php
                    if (false === $query) {
                        die(mysql_error()); 
                    }
                   while ($row = mysqli_fetch_array($query)) {
                       echo "<tr>";
                       echo "<td>".$row[userName]."</td>";
                       echo "<td>".$row[userTable]."</td>";
                       echo "<td>".$row[userDay]."</td>";
                       echo "<td>".$row[userTime]."</td>";
                       echo "<td>".$row[email]."</td>";
                       echo "<td>".$row[ranNum]."</td>";
                       echo "<td><form id=\"delete\" method=\"post\" action=\"deleteBooking.php\" onsubmit=\"return confirm('Are you sure?')\">
    <input type=\"hidden\" name=\"id\" value=" . $row["id"] . ">
    <input type=\"hidden\" name=\"table\" value=" . $row["userTable"] . ">
    <input type=\"hidden\" name=\"day\" value=" . $row["userDay"] . ">
    <input type=\"hidden\" name=\"time\" value=" . $row["userTime"] . ">
    <input class=\"submitb\" name=\"submit\" type=\"image\" src=\"images/delete.png\" height=\"42\" width=\"42\" value=\"Submit\">
    </form></td>";
                       echo "</tr>";
                   }
                ?>
            </table>
        </div>
        <br>
        <div>
            <p><b>Click here to return to the admin page.</b></p>
            <form action="admin.php" name="add" method="post">
                <input type="submit" class="btn btn-info" name="submit" value="Enter" />
            </form>
        </div>
        <div>
          <!-- need an empty div here due to issue with the webhost account -->
          <br>
          <br>
          <br>
      </div>
    </body>
</html>