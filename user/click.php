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
<body class="about-page">
    
                                        <?php
										require('login/db.php');
										require('func.php');
										session_start();
										if(isset($_SESSION['email']) && $_SESSION['email'] && isset($_GET['id'])){
											$email=$_SESSION['email'];
											$id=$_GET['id'];
											$query='SELECT * FROM "Student" WHERE email='.$email ;
											$result = pg_query($con,$query) or die(pg_errormessage($con));
											$info = pg_fetch_assoc($result);		// Lấy thông tin user đang đăng nhập
											
											$query='SELECT * FROM "ClickRecord" WHERE student_id='.$info["student_id"].'AND course_id='.$id ;
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
                                   
    <script type='text/javascript' src='js/jquery.js'></script>
    <script type='text/javascript' src='js/swiper.min.js'></script>
    <script type='text/javascript' src='js/masonry.pkgd.min.js'></script>
    <script type='text/javascript' src='js/jquery.collapsible.min.js'></script>
    <script type='text/javascript' src='js/custom.js'></script>

</body>
</html>