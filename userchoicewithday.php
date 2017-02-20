<?php
	/*
*@ author Conor Prunty
*/
	// connect to DB
	require("session.php");

    session_start();
    $userTable = $_SESSION['userTable'];
    $userDay = $_POST["userOption"]; session_start(); $_SESSION['userDay'] = $userDay;
			//selecting all areas available
			$query = " 
            SELECT id, Time
            FROM $userTable
            WHERE `Used` = 'Yes'
            ORDER BY id asc;
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

?>
<!DOCTYPE html>

<html>
    <head>
        <title>Online Booking System</title>
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
                    TBC
                    </a>
                </li>
            </ul>
        </div>
    </nav>
      
      <div id="pageheader" align="center">
        Booking
      </div>
        <form action="usertable.php" name="userChoice" method="post" id="userSubmit">
          <div class="container">
              <div class="row">      
                  <div align="center">
                      <br>
                      <div class="styled-select select">
                          <p><b>Day chosen:</b></p>
                          <select>
                            <option value="volvo" disabled><?php echo $userDay; ?></option>
                          </select>
                      </div>
                      <br>
                      <div class="styled-select select">
                          <p><b>Choose your day:</b></p>

                          <?php
                            //partially taken from:
                            //http://stackoverflow.com/questions/8022353/how-to-populate-html-dropdown-list-with-values-from-database
                            if($row != null){
                                echo "<select name='userOption' id='allOptions'>";
                                do{
                                    unset($id, $Time);
                                    $id = $row['Time'];
                                    $Time = $row['Time']; 
                                    echo '<option value="'.$Time.'">'.$Time.'</option>';
                                }
                                while ($row = $stmt->fetch()) ;
                                echo "</select>"; 
                                ?>
                                <br>
                                <br>
                                <br>
                                <input type="submit" class="homepageSubmit" name="Submit" value="Submit"/>
                              <?php
                                }  
                            
                            else{
                                echo "There are no days available!";
                                ?>
                                <br>
                                <br>
                                <p><b> Please contact the admin of the site. </b></p>
                                <?php
                            }
                            ?>     
                      </div>
                      <br>
                  </div>
               </div>
          </div>
      </form> 
    </body>
</html>
