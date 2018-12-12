<?php include('header.php'); ?>
<?php include('session.php'); ?>
<body>

    <div class="row-fluid">
        <div class="span12">

            <?php include('navbar.php'); ?>

            <div class="container">

                <div class="row-fluid">

                    <div class="span12">
                        <div class="hero-unit-3">
                            <a href="add_assign.php" class="btn btn-success"><i class="icon-plus-sign icon-large"></i>&nbsp;Add</a>
                            <br>
                            <br>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong><i class="icon-user icon-large"></i>&nbsp;Assigned Teachers Table</strong>
                                </div>
                                <thead>
                                    <tr>
                                        <th>Teacher ID</th>
                                        <th>Name</th>
                                        <th>Course ID</th>
                                        <th>Course</th>
                                        <th>Assigned Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = 'SELECT "Teacher".teacher_id, "Teacher".name as teachername, "Course".course_id, "Course".name as coursename, assigned_date FROM "Teacher" NATURAL JOIN "AssignTeacher" JOIN "Course" ON "AssignTeacher".course_id = "Course".course_id';
                                    $result = pg_query($query) or die(pg_errormessage());
                                    while ($row = pg_fetch_array($result)) {
                                        $teacher_id = $row['teacher_id'];
                                        ?>
                                        <tr class="odd gradeX">

                                            <!-- script -->
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                                
                                            $('#e<?php echo $teacher_id; ?>').tooltip('show')
                                            $('#e<?php echo $teacher_id; ?>').tooltip('hide')
                                        });
                                    </script>
                                    <!-- end script -->
                                    <!-- script -->
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                                
                                            $('#d<?php echo $teacher_id; ?>').tooltip('show')
                                            $('#d<?php echo $teacher_id; ?>').tooltip('hide')
                                        });
                                    </script>
                                    <!-- end script -->

                                    <td><?php echo $row['teacher_id']; ?></td> 
                                    <td><?php echo $row['teachername']; ?></td> 
                                    <td><?php echo $row['course_id'] . " "; ?></td> 
                                    <td><?php echo $row['coursename']; ?></td>
                                    <td><?php echo $row['assigned_date']; ?></td>            

                                    <!-- user delete modal -->
                                    <div id="course_id<?php echo $teacher_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-header">
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger">Are you Sure you Want to <strong>Delete</strong>&nbsp; this Teacher?</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
                                            <a href="delete_teacher.php<?php echo '?id=' . $teacher_id; ?>" class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Delete</a>
                                        </div>
                                    </div>
                                    <!-- end delete modal -->

                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <?php include('footer.php'); ?>
            </div>
        </div>
    </div>





</body>
</html>


