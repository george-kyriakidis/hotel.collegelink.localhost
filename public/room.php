<?php

require __DIR__ . '/../boot/boot.php';

use Hotel\Room;
use Hotel\Favorite;
use Hotel\User;
use Hotel\Review;
use Hotel\Booking;

//Initialize Room Service
$room = new Room();
$favorite = new Favorite();


//Check for room id
$roomId = $_REQUEST['room_id'];
if (empty($roomId)) {
    header('Location: index.php');
    
    return;
}

//Load room info
$roomInfo = $room->getRoom($roomId);
if (empty($roomInfo)) {
    header('Location: index.php');
    
    return;
}

//Get current user id
$userId = User::getCurrentUserId();

//Check if room is favorite for current user
$isFavorite = $favorite->isFavorite($roomId, $userId);

//Load all room reviews
$review = new Review();
$allReviews = $review->getReviewByRoom($roomId);

//Check for booking room
$checkInDate = $_REQUEST['check_in_date'];
$checkOutDate = $_REQUEST['check_out_date'];
$alreadyBooked = empty($checkInDate) || empty($checkOutDate);
if (!$alreadyBooked) {
    //Looking for bookings
    $booking = new Booking();
    $alreadyBooked = $booking->isBooked($roomId, $checkInDate, $checkOutDate);
}

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
        <!-- Scripts -->
		<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
		<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
		<script src="/public/assets/js/room.js"></script>
		<title>Hotels-<?php echo $roomInfo['name'] ;?></title>
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
        
        <div class="container-room">
            <section class="title">
                <h4><?php echo sprintf('%s - %s, %s', $roomInfo['name'], $roomInfo['city'], $roomInfo['area']); ?></h4>
                <div class="title-details">
                    <h4>REVIEWS</h4>
                    <?php 
                        $roomAvgReview = $roomInfo['avg_reviews'];
                        for ($i=1; $i <= 5; $i++) { 
                            if ($roomAvgReview >= $i) {
                            ?>
                                <span class="fa fa-star checked"></span>
                            <?php
                            } else {
                            ?>
                                <span class="fa fa-star"></span>
                            <?php
                            }           
                        }
                    ?>
                </div>
                <div class="title-details">
                    <form action="./actions/favorite.php" class="favoriteForm" name="favoriteForm" method="post" id="favoriteForm">
                        <input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
                        <input type="hidden" name="is_favorite" value="<?php echo $isFavorite ? '1' : '0'; ?>">
                        <button id="favorite-btn" type="submit"><i id="fav-btn" class="fa fa-heart <?php echo $isFavorite ? 'selected' : "";?>"></i></button>
                    </form>
                </div>
                <div class="title-details">
                    <p>Per Night: <?php echo $roomInfo['price'] ;?>€</p>
                </div>
            </section>
            <img src="/public/assets/images/rooms/<?php echo $roomInfo['photo_url'] ;?>" alt="room">
            <section class="details">
                <div class="list-details">
                    <i class="fa fa-user"><?php echo $roomInfo['count_of_guests'] ;?></i>
                    <p>Guests</p>
                </div>
                <div class="list-details">
                    <i class="fa fa-bed"></i>
                    <p><?php echo $roomInfo['room_type'] ;?></p>
                </div>
                <div class="list-details">
                    <i class="fa fa-parking"><?php echo $roomInfo['parking'] == 1 ? 'Yes' : 'No';?></i>
                    <p>Parking</p>
                </div>
                <div class="list-details">
                    <i class="fa fa-wifi"><?php echo $roomInfo['wifi'] == 1 ? 'Yes' : 'No';?></i>
                    <p>Wifi</p>
                </div>
                <div class="list-details">
                    <i class="fa fa-paw"><?php echo $roomInfo['pet_friendly'] == 1 ? 'Yes' : 'No';?></i>
                    <p>Pet Friendly</p>
                </div>
            </section>
            <section class="room-decription">
                <h4>Room Description</h4>
                <p><?php echo $roomInfo['description_long'] ;?></p>
            </section>

            <?php
                if ($alreadyBooked) {
                    
            ?>
            <button class="room-details-btn">Already Booked</button>
            <?php
                }else {
            ?>
            <form action="./actions/booking.php" method="post">
                <input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
                <input type="hidden" name="check_in_date" value="<?php echo $checkInDate; ?>">
                <input type="hidden" name="check_out_date" value="<?php echo $checkOutDate; ?>">
                <button type="sumbit" class="room-details-btn">Book Now</button>
            </form>
            <?php
                }
            ?>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12580.112011514222!2d23.7503565!3d37.9764758!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x96690683c8008e91!2zSGlsdG9uIM6RzrjOt869z47OvQ!5e0!3m2!1sel!2sgr!4v1640779513884!5m2!1sel!2sgr" 
                width="100%" height="350" loading="lazy"></iframe>
            <section class="room-reviews">
                <h4>Reviews</h4>
                <div id="room-reviews-container">
                    <?php
                        foreach ($allReviews as $review) {    
                    ?>
                    <div class="user-review">
                        <p><?php echo $review['user_name']; ?></p>
                        <?php 
                            for ($i=1; $i <= 5; $i++) { 
                                if ($review['rate'] >= $i) {
                                ?>
                                    <span class="fa fa-star checked"></span>
                                <?php
                                } else {
                                ?>
                                    <span class="fa fa-star"></span>
                                <?php
                                }           
                            }
                        ?>
                        <h5><?php echo $review['created_time']; ?></h5>
                        <p><?php echo htmlentities($review['comment']); ?></p>
                        <br>
                        <hr>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </section>
            <section class="add-review">
                <form action="/actions/review.php" name="reviewForm" class="reviewForm" method="post">
                <input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
                    <h4>Add Review</h4>
                    <label for="1"><i class="fa fa-star"></i></label>
                    <input type="radio" id="1" name="rate" value="1" class="fa fa-star"></input>
                    <label for="2"><i class="fa fa-star"></i></label>
                    <input type="radio" id="2" name="rate" value="2" class="fa fa-star"></input>
                    <label for="3"><i class="fa fa-star"></i></label>
                    <input type="radio" id="3" name="rate" value="3" class="fa fa-star"></input>
                    <label for="4"><i class="fa fa-star"></i></label>
                    <input type="radio" id="4" name="rate" value="4" class="fa fa-star"></input>
                    <label for="5"><i class="fa fa-star"></i></label>
                    <input type="radio" id="5" name="rate" value="5" class="fa fa-star"></input>
                    <textarea name="comment" id="comment" placeholder="Write your review..."></textarea>
                    <button id="review" type="submit" >Submit</button>
                </form>
            </section>
        </div>
        <!-- Footer -->
        <footer>&copy Collegelink 2021</footer>
    </body>
</html>