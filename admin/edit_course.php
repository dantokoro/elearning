<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php  $get_id=$_GET['id'];  ?>
<body>
    <?php
    $query = 'SELECT * FROM "Course" WHERE course_id=' . $get_id;
    $student_query=pg_query($conn, $query)or die(pg_errormessage());
    $rows=pg_fetch_array($student_query);
    ?> 
    <div class="row-fluid">
        <div class="span12">
            <?php include('navbar.php'); ?>

            <div class="container">

                <div class="row-fluid">

                    <div class="span12">
                        <div class="hero-unit-3">
                            <a href="teacher.php" class="btn btn-success"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a>
                            <br>
                            <br>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <div class="control-group">
                                    <label class="control-label" for="name">Course Name:</label>
                                    <div class="controls">
                                        <input type="text" id="name" name="name" value="<?php echo $rows['name'] ?>" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="price">price:</label>
                                    <div class="controls">
                                        <input type="text" name="price" id="price" value="<?php echo $rows['price'] ?>" required>
                                    </div>
                                    <div class="control-group">
                                    <label class="control-label" for="input01">Cover:</label>
                                    <div class="controls">
                                        <input type="file" name="cover" class="font" required> 
                                    </div>
                                </div> 
                                <div class="control-group">
                                    <label class="control-label" for="input01">Avatar:</label>
                                    <div class="controls">
                                        <input type="file" name="avatar" class="font" required> 
                                    </div>
                                </div> 

                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" name="save" class="btn btn-info"><i class="icon-save icon-large"></i>&nbsp;Save</button>
                                    </div>
                                </div>
                            
							</form>

                            <?php
                            if (isset($_POST['save'])) {
                                $name = $_POST['name'];
                                $price = $_POST['price'];
                                if(empty($_FILES['cover'])) {
                                    $cover = $row['cover'];
                                } else {
                                    $cover = upload_image($_FILES['cover']);
                                }

                                if(empty($_FILES['avatar'])) {
                                    $avatar = $row['cover'];
                                } else {
                                    $avatar = upload_image($_FILES['avatar']);
                                }

                                $query = 'UPDATE "Course" SET name=' . "'$name'" . ", price=" . $price . ", cover=" . "'$cover'" . ", avatar=" . "'$avatar'" . "WHERE course_id=" . $get_id; 
			                    pg_query($conn, $query)or die(pg_errormessage());

                                header('location:course.php') or die(pg_errormessage());
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
