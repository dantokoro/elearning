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
    <!-- Jquery Style -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body class="contact-page">
    <div class="page-header">
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
						require('func.php');
						session_start();
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
                                <ul class="flex flex-column flex-lg-row justify-content-lg-end align-content-center" style="padding-left: 10px;">
                                    <li class="current-menu-item"><a href="index_login.php">Home</a></li>
                                    <li><a href="about.php">About</a></li>
                                    <li><a href="courses.php">Courses</a></li>
                                    <li><a href="blog.php">Ask&Ans</a></li>
                                    <li><a href="contact.php">Contact</a></li>
                                </ul>

                                <div class="header-bar-cart">
                                    <a href="#" class="flex justify-content-center align-items-center"><span aria-hidden="true" class="icon_bag_alt"></span></a>
                                </div><!-- .header-bar-search -->
                            </nav><!-- .site-navigation -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .container -->
            </div><!-- .nav-bar -->
        </header><!-- .site-header -->

        <div class="page-header-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <header class="entry-header">
                            <h1>CONTACT</h1>
                        </header><!-- .entry-header -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .page-header-overlay -->
    </div><!-- .page-header -->

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbs">
                    <ul class="flex flex-wrap align-items-center p-0 m-0">
                        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li>Contact</li>
                    </ul>
                </div><!-- .breadcrumbs -->
            </div><!-- .col -->
        </div><!-- .row -->

        <div class="row justify-content-between">
            <div class="col-12">
                <div class="contact-gmap">
                    <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAyCkIjViJ_7vt5PMIHai_NjcdR64QYycw&q=Space+Needle,Seattle+WA" allowfullscreen></iframe>
                </div><!-- .contact-gmap -->
            </div><!-- .col -->

            <div class="col-12 col-lg-6">
                <div class="contact-form">
                    <h3>Contact Form</h3>

                    <form>
                        <input type="text" placeholder="Your Name">
                        <input type="email" placeholder="Your Email">
                        <input type="text" placeholder="Subject">
                        <textarea placeholder="Your Message" rows="4"></textarea>
                        <input type="submit" value="Send Message">
                    </form>
                </div><!-- .contact-form -->
            </div><!-- .col -->

            <div class="col-12 col-lg-6">
                <div class="contact-info">
                    <h3>Contact Information</h3>

                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia dese mollit anim id est laborum. </p>

                    <ul class="p-0 m-0">
                        <li><span>Location:</span>1 Dai Co Viet, Hanoi, Vietnam</li>
                        <li><span>Email:</span>duongdang0508@gmail.com</li>
                        <li><span>Phone:</span>0762122010</li>
                    </ul>
                </div><!-- .contact-info -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->

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

                            <ul>
                                <li>Email: duongdang0508@gmail.com</li>
                                <li>Phone: 0762122010</li>
                                <li>Address: 1 Dai Co Viet, Hanoi, Vietnam</li>
                            </ul>
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

</body>
</html>