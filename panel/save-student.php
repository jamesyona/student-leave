<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include('../config/connection.php');
    if(isset($_POST['save_student'])) {	
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $middle_name   = mysqli_real_escape_string($connection, $_POST['middle_name']);
        $last_name 	   = mysqli_real_escape_string($connection, $_POST['last_name']);
        $sex 	   = mysqli_real_escape_string($connection, $_POST['sex']);
        $phone 	   = mysqli_real_escape_string($connection, $_POST['phone']);
        $programme     = mysqli_real_escape_string($connection, $_POST['programme']);
        $dob 	   =  $_POST['dob'];
        $today = date('d-m-Y');

        //get year
        $year = date('Y');
        $year = substr("$year", 2);

        //create passowrd
        $password = strtolower($last_name);

        //create email
        $email_id = rand(12, 99999);
        $email = strtolower($first_name).".".strtolower($last_name)."$email_id@mustudent.ac.tz";

        //create reg number
        $reg_id = rand(2000, 2999);
        $reg_number = "1432$reg_id/T.$year";

        if(strtotime($dob) >= strtotime($today)) {
            echo "date must be less than today";
        }

        else {
            $hash_password = md5($password);
            $status = "student";
            $save_user_sql = "INSERT INTO user(first_name, middle_name, surname, username, sex, email, phone_number, status, password)
                VALUES('$first_name', '$middle_name', '$last_name', '$reg_number', '$sex', '$email', '$phone', '$status', '$hash_password')";
            $save_user_query = mysqli_query($connection, $save_user_sql);

            $user_id = mysqli_insert_id($connection);

            if($save_user_query) {
                $save_student_query = mysqli_query($connection, "INSERT INTO student(reg_number, DOB, programme, user) 
                VALUES('$reg_number', '$dob', '$programme', '$user_id')");

                if($save_student_query) {
                    $_SESSION['success'] = "Student saved successfully";
				    header("location: student.php");
                }

                else {
                    $_SESSION['error'] = "Student not saved successfully";
				    header("location: student.php");
                    // die(mysqli_error($connection));
                }
            }
            else {
                $_SESSION['error'] = "User not saved successfully try again";
                header("location: student.php");
                die(mysqli_error($connection));
            }
            
        }
    }
    else {
        $_SESSION['error'] = "Bad access";
        header("location: student.php");
    }

?>