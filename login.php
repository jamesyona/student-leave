<?php
    include ('config/connection.php');

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty($username) || empty($password)) {
            // return to login page when field are empty
            header("location:index.php?login_error=All fields are required");
        }
        else {
            //password hashing
            $password = md5($password);

            //query to select user
            $login_query = mysqli_query($connection, "SELECT * FROM `user` 
                WHERE username = '$username'
                AND  password = '$password'");

            //count user
            $count_user = mysqli_num_rows($login_query);
            //check if number of row equal to 1
            if($count_user == 1) {
                //store user data into array
                $userdata = mysqli_fetch_assoc($login_query);
                $_SESSION['status'] = $userdata['status'];

                if($_SESSION['status'] == "student"){
                    $_SESSION['auth'] = true;
                    $_SESSION['userdata'] = $userdata;
                    header("location:Student/");
                }

                elseif($_SESSION['status'] == "staff"){
                    $_SESSION['auth'] = true;
                    $_SESSION['userdata']   = $userdata;
                    header("location:Staff/");
                }

                elseif($_SESSION['status'] == "dean" || $_SESSION['status'] == "hod" || $_SESSION['status'] == "admin"){
                    $_SESSION['userdata'] = $userdata;
                    $_SESSION['admin_loged_in'] =  true;
                    header("location:panel/");
                }
                else {
                    header("location:index.php?login_error=Authorization Error"); 
                }
            }

            else {

                //die(mysqli_error($connection));
                header("location:index.php?login_error=Invalid Username or Password");
            }
        }
    }
?>