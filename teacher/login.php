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
	?>

	<script language="javascript" src="src/js/login.js"></script>

</body>
</html>