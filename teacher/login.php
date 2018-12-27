<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="src/css/login.css" />
</head>
	<body> 
	<?php
	require('../admin/connect.php');
	ob_start();
	session_start();
	unset($_SESSION['id']);
	unset($_SESSION['username']);

	?>
	

		
			<div class="form-structor">
	<form class = "signup" name="registration" action="" method="post">
		<h2 class="form-title" id="signup"><span>or</span>Sign up</h2>

		<div class="form-holder">
			<input type="text" name="name_s" class="input" placeholder="Your name" required />
			<input type="text" name="address_s" class="input" placeholder="Address" required />
			<input type="text" name="phone_s" class="input" placeholder="Phone" required />
			<input type="text" name="email_s" class="input" placeholder="Email" required />
			<input type="password" name="password_s" class="input" placeholder="Password" required />
			<input type="password" name="REpassword_s" class="input" placeholder="Enter your password again" required />
		</div>
		<div>
			<button class="submit-btn" name="sign_up">Sign up</button>
		</div>
	</form>
	
	<form class = "login slide-up" action="" method="post" name="login">
		<div class="center">
			<h2 class="form-title" id="login"><span>or</span>Login</h2>
			<div class="form-holder">
				<input type="text" name="email" class="input" placeholder="Email" required />
				<input type="password" name="password" class="input" placeholder="Password" required />
			</div>
			<div>
				<input type="submit" name="log_in" class="submit-btn" value="Login" />
			</div>
		</div>
	</form>
		</div>

	<?php
		// if login button clicked
		if(isset($_POST['log_in'])) {
			$username = $_POST['email'];
			$password = $_POST['password'];
			pg_escape_string($password);

			$table = '"Teacher"';
			$query = "SELECT * FROM $table WHERE email=$1 AND password=$2";
			pg_prepare($conn, "log_in", $query);
			$result = pg_execute($conn, "log_in", array($username, $password));

			$count = pg_num_rows($result);
			if($count > 0) {
				$row = pg_fetch_array($result);
				session_start();
				session_regenerate_id();
				$_SESSION['username'] = $row['name'];
				$_SESSION['id'] = $row['teacher_id'];

				header('Location: index.php');
				session_write_close();
			} else {
				session_write_close();
			}
		}
		if(isset($_POST['sign_up'])) {
			if($_POST['password_s'] == $_POST['REpassword_s']) {
				$name = $_POST['name_s'];
				$email = $_POST['email_s'];
				$password = $_POST['password_s'];
				$address = $_POST['address_s'];
				$phone = $_POST['phone_s'];
				$image = 'https://www.google.com/url?sa=i&source=images&cd=&cad=rja&uact=8&ved=2ahUKEwjStqfb47_fAhVD7mEKHYl6APkQjRx6BAgBEAU&url=http%3A%2F%2Ffutbolita.com%2Fabout-us%2Favatar-1577909_960_720%2F&psig=AOvVaw3LvZOftqSu2TBEoD3d-Upp&ust=1545992153958104';
				
				$last_id = pg_fetch_array(pg_query('SELECT MAX(teacher_id) FROM "Teacher"'));
				$last_teacher_id = $last_id['max'] + 1;
				$table = '"Teacher"';
				$query = "INSERT INTO $table(teacher_id ,name, phone, email, password, address, created_at, picture) VALUES ($1, $2, $3, $4, $5, $6, $7, $8)";
				pg_prepare($conn, "insert", $query);
				pg_execute($conn, "insert", array($last_teacher_id ,$name, $phone, $email, $password, $address, 'now()', $image));
			} else {
				echo '<script>alert("Password does not match"); </script>';
			}
		}
	?>

	<script language="javascript" src="src/js/login.js"></script>

</body>
</html>