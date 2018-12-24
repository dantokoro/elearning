<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="login2.css" />
	
</head>
	<body>
	<?php
	require('db.php');
	session_start();
	// If form submitted, insert values into the database.
	if (isset($_POST['email'])){
	        // removes backslashes
		$email = stripslashes($_REQUEST['email']);
	        //escapes special characters in a string
		$email = pg_escape_literal($con,$email);
		$password = $_REQUEST['password'];
		//Checking is user existing in the database or not
		$query = 'SELECT * FROM "Student" WHERE email='.$email;
		$result = pg_query($con,$query) or die(pg_errormessage($con));
		$numofrows = pg_num_rows($result);
		$row = pg_fetch_assoc($result);
	
	        if($password == $row['password']){
		    	$_SESSION['email'] = $email;
	            // Redirect user to interface
		    	header("Location: ../index_login.php");
	        }else{
					echo "<div class='form'>
				<h3>Email/password is incorrect.</h3>
				<br/><p>Click here to <a href='login2.php'>Login</a></p></div>";
			}
			///////////////////////////////////////////////////////////
	    }elseif (isset($_REQUEST['email_s'])){
              // removes backslashes
      	$email_s = stripslashes($_REQUEST['email_s']);
		//escapes special characters in a string
      	$email_s = pg_escape_literal($con,$email_s); 
		
		$name_s = stripslashes($_REQUEST['name_s']);
        $name_s = pg_escape_literal($con,$name_s);
		
		$address_s = stripslashes($_REQUEST['address_s']);
        $address_s = pg_escape_literal($con,$address_s);
		
		$birthday = date('Y-m-d', strtotime($_REQUEST['birthday']));
		
        $password_s = stripslashes($_REQUEST['password_s']);
        $password_s = pg_escape_literal($con,$password_s);
		
      	$REpassword_s = stripslashes($_REQUEST['REpassword_s']);
      	$REpassword_s = pg_escape_literal($con,$REpassword_s);
		$chk = 'SELECT * FROM "Student" WHERE email = '.$email_s;
		$result = pg_query($con,$chk) or die(pg_errormessage($con));
		if (pg_num_rows($result) == 0){
				if( ($REpassword_s == $password_s) ){
					$info = "(".$name_s.", ".$email_s.", ".$password_s.", ".$address_s.", '".$birthday."', now(), 0)";
					$query = 'INSERT INTO "Student"(name, email, password, address, date_of_birth, create_at,buget) VALUES '. $info;
					$result = pg_query($con,$query);
					if($result){
						echo "<div class='form'>
					  <h3>You are registered successfully.</h3>
					  <p>Auto reloading <a href='login2.php'>page</a></p>";
					  header("refresh:2;url=login2.php");
					}
				 }else {
					echo "<div class='form'>
						  <h3>Password do not match</h3>
                      <br/>
                      <p>Auto reloading <a href='login2.php'>page</a></p>
                      </div>";
					header("refresh:3;url=login2.php");
              }
			}else{
				echo "<div class='form'>
						  <h3>Email has been registed!</h3>
                      <br/>
                      <p>Auto reloading <a href='login2.php'>page</a></p>
                      </div>";
					header("refresh:3;url=login2.php");
			}
        	
          }else{ 

		?>	
		
			<div class="form-structor">
	<form class = "signup" name="registration" action="" method="post">
		<h2 class="form-title" id="signup"><span>or</span>Sign up</h2>

		<div class="form-holder">
			<input type="text" name="email_s" class="input" placeholder="Email" required />
			<input type="text" name="name_s" class="input" placeholder="Name" required />
			<input type="text" name="address_s" class="input" placeholder="City" required />
			<input type="text" name ="birthday" class="input" placeholder="Birthday (mm/dd/yyyy)" id="datepicker" required />
			<input type="password" name="password_s" class="input" placeholder="Password" required />
			<input type="password" name="REpassword_s" class="input" placeholder="Enter your password again" required />
		</div>
		<button class="submit-btn">Sign up</button>
	</form>
	
	<form class = "login slide-up" action="" method="post" name="login">
		<div class="center">
			<h2 class="form-title" id="login"><span>or</span>Login</h2>
			<div class="form-holder">
				<input type="text" name="email" class="input" placeholder="Email" required />
				<input type="password" name="password" class="input" placeholder="Password" required />
			</div>
				<input type="submit" name="submit" class="submit-btn" value="Login" />

		</div>
	</form>
		</div>


		<?php 
		} 
	?>
	<script language="javascript" src="login2.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  <link rel="stylesheet" href="/resources/demos/style.css">
	  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	  <script>
	  $( function() {
		$( "#datepicker" ).datepicker();
	  } );
	  </script>	
</body>
</html>