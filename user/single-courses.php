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
<body class="single-courses-page">
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
			<?php
				if(isset($_SESSION['email']) && $_SESSION['email'] && isset($_GET['id'])){	// Cộng số lần click
					$email=$_SESSION['email'];
					$id=$_GET['id'];		// Lấy course_id
											
					$query='SELECT * FROM "ClickRecord" WHERE student_id='.$info["student_id"].'AND course_id='.$id;
					$result = pg_query($con,$query) or die(pg_errormessage($con));
					$click_record = pg_fetch_assoc($result);	// Lấy số lần click vào khóa học này
											
					if(pg_num_rows($result) > 0){
						$click=$click_record["click"]+1;		
						$query='UPDATE "ClickRecord" SET click='.$click. 
								' WHERE student_id='.$info["student_id"].' AND course_id='.$id;
						$result = pg_query($con,$query);
					} else{
						$query='INSERT INTO "ClickRecord" VALUES ('.$info["student_id"].','.$id.',1)';
						$result = pg_query($con,$query);
					}
				}
									?>
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
                                    <li><a href="blog.php">Ask&Ans</a></li>
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
        <div class="page-header-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <header class="entry-header">
                            <h1 class="entry-title"><?php
										require('login/db.php');
										if(isset($_GET['id'])){
											$id=$_GET['id'];
											$query= 'SELECT * FROM "Course" WHERE course_id='.$id ;	// Lấy info của course
											$result = pg_query($con,$query) or die(pg_errormessage($con));
											if (pg_num_rows($result) > 0) {
												$course = pg_fetch_assoc($result);
												echo $course["name"];
													
											}
										}	?></h1>

                            <div class="ratings flex justify-content-center align-items-center">
                                <?php		
											$query= '	SELECT AVG(rate), COUNT(*)
														FROM "Vote"
														WHERE course_id='.$id ;						
											$result = pg_query($con,$query) or die(pg_errormessage($con));
											$rating = pg_fetch_assoc($result);					// Lấy rating của course
											if (pg_num_rows($result) > 0) {
													$rate = $rating["avg"];
													$star=(int)$rate;
														
											} else {
													$star=0;
												}	
											for($i=0;$i<$star;$i++){	
													echo '<i class="fa fa-star"></i>';
													}
											for($i=0;$i<(5-$star);$i++){ 
													echo '<span class="fa fa-star-o"></span>';
													}

											
								?>
                                <span><?php	echo '('.$rating["count"].' rates)'  ?></span>
                            </div><!-- .ratings -->
                        </header><!-- .entry-header -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .page-header-overlay -->
    </div><!-- .page-header -->

    <div class="container">
        <div class="row">
            <div class="col-12 offset-lg-1 col-lg-10">
                <div class="featured-image">
                    <img src="<?php echo $course["cover"];	?>" alt="">	

                    <div class="course-cost"><?php	
											
													$price=$course["price"];
													$discount=$course["discount"];
													
													if( $discount==100){
														  echo '<span class="free-cost">Free</span>';
													  }else{
														echo $price*(100-$discount)*0.01 ."$";
													  }   
											
					?></div>
                </div>
            </div><!-- .col -->
        </div><!-- .row -->

        <div class="row">
            <div class="col-12 offset-lg-1 col-lg-1">
                <div class="post-share">
                    <h3>share</h3>

                    <ul class="flex flex-wrap align-items-center p-0 m-0">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-thumb-tack"></i></a></li>
                    </ul>
                </div><!-- .post-share -->
            </div><!-- .col -->
				<?php
							$query_teacher='SELECT * 
											FROM "Teacher" 
											WHERE teacher_id IN( 
																SELECT teacher_id 
																FROM "AssignTeacher" 
																WHERE course_id='.$id.')';			
							$result = pg_query($con,$query_teacher) or die(pg_errormessage($con));
							$teacher = pg_fetch_assoc($result); 					//Lấy info teacher
				?>
            <div class="col-12 col-lg-8">
                <div class="single-course-wrap">
                    <div class="course-info flex flex-wrap align-items-center">
                        <div class="course-author flex flex-wrap align-items-center mt-3">
                            <img src="<?php echo $teacher["picture"];	?>" alt="">		

                            <div class="author-wrap">
                                <label class="m-0">Teacher</label>
                                <div class="author-name"><a href="teacher/teacher.php?id=<?php	echo $teacher['teacher_id'] ?>"><?php
											
												echo $teacher["name"];
											?></a></div>
                            </div><!-- .author-wrap -->
                        </div><!-- .course-author -->
						<?php	
							$query_category='SELECT * 
											FROM "Category"
											WHERE category_id IN(
															SELECT category_id
															FROM "CourseCategory"
															WHERE course_id='.$id.')';			
							$result = pg_query($con,$query_category) or die(pg_errormessage($con));
							$category = pg_fetch_assoc($result);					// Lấy Category
							?>
                        <div class="course-cats mt-3"> 
                            <label class="m-0">Categories</label>
                            <div class="author-name"><?php echo '<a href="courses.php?c='.$category["category_id"].'">';
								 echo $category["category"];	?>	 
							</a></div>
                        </div><!-- .course-cats -->

                        <div class="course-students mt-3">
                            <label class="m-0">Student</label>
                            <div class="author-name"><?php
								$query_regis='	SELECT COUNT(student_id) 
												FROM "Enrolled" 
												WHERE course_id='.$id;
								$result = pg_query($con,$query_regis) or die(pg_errormessage($con));
								$regis_num = pg_fetch_assoc($result);				//Lấy số học sinh đăng kí khóa học 
								echo $regis_num["count"];
							?> (REGISTERED)</div>
                        </div><!-- .course-students -->

                        <div class="buy-course mt-3"><?php
                        if(isset($_SESSION['email']) && $_SESSION['email']){
                            echo '<a class="btn" href="checkout.php?id='.$id.'">BUY NOW</a>';
                        }
                        else echo'<p>Log in to buy course</p>';
                            ?>
                        </div><!-- .buy-course -->
                    </div><!-- .course-info -->

                    <div class="single-course-cont-section">
                        <h2>What Will I Learn? </h2>

                        <ul class="p-0 m-0 green-ticked">
						<?php
							$query_goal='SELECT * 
									FROM "CourseArchievement"
									WHERE course_id='.$id;
							$result = pg_query($con,$query_goal) or die(pg_errormessage($con));
							if (pg_num_rows($result) > 0) {
								while($goal = pg_fetch_assoc($result)) {					// Lấy mục tiêu của khóa học
									echo '<li>'.$goal["description"].'</li>';
								}
							}
						?>	
                        </ul>

                        <h2>Requirements</h2>

                        <ul class="p-0 m-0 black-doted">
						<?php
							$query_require='SELECT * 
											FROM "CourseRequirement"
											WHERE course_id='.$id;
							$result = pg_query($con,$query_require) or die(pg_errormessage($con));
							if (pg_num_rows($result) > 0) {
								while($requirement = pg_fetch_assoc($result)) {					// Lấy mục tiêu của khóa học
									echo '<li>'.$requirement["description"].'</li>';
								}
							}
						?>	
                        </ul>
						
                        <h2>Description</h2>
						<?php
							$query_des='SELECT * 
											FROM "CourseDescription"
											WHERE course_id='.$id;
							$result = pg_query($con,$query_des) or die(pg_errormessage($con));
							if (pg_num_rows($result) > 0) {
								while($description = pg_fetch_assoc($result)) {					// Lấy description
									echo $description["description"];
								}
							}
						?>	
                        <p></p>
						<h2>SOME VIDEOS OF THIS COURSE</h2>
						<h2>....</h2>

                    

                            
                </div><!-- .single-course-wrap -->
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