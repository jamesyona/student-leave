<?php 

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include('../config/connection.php');

    if(isset($_POST['assign'])) {	

        $staff_id = mysqli_real_escape_string($connection, $_POST['staff_id']);
        $course   = mysqli_real_escape_string($connection, $_POST['course']);
        $title   = mysqli_real_escape_string($connection, $_POST['title']);

        $save_staff_course_sql = "INSERT INTO lecturer_course(staff, course, title)
            VALUES('$staff_id', '$course', '$title')";
        $save_staff_course_query = mysqli_query($connection, $save_staff_course_sql);

        if($save_staff_course_query) {
            $_SESSION['success'] = "Staff assigned to course successfully";
            header("location: staff.php");
        }

        else {
            $_SESSION['error'] = mysqli_error($connection);
            // "Staff not assigned to course successfully try again";
            header("location: staff.php");
            die(mysqli_error($connection));
        }
    }
    else {
        $_SESSION['error'] = "Bad access";
        header("location: staff.php");
    }

?>