<?php

	require __DIR__ . '/../boot/boot.php';

	use Hotel\Favorite;
	use Hotel\Review;
	use Hotel\Booking;
	use Hotel\User;

	//Check for logged in user
	$userId = User::getCurrentUserId();
	if (empty($userId)) {
		header('Location: login.php');

		return;
	}

	//Get all favorites
	$favorite = new Favorite();
	$userFavorites = $favorite->getListByUser($userId);

	//Get all reviews
	$review = new Review();
	$userReviews = $review->getListByUser($userId);

	//Get all user Booking
	$booking = new Booking();
	$userBookings = $booking->getListByUser($userId);

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
		<title>Hotels-Profile</title>
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
					<li><button id="logOutBtn"><i class="fas fa-sign-out-alt"></i></button></li>
					</ul>
				</div>
			</nav>
		</section>
		<!-- The container for aside and list results -->
		<div class="container">
			<!-- Aside Bar -->
			<section class="aside-bar">
                <ul>
                    <li><h3>FAVORITES</h3>
						<?php
							if (count($userFavorites) > 0) {
						?>
                        <ol>
							<?php
								foreach ($userFavorites as $favorite) {
							?>		
                            <li><a href="/public/room.php?room_id=<?php echo $favorite['room_id']; ?>"><?php echo $favorite['name']; ?></a></li>
							<?php
								}
							?>
                        </ol>
						<?php
							}else{
						?>
						<h4>You don't have any favorite Hotel</h4>
						<?php
							}
						?>
                    </li>
                    <li><h3>REVIEWS</h3>
						<?php
							if (count($userReviews) > 0) {
						?>
							<ol>
								<?php
									foreach ($userReviews as $review) {
								?>
									<li><a href="/public/room.php?room_id=<?php echo $review['room_id']; ?>"><?php echo $review['name']; ?></a></li>
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
								<?php
									}
								?>
							</ol>
						<?php
							}else{
						?>
							<h4>You haven't made any review yet!!</h4>
						<?php
							}
						?>
                    </li>
                </ul>
			</section>
			<!-- List of results -->
			<section class="results">
				<h3 class="search-results">My Bookings</h3>
				<?php
					if (count($userBookings) > 0) {
				?>
					<?php
						foreach ($userBookings as $booking) {
					?>
						<div class="list-results">
							<img src="/public/assets/images/rooms/<?php echo $booking['photo_url'] ;?>" alt="room">
							<div class="result-item">
								<h3 class="item-title"><?php echo $booking['name'] ;?></h3>
								<h4 class="item-area"><?php echo $booking['city'];?> | <?php echo $booking['area'] ;?></h4>
								<p class="item-description"><?php echo $booking['description_short'];?></p>
								<a href="/public/room.php?room_id=<?php echo $booking['room_id']; ?>" class="button">Go to Room Page</a>
							</div>
						</div>
						<div class="result-item-info">
							<p class="total-price">Total Price: <?php echo $booking['total_price']; ?>€</p>
							<p class="check-in-date">CheckIn Date: <?php echo $booking['check_in_date']; ?></p>
							<p class="check-out-date">CheckOut Date: <?php echo $booking['check_out_date']; ?></p>
							<p class="type-room">Type of Room: <?php echo $booking['room_type']; ?></p>
						</div>
					<?php
						}
					?>
				<?php
					}else{
				?>
					<h4>You don't have any booking!!</h4>
				<?php
					}
				?>
			</section>
		</div>
		<!-- Footer -->
		<footer>&copy Collegelink 2021</footer>
		<!-- Scripts -->
		<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
		<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
		<script src="/public/assets/js/logout.js"></script>
	</body>
</html>