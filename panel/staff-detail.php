<?php 
    $user_id = $_SESSION['userdata']['userID'];
    $staff_detail = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM staff WHERE user = $user_id"));
    $staff_department = $staff_detail['department'];
?>