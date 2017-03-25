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
        require("registersession.php");
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
            <div class="styled-select select" align="right">
                <select>
                    <option id="date"></option>
                </select>
            </div>
            <br>
            <script src="js/date.js" type="text/javascript"></script>
            <table class="table table-hover table-bordered table-responsive fulltable" align='center'>
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                        <th>Sunday</th>
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
             <div>
          <!-- need an empty div here due to issue with the webhost account -->
          <br>
          <br>
          <br>
      </div>
        
    </body>
</html>