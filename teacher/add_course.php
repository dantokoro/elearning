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

	<!-- Angular -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

	<!-- Jquery -->
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/mvc/5.2.3/jquery.validate.unobtrusive.min.js"></script>
	<script src="http://malsup.github.com/jquery.form.js"></script>



</head>


<!------ Include the above in your HEAD tag ---------->
<?php include '../admin/connect.php'; session_start(); ob_start(); $user_id=$_SESSION[ 'id']; ?>

<body>

	<div class="container emp-profile" ng-app="myApp" ng-controller="myController" style="margin-left: auto; margin-right: auto; padding-left: 450px;">
		<div class="row" style="margin-bottom: 40px;">
			<h1>
                    Create Course
                </h1>
		</div>
		<div class="row">
			<div class="tab-content profile-tab" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<div class="row" style="margin-bottom: 10px;">
						<div class="col-md-6">
							<label style="text-align: left;">Course Name:</label>
						</div>
						<div class="col-md-6">
							<input type="text" name="name" id="name" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px;" required>
						</div>
					</div>
					<div class="row" style="margin-bottom: 10px;">
						<div class="col-md-6">
							<label style="text-align: left;">Fee</label>
						</div>
						<div class="col-md-6">
							<input type="text" name="email" id="fee" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px;" required>
						</div>
					</div>
				</div>
				<script>
					var app = angular.module('myApp', []);
					app.controller('myController', function($scope, $http) {
						$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
						$scope.Cat = [];
						$scope.cid = 1;
						$scope.Arc = [];
						$scope.aid = 1;
						$scope.Des = [];
						$scope.did = 1;
						$scope.Req = [];
						$scope.rid = 1;

						$scope.addCategory = function() {
							$scope.Cat.push({
								Id: $scope.cid,
								Name: ""
							});
							$scope.cid += 1;
						};

						$scope.removeCategory = function() {
							$scope.Cat.pop();
						};

						$scope.addArchievement = function() {
							$scope.Arc.push({
								Id: $scope.aid,
								Name: ""
							});
							$scope.aid += 1;
						}

						$scope.removeArchievement = function() {
							$scope.Arc.pop();
						}

						$scope.addDescription = function() {
							$scope.Des.push({
								Id: $scope.cid,
								Name: ""
							});
							$scope.cid += 1;
						};

						$scope.removeDescription = function() {
							$scope.Des.pop();
						};

						$scope.addRequirement = function() {
							$scope.Req.push({
								Id: $scope.rid,
								Name: ""
							});
							$scope.rid += 1;
						};

						$scope.removeRequirement = function() {
							$scope.Req.pop();
						};

						$scope.save = function() {
							// necessary variables init
							$scope.data = []; // all data store in this array
							$scope.category = [];
							$scope.requirement = [];
							$scope.description = [];
							$scope.archievement = [];

							// assign values for variables
							$scope.data['name'] = document.getElementById("name").value;
							$scope.data['fee'] = document.getElementById("fee").value;
							var temp = document.getElementsByName("cat");
							for (var i = 0; i < temp.length; i++) {
								$scope.category.push(temp[i].value);
							}
							var temp = document.getElementsByName("req");
							for (var i = 0; i < temp.length; i++) {
								$scope.requirement.push(temp[i].value);
							}
							var temp = document.getElementsByName("des");
							for (var i = 0; i < temp.length; i++) {
								$scope.description.push(temp[i].value);
							}
							var temp = document.getElementsByName("arc");
							for (var i = 0; i < temp.length; i++) {
								$scope.archievement.push(temp[i].value);
							}



							/*
							console.log("message=" + $.param($scope.data));
							check if function running right
							*/
							// post request


							$http({
								url: 'add_course_info.php',
								method: "POST",
								data: {
									name: $scope.data['name'],
									fee: $scope.data['fee'],
									category: $scope.category.join("| "),
									archievement: $scope.archievement.join("| "),
									requirement: $scope.requirement.join("| "),
									description: $scope.description.join("| "),
								}
							}).then(function(response) {
								console.log(response);
								//uploadImage();
							});
						};
					});
				</script>

				<div class="row" style="margin-bottom: 10px;">
					<div class="col-md-6">
						<label style="text-align: left;">Categories: </label>
					</div>
					<div class="col-md-6">
						<div ng-repeat="cat in Cat">
							<div class="item">
								<input type="text" name="cat" id="category" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px; margin-bottom: 10px;" ng-model="cat.Name">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6" style="margin-bottom: 10px">
								<button type="button" class="btn btn-default btn-lg" ng-click="addCategory()" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-around; align-items: center; align-content: space-around;">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</button>
							</div>
							<div class="col-md-6" style="margin-bottom: 10px">
								<button type="button" class="btn btn-default btn-lg" ng-click="removeCategory()" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-around; align-items: center; align-content: space-around;">
									<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<!-- categories row -->
				<div class="row" style="margin-bottom: 10px;">
					<div class="col-md-6">
						<label style="text-align: left;">Archievement: </label>
					</div>
					<div class="col-md-6">
						<div ng-repeat="arc in Arc">
							<div class="item">
								<input type="text" name="arc" id="archievement" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px; margin-bottom: 10px;" ng-model="arc.Name">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6" style="margin-bottom: 10px">
								<button type="button" class="btn btn-default btn-lg" ng-click="addArchievement()" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-around; align-items: center; align-content: space-around;">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</button>
							</div>
							<div class="col-md-6" style="margin-bottom: 10px">
								<button type="button" class="btn btn-default btn-lg" ng-click="removeArchievement()" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-around; align-items: center; align-content: space-around;">
									<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<!-- archievement row -->
				<div class="row" style="margin-bottom: 10px;">
					<div class="col-md-6">
						<label style="text-align: left;">Description: </label>
					</div>
					<div class="col-md-6">
						<div ng-repeat="des in Des">
							<div class="item">
								<input type="text" name="des" id="description" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px; margin-bottom: 10px;" ng-model="des.Name">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6" style="margin-bottom: 10px">
								<button type="button" class="btn btn-default btn-lg" ng-click="addDescription()" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-around; align-items: center; align-content: space-around;">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</button>
							</div>
							<div class="col-md-6" style="margin-bottom: 10px">
								<button type="button" class="btn btn-default btn-lg" ng-click="removeDescription()" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-around; align-items: center; align-content: space-around;">
									<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<!-- description row -->
				<div class="row" style="margin-bottom: 10px;">
					<div class="col-md-6">
						<label style="text-align: left;">Requirement: </label>
					</div>
					<div class="col-md-6">
						<div ng-repeat="req in Req">
							<div class="item">
								<input type="text" name="req" id="description" style="border: 2px solid; border-radius: 20px; text-align:center; font-size:12px; margin-bottom: 10px;" ng-model="reg.Name">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6" style="margin-bottom: 10px">
								<button type="button" class="btn btn-default btn-lg" ng-click="addRequirement()" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-around; align-items: center; align-content: space-around;">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</button>
							</div>
							<div class="col-md-6" style="margin-bottom: 10px">
								<button type="button" class="btn btn-default btn-lg" ng-click="removeRequirement()" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-around; align-items: center; align-content: space-around;">
									<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<!-- description row -->

				<div class="row">
					<form class="form-horizontal" method="post" enctype="multipart/form-data" class="putImages" action="add_course_image.php">
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-6">
								<label style="text-align: left;">Cover: </label>
							</div>
							<div class="col-md-6">
								<input type="file" id="cover" name="cover" style="display: inline-block; font-size: 12px"/>
							</div>
						</div>
						<!-- cover img-->
						<br>
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-6">
								<label style="text-align: left;">Avatar: </label>
							</div>
							<div class="col-md-6">
								<input type="file" id="avatar" name="avatar" style="display: inline-block; font-size: 12px"/>
							</div>
						</div>
				<!-- avatar img-->
						<br>
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-6" style="margin: auto;">
								<button type="submit" name="save" class="btn submit_btn" ng-click="save()">Save</button>
							</div>
						</div>
					</form>
				</div>
		</div>
	</div>
	</div>
	<script type="text/javascript">

	</script>
</body>