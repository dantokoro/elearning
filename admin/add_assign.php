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
                            <a href="course.php" class="btn btn-success"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a>
                            <br><br>
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                                <div class="control-group">
                                    <label class="control-label" for="input">Teacher ID:</label>
                                    <div class="controls">
                                        <input type="text" name="tid" id="input" placeholder="Teacher ID" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input">Course ID:</label>
                                    <div class="controls">
                                        <input type="text" name="cid" id="input" placeholder="Course ID" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" name="submit" class="btn btn-info"><i class="icon-save icon-large"></i>&nbsp;Save</button>
                                    </div>
                                </div>
                            </form>

                            <?php
                            if (isset($_POST['submit'])) {
                                $teacher_id = $_POST['tid'];
                                $course_id = $_POST['cid'];

                                $query = 'INSERT INTO "AssignTeacher"(teacher_id, course_id, assigned_date) VALUES('. "$teacher_id" . ", $course_id" . ", now())";
                                $result = pg_query($query);
                                if(!$result) {
                                    echo '<script type="text/javascript">alert('.pg_errormessage().') </script>';
                                } else {
                                    header('location:assigned_teacher.php');
                                }
                            }
                            ?>


                        </div>

                    </div>
                </div>
<?php include('footer.php'); ?>
            </div>
        </div>
    </div>
</body>
</html>


