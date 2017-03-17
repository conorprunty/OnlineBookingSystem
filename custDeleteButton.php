<?php
/*
*@ author Conor Prunty
*/ include("registersession.php");

session_start();
$bookingref = $_SESSION['bookingref'];

            $result = mysqli_query($connect, "SELECT userTable, userDay, userTime FROM `bookings` WHERE `ranNum` = '$bookingref'");
            if (!$result) {
                echo 'Could not run query: ' . mysql_error();
                exit;
            }
            $row = mysqli_fetch_row($result);
            $userTableTBD = $row[0]; session_start(); $_SESSION['userTableTBD'] = $userTableTBD;
            $userDayTBD = $row[1]; session_start(); $_SESSION['userDayTBD'] = $userDayTBD;
            $userTimeTBD = $row[2]; session_start(); $_SESSION['userTimeTBD'] = $userTimeTBD;

        header("Location: custDeleted.php");
		// this statement is needed 
		die("Redirecting to custDeleted.php");    

	$mysqli->close();
?>
