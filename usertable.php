<?php
    if (strstr($_SERVER['HTTP_REFERER'],"userbooking.php")){
            //you came from the right page
        }
        else{
            // returns to setup.php page
            header("Location: userbooking.php");
            // this kills the php script
            die("Redirecting to userbooking.php");
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
              <a class="navbar-brand" href="welcome.php">Online Booking System</a>
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
      
      <div id="pageheader" align="center">
        Booking
      </div>
         <div align='center'>
            <?php

            include("sessions.php");

            $query = mysqli_query($db," 
            SELECT *
            FROM ".$_POST['userOption']."
            WHERE Used = 'Yes'
            ORDER BY id asc;
        ");
        $userTable = $_POST["userOption"]; session_start(); $_SESSION['userTable'] = $userTable;
        ?>
        <h4><?= $_POST['userOption'] ?> table:</h4>
        <div class="floater">
            <table class="table table-hover table-bordered table-responsive fulltable" align='center'>
                <thead>
                    <tr>
                        <td><h4>Time</h4></td>
                        <td><h4>Monday</h4></td>
                        <td><h4>Tuesday</h4></td>
                        <td><h4>Wednesday</h4></td>
                        <td><h4>Thursday</h4></td>
                        <td><h4>Friday</h4></td>
                        <td><h4>Saturday</h4></td>
                        <td><h4>Sunday</h4></td>
                    </tr>
                </thead>
                <?php
                    if (false === $query) {
                        die(mysql_error()); 
                    }
                   while ($row = mysqli_fetch_array($query)) {
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
        <br>
        <div>
            <p><b>Click here to select a different area.</b></p>
            <form action="userbooking.php" method="post">
                <input type="submit" class="btn btn-info" name="submit" value="Enter" />
            </form>
            <p><b>Click here to make a booking.</b></p>
            <form action="userchoice.php" method="post">
                <input type="submit" class="btn btn-info" name="submit" value="Enter" />
            </form>
        </div>
             <footer>
    <p>Contact site owner: <a href="mailto:conorprunty@hotmail.com">
     conorprunty@hotmail.com</a></p>
  </footer>
        
    </body>
</html>