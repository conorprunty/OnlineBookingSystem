<?php
	/*
* insert.php *
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
    else {
			//selecting all areas available
			$query = " 
            SELECT id, allAreas
            FROM areas
            ORDER BY id desc;
        ";

		try {
			// run query
			$stmt   = $db->prepare($query);
			$result = $stmt->execute($query_params);
			$row    = $stmt->fetch();
		}

		catch (PDOException $ex) {
			die("Failed to run query: " . $ex->getMessage());
		}

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
      
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">Online Booking System</a>
            </div>
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#">Admin</a></li>
              <li><a href="#">Bookings</a></li>
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
        Setup
      </div>
      
      <div class="container">
          <div class="row">       
            <form action="userSelect.php" name="userChoice" method="post" class="setupForm">
              <div class="col-6 col-md-4">
                  <br>
                  <div class="styled-select select">
                      <p><b>Choose area required for your club:</b></p>
                      
                      <?php
                        //partially taken from:
                        //http://stackoverflow.com/questions/8022353/how-to-populate-html-dropdown-list-with-values-from-database

                        echo "<select name='userOption'>";
                        do{
                            unset($id, $name);
                            $id = $row['allAreas'];
                            $allAreas = $row['allAreas']; 
                            echo '<option value="'.$allAreas.'">'.$allAreas.'</option>';
                        }
                        while ($row = $stmt->fetch()) ;
                        echo "</select>";
                        ?>                      
                  </div>
                  <br>
              </div>
              <div class="col-6 col-md-4">
                  <br>
                  <p><b>Choose days required:</b></p>
                        <input type="checkbox" checked="true" name="monday" value="Free" class="dayselect">Monday<br>
                        <input type="checkbox" checked="true" name="tuesday" value="Free" class="dayselect">Tuesday<br>
                        <input type="checkbox" checked="true" name="wednesday" value="Free" class="dayselect">Wednesday<br>
                        <input type="checkbox" checked="true" name="thursday" value="Free" class="dayselect">Thursday<br>
                        <input type="checkbox" checked="true" name="friday" value="Free" class="dayselect">Friday<br>
                        <input type="checkbox" checked="true" name="saturday" value="Free" class="dayselect">Saturday<br>
                        <input type="checkbox" checked="true" name="sunday" value="Free" class="dayselect">Sunday<br>
                  <br>
                  <br>
                        <input type="submit" class="homepageSubmit" name="submit" value="Submit" />
              </div>
              <div class="col-6 col-md-4">
                  <br>
                  <p><b>Choose times required:</b></p>
                  <div class="col-6 col-md-4">
                      <input type="checkbox" checked="true" name="time1" value="Free" class="timeselect">09-10<br>
                      <input type="checkbox" checked="true" name="time2" value="Free" class="timeselect">10-11<br>
                      <input type="checkbox" checked="true" name="time3" value="Free" class="timeselect">11-12<br>
                      <input type="checkbox" checked="true" name="time4" value="Free" class="timeselect">12-13<br>
                      <input type="checkbox" checked="true" name="time5" value="Free" class="timeselect">13-14<br>
                      <input type="checkbox" checked="true" name="time6" value="Free" class="timeselect">14-15<br>
                  </div>
                  <div class="col-6 col-md-4">
                      <input type="checkbox" checked="true" name="time7" value="Free" class="timeselect">15-16<br>
                      <input type="checkbox" checked="true" name="time8" value="Free" class="timeselect">16-17<br>
                      <input type="checkbox" checked="true" name="time9" value="Free" class="timeselect">17-18<br>
                      <input type="checkbox" checked="true" name="time10" value="Free" class="timeselect">18-19<br>
                      <input type="checkbox" checked="true" name="time11" value="Free" class="timeselect">19-20<br>
                      <input type="checkbox" checked="true" name="time12" value="Free" class="timeselect">20-21<br>
                  </div>
              </div>
            </form> 
        </div>
      </div>
      <div class="addNew">
            <form action="addNew.php" name="add" method="post" onsubmit="return validateForm()">
                 <p>Don't see your area? <br>Type here and click submit to add to the list!</p>
                <input type="text" name="area" id="entry" placeholder="area" /></li>
                <input type="submit" class="homepageSubmit" name="submit" value="Submit" />
            </form>
        </div>
</body>
</html>