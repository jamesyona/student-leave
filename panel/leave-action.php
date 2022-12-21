<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
	// database connection
	include('../config/connection.php');

	if(isset($_POST['accept_leave'])) {

        $leave_id = mysqli_real_escape_string($connection, $_POST['leave_id']);

		$reject_leave = mysqli_query($connection, "UPDATE `leave_form` SET current = 0,  status = 'accepted'  WHERE leave_id = $leave_id");

		if($reject_leave) {
			$_SESSION['success'] = "Leave accepted successfully";
			header("location: leave.php");
			// echo "success";
		}

		else {
			//die(mysqli_error($connection));
			 $_SESSION['error'] = "Something went wrong try again!";
			 header("location: leave.php");
			 die(mysqli_error($connection));

		}	
	}


	else if(isset($_POST['reject_leave'])) {

		$leave_id = mysqli_real_escape_string($connection, $_POST['leave_id']);

		$reject_leave = mysqli_query($connection, "UPDATE `leave_form` SET status = 'rejected', current = 0 WHERE leave_id = $leave_id");

		if($reject_leave) {
			$_SESSION['success'] = "Leave rejected successfully";
			header("location: leave.php");
			// echo "success";
		}

		else {
			// die(mysqli_error($connection));
			$_SESSION['error'] = "Something went wrong try again!";
			header("location: leave.php");
			die(mysqli_error($connection));

		}	
	}

	else {
		$_SESSION['error'] = "Bad access";
		header("location: leave.php");
	}

	
?>