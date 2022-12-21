<?php require_once('sidebar.php') ?>
    <div class="container-fluid">
        <div class="row justify-content-center">    
            <div class="col-md-6 col-xl-8 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header mu-bg">
                        <h4 class="text-center mt-2 text-light">change_password Form</h4>
                    </div>
                    <div class="card-body">
                        <form action="change_password.php" method="post">
                            <div class="row mt-2">
                                <div class="form-group mt-1 col-12">
                                    <label for="current_password" class="text-muted pb-2">
                                        Your Current Password <strong class="text-danger">*</strong></label>
                                    <input type="password" name="current_password" id="next_date" 
                                    placeholder="Enter Current Password" class="form-control" required>
                                </div>
                                <div class="form-group mt-1 col-12">
                                    <label for="new_password" class="text-muted pt-3 pb-2">
                                        Your New Password <strong class="text-danger">*</strong></label>
                                    <input type="password" name="new_password" id="new_password" 
                                    placeholder="Enter New Password" class="form-control" required>
                                </div>
                                <div class="form-group mt-1 col-12">
                                    <label for="confirm_password" class="text-muted pt-3 pb-2">
                                        Your Confirm Password <strong class="text-danger">*</strong></label>
                                    <input type="password" name="confirm_password" id="confirm_password" 
                                    placeholder="Confirm Password" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group mt-2 col-6">
                                <input type="submit" name="pass_change" 
                                    value="Save Changes" class="btn btn-outline-dark" >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('../footer.php') ?>