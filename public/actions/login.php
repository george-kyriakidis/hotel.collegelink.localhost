<?php

use Hotel\User;

//Boot application
require_once __DIR__ . '/../../boot/boot.php';

//Return to home page if not a post request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
    header('Location: /');

    return;
} 

//Verify User
$user = new User();
$user->verifyUser($_REQUEST['email'], $_REQUEST['password']);

        
//Retrieve user
$userInfo = $user->getByEmail($_REQUEST['email']);

//Generate Token
$token = $user->generateToken($userInfo['user_id']);

//Set Cookie
setcookie('user_token', $token, time() + (30 * 24 * 60 * 60), '/');

//Return to Home page
header('Location: http://hotel.collegelink.localhost/public/index.php');