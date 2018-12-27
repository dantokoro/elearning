<?php 
   require('header.php');
   ob_start();
   session_start();

   if(isset($_SESSION['username'])) {
      $username = $_SESSION['username'];
   }
   if(isset($_SESSION['id'])) {
      $user_id = $_SESSION['id'];
   }
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
                           <?php
                              if(empty($username)) {
                                 echo '<li><a href="login.php">Register/Login</a></li>';
                              } else {
                                 echo '<li><a href="profile.php">Hi '.$username.'</a></li>';
                              }
                           ?>
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
                        <a href="add_course.php">Create</a>
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
               <header class="heading flex justify-content-between align-items-center" style="padding: 20px;">
                  <h2 class="entry-title">Your courses</h2>
                  <a class="btn mt-4 mt-sm-0" href="courses.php">view all</a>
               </header>
               <!-- .heading -->
            </div>
            <!-- col -->
         </div>
         <!-- row -->
         <div class="row">
         <?php
            $table = array('"AssignTeacher"', '"Course"', '"Vote"');
            $query = "SELECT {$table[1]}.*, AVG(rate) as avg, COUNT(*) FROM {$table[1]} JOIN {$table[2]} ON {$table[1]}.course_id = {$table[2]}.course_id GROUP BY {$table[1]}.course_id HAVING {$table[1]}.course_id IN(SELECT course_id FROM {$table[0]} WHERE teacher_id = $1) ORDER BY AVG(rate) LIMIT 6";
            pg_prepare($conn, "best course", $query);
            $result = pg_execute($conn, "best course",array($user_id));
            $info = pg_fetch_all($result);
            //print_r($info);
            foreach($info as $value) {
               print_a_course($value);
            }
         ?>
   <section>

   </section>
   <section class="about-section">
      <div class="container">
         <div class="row">
            <div class="col-12 col-lg-6 align-content-lg-stretch">
               <header class="heading">
                  <h2 class="entry-title">Your achievement</h2>
                  <p>All of achievement you have made</p>
                  <hr>
               </header>
               <!-- .heading -->
               <div class="entry-content ezuca-stats">
                  <div class="stats-wrap flex flex-wrap justify-content-lg-between">
                     <div class="stats-count">
                        <!-- Learning student -->
                        <?php
                           $table = array('"Enrolled"', '"AssignTeacher"');
                           $query = "SELECT count(*) FROM {$table[0]} WHERE course_id IN ( SELECT course_id FROM {$table[1]} WHERE teacher_id = $1)"; 
                           pg_prepare($conn, "archieve", $query);
                           $result = pg_execute($conn, "archieve", array($user_id));
                           $teacher_info = pg_fetch_array($result);
                        
                           echo $teacher_info['count'].'<span>+</span>' ?>
                        <p>Student Learning</p>
                     </div>
                     <!-- .stats-count -->
                     <div class="stats-count">
                        <!-- Number of courses -->
                        <?php 
                           $table = '"AssignTeacher"';
                           $query = "SELECT count(*) FROM {$table} WHERE teacher_id = $1";
                           pg_prepare($conn, "courses", $query);
                           $result = pg_execute($conn, "courses", array($user_id));
                           $active_courses = pg_fetch_array($result);

                           echo $active_courses['count'].'<span>+</span>';
                        ?>
                        <p>Active Courses</p>
                     </div>
                     <!-- .stats-count -->
                     <div class="stats-count">
                        <!-- Average rating -->
                        <?php 
                           $table = array('"Vote"', '"AssignTeacher"');
                           $query = "SELECT AVG(rate) FROM {$table[0]} WHERE course_id IN ( SELECT course_id FROM {$table[1]} WHERE teacher_id = $1)";
                           pg_prepare($conn, "rating", $query);
                           $result = pg_execute($conn, "rating", array($user_id));
                           $rating = pg_fetch_array($result);

                           if(isset($rating['avg'])) {
                              echo round($rating['avg'], 2).'<span></span>';
                              echo '<p>Average rating</p>';
                           } else {
                              echo '0<p>Average rating</p>';
                           }
                        ?>
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
   <section class="home-gallery">
      <div class="gallery-wrap flex flex-wrap">
         <div class="gallery-grid gallery-grid1x1">
            <a href="#"><img src="images/a.jpg" alt=""></a>
         </div>
         <!-- .gallery-grid -->
         <div class="gallery-grid gallery-grid1x1">
            <a href="#"><img src="images/b.jpg" alt=""></a>
         </div>
         <!-- .gallery-grid -->
         <div class="gallery-grid gallery-grid2x2">
            <a href="#"><img src="images/c.jpg" alt=""></a>
         </div>
         <!-- .gallery-grid -->
         <div class="gallery-grid gallery-grid1x1">
            <a href="#"><img src="images/d.jpg" alt=""></a>
         </div>
         <!-- .gallery-grid -->
         <div class="gallery-grid gallery-grid1x1">
            <a href="#"><img src="images/e.jpg" alt=""></a>
         </div>
         <!-- .gallery-grid -->
         <div class="gallery-grid gallery-grid2x1">
            <a href="#"><img src="images/g.jpg" alt=""></a>
         </div>
         <!-- .gallery-grid -->
         <div class="gallery-grid gallery-grid2x1">
            <a href="#"><img src="images/h.jpg" alt=""></a>
         </div>
         <!-- .gallery-grid -->
         <div class="gallery-grid gallery-grid1x1">
            <a href="#"><img src="images/i.jpg" alt=""></a>
         </div>
         <!-- .gallery-grid -->
         <div class="gallery-grid gallery-grid2x2 ">
            <a href="#"><img src="images/j.jpg" alt=""></a>
         </div>
         <!-- .gallery-grid -->
         <div class="gallery-grid gallery-grid1x1">
            <a href="#"><img src="images/k.jpg" alt=""></a>
         </div>
         <!-- .gallery-grid -->
         <div class="gallery-grid gallery-grid1x1">
            <a href="#"><img src="images/l.jpg" alt=""></a>
         </div>
         <!-- .gallery-grid -->
         <div class="gallery-grid gallery-grid2x1">
            <a href="#"><img src="images/m.jpg" alt=""></a>
         </div>
         <!-- .gallery-grid -->
         <div class="gallery-grid gallery-grid3x1">
            <a href="#"><img src="images/n.jpg" alt=""></a>
         </div>
         <!-- .gallery-grid -->
         <div class="gallery-grid gallery-grid1x1">
            <a href="#"><img src="images/o.jpg" alt=""></a>
         </div>
         <!-- .gallery-grid -->
      </div>
      <!-- .gallery-wrap -->
   </section>
   <!-- .home-gallery -->
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