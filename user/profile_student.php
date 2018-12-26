<!DOCTYPE html>
<html lang="en">
<head>
    <title>DABAKI ACADEMY</title>
	
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="style.css">
    
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/mvc/5.2.3/jquery.validate.unobtrusive.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>

    <!-- Angular -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

</head>


<!------ Include the above in your HEAD tag ---------->
<?php
    require 'login/db.php';
    session_start();
    ob_start();
    if(isset($_SESSION['email']) && $_SESSION['email']){
        $email = $_SESSION['email'];
        // retrieve teacher infomation
        $table = '"Student"';
        $query = "SELECT * FROM {$table} WHERE email = $email";
        $result = pg_query($con,$query) or die(pg_errormessage($con));
        $info = pg_fetch_array($result);
    }
?>
<body>

<div class="container emp-profile" ng-app="cerApp" ng-controller="cerController">
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="row"  style="height:200px;">
            <!--<div class="col-md-4">
                <div class="profile-img">
                    <?php/* echo '<img id="pic" src="'.$info['picture'].'" alt=""/>' */?>
                    <div class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" name="file"/>
                    </div>
                </div>
            </div>-->
            <div class="col-md-10">
                <div class="profile-head">
                            <h5>
                                <?php echo $info['name']; ?>
                            </h5>
                            <!--<p class="proile-rating">RANKINGS : 
                                <?php 
                                    /*$table = array('"Vote"', '"AssignTeacher"');
                                    $query = "SELECT AVG(rate) FROM {$table[0]} WHERE course_id IN (SELECT course_id FROM {$table[1]} WHERE teacher_id = $1)";
                                    pg_prepare($conn, "ranking", $query);
                                    $result = pg_execute($conn, "ranking", array($user_id));
                                    $rank = pg_fetch_array($result);
                                    if($rank['avg'] == 0) {
                                        echo '<span>Unranked now</span>';
                                    } else {
                                        echo '<span>'. round($rank['avg']) .'5</span></p>';
                                    }*/
                                ?>-->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn submit_btn" ng-click="save()">Save</button>
                <a class="btn" href="index_login.php">BACK</a>         
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-md-6">
                                        <label style="text-align: left;">User Id</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p id="student_id"> <?php echo $info['student_id']; ?> </p>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-md-6">
                                        <label style="text-align: left;">Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="name" id="name" value="<?php echo $info['name']; ?>" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px;" required>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-md-6">
                                        <label style="text-align: left;">Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="email" id="email" value="<?php echo $info['email']; ?>" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px;" required>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-md-6">
                                        <label style="text-align: left;">Password</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="password" id="password" value="<?php echo $info['password'];?>" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px;" required>
                                    </div>
                                </div>
                                <!--<div class="row" style="margin-bottom: 10px;">
                                    <div class="col-md-6">
                                        <label style="text-align: left;">Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="phone" id="phone" value="<?php /*echo $info['phone'];*/?>" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px;" required>
                                    </div>
                                </div>-->
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-md-6">
                                        <label style="text-align: left;">Address</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="address" id="address" value="<?php echo $info['address'];?>" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px;" required>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-md-6">
                                        <label style="text-align: left;">DOB</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="DOB" id="DOB" value="<?php echo $info['date_of_birth'];?>" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px;" required>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-md-6">
                                        <label style="text-align: left;">Balance($)</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="balance" id="balance" value="<?php echo $info['buget'];?>" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px;" required>
                                    </div>
                                </div>
                    </div>
                    <script>
                        var app = angular.module('cerApp', []);
                            app.controller('cerController', function($scope, $http) {
                                $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
                                /*$scope.Cers = [];
                                $scope.addElement = function() {
                                    $scope.Cers.push({
                                        Id: $scope.id,
                                        Name: ""
                                    });
                                    $scope.id+=1;
                                };
                                $scope.removeElement = function() {
                                    $scope.Cers.pop();
                                };*/
                                
                                $scope.save = function() {
                                    $scope.data = {};
                                    /*$scope.certificates = [];*/
                                    
                                    $scope.data['name'] = document.getElementById("name").value;
                                    $scope.data['email'] = document.getElementById("email").value;
                                    $scope.data['password'] = document.getElementById("password").value;
                                    $scope.data['address'] = document.getElementById("address").value;
                                    $scope.data['DOB'] = document.getElementById("DOB").value;
                                    $scope.data['balance'] = document.getElementById("balance").value;
                                    /*var temp = document.getElementsByName("certificate");
                                    for(var i = 0; i < temp.length; i++) {
                                        $scope.certificates.push(temp[i].value);
                                    }                            
                                                                    
                                    $scope.data['certificates'] = $scope.certificates.join(", ");*/
                                    
                                    /*
                                    console.log("message=" + $.param($scope.data));
                                    check if function running right
                                    */
                                    // post request
                                    
                                    
                                    $http({
                                        url: 'edit_profile_student.php',
                                        method: "POST",
                                        data: {
                                            name: $scope.data['name'],
                                            email:  $scope.data['email'],
                                            password: $scope.data['password'],
                                            address: $scope.data['address'],
                                            DOB: $scope.data['DOB'],
                                            balance: $scope.data['balance']
                                        }
                                    }) .then(function(response){
                                        console.log(response);
                                        alert("Edit successful");
                                    });
                                };
                            });
                    </script>

                                <!--<div class="row">
                                    <div class="col-md-6">
                                        <label style="text-align: left;">Certificates</label>
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                            /*$certificates = explode(",", $info['certificate']);
                                            if(is_array($certificates) || is_object($certificates)) {
                                                foreach($certificates as $key => $value) {
                                                    echo '<input type="text" name="certificate" id="certificate" value="' . $value . '" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px; margin-bottom: 10px;" required><br>';
                                                }
                                            }*/
                                        ?>
                                        <div ng-repeat="cer in Cers">
                                            <div class="item">
                                                <input type="text" name="certificate" id="certificate" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px; margin-bottom: 10px;" ng-model="cer.Name">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3" style="margin-bottom: 10px">
                                                <button type="button" class="btn btn-default btn-lg" ng-click="addElement()" style="width:50px; height:40px; position:relative; width:90px;">
                                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                                </button>
                                        </div>
                                        <div class="col-md-3" style="margin-bottom: 10px">
                                            <button type="button" class="btn btn-default btn-lg" ng-click="removeElement()" style="width:50px; height:40px; margin:auto; width:90px;">
                                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                        </div>
                                    </div>
                                </div>-->

                                <div class="row">
                                <div class="col-md-6">
                                        <label>Total Courses</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <?php 
                                                $table = '"Enrolled"';
                                                $infos = $info['student_id'];
                                                $query = "SELECT count(*) FROM {$table} WHERE student_id = $infos";
                                                $result = pg_query($con,$query) or die(pg_errormessage($con));
                                                $info = pg_fetch_array($result);
                                                
                                                echo $info['count'];
                                            ?>
                                        </p>
                                    </div>
                        </div>
                        <div class="row">		<!-- In ra course cua student nay nay	-->
            <div class="col-12 col-lg-8">
                <div class="featured-courses courses-wrap">
                    <div class="row mx-m-25">
                        <?php
                            require 'func.php';
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
									FROM "Enrolled"
									WHERE student_id='.$infos.
									' LIMIT '.$limit.' OFFSET '.$start ;
							$result = pg_query($con,$query) or die(pg_errormessage($con));
							$quantity = pg_num_rows($result);
							if (pg_num_rows($result) > 0) {
								$i=0;
								while($i<$limit && $course = pg_fetch_assoc($result)) {			// Lấy thông tin khóa học
									print_course($course["course_id"]);
									$i++;
								}
							}
							
										
							
						?>
						
					</div><!-- .row -->
				</div><!-- .featured-courses -->		
				<div class="pagination flex flex-wrap justify-content-between align-items-center">
								<div class="col-12 col-lg-4 order-2 order-lg-1 mt-3 mt-lg-0">
									<ul class="flex flex-wrap align-items-center order-2 order-lg-1 p-0 m-0">
										<li class="active"><a href="profile_student?page=1">1</a></li>
										<?php
											for($i=2;$i<=((int)($quantity/$limit)+1);$i++){
												echo '<li><a href="profile_student?page='.$i.'">'.$i.'</a></li>';
											}
										?>
										<li><a href="profile_student.php<?php
											echo '?page='.($page+1);	
										?>"><i class="fa fa-angle-right"></i></a></li>
									</ul>
								</div>
				</div><!-- .pagination -->
            </div><!-- .col -->
    </div><!-- .row -->
                    </div>
                </div>
            </div>
        </div>
</div>
</body>
