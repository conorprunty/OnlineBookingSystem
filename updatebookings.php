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
    else {
			//selecting all areas available
			$query = " 
            SELECT id, allAreas
            FROM areas
            WHERE `Chosen` = 'Yes'
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
      
      <form action="adminopts.php" name="userChoice" method="post" onsubmit="return confirm('Warning: Updating or deleting entries cannot be undone. Are you sure you wish to continue?');">
          <div class="container">
              <div class="row">      
                  <div align="center">
                      <br>
                      <div class="styled-select select">
                          <p><b>Select from your list of areas:</b></p>

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
                          <br>
                          <br>
                          <p><b>And choose to update or delete:</b></p>
                          <br>
                        <input type="submit" class="homepageSubmit" name="Update" value="Update" />
                        <input type="submit" class="homepageSubmit" name="Delete" value="Delete" />
                      </div>
                      <br>
                  </div>
               </div>
          </div>
      </form> 
</body>
</html>