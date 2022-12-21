<?php require_once('sidebar.php') ?>
<?php  
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $sql = "SELECT * FROM user, staff, department WHERE staff.user = user.userID 
    AND department.dept_Id = staff.department
    AND staff.user != $user_id";
    $staff_query = mysqli_query($connection, $sql);

    $department = mysqli_query($connection, "SELECT * FROM department");  

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
                    <button class="btn btn-dark" type="button" data-target="#staff" data-toggle="modal">
                        Add Staff</button>
                </div>
                <table class="table" id="datatable">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Work Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Sex</th>
                            <th>Role</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; while($staff_row = mysqli_fetch_array($staff_query)) { ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $staff_row['worker_id'] ?></td>
                                <td><?php echo $staff_row['first_name'] ?></td>
                                <td><?php echo $staff_row['surname'] ?></td>
                                <td><?php echo $staff_row['sex'] ?></td>
                                <td><?php echo $staff_row['role'] ?></td>
                                <td><?php echo $staff_row['department_name'] ?></td>
                                <td>
                                    <a href="" data-target="#assign<?php echo $staff_row['worker_id'] ?>" data-toggle="modal" class="btn btn-success btn-sm">Assign Course</a>
                                    <a href="" data-target="#view<?php echo $staff_row['worker_id'] ?>" data-toggle="modal" class="btn btn-dark btn-sm">View Course</a>
                                </td>
                            </tr>
                            <div class="modal fade" id="assign<?php echo $staff_row['worker_id'] ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header mu-bg">
                                            <h4 class="text-light">Assign Course</h4>
                                        </div>
                                        <form action="assign-course.php" method="POST">
                                            <div class="modal-body">
                                                <input type="text" name="staff_id" value="<?php echo $staff_row['staff_id'] ?>" hidden>
                                                <div class="form-group">
                                                    <select class="form-control" required name="course">
                                                        <option>---select course---</option>
                                                        <?php $course_list = mysqli_query($connection, "SELECT * FROM course"); ?> 
                                                            <?php while($course_item = mysqli_fetch_array($course_list)) { ?>
                                                            <option value="<?php echo $course_item['course_id'] ?>">
                                                                <?php echo $course_item['course_name'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <select class="form-control" name="title" required>
                                                        <option value="">---select title---</option>
                                                        <option value="lecturer">Lecturer</option>
                                                        <option value="TA">Tutorial Assistant</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-success" name="assign" type="submit">Assign Course</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="view<?php echo $staff_row['worker_id'] ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header mu-bg">
                                            <h4 class="text-light">View Course</h4>
                                        </div>
                                        <div class="modal-body">
                                            <?php 
                                                $staff = $staff_row['staff_id'];
                                                $sql = "SELECT * FROM course, lecturer_course WHERE course.course_id =lecturer_course.course AND lecturer_course.staff = $staff";  
                                                $lecturer_course_list = mysqli_query($connection, $sql); ?> 

                                                <?php while($lecturer_course_item = mysqli_fetch_array($lecturer_course_list)) { ?>
                                                    <div class="d-flex justify-content-between">
                                                        <h5>
                                                            <?php echo $lecturer_course_item['course_name'] ?> 
                                                            -<?php echo $lecturer_course_item['title'] ?>
                                                        </h5>
                                                        <a style="text-decoration: none; padding-top: 0.6rem" href="remove-course.php?course=<?php echo  $lecturer_course_item['lecturer_course_id'] ?>" class="badge bg-danger text-light">Remove Course</a>
                                                    </div>
                                                <hr>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="staff">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header mu-bg">
                <h4 class="text-light">Register Staff</h4>
            </div>
            <div class="modal-body">
                <form action="save-staff.php" method="post">
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
                            <input type="number" name="phone" class="form-control" placeholder="Phone Number">
                        </div>
                        <div class="col-md-6 mt-3">
                            <select required class="form-control" name="role">
                                <option value="">---Select Role---</option>
                                <option value="lecture">Lecture</option>
                                <option value="hod">hod</option>
                                <option value="staff">staff</option>
                                <option value="dean">dean</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-3">
                            <select required class="form-control" name="department">
                                <option value="">---Select Department---</option>
                                    <?php while($dept_item = mysqli_fetch_array($department)) { ?>
                                        <option value="  <?php echo $dept_item['dept_Id'] ?> ">
                                            <?php echo $dept_item['department_name'] ?> 
                                        </option>
                                    <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="save_staff" class="btn btn-dark">Save Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php require_once('../footer.php') ?>