<?php 
    $user_id = $_SESSION['userdata']['userID'];
    $get_staff_query = mysqli_query($connection, "SELECT * FROM staff WHERE user = $user_id");
    $fetch_staff = mysqli_fetch_array($get_staff_query);
    $get_staff_id = $fetch_staff['staff_id'];
?>