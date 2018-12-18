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
                            <a href="add_category.php" class="btn btn-success"><i class="icon-plus-sign icon-large"></i>&nbsp;Add Category</a>
                            <br><br>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong><i class="icon-user icon-large"></i>&nbsp;Category Table</strong>
                                </div>
                                <thead>
                                    <tr>
                                        <th>Category ID</th>
                                        <th>Category Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //$table = '"Student"';
                                    $query = pg_query($conn ,'select *from "Category"') or die(pg_errormessage());
                                    while ($row =  pg_fetch_array($query)) {
                                        $category_id = $row['category_id'];
                                        ?>


                                        <!-- script -->
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                                
                                            $('#e<?php echo $category_id; ?>').tooltip('show')
                                            $('#e<?php echo $category_id; ?>').tooltip('hide')
                                        });
                                    </script>
                                    <!-- end script -->
                                    <!-- script -->
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                                
                                            $('#d<?php echo $category_id; ?>').tooltip('show')
                                            $('#d<?php echo $category_id; ?>').tooltip('hide')
                                        });
                                    </script>
                                    <!-- end script -->


                                    <tr class="odd gradeX">
                                        <td><?php echo $row['category_id']; ?></td> 
                                        <td><?php echo $row['category']; ?></td> 
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


