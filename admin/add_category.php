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
                                    <label class="control-label" for="input">Category:</label>
                                    <div class="controls">
                                        <input type="text" name="category" id="input" placeholder="Course Name" required>
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
                                // hàm thêm
                                $name = $_POST['category'];
                                $query = 'INSERT INTO "Category"(category) VALUES(' . "'$name')";
                                $result = pg_query($conn, $query);
                                if(!$result) {
                                    echo '<script type="text/javascript">alert('.pg_errormessage().') </script>';
                                } else {
                                    header('location:category.php');
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


