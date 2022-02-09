<?php

require __DIR__ . '/../boot/boot.php';

use Hotel\Room;
use Hotel\RoomTypes;

//Get cities
$room = new Room();
$cities = $room->getCities();

//Get room types
$type = new RoomTypes();
$allTypes = $type->getRoomTypes();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="/public/assets/css/styles.css" />
		<link
			rel="stylesheet"
			href="/public/assets/css/fontawesome-free-5.15.4-web/fontawesome-free-5.15.4-web/css/all.min.css"
		/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
		<link
			rel="stylesheet"
			href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css"
		/>

		<style>
			body {
				background-image: url(/public/assets/images/background.jpg);
				background-repeat: no-repeat;
				background-attachment: fixed;
				background-size: cover;
			}

			nav {
				box-shadow: none;
			}
		</style>
		<title>Hotels-Home</title>
	</head>
	<body>
	<!-- Header -->
		<section class="header">
			<nav>
				<a href="/public/index.php">Hotels</a>
				<div class="nav-links">
					<ul>
					<li><a href="/public/index.php"><i class="fas fa-home"></i><span>Home</span></a></li>
					<li><a href="/public/profile.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
					</ul>
				</div>
			</nav>
		</section>
		<!-- Form -->
		<section class="container">
			<form action="/public/list.php" class="form-container">
				<select name="city" id="city">
					<option value="0" disabled selected>City</option>
					<?php
						foreach ($cities as $city) {
					?>
						<option value="<?php echo $city; ?>"><?php echo $city; ?></option>
					<?php	
						}
					?>
				</select>
				<div class="city-value-error error">Must choose a city!</div>
				<select name="room_type" id="room_type">
					<option value="0" disabled selected>Room Type</option>
					<?php
						foreach ($allTypes as $roomType) {
					?>
						<option value="<?php echo $roomType['type_id']; ?>"><?php echo $roomType['title']; ?></option>
					<?php	
						}
					?>
				</select>
				<div class="dates">
					<input
						type="text"
						id="from"
						name="check_in_date"
						placeholder="Check-In Date"
					/>
					<div class="check-in-date-error error">Must be a valid check in date!</div>
					<input type="text" id="to" name="check_out_date" placeholder="Check-Out Date" />
					<div class="check-out-date-error error">Must be a valid check out date!</div>
				</div>
				<button type="submit" class="submit-btn" disabled="disabled">Search</button>
			</form>
		</section>
		<!-- Footer -->
		<footer>&copy Collegelink 2021</footer>
		<!-- Scripts -->
		<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
		<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
		<script src="/public/assets/js/app-jquery.js"></script>
	</body>
</html>
