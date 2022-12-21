<?php require_once('sidebar.php') ?>
<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include('staff-detail.php');

    $programme_list = mysqli_query($connection, "SELECT programme.*,department_name 
    FROM programme, department WHERE dept_Id = depertment AND depertment = $staff_department");
    $count_program = mysqli_num_rows($programme_list);

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h4 class="text-muted">Course</h4>
                <hr>
                <div>
                    <a href="" data-target="#programme" 
                        data-toggle="modal" class="btn btn-dark mb-3">add programme</a>
                </div>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <tr>
                        <th>S/N</th>
                        <th width="">Programme Name</th>
                        <th width="">Department Name</th>
                        <th width="">Action</th>
                    </tr>
                    <?php $sn=1; while($program_item = mysqli_fetch_array($programme_list)){ ?>
                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td> <?php echo strtoupper($program_item['programme_name']) ?> </td>
                            <td> <?php echo $program_item['department_name'] ?> </td>
                            <td>
                                <a class="btn btn-dark btn-sm" 
                                    data-target="#programme<?php echo $program_item['programme_id'] ?>"
                                    data-toggle="modal">Add course</a>
                            </td>
                        </tr>
                        <div class="modal fade" id="programme<?php echo $program_item['programme_id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3>Add new Programme</h3>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="programme-action.php">
                                            <input hidden type="text" name="programme" value="<?php echo $program_item['programme_id'] ?>" mt-3">
                                            <select class="form-control mt-3" required name="course">
                                                <option>---select course---</option>
                                                <?php $course_list = mysqli_query($connection, "SELECT * FROM course"); ?> 
                                                    <?php while($course_item = mysqli_fetch_array($course_list)) { ?>
                                                    <option value="<?php echo $course_item['course_id'] ?>">
                                                        <?php echo $course_item['course_name'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <div class="modal-footer">
                                                <button type="submit" name="save_programme_course" class="btn btn-dark text-white"> 
                                                    Save Programme</button>
                                            </div>
                                        </form>
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

<div class="modal fade" id="programme">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add new Programme</h3>
            </div>
            <div class="modal-body">
                <form method="POST" action="programme-action.php">
                    <input type="text" name="programme_name" placeholder="Programme name" class="form-control mt-3">
                    <div class="modal-footer">
                        <button type="submit" name="save_programme" class="btn btn-dark text-white"> 
                            Save Programme</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>

<?php require_once('../footer.php') ?>