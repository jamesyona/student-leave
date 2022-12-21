<?php require_once('sidebar.php') ?>
<?php 

    $department = mysqli_query($connection, "SELECT department_name, faculty_name FROM department, faculty WHERE faculty_id = faculty");
    $count_department = mysqli_num_rows($department);

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h4 class="text-muted">department</h4>
                <hr>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <tr>
                        <th>S/N</th>
                        <th width="">Department Name</th>
                        <th width="">Faculty Name</th>
                    </tr>
                    <?php $sn=1; while($department_item = mysqli_fetch_array($department)){ ?>
                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td> <?php echo $department_item['department_name'] ?> </td>
                            <td> <?php echo $department_item['faculty_name'] ?> </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="department">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add new department</h3>
            </div>
            <div class="modal-body">
                <form method="POST" action="department-action.php">
                    <input type="text" name="department_code" placeholder="department code" class="form-control">
                    <input type="text" name="department_name" placeholder="department name" class="form-control mt-3">
                    <div class="modal-footer">
                        <button type="submit" name="save_falculty" class="btn btn-dark text-white"> 
                            Save department</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>

<?php require_once('../footer.php') ?>