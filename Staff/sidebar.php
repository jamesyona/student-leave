<!-- database connection -->
<?php include('../config/connection.php') ?>
<?php include('staff_info.php') ?>

<!-- check if user loged in -->
<?php if(!isset($_SESSION['auth'])): ?>
    <?php header('location:../logout.php') ?>
<?php endif ?>

<?php $user_id = $_SESSION['userdata']['userID'];?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin | Panel</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../photos/logo.png" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="Gets/css/styles.css" rel="stylesheet" />
        <link href="Gets/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- datatable  -->
        <link rel="stylesheet" href="Gets/asset/datatables.min.css">
        <link rel="stylesheet" href="Gets/asset/responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="Gets/asset/responsive/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="Gets/css/style.css">
        <style>
            .info {
                border-left: 2px solid red;
                padding: 2rem;
            }
            .mu-bg {
                background-color: #15283e;
            }
            .mu-text {
                color: #fff;
            }
            .list-group-item .mu-text:hover {
                color: #15283e;
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end mu-bg" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light text-light sticky-top" style="padding-bottom: 5px;">
                    <div class="d-flex">
                        <div><img src="../photos/logo.png" width="30px" height="30px" class="gets"></div> 
                        <b class="text-dark text-center h6 ms-3 mt-2">Student Leave </b>
                    </div>  
                </div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action mu-bg 
                        mu-text p-3 nav-hover" href="index.php"><i class="fa fa-dashboard"></i> <b>Manage leave</b></a>
                    <a class="list-group-item list-group-item-action mu-bg
                        mu-text p-3" href="../logout.php"><i class="fa fa-sign-out"></i> <b>Logout</b></a>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar sticky-top navbar-expand-lg navbar-light mu-bg border-bottom shadow">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item active">
                                    <a class="nav-link text-light" href="#!">
                                        Welcome <b>
                                        <?php echo $_SESSION['userdata']['first_name'];?>
                                        <?php echo $_SESSION['userdata']['surname'];?>
                                        </b></a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container-fluid p-3">
                    <?php include('../config/message.php') ?>
