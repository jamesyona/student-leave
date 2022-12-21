<?php
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
	// database connection
 	include('student_info.php');

	if(isset($_POST['save_course'])) {

		$leave_id = mysqli_real_escape_string($connection, $_POST['leave_id']);
		$course = mysqli_real_escape_string($connection, $_POST['course']);

		$save_leave_course = mysqli_query($connection, "INSERT INTO `leave_course` (`course`, `leave_id`) VALUES ('$course', '$leave_id')");

		if($save_leave_course) {
			$_SESSION['success'] = "Course registered successfully";
			header("location: view-leave.php?leave_id=$leave_id");
			// echo "success";
		}

		else {
			// die(mysqli_error($connection));
			$_SESSION['error'] = "Something went wrong try again!";
			header("location: request_leave.php");
			die(mysqli_error($connection));

		}	
	}

	else {
		$_SESSION['error'] = "Bad access";
		header("location: request_leave.php");
	}
?>