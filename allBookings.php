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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
        User Bookings
      </div>
         <div align='center'>
            <?php
            $query = mysqli_query($db, " 
            SELECT *
            FROM bookings
            ORDER BY id asc;
        ");
        ?>
        <div class="floater">
            <table class="striped" align='center'>
                <tr class="header">
                    <td><h4>ID</h4></td>
                    <td><h4>User</h4></td>
                    <td><h4>Table</h4></td>
                    <td><h4>Day</h4></td>
                    <td><h4>Time</h4></td>
                    <td><h4>Email</h4></td>
                    <td><h4>Reference</h4></td>
                </tr>
                <?php
                    if (false === $query) {
                        die(mysql_error()); 
                    }
                   while ($row = mysqli_fetch_array($query)) {
                       echo "<tr>";
                       echo "<td>".$row[id]."</td>";
                       echo "<td>".$row[userName]."</td>";
                       echo "<td>".$row[userTable]."</td>";
                       echo "<td>".$row[userDay]."</td>";
                       echo "<td>".$row[userTime]."</td>";
                       echo "<td>".$row[email]."</td>";
                       echo "<td>".$row[ranNum]."</td>";
                       echo "</tr>";
                   }
                ?>
            </table>
        </div>
        <br>
        <div>
            <p><b>Click here to return to the admin page.</b></p>
            <form action="admin.php" name="add" method="post">
                <input type="submit" class="homepageSubmit" name="submit" value="Enter" />
            </form>
        </div>
        
    </body>
</html>