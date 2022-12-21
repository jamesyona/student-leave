<?php require_once('sidebar.php') ?>
<?php 

    $course = mysqli_query($connection, "SELECT * FROM course");
    $count_course = mysqli_num_rows($course);

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h4 class="text-muted">Course</h4>
                <hr>
                <div>
                    <a href="" data-target="#course" 
                        data-toggle="modal" class="btn btn-dark mb-3">add Course</a>
                </div>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <tr>
                        <th>S/N</th>
                        <th width="">Course Name</th>
                        <th width="">Course Code</th>
                    </tr>
                    <?php $sn=1; while($course_item = mysqli_fetch_array($course)){ ?>
                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td> <?php echo $course_item['course_name'] ?> </td>
                            <td> <?php echo $course_item['course_code'] ?> </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="course">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add new course</h3>
            </div>
            <div class="modal-body">
                <form method="POST" action="course-action.php">
                    <input type="text" name="course_code" placeholder="course code" class="form-control">
                    <input type="text" name="course_name" placeholder="course name" class="form-control mt-3">
                    <div class="modal-footer">
                        <button type="submit" name="save_course" class="btn btn-dark text-white"> 
                            Save Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>

<?php require_once('../footer.php') ?>