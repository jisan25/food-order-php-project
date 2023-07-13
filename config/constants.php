<?php

session_start();

define('SITEURL', 'http://localhost/wd_2023/july/php_projects/food-order2/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order2');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
