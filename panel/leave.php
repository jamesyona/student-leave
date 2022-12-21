<?php require_once('sidebar.php') ?>
<?php 

    $get_leave = mysqli_query($connection, "SELECT leave_form.leave_id AS leave_form_id, reason, date_of_depacture, date_of_return,
    student.reg_number, leave_form.current, leave_form.status
    FROM student, leave_form
    WHERE leave_form.student = student.student_id
  	GROUP BY leave_form.leave_id");

    $count_leave= mysqli_num_rows($get_leave);

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h4 class="text-muted">List of leave you are required to accept or decline</h4>
                <hr>
                <table class="table">
                    <tr>
                        <th>Registration Number</th>
                        <th>Depature Date</th>
                        <th>Return Date</th>
                        <th>Action</th>
                    </tr>
                    <?php while($get_leave_row = mysqli_fetch_array($get_leave)){ ?>
                        <tr>
                            <td><?php echo $get_leave_row['reg_number'] ?></td>
                            <td><?php echo $get_leave_row['date_of_depacture'] ?></td>
                            <td><?php echo $get_leave_row['date_of_return'] ?> <?php echo $_SESSION['status'] ?></td>
                            <td>
                                <?php if($get_leave_row['current'] == 1 && $_SESSION['status'] == "dean"): ?>
                                    <button class="btn btn-success btn-sm" data-target="#reject<?php echo $get_leave_row['leave_form_id'] ?>" data-toggle="modal">
                                        View Course</button>
                                <?php else: ?>
                                    <?php if($get_leave_row['status'] == "rejected"): ?>
                                        <span class="badge bg-danger pt-1"><?php echo $get_leave_row['status'] ?></span>
                                    <?php elseif($get_leave_row['status'] == "accepted"): ?>
                                        <span class="badge bg-success pt-1"><?php echo $get_leave_row['status'] ?></span>
                                    <?php elseif($get_leave_row['status'] == "proccessing"): ?>
                                        <span class="badge bg-dark pt-1"><?php echo $get_leave_row['status'] ?></span>
                                    <?php endif ?>
                                <?php endif ?>
                            </td>
                        </tr>
                        
                        <!-- query for given leave  -->
                        <?php 
                            $get_leave_id = $get_leave_row['leave_form_id'];
                            $leave_cource = mysqli_query($connection, "SELECT course.course_code, course.course_name, status
                            FROM `leave_course`, course
                            WHERE leave_course.course = course.course_id
                            AND leave_course.leave_id = $get_leave_id");

                            $count_course_leave = mysqli_num_rows($leave_cource);
                        ?>

                        <!-- accept modal  -->
                        <div class="modal fade" id="reject<?php echo $get_leave_row['leave_form_id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3>Course For Given Leave</h3>
                                    </div>
                                    <div class="modal-body">
                                        <p class="bg-dark p-3 text-light"><?php echo $get_leave_row['reason'] ?></p>
                                        <?php if( $count_course_leave > 0): ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="list-unstyled">
                                                    <?php while($leave_cource_item = mysqli_fetch_array($leave_cource)) { ?>
                                                        <li class="d-flex justify-content-between">
                                                            <div>
                                                                <?php echo $leave_cource_item['course_name'] ?>
                                                                (<?php echo $leave_cource_item['course_code'] ?>) 
                                                            </div>
                                                            <?php if($leave_cource_item['status'] == "declined"): ?>
                                                                <span class="badge bg-danger pt-1"><?php echo $leave_cource_item['status'] ?></span>
                                                            <?php elseif($leave_cource_item['status'] == "accepted"): ?>
                                                                <span class="badge bg-success pt-1"><?php echo $leave_cource_item['status'] ?></span>
                                                            <?php elseif($leave_cource_item['status'] == "proccessing"): ?>
                                                                <span class="badge bg-dark pt-1"><?php echo $leave_cource_item['status'] ?></span>
                                                            <?php endif ?>
                                                        </li>
                                                        <hr>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <form method="POST" action="leave-action.php">
                                            <input hidden type="number" name="leave_id" value="<?php echo $get_leave_row['leave_form_id'] ?>">
                                            <div class="modal-footer">
                                                <button type="submit" name="accept_leave" class="btn btn-dark text-white"> 
                                                    Yes Accept</button>
                                                <button type="submit" name="reject_leave" class="btn btn-danger text-white"> 
                                                    Reject  Leave</button>
                                            </div>
                                        </form>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once('../footer.php') ?>