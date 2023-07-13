<?php
if (!isset($_SESSION['user'])) {
    $_SESSION['not-logged-in'] = "<div class='error text-center'>Please Login to access Admin Panel.<div>";
    header("Location:" . SITEURL . "admin/login.php");
}
