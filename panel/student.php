<?php require_once('sidebar.php') ?>
<?php  

    $sql = "SELECT * FROM student, user, programme WHERE student.user = user.userID AND programme.programme_id = student.programme";
    $student_query = mysqli_query($connection, $sql);

    $programme_query = mysqli_query($connection, "SELECT * FROM `programme`");
?>
<?php if($_SESSION['status'] != "admin"): ?>
    <?php header("location:index.php") ?>
<?php endif ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                <?php include("../config/message.php");?>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-dark" type="button" data-target="#student" data-toggle="modal">
                        Add Student</button>
                </div>
                <table class="table" id="datatable">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Regstration Number</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Sex</th>
                            <th>Programme</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; while($student_row = mysqli_fetch_array($student_query)) { ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $student_row['reg_number'] ?></td>
                                <td><?php echo $student_row['first_name'] ?></td>
                                <td><?php echo $student_row['surname'] ?></td>
                                <td><?php echo $student_row['sex'] ?></td>
                                <td><?php echo strtoupper($student_row['programme_name']) ?></td>
                                <!-- <td>action</td> -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="student">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header mu-bg">
                <h4 class="text-light">Register Student</h4>
            </div>
            <div class="modal-body">
                <form action="save-student.php" method="post">
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <input type="text" name="first_name" class="form-control" placeholder="First Name">
                        </div>
                        <div class="col-md-6 mt-3">
                            <input type="text" name="middle_name" class="form-control" placeholder="Middle Name">
                        </div>
                        <div class="col-md-6 mt-3">
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                        </div>
                        <div class="col-md-6 mt-3">
                           <select name="sex" class="form-control">
                               <option value="">--select sex--</option>
                               <option value="F">Female</option>
                               <option value="M">Male</option>
                           </select>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="" class="text-muted"><small>Phone Number</small></label>
                            <input type="number" name="phone" class="form-control" placeholder="Phone Number">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="" class="text-muted"><small>Date of Birth</small></label>
                            <input type="date" name="dob" class="form-control">
                        </div>
                        <div class="col-md-6 mt-3">
                            <select required class="form-control" name="programme">
                                <option value="">---Select Programme---</option>
                                <?php while($programme_row = mysqli_fetch_array($programme_query)){ ?>
                                    <option value="<?php echo $programme_row['programme_id'] ?>" >
                                        <?php echo $programme_row['programme_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="save_student" class="btn btn-dark">Save Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php require_once('../footer.php') ?>