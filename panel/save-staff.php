<?php 

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include('../config/connection.php');

    if(isset($_POST['save_staff'])) {	
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $middle_name   = mysqli_real_escape_string($connection, $_POST['middle_name']);
        $last_name 	   = mysqli_real_escape_string($connection, $_POST['last_name']);
        $sex 	   = mysqli_real_escape_string($connection, $_POST['sex']);
        $phone 	   = mysqli_real_escape_string($connection, $_POST['phone']);
        $role 	   = mysqli_real_escape_string($connection, $_POST['role']);
        $department = mysqli_real_escape_string($connection, $_POST['department']);

        //create passowrd
        $password = strtolower($last_name);

        //create email
        $email_id = rand(12, 99999);
        $email = strtolower($first_name).".".strtolower($last_name)."$email_id@mzumbe.ac.tz";

        //create reg number
        $staff_id = rand(2000, 2999);
        $staff_number = "mu-staff-$staff_id";

     
        $hash_password = md5($password);
        $status = "staff";

        $save_user_sql = "INSERT INTO user(first_name, middle_name, surname, username, sex, email, phone_number, status, password)
            VALUES('$first_name', '$middle_name', '$last_name', '$staff_number', '$sex', '$email', '$phone', '$role', '$hash_password')";
        $save_user_query = mysqli_query($connection, $save_user_sql);

        $user_id = mysqli_insert_id($connection);

        if($save_user_query) {
            $save_staff_query = mysqli_query($connection, "INSERT INTO staff(worker_id, `role`, user, department) 
            VALUES('$staff_number', '$role', '$user_id', '$department')");

            if($save_staff_query) {
                $_SESSION['success'] = "Staff saved successfully";
                header("location: staff.php");
                die(mysqli_error($connection));
            }

            else {
                $_SESSION['error'] = "Staff not saved successfully";
                header("location: staff.php");
                die(mysqli_error($connection));
            }
        }
        else {
            $_SESSION['error'] = "User not saved successfully try again";
            header("location: staff.php");
            die(mysqli_error($connection));
        }
            
        
    }
    else {
        $_SESSION['error'] = "Bad access";
        header("location: staff.php");
    }

?>