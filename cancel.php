<?php 
	/*
* cancel.php *
*
* @reference (PHP) http://forums.devshed.com/php-faqs-stickies-167/program-basic-secure-login-system-using-php-mysql-891201.html *
*/
	// get connection to DB
	require("session.php");
	//check if form has been submitted, if not form is displayed
	
	if(!empty($_POST))     {
		// if username is empty, tell user to submit proper username
		
		if(empty($_POST['ranNum']))         {
            ?>
			<script type="text/javascript">
                alert("Please enter a booking reference number.");
                location.reload();
            </script>
    <?php
            die();
		}
		// SQL query to check if reference is valid
		$query = " 
            SELECT 
                1 
            FROM bookings 
            WHERE 
                ranNum = :ranNum
        ";
		// this is the token for the ranNum - this is used to 
		// prevent sql injection attacks.
		$query_params = array(             ':ranNum' => $_POST['ranNum']         );
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
		
		if(!$row)         {
			?>
			<script type="text/javascript">
                alert("Invalid booking reference.");
                location.reload();
            </script>
        <?php
            die();
		}
        
		// Remove option from bookings table
		$query = " 
            DELETE FROM bookings WHERE ranNum = :ranNum
        ";
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
            alert("Booking deleted.");
            window.location.href = "index.php";
            </script>
<?php
 } ?>
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
        Cancel
      </div>
        <div align="center">
            <form action="cancel.php" name="cancel" method="post" id="cancel">
                Enter the booking reference number here to cancel<br><br>
                <input name="ranNum" type="text" id="ranNum"><br><br>
                <input type="submit" class="btn btn-info" value="Submit"><br><br>
            </form>
        </div>
    </body>
</html>
