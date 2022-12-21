<?php require_once('sidebar.php') ?>
<?php 

    $faculty = mysqli_query($connection, "SELECT * FROM faculty");
    $count_faculty = mysqli_num_rows($faculty);

?>
<?php if($_SESSION['status'] != "admin"): ?>
    <?php header("location:index.php") ?>
<?php endif ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h4 class="text-muted">Faculty</h4>
                <hr>
                <div>
                    <a href="" data-target="#faculty" 
                        data-toggle="modal" class="btn btn-dark mb-3">add Faculty</a>
                </div>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <tr>
                        <th>S/N</th>
                        <th width="50%">Faculty Name</th>
                        <th>Action</th>
                    </tr>
                    <?php $sn=1; while($faculty_item = mysqli_fetch_array($faculty)){ ?>
                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td> <?php echo $faculty_item['faculty_name'] ?> </td>
                            <td> 
                                <a href="" data-target="#add<?php echo $faculty_item['faculty_id'] ?>" 
                                    data-toggle="modal" class="btn btn-dark btn-sm">add department</a>
                                <a href="" data-target="#view<?php echo $faculty_item['faculty_id'] ?>" 
                                    data-toggle="modal" class="btn btn-success btn-sm">View department</a>
                            </td>
                        </tr>
                        
                        <div class="modal fade" id="add<?php echo $faculty_item['faculty_id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3><?php echo $faculty_item['faculty_name'] ?></h3>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="faculty-action.php">
                                            <input hidden type="number" name="faculty" value="<?php echo $faculty_item['faculty_id'] ?>">
                                            <input type="text" name="department" placeholder="Department Name" class="form-control">
                                            <div class="modal-footer">
                                                <button type="submit" name="save_dept" class="btn btn-dark text-white"> 
                                                    Save Department</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <?php 
                            $faculty_id = $faculty_item['faculty_id'];
                            $department = mysqli_query($connection, "SELECT * FROM department
                            WHERE faculty = $faculty_id");

                            $count_department = mysqli_num_rows($department);
                        ?>
                        <div class="modal fade" id="view<?php echo $faculty_item['faculty_id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark">
                                        <h3 class="text-white"><?php echo $faculty_item['faculty_name'] ?></h3>
                                    </div>
                                    <div class="modal-body">
                                        <?php if( $count_department > 0): ?>
                                            <ul class="list-unstyled">
                                                <?php while($dept_item = mysqli_fetch_array($department)) { ?>
                                                    <li class="list-unstyled">
                                                        <?php echo $dept_item['department_name'] ?>
                                                    </li>
                                                    <hr>
                                                <?php } ?>
                                            </ul>
                                        <?php else: ?>
                                            Not Department
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

<div class="modal fade" id="faculty">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add new Faculty</h3>
            </div>
            <div class="modal-body">
                <form method="POST" action="faculty-action.php">
                    <input type="text" name="faculty" placeholder="faculty" class="form-control">
                    <div class="modal-footer">
                        <button type="submit" name="save_falculty" class="btn btn-dark text-white"> 
                            Save Falculty</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>

<?php require_once('../footer.php') ?>