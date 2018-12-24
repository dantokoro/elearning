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

                        <div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center justify-content-lg-end align-items-center">
                            <div class="header-bar-search">
                                <form class="flex align-items-stretch">
                                    <input type="search" placeholder="What would you like to learn?">
                                    <button type="submit" value="" class="flex justify-content-center align-items-center"><i class="fa fa-search"></i></button>
                                </form>
                            </div><!-- .header-bar-search -->

                            <div class="header-bar-menu">
                                <ul class="flex justify-content-center align-items-center py-2 pt-md-0">
                                    <?php
										require('login/db.php');
										require('func.php');
										session_start();
										if(isset($_SESSION['email']) && $_SESSION['email']){
											echo '<li><a>Hello ';
											$email=$_SESSION['email'];
											$query='SELECT name FROM "Student" WHERE email='.$email ;
											$result = pg_query($con,$query) or die(pg_errormessage($con));
											if (pg_num_rows($result) > 0) {
												$info = pg_fetch_assoc($result);
												$mang_ho_ten= explode(" ", $info["name"]);
												$so_phan_tu = count($mang_ho_ten);
												$ten = $mang_ho_ten[$so_phan_tu-1];
												echo $ten;
											}
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
                                <span><?php	echo '('.$rating["count"].' votes)'  ?></span>
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
                                <div class="author-name"><a href="#"><?php
											
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

                        <div class="buy-course mt-3">
                            <a class="btn" href="#">BUY NOW</a>
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

                    <div class="single-course-accordion-cont mt-3">
                        <header class="entry-header flex flex-wrap justify-content-between align-items-center">
                            <h2>Curriculum For This Course</h2>

                            <div class="number-of-lectures">340 Lectures</div>

                            <div class="total-lectures-time">42:57:42</div>
                        </header><!-- .entry-header -->

                        <div class="entry-contents">
                            <div class="accordion-wrap type-accordion">
                                <h3 class="entry-title flex flex-wrap justify-content-between align-items-lg-center active">
                                    <span class="arrow-r"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
                                    <span class="lecture-group-title">Introduction to this Course</span>
                                    <span class="number-of-lectures">7 Lectures</span>
                                    <span class="total-lectures-time">21:29</span>
                                </h3>

                                <div class="entry-content">
                                    <ul class="p-0 m-0">
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">A Note On Asking For Help</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Introducing Our TA</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:43</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Our Class Chat Room</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">07:48</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Why This Course?</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Download</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">2 pages</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Walkthrough</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">09:40</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Lecture Slides</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">00:03</span></li>
                                    </ul>
                                </div>

                                <h3 class="entry-title flex flex-wrap justify-content-between align-items-lg-center">
                                    <span class="arrow-r"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
                                    <span class="lecture-group-title">Introduction to Front End Development</span>
                                    <span class="number-of-lectures">4 Lectures</span>
                                    <span class="total-lectures-time">26:45</span>
                                </h3>

                                <div class="entry-content">
                                    <ul class="p-0 m-0">
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">A Note On Asking For Help</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Introducing Our TA</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:43</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Our Class Chat Room</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">07:48</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Why This Course?</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Download</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">2 pages</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Walkthrough</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">09:40</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Lecture Slides</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">00:03</span></li>
                                    </ul>
                                </div>

                                <h3 class="entry-title flex flex-wrap align-items-center">
                                    <span class="arrow-r"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
                                    <span class="lecture-group-title">Introduction to HTML	</span>
                                    <span class="number-of-lectures">12 Lectures</span>
                                    <span class="total-lectures-time">58:36</span>
                                </h3>

                                <div class="entry-content">
                                    <ul class="p-0 m-0">
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">A Note On Asking For Help</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Introducing Our TA</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:43</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Our Class Chat Room</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">07:48</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Why This Course?</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Download</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">2 pages</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Walkthrough</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">09:40</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Lecture Slides</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">00:03</span></li>
                                    </ul>
                                </div>

                                <h3 class="entry-title flex flex-wrap justify-content-between align-items-lg-center">
                                    <span class="arrow-r"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
                                    <span class="lecture-group-title">Intermediate HTML</span>
                                    <span class="number-of-lectures">12 Lectures</span>
                                    <span class="total-lectures-time">01:12</span>
                                </h3>

                                <div class="entry-content">
                                    <ul class="p-0 m-0">
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">A Note On Asking For Help</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Introducing Our TA</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:43</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Our Class Chat Room</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">07:48</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Why This Course?</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Download</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">2 pages</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Walkthrough</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">09:40</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Lecture Slides</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">00:03</span></li>
                                    </ul>
                                </div>

                                <h3 class="entry-title flex flex-wrap justify-content-between align-items-lg-center">
                                    <span class="arrow-r"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
                                    <span class="lecture-group-title">Introduction to this Course</span>
                                    <span class="number-of-lectures">7 Lectures</span>
                                    <span class="total-lectures-time">21:29</span>
                                </h3>

                                <div class="entry-content">
                                    <ul class="p-0 m-0">
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">A Note On Asking For Help</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Introducing Our TA</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:43</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Our Class Chat Room</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">07:48</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Why This Course?</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Download</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">2 pages</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Walkthrough</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">09:40</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Lecture Slides</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">00:03</span></li>
                                    </ul>
                                </div>

                                <h3 class="entry-title flex flex-wrap justify-content-between align-items-lg-center">
                                    <span class="arrow-r"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
                                    <span class="lecture-group-title">Introduction to CSS</span>
                                    <span class="number-of-lectures">12 Lectures</span>
                                    <span class="total-lectures-time">01:39</span>
                                </h3>

                                <div class="entry-content">
                                    <ul class="p-0 m-0">
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">A Note On Asking For Help</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Introducing Our TA</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:43</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Our Class Chat Room</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">07:48</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Why This Course?</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Download</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">2 pages</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Walkthrough</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">09:40</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Lecture Slides</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">00:03</span></li>
                                    </ul>
                                </div>

                                <h3 class="entry-title flex flex-wrap justify-content-between align-items-lg-center">
                                    <span class="arrow-r"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
                                    <span class="lecture-group-title">Intermediate CSS</span>
                                    <span class="number-of-lectures">16 Lectures</span>
                                    <span class="total-lectures-time">01:25</span>
                                </h3>

                                <div class="entry-content">
                                    <ul class="p-0 m-0">
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">A Note On Asking For Help</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Introducing Our TA</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:43</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Our Class Chat Room</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">07:48</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Why This Course?</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Download</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">2 pages</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Walkthrough</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">09:40</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Lecture Slides</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">00:03</span></li>
                                    </ul>
                                </div>

                                <h3 class="entry-title flex flex-wrap justify-content-between align-items-lg-center">
                                    <span class="arrow-r"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
                                    <span class="lecture-group-title">Bootstrap</span>
                                    <span class="number-of-lectures">16 Lectures</span>
                                    <span class="total-lectures-time">01:59</span>
                                </h3>

                                <div class="entry-content">
                                    <ul class="p-0 m-0">
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">A Note On Asking For Help</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Introducing Our TA</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:43</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Our Class Chat Room</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">07:48</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Why This Course?</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Download</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">2 pages</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Walkthrough</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">09:40</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Lecture Slides</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">00:03</span></li>
                                    </ul>
                                </div>

                                <h3 class="entry-title flex flex-wrap justify-content-between align-items-lg-center">
                                    <span class="arrow-r"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
                                    <span class="lecture-group-title">Introduction to JavaScript</span>
                                    <span class="number-of-lectures">12 Lectures</span>
                                    <span class="total-lectures-time">56:21</span>
                                </h3>

                                <div class="entry-content">
                                    <ul class="p-0 m-0">
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">A Note On Asking For Help</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Introducing Our TA</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:43</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Our Class Chat Room</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">07:48</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Why This Course?</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Download</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">2 pages</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Walkthrough</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">09:40</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Lecture Slides</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">00:03</span></li>
                                    </ul>
                                </div>

                                <h3 class="entry-title flex flex-wrap justify-content-between align-items-lg-center">
                                    <span class="arrow-r"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
                                    <span class="lecture-group-title">DOM Manipulation</span>
                                    <span class="number-of-lectures">13 Lectures</span>
                                    <span class="total-lectures-time">01:15</span>
                                </h3>

                                <div class="entry-content">
                                    <ul class="p-0 m-0">
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">A Note On Asking For Help</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Introducing Our TA</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:43</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Our Class Chat Room</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">07:48</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Why This Course?</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Download</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">2 pages</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Walkthrough</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">09:40</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Lecture Slides</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">00:03</span></li>
                                    </ul>
                                </div>

                                <h3 class="entry-title flex flex-wrap justify-content-between align-items-lg-center">
                                    <span class="arrow-r"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
                                    <span class="lecture-group-title">Color Game Project</span>
                                    <span class="number-of-lectures">10 Lectures</span>
                                    <span class="total-lectures-time">01:47</span>
                                </h3>

                                <div class="entry-content">
                                    <ul class="p-0 m-0">
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">A Note On Asking For Help</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Introducing Our TA</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:43</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Our Class Chat Room</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">07:48</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Why This Course?</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Download</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">2 pages</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Walkthrough</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">09:40</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Lecture Slides</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">00:03</span></li>
                                    </ul>
                                </div>

                                <h3 class="entry-title flex flex-wrap justify-content-between align-items-lg-center">
                                    <span class="arrow-r"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
                                    <span class="lecture-group-title">Intro to jQuery</span>
                                    <span class="number-of-lectures">9 Lectures</span>
                                    <span class="total-lectures-time">01:09</span>
                                </h3>

                                <div class="entry-content">
                                    <ul class="p-0 m-0">
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">A Note On Asking For Help</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Introducing Our TA</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:43</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Our Class Chat Room</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">07:48</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Why This Course?</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Download</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">2 pages</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Walkthrough</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">09:40</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Lecture Slides</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">00:03</span></li>
                                    </ul>
                                </div>

                                <h3 class="entry-title flex flex-wrap justify-content-between align-items-lg-center">
                                    <span class="arrow-r"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
                                    <span class="lecture-group-title">Advanced jQuery</span>
                                    <span class="number-of-lectures">5 Lectures</span>
                                    <span class="total-lectures-time">34:34</span>
                                </h3>

                                <div class="entry-content">
                                    <ul class="p-0 m-0">
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">A Note On Asking For Help</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Introducing Our TA</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:43</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Our Class Chat Room</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">07:48</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Why This Course?</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Download</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">2 pages</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Walkthrough</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">09:40</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Lecture Slides</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">00:03</span></li>
                                    </ul>
                                </div>

                                <h3 class="entry-title flex flex-wrap justify-content-between align-items-lg-center">
                                    <span class="arrow-r"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
                                    <span class="lecture-group-title">Data Associations</span>
                                    <span class="number-of-lectures">4 Lectures</span>
                                    <span class="total-lectures-time">38:07</span>
                                </h3>

                                <div class="entry-content">
                                    <ul class="p-0 m-0">
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">A Note On Asking For Help</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Introducing Our TA</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">01:43</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Our Class Chat Room</span><span class="lectures-preview"></span><span class="lectures-time text-left text-lg-right">07:48</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Why This Course?</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">01:39</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Download</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">2 pages</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Syllabus Walkthrough</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">09:40</span></li>
                                        <li class="flex flex-column flex-lg-row align-items-lg-center"><span class="lecture-title">Lecture Slides</span><span class="lectures-preview">Preview</span><span class="lectures-time text-left text-lg-right">00:03</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .entry-contents -->
                    </div><!-- .single-course-accordion-cont  -->

                    <div class="instructors-info">
                        <header class="entry-heading">
                            <h2 class="entry-title">Instructors</h2>
                        </header><!-- .entry-heading -->

                        <div class="instructor-short-info flex flex-wrap">
                            <div class="instructors-stats">
                                <img src="images/instructor.jpg" alt="">

                                <ul class="p-0 m-0 mt-3">
                                   <li><i class="fa fa-star"></i> 4.7 .7 Average rating</li>
                                    <li><i class="fa fa-comment"></i> 25,182 Reviews</li>
                                    <li><i class="fa fa-user"></i> 11,085 Students</li>
                                    <li><i class="fa fa-play-circle"></i> 2 Courses</li>
                                </ul>
                            </div><!-- .instructors-stats -->

                            <div class="instructors-details">
                                <div class="ratings flex align-items-center">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <span> (4 votes)</span>
                                </div><!-- .ratings -->

                                <h2 class="entry-title mt-3">The Unreal Engine Developer Course Learn C++ & Make Games</h2>

                                <div class="course-teacher mt-3">
                                    Teacher: <a href="#">Ms. Lara Croft</a>
                                </div><!-- .course-teacher -->

                                <div class="entry-content mt-3">
                                    <p>Hi! I'm Colt. I'm a developer with a serious love for teaching. I've spent the last few years teaching people to program at 2 different immersive bootcamps where I've helped hundreds of people become web developers and change their lives. My graduates work at companies like Google, Salesforce, and Square.</p>
                                </div><!-- .entry-content -->
                            </div><!-- .instructors-details -->
                        </div><!-- .instructor-short-info -->
                    </div><!-- .instructors-info -->

                    <div class="related-courses">
                        <header class="entry-heading flex flex-wrap justify-content-between align-items-center">
                            <h2 class="entry-title">Related Courses</h2>

                            <a href="#">View all</a>
                        </header><!-- .entry-heading -->

                        <div class="row mx-m-25">
                            <div class="col-12 col-lg-6 px-25">
                                <div class="course-content">
                                    <figure class="course-thumbnail">
                                        <a href="#"><img src="images/3.jpg" alt=""></a>
                                    </figure><!-- .course-thumbnail -->

                                    <div class="course-content-wrap">
                                        <header class="entry-header">
                                            <h2 class="entry-title"><a href="#">The Complete Digital Marketing Course</a></h2>

                                            <div class="entry-meta flex flex-wrap align-items-center">
                                                <div class="course-author"><a href="#">Ms. Lucius</a></div>

                                                <div class="course-date">Dec 18, 2018</div>
                                            </div><!-- .course-date -->
                                        </header><!-- .entry-header -->

                                        <footer class="entry-footer flex flex-wrap justify-content-between align-items-center">
                                            <div class="course-cost">
                                                $55 <span class="price-drop">$78</span>
                                            </div><!-- .course-cost -->

                                            <div class="course-ratings flex justify-content-end align-items-center">
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star-o"></span>

                                                <span class="course-ratings-count">(4 votes)</span>
                                            </div><!-- .course-ratings -->
                                        </footer><!-- .entry-footer -->
                                    </div><!-- .course-content-wrap -->
                                </div><!-- .course-content -->
                            </div><!-- .col -->

                            <div class="col-12 col-lg-6 px-25">
                                <div class="course-content">
                                    <figure class="course-thumbnail">
                                        <a href="#"><img src="images/2.jpg" alt=""></a>
                                    </figure><!-- .course-thumbnail -->

                                    <div class="course-content-wrap">
                                        <header class="entry-header">
                                            <h2 class="entry-title"><a href="#">The Ultimate Drawing Course Beginner to Advanced</a></h2>

                                            <div class="entry-meta flex flex-wrap align-items-center">
                                                <div class="course-author"><a href="#">Michelle Golden</a></div>

                                                <div class="course-date">Mar 14, 2018</div>
                                            </div><!-- .course-date -->
                                        </header><!-- .entry-header -->

                                        <footer class="entry-footer flex flex-wrap justify-content-between align-items-center">
                                            <div class="course-cost">
                                                <span class="free-cost">Free</span>
                                            </div><!-- .price-drop -->

                                            <div class="course-ratings flex justify-content-end align-items-center">
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star-o"></span>

                                                <span class="course-ratings-count">(4 votes)</span>
                                            </div><!-- .course-ratings -->
                                        </footer><!-- .entry-footer -->
                                    </div><!-- .course-content-wrap -->
                                </div><!-- .course-content -->
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .related-course -->
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

                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia dese mollit anim id est laborum. </p>

                            <p class="footer-copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </div><!-- .foot-about -->
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                        <div class="foot-contact">
                            <h2>Contact Us</h2>

                            <ul>
                                <li>Email: info.deertcreative@gmail.com</li>
                                <li>Phone: (+88) 111 555 666</li>
                                <li>Address: 40 Baria Sreet 133/2 NewYork City, US</li>
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