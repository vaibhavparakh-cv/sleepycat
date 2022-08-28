<?php

include('../index.php');
session_destroy();
header('Location: ' . BASE_URL . 'views/login.php');

?>