<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include('../config/connection.php');

    if(isset($_POST['save_falculty'])) {	

        $faculty =  $_POST['faculty'];
        $save_faculty = mysqli_query($connection, "INSERT INTO faculty(faculty_name) VALUES('$faculty')");

        if($save_faculty) {
            $_SESSION['success'] = "Faculty saved Successfully";
            header("location:faculty.php");
        }

        else {
            $_SESSION['error'] = "Error try again";
            header("location:faculty.php");
            // die(mysqli_error($connection));
        }
    }

    elseif(isset($_POST['save_dept'])) {	

        $faculty =  $_POST['faculty'];
        $department = $_POST['department'];
        $save_faculty = mysqli_query($connection, "INSERT INTO department(department_name, faculty) 
        VALUES('$department', '$faculty')");

        if($save_faculty) {
            $_SESSION['success'] = "Department saved Successfully";
            header("location:faculty.php");
        }

        else {
            $_SESSION['error'] = "Error try again";
            header("location:faculty.php");
            // die(mysqli_error($connection));
        }
    }

    else {
        $_SESSION['error'] = "Bad access";
        header("location:faculty.php");
    }

?>