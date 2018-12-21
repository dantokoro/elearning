<!DOCTYPE html>
<html lang="en">
<head>
    <title>DABAKI ACADEMY</title>
	
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="src/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="src/css/font-awesome.min.css">

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="src/css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="src/css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="src/css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="src/css/profile.css">
    
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Angular -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
-->
</head>


<!------ Include the above in your HEAD tag ---------->
<?php
    include '../admin/connect.php';
    session_start();
    ob_start();
    
    $user_id = $_SESSION['id'];

    // retrieve teacher infomation
    $table = '"Teacher"';
    $query = "SELECT * FROM {$table} WHERE teacher_id = $1";
    pg_prepare($conn, "get_info", $query);
    $result = pg_execute($conn, "get_info", array($user_id));
    $info = pg_fetch_array($result);
?>

<body>
<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <?php echo '<img src="'.$info['picture'].'" alt=""/>' ?>
                    <div class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" name="file"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                            <h5>
                                <?php echo $info['name']; ?>
                            </h5>
                            <p class="proile-rating">RANKINGS : 
                                <?php 
                                    $table = array('"Vote"', '"AssignTeacher"');
                                    $query = "SELECT AVG(rate) FROM {$table[0]} WHERE course_id IN (SELECT course_id FROM {$table[1]} WHERE teacher_id = $1)";
                                    pg_prepare($conn, "ranking", $query);
                                    $result = pg_execute($conn, "ranking", array($user_id));
                                    $rank = pg_fetch_array($result);

                                    if($rank['avg'] == 0) {
                                        echo '<span>Dont have rank now</span>';
                                    } else {
                                        echo '<span>'. round($rank['avg']) .'5</span></p>';
                                    }
                                ?>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work">
                    <p>WORK LINK</p>
                    <p>SKILLS</p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6" style="padding: 10px;">
                                        <label>User Id</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p> <?php echo $info['teacher_id']; ?> </p>
                                    </div>
                                </div>
                                <div class="row" style="padding: 10px;">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="name" value="<?php echo $info['name']; ?>" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px;" required>
                                    </div>
                                </div>
                                <div class="row" style="padding: 10px;">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="name" value="<?php echo $info['email']; ?>" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px;" required>
                                    </div>
                                </div>
                                <div class="row" style="padding: 10px;">
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="name" value="<?php echo $info['phone'];?>" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px;" required>
                                    </div>
                                </div>
                                <div class="row" style="padding: 10px;">
                                    <div class="col-md-6">
                                        <label>Address</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="name" value="<?php echo $info['address'];?>" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px;" required>
                                    </div>
                                </div>
                    </div>
                    <script>
                        var app = angular.module('cerApp', []);
                            app.controller('cerController', function($scope) {
                                $scope.Cers = [];
                                $scope.addElement = function() {
                                    $scope.Cers.push({
                                        Id: $scope.id,
                                        Name: ""
                                    });
                                    $scope.id+=1;
                                };
                            });
                    </script>

                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Certificates</label>
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                            $certificates = explode(",", $info['certificate']);
                                            if(is_array($certificates) || is_object($certificates)) {
                                                foreach($certificates as $key => $value) {
                                                    echo '<input type="text" name="name" value="' . $value . '" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px; margin-bottom: 10px;" required><br>';
                                                }
                                            }
                                        ?>
                                        <div ng-repeat="cer in Cers">
                                            <div class="item">
                                                <input type="text" name="name" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px; margin-bottom: 10px;">
                                            </div>
                                        </div>
                                        <div style="margin-bottom: 10px">
                                            <button ng-click="addElement()">+</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Total Courses</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <?php 
                                                $table = '"AssignTeacher"';
                                                $query = "SELECT count(*) FROM {$table} WHERE teacher_id=$1";
                                                pg_prepare($conn, "course_num", $query);
                                                $result = pg_execute($conn, "course_num", array($user_id));
                                                $info = pg_fetch_array($result);
                                                
                                                echo $info['count'];
                                            ?>
                                        </p>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>           
</div>

</body>