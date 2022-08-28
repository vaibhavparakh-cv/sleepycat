<?php

session_start();

// env variables
define('BASE_PATH', '/opt/lampp/htdocs/sleepycat/');
define('BASE_URL', 'http://localhost/sleepycat/');
define('INVALID_DETAILS', 'Please fill all details');
define('TRY_AGAIN', 'Something went wrong. Please try again');
define('USER_EXIST', 'User already exist. Please login');
define('USER_NOT_FOUND', 'User not found');

// setting redirection false
$_SESSION['redirect'] = false;

// check for login session
if(isset($_SESSION['user_login_created']) && (time() - $_SESSION['user_login_created']) > 3600) {
    unset($_SESSION['user_login']);
}

// route
include('requests/route.php');

// assets
include('includes/header.php');

// alert
if(isset($_SESSION['message'])) {
    include('includes/alert.php');
}

// footer
include('includes/footer.php');

if(!$_SESSION['redirect']) {
    unset($_SESSION['message']);
    unset($_SESSION['redirect']);
}

?>