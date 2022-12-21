<?php
	// database connection
	include('../config/connection.php');

	if(isset($_POST['accept_leave'])) {

		$leave_course_id = mysqli_real_escape_string($connection, $_POST['leave_course_id']);

		$accept_leave_course = mysqli_query($connection, "UPDATE `leave_course` SET status = 'accepted' WHERE leave_course_id = $leave_course_id");

		if($accept_leave_course) {
			$_SESSION['success'] = "Leave accepted successfully";
			header("location: index.php");
			// echo "success";
		}

		else {
			// die(mysqli_error($connection));
			$_SESSION['error'] = "Something went wrong try again!";
			header("location: index.php");
			die(mysqli_error($connection));

		}	
	}


	else if(isset($_POST['decline_leave'])) {

		$leave_course_id = mysqli_real_escape_string($connection, $_POST['leave_course_id']);

		$accept_leave_course = mysqli_query($connection, "UPDATE `leave_course` SET status = 'declined' WHERE leave_course_id = $leave_course_id");

		if($accept_leave_course) {
			$_SESSION['success'] = "Leave accepted successfully";
			header("location: index.php");
			// echo "success";
		}

		else {
			// die(mysqli_error($connection));
			$_SESSION['error'] = "Something went wrong try again!";
			header("location: index.php");
			die(mysqli_error($connection));

		}	
	}

	else {
		$_SESSION['error'] = "Bad access";
		header("location: index.php");
	}

	
?>