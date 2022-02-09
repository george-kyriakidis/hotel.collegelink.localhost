<?php

use Hotel\User;
use Hotel\Favorite;

//Boot application
require_once __DIR__ . '/../../boot/boot.php';

//Return to home page if not a post request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
    die;
} 

//If no user is logged in, return to main page
if (empty(User::getCurrentUserId())) {
    die;
}

//Check if room id is given
$roomId = $_REQUEST['room_id'];
if (empty($roomId)) {
    die;
}

//Set room to favorites
$favorite = new Favorite();

//Add or remove room from favorite
$isFavorite = $_REQUEST['is_favorite'];
if (!$isFavorite) {
    $status = $favorite->addFavorite(User::getCurrentUserId(), $roomId);
} else {
    $status = $favorite->removeFavorite(User::getCurrentUserId(), $roomId);
}

//Return to room page
header('Content-Type: application/json');
echo json_encode([
    'status' => $status,
    'is_favorite' => !$isFavorite,
]);