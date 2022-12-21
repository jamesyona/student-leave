<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include('../config/connection.php');
    include('staff-detail.php');

    if(isset($_POST['save_programme'])) {	

        $programme_name =  $_POST['programme_name'];

        $save_programme = mysqli_query($connection, "INSERT INTO programme(programme_name, depertment) 
            VALUES('$programme_name', '$staff_department')");

        if($save_programme) {
            $_SESSION['success'] = "Programme saved Successfully";
            header("location:programme.php");
        }

        else {
            $_SESSION['error'] = "Error try again";
            header("location:programme.php");
        }
    }
    elseif(isset($_POST['save_programme_course'])) {	

        $programme =  $_POST['programme'];
        $course =  $_POST['course'];

        $save_programme = mysqli_query($connection, "INSERT INTO programe_course(course, programe) 
            VALUES('$course', '$programme')");

        if($save_programme) {
            $_SESSION['success'] = "Course added to Programme saved Successfully";
            header("location:programme.php");
        }

        else {
            $_SESSION['error'] = "Error try again";
            header("location:programme.php");
        }
    }
    
    else {
        $_SESSION['error'] = "Bad access";
        header("location:programme.php");
    }

?>