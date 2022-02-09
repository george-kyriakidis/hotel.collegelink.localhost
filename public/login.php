<?php

	require __DIR__ . '/../boot/boot.php';

	use Hotel\User;

	if(!empty(User::getCurrentUserId())) {
		header('Location: http://hotel.collegelink.localhost/public/index.php'); die;
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="/public/assets/css/styles.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
		<title>Hotels-LogIn</title>
	</head>
	<body>
		<!-- Login Form -->
		<section class="container">
			<form action="actions/login.php" class="form-container" method="post">
				<h2>Log In</h2>
				<label for="email">Email:</label>
				<input type="input" id="email" placeholder="Email Address" name="email"/>
				<div class="email-error error">Must be a valid email address!</div>
				<label for="password">Password:</label>
				<input
					type="password"
					id="password"
					placeholder="Password"
					name="password"
				/>
				<div class="password-error error">
				Must contain more than 8 characters!
				</div>
				<button id="login" type="submit" class="submit-btn" disabled="disabled" >LogIn</button>
				<div class="register-redirection">
					<p>Not a member? <a href="/public/register.php">Register now</a></p>
				</div>
			</form>
		</section>
		<!-- Footer -->
		<footer>&copy Collegelink 2021</footer>
		<!-- Scripts -->
		<script src="/public/assets/js/login.js"></script>
	</body>
</html>
