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
            <div class="col-md-6">
                <div class="profile-head">
                            <h5>
                                <?php echo 'Checkout'; ?>
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
                    <!--<ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>
                    </ul>-->
                </div>
            </div>
            <div class="col-md-6">
            <?php
            if(isset($_GET['id'])){
                $id=$_GET['id'];
                $sid=$info['student_id'];
                $table = '"Course"';
                $query="SELECT * FROM {$table} WHERE course_id = $id";
                $result=pg_query($con,$query) or die(pg_errormessage($con));
                $cinfo = pg_fetch_assoc($result);
                $tprice = $cinfo["price"]*(100-$cinfo["discount"])*0.01;
                $table = '"Enrolled"';
                $query="SELECT * FROM {$table} WHERE student_id = $sid AND course_id = $id";
                $result= pg_query($con,$query) or die(pg_errormessage($con));
                if (pg_num_rows($result) > 0) {
                    echo '<p>You have already enrolled in this course</p>';
                    echo '<a class="btn" href="single-courses.php?id='.$id.'">BACK</a>';
                }
                else {
                    
                    if($info['buget']<$tprice){
                        echo '<p>Your balance is not enough</p>';
                        echo '<a class="btn" href="single-courses.php?id='.$id.'">BACK</a>';
                    }
                    else{
                        echo '<button type="button" class="btn submit_btn" ng-click="save()">Confirm</button>';
                        echo '<a class="btn" href="single-courses.php?id='.$id.'">BACK</a>';
                    }
                }
            }

                
                ?>         
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-md-6">
                                        <label style="text-align: left;">Current balance</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p id="cbalance"> <?php echo $info['buget']; ?>$ </p>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 10px;">
                                    <?php
                                    require 'func.php';
                                    print_course($id);
                                    ?>
                                </div>
                                <div class="row" style="margin-bottom: 10px;">
                                <?php
                                if($info['buget']>=$tprice){
                                    $abalance=$info['buget']-$tprice;
                                    echo '<div class="col-md-6">
                                        <label style="text-align: left;">Balance after purchase</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p> '.$abalance.'$</p>
                                        <input type="hidden" name="abalance" id="abalance" value="'.$abalance.'" >
                                        <input type="hidden" name="course_id" id="course_id" value="'.$id.'" >
                                        <input type="hidden" name="student_id" id="student_id" value="'.$sid.'" >
                                    </div>';
                                }
                                ?>
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
                                    
                                    $scope.data['abalance'] = document.getElementById("abalance").value;
                                    $scope.data['course_id'] = document.getElementById("course_id").value;
                                    $scope.data['student_id'] = document.getElementById("student_id").value;
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
                                        url: 'confirm_checkout.php',
                                        method: "POST",
                                        data: {
                                            abalance: $scope.data['abalance'],
                                            course_id:  $scope.data['course_id'],
                                            student_id: $scope.data['student_id']
                                        }
                                    }) .then(function(response){
                                        console.log(response);
                                        alert("Purchase successful");
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

                                <!--<div class="row">
                                <div class="col-md-6">
                                        <label>Total Courses</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <?php 
                                                /*$table = '"Enrolled"';
                                                $infos = $info['student_id'];
                                                $query = "SELECT count(*) FROM {$table} WHERE student_id = $infos";
                                                $result = pg_query($con,$query) or die(pg_errormessage($con));
                                                $info = pg_fetch_array($result);
                                                
                                                echo $info['count'];*/
                                            ?>
                                        </p>
                                    </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
</div>

</body>
