<?php
	/*
* index.php *
*
* @reference (PHP) http://forums.devshed.com/php-faqs-stickies-167/program-basic-secure-login-system-using-php-mysql-891201.html *
*/
	// Get DB link
	require("session.php");
	// this variable will be used to re-display the username if incorrect password entered 
	$submitted_username = '';
	// check if login submitted
	
	if(!empty($_POST))     {
		// retrieve user info query
		$query = " 
            SELECT 
                id, 
                username, 
                password, 
                salt, 
                email 
            FROM users 
            WHERE 
                username = :username 
        ";
		// parameter
		$query_params = array(             ':username' => $_POST['username']         );
		try         {
			// run query
			$stmt = $db->prepare($query);
			$result = $stmt->execute($query_params);
		}

		catch(PDOException $ex)         {
			die("Failed to run query: " . $ex->getMessage());
		}

		// This variable tells us whether the user has successfully logged in or not. 
		// We initialize it to false, assuming they have not. 
		// If we determine that they have entered the right details, then we switch it to true. 
		$login_ok = false;
		// Retrieve the user data from the database.  If $row is false, then the username 
		// they entered is not registered. 
		$row = $stmt->fetch();
		
		if($row)         {
			// Using the password submitted by the user and the salt stored in the database, 
			// we now check to see whether the passwords match by hashing the submitted password 
			// and comparing it to the hashed version already stored in the database. 
			$check_password = hash('sha256', $_POST['password'] . $row['salt']);
			for($round = 0; $round < 65536; $round++)             {
				$check_password = hash('sha256', $check_password . $row['salt']);
			}

			
			if($check_password === $row['password'])             {
				// If they do, then we flip this to true 
				$login_ok = true;
			}

		}

		
		if($login_ok)         {
			// $_SESSION is stored on the server-side, there is no reason to store 
			// sensitive values in it unless you have to. Here I remove these.
			unset($row['salt']);
			unset($row['password']);
			// This stores the user's data into the session at the index 'user'. 
			$_SESSION['user'] = $row;
			// Rediret to main menu
			header("Location: admin.php");
			die("Redirecting to: admin.php");
		} else         {
			echo '<script language="javascript">';
			echo 'alert("Login Failed: Invalid Details")';
			echo '</script>';
			// Show user their password again. The use of htmlentities prevents XSS attacks. 
			$submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
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
        </div>
    </nav>
      
      <div id="pageheader" align="center">
        Login
      </div>
      
      <div align="center">
          <div class="row">
              <div class="col-md-offset-4 col-md-4">
                  <div class="panel-default">
                      <div class="panel-body">
                        <form action="index.php" method="post">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input name="username" type="text" class="form-control" id="input-default" placeholder="Username">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-key fa-fw"></i>
                                </span>
                                <input name="password" type="password" class="form-control" id="input-default" placeholder="Password">
                            </div> 
                            <br>
                            <input type="submit" class="btn btn-info" value="Submit">
                        </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
</body>
</html>