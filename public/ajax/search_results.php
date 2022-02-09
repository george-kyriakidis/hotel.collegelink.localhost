<?php

require __DIR__ . '/../../boot/boot.php';

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
$countOfGuests = $_REQUEST['guests'];
$minAmount = $_REQUEST['min_amount'];
$maxAmount = $_REQUEST['max_amount'];

//Search for rooms
$allAvailableRooms = $room->searchRoom( new DateTime($checkInDate), new DateTime($checkOutDate), $selectedCity, $selectedTypeId, $countOfGuests, $minAmount, $maxAmount);

?>

<!-- List of results -->
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
            <p class="price">Per Night:<?php echo $availableRoom['price'] ;?>€</p>
            <p class="guests">Count of guests: <?php echo $availableRoom['count_of_guests'] ;?></p>
            <p class="type-room" >Type of Room: <?php echo $availableRoom['room_type'] ;?></p>
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
