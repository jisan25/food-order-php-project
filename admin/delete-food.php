<?php

include('../config/constants.php');

if (isset($_GET['id']) and isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    if ($image_name != "") {
        $path = "../images/" . $image_name;
        $remove = unlink($path);

        if ($remove == false) {
            $_SESSION['img-remv-failed'] = "<div class='error'>Failed to Remove Food Image.<div>";
            header("Location:" . SITEURL . "admin/manage-food.php");
            die();
        }
    }
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $_SESSION['delete-food'] = "<div class='success'>Food Deleted Successfully.<div>";
        header("Location:" . SITEURL . "admin/manage-food.php");
    } else {
        $_SESSION['delete-food'] = "<div class='error'>Failed To Delete Food<div>";
        header("Location:" . SITEURL . "admin/manage-food.php");
    }
} else {
    $_SESSION['unathorized'] = "<div class='error'>Unathorized Access.<div>";
    header('Location:' . SITEURL . 'amin/manage-food.php');
}
