<?php

include('../config/constants.php');

if (isset($_GET['id']) and isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    if ($image_name != "") {
        $path = "../images/" . $image_name;
        $remove = unlink($path);

        if ($remove == false) {
            $_SESSION['image_remove_failed'] = "<div class='error'>Failed to Remove Category Image.<div>";
            header("Location:" . SITEURL . "admin/manage-category.php");
            die();
        }
    }
    $sql = "DELETE FROM tbl_category WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $_SESSION['delete_category'] = "<div class='success'>Category Deleted Successfully.<div>";
        header("Location:" . SITEURL . "admin/manage-category.php");
    } else {
        $_SESSION['delete_category'] = "<div class='error'>Failed To Delete Category<div>";
        header("Location:" . SITEURL . "admin/manage-category.php");
    }
} else {
    header('Location:' . SITEURL . 'amin/manage-category.php');
}
