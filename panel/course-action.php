<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include('../config/connection.php');

    if(isset($_POST['save_course'])) {	

        $course_code =  $_POST['course_code'];
        $course_name =  $_POST['course_name'];
        $save_course = mysqli_query($connection, "INSERT INTO course(course_code, course_name) 
            VALUES('$course_code', '$course_name')");

        if($save_course) {
            $_SESSION['success'] = "Course saved Successfully";
            header("location:course.php");
        }

        else {
            $_SESSION['error'] = "Error try again";
            header("location:course.php");
            // die(mysqli_error($connection));
        }
    }

    else {
        $_SESSION['error'] = "Bad access";
        header("location:course.php");
    }

?>