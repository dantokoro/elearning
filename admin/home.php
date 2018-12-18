<?php include('header.php'); ?>
<?php include('session.php'); ?>
<body>

    <div class="row-fluid">
        <div class="span12">

            <?php include 'navbar.php'; ?>
            <div class="container">
                <div class="row-fluid">
                    <div class="span12">
                        <!--slider-->
                        <div class="slider-wrapper theme-default">

                            <div id="slider" class="nivoSlider">
                                <img src="src/images/1.jpg" data-thumb="src/images/toystory.jpg" alt="" />
                                <img src="src/images/2.jpg" data-thumb="src/images/toystory.jpg" alt="" />
                                <img src="src/images/3.jpg" data-thumb="src/images/wineries.jpg" alt="" t />
                                <img src="src/images/4.jpg"  alt="" data-transition="slideInLeft" />
                        
                            </div>

                        </div>
                        <!-- end slider -->
                    </div>
                
                </div>

                <?php include('footer.php'); ?>
            </div>

        </div>
    </div>
</body>
</html>