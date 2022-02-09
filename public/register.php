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
		<title>Hotels-Register</title>
	</head>
	<body>
		<!-- Register Form -->
		<section class="container">
			<form action="./actions/register.php" class="form-container" method="post">
				<h2>Register</h2>
				<label for="full-name">Full Name:</label>
				<input
					type="input"
					id="full-name"
					placeholder="Full Name"
					name="name"
				/>
				<div class="full-name-error error">Full Name must contains only letters without spaces!</div>
				<label for="email">Email:</label>
				<input
					type="input"
					id="email"
					placeholder="Email Address"
					name="email"
				/>
				<div class="email-error error">
					Must be a valid email address!
				</div>
				<label for="second-email">Verify Email:</label>
				<input type="input" id="second-email" placeholder="Email Address" name="second-email"/>
				<div class="second-email-error error">
					Email is not the same with the first email!
				</div>
				<label for="password">Password:</label>
				<input
					type="password"
					id="password"
					name="password"
					placeholder="Password"
				/>
				<div class="password-error error">
					Must contain more than 8 characters!
				</div>
				<button id="register" type="submit" class="submit-btn" disabled="disabled" >Register</button>
			</form>
		</section>
		<!-- Footer -->
		<footer>&copy Collegelink 2021</footer>
		<!-- Scripts -->
		<script src="/public/assets/js/register.js"></script>
	</body>
</html>
