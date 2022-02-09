<?php

require __DIR__ . '/../boot/boot.php';

use Hotel\Room;
use Hotel\RoomTypes;

//Initialize Room Service
$room = new Room();

//Get all cities
$cities = $room->getCities();
$guests = $room->getCountOfguests();

//Get room types
$type = new RoomTypes();
$allTypes = $type->getRoomTypes();

//Get page parameters
$selectedCity = $_REQUEST['city'];
$selectedTypeId = $_REQUEST['room_type'];
$checkInDate = $_REQUEST['check_in_date'];
$checkOutDate = $_REQUEST['check_out_date'];

//Search for rooms
$allAvailableRooms = $room->searchRoom( new DateTime($checkInDate), new DateTime($checkOutDate), $selectedCity, $selectedTypeId);

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
		<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
		<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
		<script src="/public/assets/js/search.js"></script>
		<title>Hotels-List</title>
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
		<!-- The container for aside and list results -->
		<div class="container">
			<!-- Aside filter -->
			<section class="aside">
				<form action="/public/list.php" name="searchForm" class="searchForm">
					<h3>FIND THE PERFECT HOTEL</h3>
					<select name="guests" id="guests">
						<option value="0" disabled selected>Count of Guests</option>
						<?php
							foreach ($guests as $guest) {
						?>
						<option value="<?php echo $guest; ?>"><?php echo $guest; ?></option>
						<?php	
							}
						?>
					</select>

					<select name="city" id="city">
						<option value="0" disabled selected>City</option>
						<?php
							foreach ($cities as $city) {
						?>
						<option <?php echo $selectedCity == $city ? 'selected="selected"' : ''; ?>value="<?php echo $city; ?>"><?php echo $city; ?></option>
						<?php	
							}
						?>
					</select>

					<select name="room_type" id="room_type">
						<option value="0" disabled selected>Room Type</option>
						<?php
							foreach ($allTypes as $roomType) {
						?>
						<option <?php echo $selectedTypeId == $roomType['type_id'] ? 'selected="selected"' : ''; ?>value="<?php echo $roomType['type_id']; ?>"><?php echo $roomType['title']; ?></option>
						<?php	
							}
						?>
					</select>
					<p>
						<input type="hidden" name="min_amount" id="min_amount" value="0"/>
    					<input type="hidden" name="max_amount" id="max_amount" value="5000"/>
						<input type="text" id="amount">
						<div id="slider-range"></div> 
					</p>
					<div class="dates">
						<input type="text" id="from" name="check_in_date" placeholder="Check-In Date" value="<?php echo $checkInDate; ?>"/>
						<input type="text" id="to" name="check_out_date" placeholder="Check-Out Date" value="<?php echo $checkOutDate; ?>"/>
					</div>
					<button type="submit" class="submit-btn submit">FIND HOTEL</button>
				</form>
			</section>
			<!-- List of results -->
			<div id="results-container">
				<section class="results">
					<h3 class="search-results">Search Results</h3>
					<?php
						foreach ($allAvailableRooms as $availableRoom) {
							
					?>
					<div class="list-results">
						<img src="/public/assets/images/rooms/<?php echo $availableRoom['photo_url'];?>" alt="room"> 
						<div class="result-item">
							<h3 class="item-title"><?php echo $availableRoom['name'];?></h3>
							<h4 class="item-area"><?php echo $availableRoom['city'];?> | <?php echo $availableRoom['area'] ;?></h4>
							<p class="item-description"><?php echo $availableRoom['description_short'];?></p>
							<a href="/public/room.php?room_id=<?php echo $availableRoom['room_id'] ;?>
									&check_in_date=<?php echo $checkInDate; ?>
									&check_out_date=<?php echo $checkOutDate; ?>" class="button">Go to Room Page</a>
						</div>
					</div>
					<div class="result-item-info">
						<p class="price">Per Night: <?php echo $availableRoom['price'] ;?>€</p>
						<p class="guests">Count of guests: <?php echo $availableRoom['count_of_guests'] ;?></p>
						<p class="type-room">Type of Room: <?php echo $availableRoom['room_type'] ;?></p>
					</div>
					<?php
						}
					?>
					<!-- Message for no Rooms -->
					<?php
						if (count($allAvailableRooms) == 0) {
					?>
					<h2>There are no rooms!!</h2>
					<?php
						}
					?>
					<hr>
				</section>
			</div>
		</div>
		<!-- Footer -->
		<footer>&copy Collegelink 2021</footer>
		<!-- Scripts -->

		<script src="/public/assets/js/app-jquery.js"></script>
	</body>
</html>