<?php require_once('sidebar.php') ?>
<?php 

    $get_leave = mysqli_query($connection, "SELECT leave_course_id, leave_form.leave_id AS leave_form_id, 
    date_of_depacture, date_of_return, reason, student.reg_number, course_name, course_code,
    leave_course.status, leave_course.date, lecturer_course.course 
    FROM lecturer_course, leave_course, course, staff, student, leave_form
    WHERE lecturer_course.staff = staff.staff_id
    AND lecturer_course.course = course.course_id
    AND leave_course.course = course.course_id
    AND leave_form.student = student.student_id
    AND leave_course.leave_id = leave_form.leave_id
    AND staff.staff_id = $get_staff_id
    ORDER BY leave_course.date DESC");

    $count_leave= mysqli_num_rows($get_leave);

?>
<div class="container">
  <!--   <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-danger">
                <div class="card-body">
                    <div class="quantinty">
                     <i class="fa fa-envelope text-white fa-3x"></i>
                        <h4 class="text-light"></h4>
                        <a> <span class="h5 text-white">
                            </span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-info">
                <div class="card-body">
                    <div class="quantinty">
                        <i class="fa fa-user text-white fa-3x"></i>
                        <h4 class="text-light"></h4>
                        <a> <span class="h5 text-white">
                            </span></a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
          
                <h4 class="text-muted">List of leave you are required to accept or decline the leave</h4>
                <hr>
                <table class="table">
                    <tr>
                        <th>Registration Number</th>
                        <th>Depature Date</th>
                        <th>Return Date</th>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Reason</th>
                        <th>Action</th>
                    </tr>
                    <?php while($get_leave_row = mysqli_fetch_array($get_leave)){ ?>
                        <tr>
                            <td><?php echo $get_leave_row['reg_number'] ?></td>
                            <td><?php echo $get_leave_row['date_of_depacture'] ?></td>
                            <td><?php echo $get_leave_row['date_of_return'] ?></td>
                            <td><?php echo $get_leave_row['course_code'] ?></td>
                            <td><?php echo $get_leave_row['course_name'] ?></td>
                            <td>
								<a class="badge mu-bg reason" type="button" 
                                    data-target="#reason<?php echo $get_leave_row['leave_form_id'] ?>" 
                                    data-toggle="modal" style="text-decoration: none; color:white" >	
									reason <i class="fa fa-eye"></i>	
								</a>
							</td>
                            <td>
                                <?php if($get_leave_row['status'] == "proccessing"): ?>
                                    <button class="btn btn-success btn-sm" data-target="#accept<?php echo $get_leave_row['leave_form_id'] ?>" data-toggle="modal">
                                        Accept</button>
                                    <button class="btn btn-danger btn-sm" data-target="#decline<?php echo $get_leave_row['leave_form_id'] ?>" data-toggle="modal">
                                    Decline</button>
                                <?php else: ?>
                                    <span class="badge bg-dark pb-2"><?php echo $get_leave_row['status'] ?></span>
                                <?php endif ?>
                            </td>
                        </tr>
                        <!-- reason modal  -->
                        <div class="modal fade" id="reason<?php echo $get_leave_row['leave_form_id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header mu-bg">
                                        <h5 class="text-light">Leave Reason</h5>
                                        <button type="button" class="close btn text-light" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <?php  echo $get_leave_row['reason'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- accept modal  -->
                        <div class="modal fade" id="accept<?php echo $get_leave_row['leave_form_id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info text-white">
                                        <h3>Accept Leave</h3>
                                    </div>
                                    <form method="POST" action="leave_action.php">
                                        <div class="modal-body">
                                            <p class="h6">Are you sure you want to accept this leave ?</p>
                                            <input hidden type="number" name="leave_course_id" value="<?php echo $get_leave_row['leave_course_id'] ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="accept_leave" class="btn btn-info text-white"> Yes Accept</button>
                                        </div>
                                    </form>
                                </div>
                            </div> 
                        </div>

                        <!-- decline modal  -->
                        <div class="modal fade" id="decline<?php echo $get_leave_row['leave_form_id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h3>Declice Leave</h3>
                                    </div>
                                    <form method="POST" action="leave_action.php">
                                        <div class="modal-body">
                                            <p class="h6">Are you sure you want to decline this leave ?</p>
                                            <input hidden type="number" name="leave_course_id" value="<?php echo $get_leave_row['leave_course_id'] ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="decline_leave" class="btn btn-danger text-white"> Yes Decline</button>
                                        </div>
                                    </form>
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