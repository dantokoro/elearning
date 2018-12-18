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
                            <a href="add_course.php" class="btn btn-success"><i class="icon-plus-sign icon-large"></i>&nbsp;Add Course</a>
                            <br><br>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong><i class="icon-user icon-large"></i>&nbsp;Course Table</strong>
                                </div>
                                <thead>
                                    <tr>
                                        <th>Course ID</th>
                                        <th>Course Name</th>
                                        <th>price</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //$table = '"Student"';
                                    $query = pg_query($conn ,'select * from "Course"') or die(pg_errormessage());
                                    while ($row =  pg_fetch_array($query)) {
                                        $course_id = $row['course_id'];
                                        ?>


                                        <!-- script -->
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                                
                                            $('#e<?php echo $course_id; ?>').tooltip('show')
                                            $('#e<?php echo $course_id; ?>').tooltip('hide')
                                        });
                                    </script>
                                    <!-- end script -->
                                    <!-- script -->
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                                
                                            $('#d<?php echo $course_id; ?>').tooltip('show')
                                            $('#d<?php echo $course_id; ?>').tooltip('hide')
                                        });
                                    </script>
                                    <!-- end script -->


                                    <tr class="odd gradeX">
                                        <td><?php echo $row['course_id']; ?></td> 
                                        <td><?php echo $row['name']; ?></td> 
                                        <td><?php echo $row['price']; ?></td> 
                                        <td><?php echo $row['created_at']; ?></td> 
                                        <td width="100">
                                            <a rel="tooltip"  title="Delete Student" id="d<?php echo $course_id; ?>" href="#course_id<?php echo $course_id; ?>" role="button"  data-toggle="modal" class="btn btn-danger"><i class="icon-trash icon-large"></i></a>
                                            <a rel="tooltip"  title="Edit Student" id="e<?php echo $course_id; ?>" href="edit_course.php<?php echo '?id='.$course_id; ?>" class="btn btn-success"><i class="icon-pencil icon-large"></i></a>
                                        </td>
                                        <!-- user delete modal -->
                                    <div id="course_id<?php echo $course_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-header">
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger">Are you Sure you Want to <strong>Delete</strong>&nbsp; this Course?</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
                                            <a href="delete_course.php<?php echo '?id=' . $course_id; ?>" class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Delete</a>
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


