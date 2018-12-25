<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php
		require('../login/db.php');
		require('../func.php');
		session_start();
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$query = '	SELECT * 
						FROM "Teacher" 
						WHERE teacher_id='.$id;
			$result = pg_query($con,$query) or die(pg_errormessage($con));
			$teacher = pg_fetch_assoc($result);					// info teacher 
			echo $teacher["name"];
		}else{
			echo "ADD GET['id']!!!";
		}
	?></title>
    <meta name="description" content="Creative CV is a HTML resume template for professionals. Built with Bootstrap 4, Now UI Kit and FontAwesome, this modern and responsive design template is perfect to showcase your portfolio, skils and experience."/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/aos.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/main.css" rel="stylesheet">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="../css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="../css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="../css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="../style.css">
  </head>
  <body id="top">
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
										if(isset($_SESSION['email']) && $_SESSION['email']){
											echo '<li><a>Hello ';
											$email=$_SESSION['email'];
											$query='SELECT * FROM "Student" WHERE email='.$email ;
											$result = pg_query($con,$query) or die(pg_errormessage($con));
											$info = pg_fetch_assoc($result);
											$mang_ho_ten= explode(" ", $info["name"]);
											$so_phan_tu = count($mang_ho_ten);
											$ten = $mang_ho_ten[$so_phan_tu-1];
											echo $ten;
											
											echo '</a></li>
													<li><a href="../login/logout.php">Logout </a></li>';											
										}													
										else{
											echo '<li><a href="../login/login2.php">Register/Login</a></li>';                                    
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
                                    <li class="current-menu-item"><a href="../index_login.php">Home</a></li>
                                    <li><a href="../about.php">About</a></li>
                                    <li><a href="../courses.php">Courses</a></li>
                                    <li><a href="../blog.php">Ask&ans</a></li>
                                    <li><a href="../contact.php">Contact</a></li>
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

        
    </div><!-- .hero-content -->
	
    <div class="page-content">
	<div class="profile-page">
	  <div class="wrapper">
		<div class="page-header page-header-small" filter-color="green">
		  <div class="page-header-image" data-parallax="true" style="background-image: url('images/cc-bg-1.jpg');"></div>
		  <div class="container">
			<div class="content-center">
			  <div class="cc-profile-image"><a href="<?php	echo $teacher["picture"];	?>"><img src="<?php	echo $teacher["picture"];	?>" alt="Image"/></a></div>
			  <div class="h2 title"><?php	echo $teacher["name"];	?></div>
			</div>
		  </div>
		  <div class="section">
			<div class="container">
			  <div class="button-container"><a class="btn btn-default btn-round btn-lg btn-icon" href="#" rel="tooltip" title="Follow me on Facebook"><i class="fa fa-facebook"></i></a><a class="btn btn-default btn-round btn-lg btn-icon" href="#" rel="tooltip" title="Follow me on Twitter"><i class="fa fa-twitter"></i></a><a class="btn btn-default btn-round btn-lg btn-icon" href="#" rel="tooltip" title="Follow me on Google+"><i class="fa fa-google-plus"></i></a><a class="btn btn-default btn-round btn-lg btn-icon" href="#" rel="tooltip" title="Follow me on Instagram"><i class="fa fa-instagram"></i></a></div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	<div class="section" id="about">
	  <div class="container">
		<div class="card" data-aos="fade-up" data-aos-offset="10">
		  <div class="row">
			<div class="col-lg-6 col-md-12">
			  <div class="card-body">
				<div class="h4 mt-0 title">About</div>
				
				<ul class="p-0 m-0 green-ticked">
						<?php
							$cer= explode(", ", $teacher["certificate"]);		//Chia thành các chứng chỉ riêng rẽ
							$cer_num = count($cer);
							for($i=0;$i<$cer_num;$i++){
								echo '<li>'.$cer[$i].'</li>';
							}
							
						?>	
                </ul>
						
			  </div>
			</div>
			<div class="col-lg-6 col-md-12">
			  <div class="card-body">
				<div class="h4 mt-0 title">Basic Information</div>
				<div class="row mt-3">
				  <div class="col-sm-4"><strong class="text-uppercase">Email:</strong></div>
				  <div class="col-sm-8"><?php	echo $teacher["email"];	?></div>
				</div>
				
				<div class="row mt-3">
				  <div class="col-sm-4"><strong class="text-uppercase">City:</strong></div>
				  <div class="col-sm-8"><?php	echo $teacher["address"];	?></div>
				</div>
				
				<div class="row mt-3">
				  <div class="col-sm-4"><strong class="text-uppercase">Students:</strong></div>
				  <div class="col-sm-8"><?php
					$query = '	SELECT COUNT (DISTINCT student_id)
								FROM "Enrolled"
								WHERE course_id IN(
										SELECT course_id
										FROM "AssignTeacher"
										WHERE teacher_id='.$id.')';
					$result = pg_query($con,$query) or die(pg_errormessage($con));
					$student_num = pg_fetch_assoc($result);
					echo $student_num["count"]; 					
				  ?></div>
				</div>
				
			  </div>
			</div>
		  </div>
		</div>
	  </div>
    </div>
	
	<div class="row">		<!-- In ra course cua teacher nay	-->
            <div class="col-12 col-lg-8">
                <div class="featured-courses courses-wrap">
                    <div class="row mx-m-25">
						<?php
							$limit=3;						// Số course được hiển thị trong 1 trang
							if(isset($_GET['page'])){
								$page=$_GET['page'];		// Trang hiện tại
								$start=($page-1)*$limit;	
							}
							else{
								$page=1;
								$start=0;
							}
							
							$query='SELECT course_id
									FROM "AssignTeacher"
									WHERE teacher_id='.$id.
									' LIMIT '.$limit.' OFFSET '.$start ;
							$result = pg_query($con,$query) or die(pg_errormessage($con));
							$quantity = pg_num_rows($result);
							if (pg_num_rows($result) > 0) {
								$i=0;
								while($i<$limit && $course = pg_fetch_assoc($result)) {			// Lấy thông tin khóa học
									print_teacher_course($course["course_id"]);
									$i++;
								}
							}
							
										
							
						?>
						
					</div><!-- .row -->
				</div><!-- .featured-courses -->		
				<div class="pagination flex flex-wrap justify-content-between align-items-center">
								<div class="col-12 col-lg-4 order-2 order-lg-1 mt-3 mt-lg-0">
									<ul class="flex flex-wrap align-items-center order-2 order-lg-1 p-0 m-0">
										<li class="active"><a href="teacher.php?page=1<?php echo "&id={$id}";	 ?>">1</a></li>
										<?php
											for($i=2;$i<=((int)($quantity/$limit)+1);$i++){
												echo '<li><a href="teacher.php?id='.$id.'&page='.$i.'">'.$i.'</a></li>';
											}
										?>
										<li><a href="teacher.php<?php
											echo '?page='.($page+1)."&id={$id}";	
										?>"><i class="fa fa-angle-right"></i></a></li>
									</ul>
								</div>
				</div><!-- .pagination -->
            </div><!-- .col -->
    </div><!-- .row -->

    </div>
    <script src="js/core/jquery.3.2.1.min.js"></script>
    <script src="js/core/popper.min.js"></script>
    <script src="js/core/bootstrap.min.js"></script>
    <script src="js/now-ui-kit.js?v=1.1.0"></script>
    <script src="js/aos.js"></script>
    <script src="scripts/main.js"></script>
  </body>
</html>