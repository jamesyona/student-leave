
<?php include_once('../config/connection.php'); ?>
<?php
if (isset($_POST['pass_change'])) {

    $user =  $_SESSION['userdata']['userID'];

    $old_pass  = mysqli_real_escape_string($connection, $_POST['current_password']);
    $password1 = mysqli_real_escape_string($connection, $_POST['new_password']);
    $password2 = mysqli_real_escape_string($connection, $_POST['confirm_password']);

    //validate form

    if (empty($old_pass) || empty($password1) || empty($password2) ) {
        //return error to user
        // $_SESSION['error'] = "All field are required";
        // header("location:change_password_form.php");
        die(mysqli_error($connection));
    }

    //password length
    else if(strlen($password1) < 4) {
        $_SESSION['error'] = "Password must have atleast 8 character";
        header("location:change_password_form.php");
    }

    //if password does not metch
    else if($password1 != $password2) {
        $_SESSION['error'] = "Password didn't match";
        header("location:change_password_form.php");
    }

    else {
        $old_pass = md5($old_pass);
        
        $check_password = mysqli_query($connection, "SELECT `password`, `userID` 
        FROM user 
        WHERE `userID` =  '$user' 
        AND password = '$old_pass'");

        $count = mysqli_num_rows($check_password);

        if($count == 1) {
            //password hashing
            $password1 = md5($password1);

            $update_password = mysqli_query($connection, "UPDATE user
            SET password = '$password1' WHERE `userID` = '$user'");

            if($update_password) {
                $_SESSION['success'] = "Password updated successfully";
                header("location:change_password_form.php");
            }
            else {
                $_SESSION['error'] = "Try again!";
                header("location:change_password_form.php");
            }
        }
        else {
            // $_SESSION['error'] = "make sure you enter the correct current password";
            // header("location:change_password_form.php");
            die(mysqli_error($connection));

        }
    }

}


// User Change password
// else if (isset($_POST['user_password'])) {

//     $user = $_SESSION['userdata']['userID'];
 
//     // receive all input values from the form for clinic
//     $old_pass  = mysqli_real_escape_string($dbconnect, $_POST['old_pass']);
//     $password1 = mysqli_real_escape_string($dbconnect, $_POST['password1']);
//     $password2 = mysqli_real_escape_string($dbconnect, $_POST['password2']);

//     //validate form

//     if (empty($old_pass) || empty($password1) || empty($password2) ) {
        
//         //return error to user
//         $_SESSION['error'] = "All field are required";
//         header("location:profile.php");
//     }

//     //password length
//     else if(strlen($password1) < 8) {
//         $_SESSION['error'] = "Password must have atleast 8 character";
//         header("location:profile.php");
//     }

//     //if password does not metch
//     else if($password1 != $password2) {
//         $_SESSION['error'] = "Password does not metch";
//         header("location:profile.php");
//     }

//     else {

//         $old_pass = md5($old_pass);
//         $check_password = mysqli_query($dbconnect, "SELECT password, user_id 
//         FROM tbl_user 
//         WHERE user_id =  '$user' 
//         AND password = '$old_pass'");

//         $count = mysqli_num_rows($check_password);

//         if($count == 1) {
//             $password1 = md5($password1);
//             $password2 = md5($password2);

//             $update_password = mysqli_query($dbconnect, "UPDATE tbl_user
//             SET password = '$password1' WHERE user_id = '$user'");

//             if($update_password) {
//                 $_SESSION['success'] = "Password updated successfully";
//                 header("location:profile.php");
//             }
//             else {
//                 $_SESSION['error'] = "Something went wrong try again";
//                 header("location:profile.php");
//             }
//         }
//         else {
//             $_SESSION['error'] = "Current password is not correct";
//             header("location:profile.php");
//         }
//     }

// }