
<?php include_once('../config/connection.php'); ?>
<?php
if (isset($_POST['pass_change'])) {

    $user =  $_SESSION['userdata']['userID'];

    $old_pass  = mysqli_real_escape_string($connection, $_POST['current_password']);
    $password1 = mysqli_real_escape_string($connection, $_POST['new_password']);
    $password2 = mysqli_real_escape_string($connection, $_POST['confirm_password']);

    //validate form

    if (empty($old_pass) || empty($password1) || empty($password2) ) {
       
        $_SESSION['error'] = "All field are required";
        header("location:change_password_form.php");
        //die(mysqli_error($connection));
    }

    //password length
    else if(strlen($password1) < 4) {
        $_SESSION['error'] = "Password must have atleast 4 character";
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
            $_SESSION['error'] = "make sure you enter the correct current password";
            header("location:change_password_form.php");
            //die(mysqli_error($connection));

        }
    }

}
?>