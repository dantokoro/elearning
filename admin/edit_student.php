<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php  $get_id=$_GET['id'];  ?>
<body>
    <?php
    $table = '"Student"';
    $student_query=pg_query("select * from $table where student_id=$get_id")or die(pg_errormessage());
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
                                    <label class="control-label" for="inputEmail">Email</label>
                                    <div class="controls">
                                        <input type="text" id="inputEmail" name="email" value="<?php echo $rows['email'] ?>" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputPassword">Password</label>
                                    <div class="controls">
                                        <input type="text" name="password" id="inputPassword" value="<?php echo $rows['password'] ?>" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputEmail">Name</label>
                                    <div class="controls">
                                        <input type="text" id="inputEmail" name="name" value="<?php echo $rows['name'] ?>" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputEmail">Date of birth</label>
                                    <div class="controls">
                                        <input type="text" id="inputEmail" name="date_of_birth" value="<?php echo $rows['date_of_birth'] ?>" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputEmail">Address</label>
                                    <div class="controls">
                                        <input type="text" id="inputEmail" name="address" value="<?php echo $rows['address'] ?>" required>
                                    </div>
                                </div>
									<div class="control-group">
	<label class="control-label" for="input01">Image:</label>
    <div class="controls">
	<input type="file" name="image" class="font"> 
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
                                $email = $_POST['email'];
                                $password = $_POST['password'];
                                $name = $_POST['name'];
                                $date_of_birth = $_POST['date_of_birth'];
                                $address = $_POST['address'];		

                                $table = '"Student"';
			                    pg_query("update $table SET email='$email',password='$password',name='$name',date_of_birth='$date_of_birth',
                                address='$address'
                                where student_id = $get_id
			                    ")or die(pg_errormessage());

                                header('location:student.php') or die(pg_errormessage());
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
