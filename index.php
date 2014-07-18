<?php
session_start();
require('new-connection.php');

?>
<!doctype html>
<html>
<head>
	<title>Greenbelt Exam</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
	<h1>Welcome to the Codingdojo Crime Watch!</h1>
	<h3>Hide your bikes, hide your flipflops, and eat some bacon</h3>
	<?php

	if(isset($_SESSION['errors']))
	{
		foreach ($_SESSION['errors'] as $error) {
			echo "<p class='text-danger'>{$error}</p>";
		}
		unset($_SESSION['errors']);
	}

	if(isset($_SESSION['success']))
	{
		echo "<p class='text-success'>{$_SESSION['success']}</p>";
	}
	unset($_SESSION['success']);

	?>
	<h4>Sign Up</h4>
	<form action="process.php" method="post">
		<input type="hidden" name="action" value="register">
		Name:<input type="text" name="first_name"/>
		Last Name:<input type="text" name="last_name"/>
		Email:<input type="text" name="email"/>
		Password:<input type="password" name="password"/>
		Confirm:<input type="password" name="confirm_password"/>
		<input type="submit" value="Register">
	</form>
	<h4>Sign In</h4>
		<form action="process.php" method="post">
			<input type="hidden" name="action" value="login">
			Email:<input type="email" name="email"/>
			Password:<input type="password" name="password"/>
			<input type="submit" value="Login">
		</form>	

</body>
</html>