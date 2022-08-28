<?php
$title = 'Home';
$url = $_SERVER['REQUEST_URI'];
$page = strtolower(str_replace('.php', '', end(explode("/", $url))));
$availablePages = ['login', 'registration', 'dashboard'];

if(isset($_SESSION['user_email']) && isset($_SESSION['user_code']) && $page != 'dashboard') {
    header('Location: ' . BASE_URL . 'views/dashboard.php');
} else if(!in_array($page, $availablePages)) {
    header('Location: ' . BASE_URL . 'views/registration.php');
}

switch ($page) {
    case 'login':
        $title = 'Login';
        break;
    
    case 'registration':
        $title = 'Registration';
        break;
    
    case 'dashboard':
        $title = 'Dashboard';
        break;
    
    default:
        break;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if($page === 'registration') {
        include(BASE_PATH . 'controllers/registration.php');
        $registrationObj = new Registration();
        $registrationObj->register($_POST);

        if($_SESSION['redirect']) {
            header('Location: ' . BASE_URL . 'views/login.php');
        }
    }

    if($page === 'login') {
        include(BASE_PATH . 'controllers/login.php');
        $loginObj = new Login();
        $loginObj->login($_POST);

        if($_SESSION['redirect'] && $_SESSION['user_code'] && $_SESSION['user_email']) {
            header('Location: ' . BASE_URL . 'views/dashboard.php');
        }
    }
}

// pages require login
$authPagesArr = ['dashboard'];

if(in_array($page, $authPagesArr)) {
    if(!isset($_SESSION['user_email']) && !isset($_SESSION['user_code'])) {
        header('Location: ' . BASE_URL . 'views/login.php');
    }
    include(BASE_PATH . 'models/user.php');
    $userObj = new User();
    $userDetails = $userObj->getUser();
}

?>
