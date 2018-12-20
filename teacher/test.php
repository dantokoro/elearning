<?php 
    require('header.php');
    include '../admin/connect.php';
    include 'autoload/autoload.php';
?>

<body>
   <div class="hero-content">
      <header class="site-header">
         <div class="top-header-bar">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-12 col-lg-6 d-none d-md-flex flex-wrap justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                     <div class="header-bar-email d-flex align-items-center">
                        <i class="fa fa-envelope"></i><a href="#"></a>
                     </div>
                     <!-- .header-bar-email -->
                     <div class="header-bar-text lg-flex align-items-center">
                        <p><i class="fa fa-phone"></i> </p>
                     </div>
                     <!-- .header-bar-text -->
                  </div>
                  <!-- .col -->
                  <div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center justify-content-lg-end align-items-center">
                     <div class="header-bar-search">
                        <form class="flex align-items-stretch">
                           <input type="search" placeholder="What you want to see?">
                           <button type="submit" value="" class="flex justify-content-center align-items-center"><i class="fa fa-search"></i></button>
                        </form>
                     </div>
                     <!-- .header-bar-search -->
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
         <?php require('navbar.php') ?>
      </header>
      <!-- .site-header -->
      <div class="hero-content-overlay">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <div class="hero-content-wrap flex flex-column justify-content-center align-items-start">
                     <header class="entry-header">
                        <h4>Get started by create your own courses</h4>
                        <h1>best online<br/>Learning system</h1>
                     </header>
                     <!-- .entry-header -->
                     <footer class="entry-footer read-more">
                        <a href="#">Create</a>
                     </footer>
                     <!-- .entry-footer -->
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
   <section class="featured-courses horizontal-column courses-wrap">
      <div class="container">
        <div class="row">
            <div class="col-12">
                <header class="heading flex justify-content-between align-items-center">
                    <h2 class="entry-title">All of your courses</h2>
                </header><!-- .heading -->
            </div><!-- .col -->
            <?php 
                all_course_printer($conn, 7);
            ?>
        </div>
         <!-- row -->
      </div>
      <!-- container -->
   </section>
   <!-- .courses-wrap -->
   <section class="about-section">
      <div class="container">
         <div class="row">
            <div class="col-12 col-lg-6 align-content-lg-stretch">
               <header class="heading">
                  <h2 class="entry-title">Your achievement</h2>
                  <p>All of achievement you have made</p>
               </header>
               <!-- .heading -->
               <div class="entry-content ezuca-stats">
                  <div class="stats-wrap flex flex-wrap justify-content-lg-between">
                     <div class="stats-count">
                        <!-- Learning student -->
                        50<span>M+</span>
                        <p>STUDENTS LEARNING</p>
                     </div>
                     <!-- .stats-count -->
                     <div class="stats-count">
                        <!-- Number of courses -->
                        30<span>K+</span>
                        <p>ACTIVE COURSES</p>
                     </div>
                     <!-- .stats-count -->
                     <div class="stats-count">
                        <!-- Average rating -->
                        340<span>M+</span>
                        <p>INSTRUCTORS ONLINE</p>
                     </div>
                     <!-- .stats-count -->
                     <!-- <div class="stats-count">
                        20<span>+</span>
                        <p>Country Reached</p>
                        </div>.stats-count -->
                  </div>
                  <!-- .stats-wrap -->
               </div>
               <!-- .ezuca-stats -->
            </div>
            <!-- .col -->
            <div class="col-12 col-lg-6 flex align-content-center mt-5 mt-lg-0">
               <!-- chart -->
            </div>
         </div>
         <!-- .row -->
      </div>
      <!-- .container -->
   </section>
   <!-- .about-section -->
  
   <div class="clients-logo">
      <div class="container">
         <div class="row">
            <div class="col-12 flex flex-wrap justify-content-center justify-content-lg-between align-items-center">
               <div class="logo-wrap">
                  <img src="images/logo-1.png" alt="">
               </div>
               <!-- .logo-wrap -->
               <div class="logo-wrap">
                  <img src="images/logo-2.png" alt="">
               </div>
               <!-- .logo-wrap -->
               <div class="logo-wrap">
                  <img src="images/logo-3.png" alt="">
               </div>
               <!-- .logo-wrap -->
               <div class="logo-wrap">
                  <img src="images/logo-4.png" alt="">
               </div>
               <!-- .logo-wrap -->
               <div class="logo-wrap">
                  <img src="images/logo-5.png" alt="">
               </div>
               <!-- .logo-wrap -->
            </div>
            <!-- .col -->
         </div>
         <!-- .row -->
      </div>
      <!-- .container -->
   </div>
   <!-- .clients-logo -->
   <?php require('footer.php'); ?>
   <script type='text/javascript' src='src/js/jquery.js'></script>
   <script type='text/javascript' src='src/js/swiper.min.js'></script>
   <script type='text/javascript' src='src/js/masonry.pkgd.min.js'></script>
   <script type='text/javascript' src='src/js/jquery.collapsible.min.js'></script>
   <script type='text/javascript' src='src/js/custom.js'></script>
   <script type="text/javascript">
      // Scrolling Effect
      
      $(window).on("scroll", function() {
          if ($(window).scrollTop()) {
              $('.nav-bar').addClass('black');
          } else {
              $('.nav-bar').removeClass('black');
          }
      })
   </script>

   <script type="text/javascript">
        $(document).ready(function() {
            $('.carousel').carousel( {
                interval: 3000;
            })
        });
        $('.carousel').carousel('cycle');
   </script>
</body>
</html>