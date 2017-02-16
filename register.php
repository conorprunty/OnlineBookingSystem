<?php 
	/*
* register.php *
*
* @reference (PHP) http://forums.devshed.com/php-faqs-stickies-167/program-basic-secure-login-system-using-php-mysql-891201.html *
*/
	// get connection to DB
	require("session.php");
	//check if form has been submitted, if not form is displayed
	
	if(!empty($_POST))     {
		// if username is empty, tell user to submit proper username
		
		if(empty($_POST['username']))         {
            ?>
			<script type="text/javascript">
                alert("Please enter a username.");
                location.reload();
            </script>
    <?php
            die();
		}
		// make sure user enters not-empty password
		
		if(empty($_POST['password']))         {
			?>
			<script type="text/javascript">
                alert("Please enter a password.");
                location.reload();
            </script>
    <?php
            die();
		}
		// check for valid email address
		
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))         {
			?>
			<script type="text/javascript">
                alert("Please enter a valid email address.");
                location.reload();
            </script>
    <?php
            die();
		}
		// SQL query to check if username already taken 
		$query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                username = :username 
        ";
		// this is the token for the username - this is used to 
		// prevent sql injection attacks.
		$query_params = array(             ':username' => $_POST['username']         );
		try         {
			// query the database
			$stmt = $db->prepare($query);
			$result = $stmt->execute($query_params);
		}
		catch(PDOException $ex)         {
			die("Failed to run query: " . $ex->getMessage());
		}
		// fetch returns an array representing the next row or false for no rows
		$row = $stmt->fetch();
		// If a row is returned, then the email is in use
		
		if($row)         {
			?>
			<script type="text/javascript">
                alert("Username already chosen.");
                location.reload();
            </script>
        <?php
            die();
		}
		// check same for email
		$query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                email = :email 
        ";
		$query_params = array(             ':email' => $_POST['email']         );
		try         {
			$stmt = $db->prepare($query);
			$result = $stmt->execute($query_params);
		}
		catch(PDOException $ex)         {
			die("Failed to run query: " . $ex->getMessage());
		}
		$row = $stmt->fetch();
		
		if($row)         {
			?>
			<script type="text/javascript">
                alert("Email address already registered.");
                location.reload();
            </script>
        <?php
            die();
		}
		// Insert details into DB 
		$query = " 
            INSERT INTO users ( 
                username, 
                password, 
                salt, 
                email 
            ) VALUES ( 
                :username, 
                :password, 
                :salt, 
                :email 
            ) 
        ";
		// generate salt to help with hashing password
		$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
		// This hashes the password with the salt for security
		$password = hash('sha256', $_POST['password'] . $salt);
		// Next we hash the hash value 65536 more times.  The purpose of this is to 
		// protect against brute force attacks.  Now an attacker must compute the hash 65537 
		// times for each guess they make against a password, whereas if the password 
		// were hashed only once the attacker would have been able to make 65537 different  
		// guesses in the same amount of time instead of only one. 
		for($round = 0; $round < 65536; $round++)         {
			$password = hash('sha256', $password . $salt);
		}
		// Here we prepare our tokens for insertion into the SQL query.  We do not 
		// store the original password; only the hashed version of it. 
		$query_params = array(             ':username' => $_POST['username'],             ':password' => $password,             ':salt' => $salt,             ':email' => $_POST['email']         );
		try         {
			// Execute the query to create the user 
			$stmt = $db->prepare($query);
			$result = $stmt->execute($query_params);
		}
		catch(PDOException $ex)         {
			die("Failed to run query: " . $ex->getMessage());
		}
		?>
        <script type="text/javascript">
            alert("Thank you for registering! Please click close to go to login page.");
            window.location.href = "index.php";
            </script>
<?php
 } ?>
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
        Registration
      </div>
      
      <div align="center">
          <div class="row">
              <div class="col-md-offset-4 col-md-4">
                  <div class="panel-default">
                      <div class="panel-body">
                        <form action="register.php" method="post">
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
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope-o fa-fw"></i>
                                </span>
                                <input name="email" type="text" class="form-control" id="input-default" placeholder="Email">
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