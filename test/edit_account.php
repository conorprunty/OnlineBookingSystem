<?php 

    //http://forums.devshed.com/php-faqs-stickies-167/program-basic-secure-login-system-using-php-mysql-891201.html
    require("session.php"); 
     
    //check user is logged in
    if(empty($_SESSION['user'])) 
    { 
        header("Location: index.php"); 
         
        //required
        die("Redirecting to index.php"); 
    } 
     
    if(!empty($_POST)) 
    { 
        //validate the email entered
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { 
            ?>
			<script type="text/javascript">
                alert("Invalid email entered.");
                location.reload();
            </script>
    <?php
            die(); 
        } 
         
        //checks if new email address already exists
        if($_POST['email'] != $_SESSION['user']['email']) 
        { 
            // Define our SQL query 
            $query = " 
                SELECT 
                    1 
                FROM users 
                WHERE 
                    email = :email 
            "; 
             
            // Define our query parameter values 
            $query_params = array( 
                ':email' => $_POST['email'] 
            ); 
             
            try 
            { 
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params); 
            } 
            catch(PDOException $ex) 
            { 
                die("Failed to run query: " . $ex->getMessage()); 
            } 
             
            // Retrieve results (if any) 
            $row = $stmt->fetch(); 
            if($row) 
            { 
                die("This E-Mail address is already in use"); 
            } 
        } 
         
        //rehash and generate salt again if new password entered
        if(!empty($_POST['password'])) 
        { 
            $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
            $password = hash('sha256', $_POST['password'] . $salt); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $password = hash('sha256', $password . $salt); 
            } 
        } 
        else 
        { 
            //password not updated if left blank
            $password = null; 
            $salt = null; 
        } 
         
        // Initial query parameter values 
        $query_params = array( 
            ':email' => $_POST['email'], 
            ':user_id' => $_SESSION['user']['id'], 
        ); 
         
        if($password !== null) 
        { 
            $query_params[':password'] = $password; 
            $query_params[':salt'] = $salt; 
        } 

        //combines all parts of the query depending on what the user enters
        $query = " 
            UPDATE users 
            SET 
                email = :email 
        "; 
         
        if($password !== null) 
        { 
            $query .= " 
                , password = :password 
                , salt = :salt 
            "; 
        } 
         
        $query .= " 
            WHERE 
                id = :user_id 
        "; 
         
        try 
        { 
            // Execute the query 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        $_SESSION['user']['email'] = $_POST['email']; 
         
        header("Location: admin.php"); 
         
        die("Redirecting to admin.php"); 
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
        Edit Account
      </div>
      
    <form action="edit_account.php" method="post">
        <div class="container">
              <div class="row">      
                  <div align="center">
                    Username:<br> 
                    <b><?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?></b> 
                    <br><br> 
                    E-Mail Address:<br> 
                    <input type="text" name="email" value="<?php echo htmlentities($_SESSION['user']['email'], ENT_QUOTES, 'UTF-8'); ?>" /> 
                    <br><br> 
                    Password:<br> 
                    <input type="password" name="password" value="" /><br> 
                    <i>(leave blank if you do not want to change your password)</i> 
                    <br><br> 
                    <input type="submit" value="Update Account" /> 
                  </div>
            </div>
        </div>
    </form>
</body>
</html>