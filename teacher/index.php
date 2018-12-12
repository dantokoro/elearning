<!DOCTYPE html>
<?php
    require('../libraries/Function.php');
    require('../libraries/Database.php');

    $conn = connect('localhost','elearning', 'postgres', 'kien1998');
?>

    <html lang="en">
    <?php
        include('layouts/header.php');
    ?>

        <body>
            <div class="hero-content">
                <header class="site-header">
                    <div class="top-header-bar">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-lg-6 d-none d-md-flex flex-wrap justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                                    <div class="header-bar-email d-flex align-items-center">
                                        <i class="fa fa-envelope"></i>
                                        <a href="#"></a>
                                    </div>
                                    <!-- .header-bar-email -->

                                    <div class="header-bar-text lg-flex align-items-center">
                                        <p><i class="fa fa-phone"></i> </p>
                                    </div>
                                    <!-- .header-bar-text -->
                                </div>
                                <!-- .col -->

                                <div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center justify-content-lg-end align-items-center">
                                    <div class="header-bar-menu">
                                        <ul class="flex justify-content-center align-items-center py-2 pt-md-0">
                                            <li><a href="login/login2.php">Register/Login</a></li>
                                        </ul>
                                    </div>
                                    <!-- .header-bar-menu -->
                                </div>
                                <!-- .col -->
                            </div>
                            <!-- .row -->
                        </div>
                        <!-- .container-fluid -->
                    </div>
                    <!-- .top-header-bar -->

                    <div class="nav-bar">
                        <div class="container">
                            <div class="row">
                                <div class="col-9 col-lg-3">
                                    <div class="site-branding">
                                        <h1 class="site-title"><a href="index.php" rel="home">Dabaki<span>Academy</span></a></h1>
                                    </div>
                                    <!-- .site-branding -->
                                </div>
                                <!-- .col -->

                                <div class="col-3 col-lg-9 flex justify-content-end align-content-center">
                                    <nav class="site-navigation flex justify-content-end align-items-center">
                                        <ul class="flex flex-column flex-lg-row justify-content-lg-end align-content-center">
                                            <li class="current-menu-item"><a href="index.php">Home</a></li>
                                            <li><a href="about.php">About</a></li>
                                            <li><a href="courses.php">Courses</a></li>
                                            <li><a href="contact.php">Contact</a></li>
                                        </ul>

                                        <div class="hamburger-menu d-lg-none">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <!-- .hamburger-menu -->

                                        <div class="header-bar-cart">
                                            <a href="#" class="flex justify-content-center align-items-center"><span aria-hidden="true" class="icon_bag_alt"></span></a>
                                        </div>
                                        <!-- .header-bar-search -->
                                    </nav>
                                    <!-- .site-navigation -->
                                </div>
                                <!-- .col -->
                            </div>
                            <!-- .row -->
                        </div>
                        <!-- .container -->
                    </div>
                    <!-- .nav-bar -->
                </header>
                <!-- .site-header -->

                <div class="hero-content-overlay">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="hero-content-wrap flex flex-column justify-content-center align-items-start">
                                    <header class="entry-header">
                                        <h1 style="color: whitesmoke">Jump Into Course Creation</h1>
                                    </header> <!-- .entry-header -->
                                    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
                                </div>  
                                <!-- .hero-content-wrap -->
                            </div>
                            <!-- .col -->
                        </div>
                        <!-- .row -->
                    </div>
                    <!-- .container -->
                </div>
                <!-- .hero-content-hero-content-overlay -->
            </div>
            <!-- .hero-content -->

            <section class="featured-courses vertical-column courses-wrap">
                <div class="container">
                    <div class="row mx-m-25">
                        <div class="col-12 px-25">
                            <header class="heading flex flex-wrap justify-content-between align-items-center">
                                <h2 class="entry-title">YOUR COURSES</h2>
                            </header>
                            <!-- .heading -->
                        </div>
                        <!-- .col -->

                        <!-- -->

                        <div class="col-12 px-25 flex justify-content-center">
                            <a class="btn" href="courses.php">view all courses</a>
                        </div>
                        <!-- .col -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </section>
            <!-- .courses-wrap -->

            <?php
        include('layouts/footer.php');
    ?>



                <script type='text/javascript' src='js/jquery.js'></script>
                <script type='text/javascript' src='js/swiper.min.js'></script>
                <script type='text/javascript' src='js/masonry.pkgd.min.js'></script>
                <script type='text/javascript' src='js/jquery.collapsible.min.js'></script>
                <script type='text/javascript' src='js/custom.js'></script>

        </body>

    </html>