<?php 

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include('../config/connection.php');

    if(isset($_GET['course'])) {	

        $course =  $_GET['course'];
        $remove_course_sql = "DELETE FROM lecturer_course WHERE lecturer_course_id = $course";
        $remove_course_query = mysqli_query($connection, $remove_course_sql);

        if($remove_course_query) {
            $_SESSION['success'] = "Course removed successfully";
            header("location: staff.php");
        }

        else {
            $_SESSION['error'] = "Error try again";
            header("location: staff.php");
            die(mysqli_error($connection));
        }
    }
    else {
        $_SESSION['error'] = "Bad access";
        header("location: staff.php");
    }

?>