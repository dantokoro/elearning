<!DOCTYPE html>
<html lang="en">
<head>
    <title>DABAKI ACADEMY</title>
	
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="style.css">
	
	<!-- Styles cho tabs -->
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Jquery Style -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
    <div class="hero-content">
        <header class="site-header">
            <div class="top-header-bar">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-6 d-none d-md-flex flex-wrap justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                            <div class="header-bar-email d-flex align-items-center">
                                <i class="fa fa-envelope"></i><a href="#"></a>
                            </div><!-- .header-bar-email -->

                            <div class="header-bar-text lg-flex align-items-center">
                                <p><i class="fa fa-phone"></i> </p>
                            </div><!-- .header-bar-text -->
                        </div><!-- .col -->
                        <?php
                        require 'login/db.php';
                        $table = '"Course"';
                        $que = "SELECT * FROM $table ";
                        $result = pg_query($con, $que) or die(pg_errormessage($con));
                        $json = array();
                        while ($row = pg_fetch_assoc($result)) {
                            $new["label"] = $row['name'];
                            $temp=$row['course_id'];
                            $new["the_link"] = "single-courses.php?id=$temp";
                            $json[]= $new;
                        }
                        ?>
                        <script>
                        $( function() {
                            var ar= <?php echo json_encode($json,JSON_PRETTY_PRINT) ?>;
                            $("#myInput").autocomplete({
                                source: ar,
                                minLength: 1,
                                select: function( event, ui) {
                                    location.href = ui.item.the_link;
                                }
                                
                            });
                        });
                        </script>
                        <div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center justify-content-lg-end align-items-center">
                            <div class="header-bar-search">
                                <form class="flex align-items-stretch" action="search.php" method="GET">
                                <input id="myInput" type="search" name="query" placeholder="What would you like to learn?">

                                <button type="submit" value="search" class="flex justify-content-center align-items-center"><i class="fa fa-search"></i></button>
                                </form>
                            </div><!-- .header-bar-search -->
                            <div class="header-bar-menu">
                                <ul class="flex justify-content-center align-items-center py-2 pt-md-0">
									<?php
										require('login/db.php');
										require('func.php');
										session_start();
										if(isset($_SESSION['email']) && $_SESSION['email']){
											echo '<li><a href="profile_student.php">Hello ';
											$email=$_SESSION['email'];
											$query='SELECT * FROM "Student" WHERE email='.$email ;
											$result = pg_query($con,$query) or die(pg_errormessage($con));
											$info = pg_fetch_assoc($result);
											$mang_ho_ten= explode(" ", $info["name"]);
											$so_phan_tu = count($mang_ho_ten);
											$ten = $mang_ho_ten[$so_phan_tu-1];
											echo $ten;
											
											echo '</a></li>
                                                    <li><a href="login/logout.php">Logout </a></li>';											
										}									
										else{
											echo '<li><a href="login/login2.php">Register/Login</a></li>';                                    
										}
									?>
                                </ul>
                            </div><!-- .header-bar-menu -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .container-fluid -->
            </div><!-- .top-header-bar -->

            <div class="nav-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-9 col-lg-3">
                            <div class="site-branding">
                                <h1 class="site-title"><a href="index_login.php" rel="home">Dabaki<span>Academy</span></a></h1>
                            </div><!-- .site-branding -->
                        </div><!-- .col -->

                        <div class="col-3 col-lg-9 flex justify-content-end align-content-center">
                            <nav class="site-navigation flex justify-content-end align-items-center">
                                <ul class="flex flex-column flex-lg-row justify-content-lg-end align-content-center">
                                    <li class="current-menu-item"><a href="index_login.php">Home</a></li>
                                    <li><a href="about.php">About</a></li>
                                    <li><a href="courses.php">Courses</a></li>
                                    <li><a href="blog.php">Ask&ans</a></li>
                                    <li><a href="contact.php">Contact</a></li>
                                </ul>

                                <div class="hamburger-menu d-lg-none">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div><!-- .hamburger-menu -->

                                <div class="header-bar-cart">
                                    <a href="#" class="flex justify-content-center align-items-center"><span aria-hidden="true" class="icon_bag_alt"></span></a>
                                </div><!-- .header-bar-search -->
                            </nav><!-- .site-navigation -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .container -->
            </div><!-- .nav-bar -->
        </header><!-- .site-header -->

        <div class="hero-content-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero-content-wrap flex flex-column justify-content-center align-items-start">
                            <header class="entry-header">
                                <h4>Get started with online courses</h4>
                                <h1>best online<br/>Learning system</h1>
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <p>Sale up to 90% is just 2 days left!! Get your course now!!</p>
                            </div><!-- .entry-content -->

                            <footer class="entry-footer read-more">
                                <a href="courses.php">find more</a>
                            </footer><!-- .entry-footer -->
                        </div><!-- .hero-content-wrap -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .hero-content-hero-content-overlay -->
    </div><!-- .hero-content -->

   

    <section class="featured-courses horizontal-column courses-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <header class="heading flex justify-content-between align-items-center">
                        <h2 class="entry-title">We made these courses for you</h2>
                    </header><!-- .heading -->
                </div><!-- .col -->
	<?php	
		$query_rank='SELECT course_id, COUNT(student_id)
				FROM "Enrolled"
				GROUP BY course_id
				ORDER BY count DESC';								// Lấy bảng xếp hạng khóa học đc mua nhiều nhất
		$result_rank = pg_query($con,$query_rank) or die(pg_errormessage($con));	//(Nếu user chưa login thì suggest bestseller)
	////////////////////////////////////	
		if(isset($_SESSION['email']) && $_SESSION['email']){			//(Nếu login rồi)
			$query='SELECT *
					FROM "ClickRecord"
					WHERE student_id='.$info["student_id"].'
					ORDER BY click DESC' ;							//  Lấy các khóa học được người này xem nhiều nhất
			$result = pg_query($con,$query) or die(pg_errormessage($con));
			if (pg_num_rows($result) > 0) {								// Nếu người này đã Click vào 1 số course
				$i=0;
				while($i<2 && $suggest = pg_fetch_assoc($result)) {			
					suggest_course($suggest["course_id"]);
					$i++;
				}
			}
			else{														// Nếu chưa nhấn course nào -> suggest bestseller
				if (pg_num_rows($result_rank) > 0) {
					$i=0;
					while($i<2 && $rank = pg_fetch_assoc($result_rank)) {					
						suggest_course($rank["course_id"]);
						$i++;
					}
				}
			}
		} else{														//Nếu chưa login -> suggest bestseller
			if (pg_num_rows($result_rank) > 0) {
				$i=0;
				while($i<2 && $rank = pg_fetch_assoc($result_rank)) {					
					suggest_course($rank["course_id"]);
					$i++;
				}
			}
		}	
	?>
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .courses-wrap -->


    <section class="featured-courses vertical-column courses-wrap">
        <div class="container">
            <div class="row mx-m-25">
                <div class="col-12 px-25">
                    <header class="heading flex flex-wrap justify-content-between align-items-center">
                        <h2 class="entry-title">BEST SELLING COURSES</h2>

                        <nav class="courses-menu mt-3 mt-lg-0">
                            <ul class="flex flex-wrap justify-content-md-end align-items-center">
								
										<div class="w3-container">
										  <div class="w3-row">
											<a href="javascript:void(0)" onclick="openCity(event, 'All');">
											  <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">All</div>
											</a>
											<a href="javascript:void(0)" onclick="openCity(event, 'Business');">
											  <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Business</div>
											</a>
											<a href="javascript:void(0)" onclick="openCity(event, 'Language');">
											  <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Language</div>
											</a>
											<a href="javascript:void(0)" onclick="openCity(event, 'Dancing');">
											  <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Dancing</div>
											</a>
											<a href="javascript:void(0)" onclick="openCity(event, 'Philosophy');">
											  <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Philosophy</div>
											</a>
										  </div>
										</div>
										
                            </ul>
                        </nav><!-- .courses-menu -->
                    </header><!-- .heading -->
                </div><!-- .col -->
					
				<div id="All" class="w3-container city" style="display:none">
					<?php	
						$result_rank = pg_query($con,$query_rank) or die(pg_errormessage($con));
						if (pg_num_rows($result_rank) > 0) {
							$i=0;
							while($i<3 && $rank = pg_fetch_assoc($result_rank)) {					
								print_course($rank["course_id"]);
								$i++;
							}
						}
					?>
				</div>
				<div id="Business" class="w3-container city" style="display:none">
					<?php
						$query='SELECT course_id, COUNT(student_id)
								FROM "Enrolled"
								WHERE course_id IN(
									SELECT course_id	
									FROM "CourseCategory"
									WHERE category_id=1
								)
								GROUP BY course_id
								ORDER BY count DESC';
						$result = pg_query($con,$query) or die(pg_errormessage($con));
						if (pg_num_rows($result) > 0) {
							$i=0;
							while($i<3 && $rank = pg_fetch_assoc($result)) {					// Lấy bảng xếp hạng khóa học Business đc mua nhiều nhất
								print_course($rank["course_id"]);
								$i++;
							}
						}
					?>
				</div>

				<div id="Language" class="w3-container city" style="display:none">
					<?php
						$query='SELECT course_id, COUNT(student_id)
								FROM "Enrolled"
								WHERE course_id IN(
									SELECT course_id	
									FROM "CourseCategory"
									WHERE category_id=2
								)
								GROUP BY course_id
								ORDER BY count DESC';
						$result = pg_query($con,$query) or die(pg_errormessage($con));
						if (pg_num_rows($result) > 0) {
							$i=0;
							while($i<3 && $rank = pg_fetch_assoc($result)) {					// Lấy bảng xếp hạng khóa học Language đc mua nhiều nhất
								print_course($rank["course_id"]);
								$i++;
							}
						}
					?>
			  </div>
			  <div id="Dancing" class="w3-container city" style="display:none">
					<?php
						$query='SELECT course_id, COUNT(student_id)
								FROM "Enrolled"
								WHERE course_id IN(
									SELECT course_id	
									FROM "CourseCategory"
									WHERE category_id=3
								)
								GROUP BY course_id
								ORDER BY count DESC';
						$result = pg_query($con,$query) or die(pg_errormessage($con));
						if (pg_num_rows($result) > 0) {
							$i=0;
							while($i<3 && $rank = pg_fetch_assoc($result)) {					// Lấy bảng xếp hạng khóa học Language đc mua nhiều nhất
								print_course($rank["course_id"]);
								$i++;
							}
						}
					?>
			  </div><div id="Philosophy" class="w3-container city" style="display:none">
					<?php
						$query='SELECT course_id, COUNT(student_id)
								FROM "Enrolled"
								WHERE course_id IN(
									SELECT course_id	
									FROM "CourseCategory"
									WHERE category_id=4
								)
								GROUP BY course_id
								ORDER BY count DESC';
						$result = pg_query($con,$query) or die(pg_errormessage($con));
						if (pg_num_rows($result) > 0) {
							$i=0;
							while($i<3 && $rank = pg_fetch_assoc($result)) {					// Lấy bảng xếp hạng khóa học Language đc mua nhiều nhất
								print_course($rank["course_id"]);
								$i++;
							}
						}
					?>
			  </div>
				
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .courses-wrap -->             
    

    <section class="home-gallery">
        <div class="gallery-wrap flex flex-wrap">
            <div class="gallery-grid gallery-grid1x1">
                <a href="#"><img src="images/a.jpg" alt=""></a>
            </div><!-- .gallery-grid -->

            <div class="gallery-grid gallery-grid1x1">
                <a href="#"><img src="images/b.jpg" alt=""></a>
            </div><!-- .gallery-grid -->

            <div class="gallery-grid gallery-grid2x2">
                <a href="#"><img src="images/c.jpg" alt=""></a>
            </div><!-- .gallery-grid -->

            <div class="gallery-grid gallery-grid1x1">
                <a href="#"><img src="images/d.jpg" alt=""></a>
            </div><!-- .gallery-grid -->

            <div class="gallery-grid gallery-grid1x1">
                <a href="#"><img src="images/e.jpg" alt=""></a>
            </div><!-- .gallery-grid -->

            <div class="gallery-grid gallery-grid2x1">
                <a href="#"><img src="images/g.jpg" alt=""></a>
            </div><!-- .gallery-grid -->

            <div class="gallery-grid gallery-grid2x1">
                <a href="#"><img src="images/h.jpg" alt=""></a>
            </div><!-- .gallery-grid -->

            <div class="gallery-grid gallery-grid1x1">
                <a href="#"><img src="images/i.jpg" alt=""></a>
            </div><!-- .gallery-grid -->

            <div class="gallery-grid gallery-grid2x2 ">
                <a href="#"><img src="images/j.jpg" alt=""></a>
            </div><!-- .gallery-grid -->

            <div class="gallery-grid gallery-grid1x1">
                <a href="#"><img src="images/k.jpg" alt=""></a>
            </div><!-- .gallery-grid -->

            <div class="gallery-grid gallery-grid1x1">
                <a href="#"><img src="images/l.jpg" alt=""></a>
            </div><!-- .gallery-grid -->

            <div class="gallery-grid gallery-grid2x1">
                <a href="#"><img src="images/m.jpg" alt=""></a>
            </div><!-- .gallery-grid -->

            <div class="gallery-grid gallery-grid3x1">
                <a href="#"><img src="images/n.jpg" alt=""></a>
            </div><!-- .gallery-grid -->

            <div class="gallery-grid gallery-grid1x1">
                <a href="#"><img src="images/o.jpg" alt=""></a>
            </div><!-- .gallery-grid -->
        </div><!-- .gallery-wrap -->
    </section><!-- .home-gallery -->

    <div class="clients-logo">
        <div class="container">
            <div class="row">
                <div class="col-12 flex flex-wrap justify-content-center justify-content-lg-between align-items-center">
                    <div class="logo-wrap">
                        <img src="images/logo-1.png" alt="">
                    </div><!-- .logo-wrap -->

                    <div class="logo-wrap">
                        <img src="images/logo-2.png" alt="">
                    </div><!-- .logo-wrap -->

                    <div class="logo-wrap">
                        <img src="images/logo-3.png" alt="">
                    </div><!-- .logo-wrap -->

                    <div class="logo-wrap">
                        <img src="images/logo-4.png" alt="">
                    </div><!-- .logo-wrap -->

                    <div class="logo-wrap">
                        <img src="images/logo-5.png" alt="">
                    </div><!-- .logo-wrap -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .clients-logo -->

    <footer class="site-footer">
        <div class="footer-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="foot-about">
                            <a class="foot-logo" href="#"><img src="images/foot-logo.png" alt=""></a>


                            <p class="footer-copyright"></p>
                        </div><!-- .foot-about -->
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                        <div class="foot-contact">
                            <h2>Contact Us</h2>

								<li>Email: duongdang0508@gmail.com</li>
                                <li>Phone: 0762122010</li>
                                <li>Address: 1 Dai Co Viet, Hanoi, Vietnam</li>
                        </div><!-- .foot-contact -->
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 col-lg-3 mt-5 mt-lg-0">
                        <div class="quick-links flex flex-wrap">
                            <h2 class="w-100">Quick Links</h2>

                            <ul class="w-50">
                                <li><a href="#">About </a></li>
                                <li><a href="#">Terms of Use </a></li>
                                <li><a href="#">Privacy Policy </a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>

                            <ul class="w-50">
                                <li><a href="#">Documentation</a></li>
                                <li><a href="#">Forums</a></li>
                                <li><a href="#">Language Packs</a></li>
                                <li><a href="#">Release Status</a></li>
                            </ul>
                        </div><!-- .quick-links -->
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 col-lg-3 mt-5 mt-lg-0">
                        <div class="follow-us">
                            <h2>Follow Us</h2>

                            <ul class="follow-us flex flex-wrap align-items-center">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            </ul>
                        </div><!-- .quick-links -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .footer-widgets -->

        <div class="footer-bar">
            <div class="container">
                <div class="row flex-wrap justify-content-center justify-content-lg-between align-items-center">
                    <div class="col-12 col-lg-6">
                        <div class="download-apps flex flex-wrap justify-content-center justify-content-lg-start align-items-center">
                            <a href="#"><img src="images/app-store.png" alt=""></a>
                            <a href="#"><img src="images/play-store.png" alt=""></a>
                        </div><!-- .download-apps -->

                    </div>

                    <div class="col-12 col-lg-6 mt-4 mt-lg-0">
                        <div class="footer-bar-nav">
                            <ul class="flex flex-wrap justify-content-center justify-content-lg-end align-items-center">
                                <li><a href="#">DPA</a></li>
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div><!-- .footer-bar-nav -->
                    </div><!-- .col-12 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .footer-bar -->
    </footer><!-- .site-footer -->

<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/swiper.min.js'></script>
<script type='text/javascript' src='js/masonry.pkgd.min.js'></script>
<script type='text/javascript' src='js/jquery.collapsible.min.js'></script>
<script type='text/javascript' src='js/custom.js'></script>
<script>
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-border-red";
}
</script>
</body>
</html>