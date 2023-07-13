<?php
include('../config/constants.php');


if (!isset($_GET['id']) || $_GET['id'] == NULL) {
    header('Location:' . SITEURL . 'admin/manage-admin.php');
} else {
    $id = $_GET['id'];
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $_SESSION['admin-deleted'] = '<div class="success">Admin Deleted Successfully</div>';
        header('Location:' . SITEURL . 'admin/manage-admin.php');
    } else {
        $_SESSION['admin-deleted'] = '<div class="error">Failed to Delete Admin. Try Again Later</div>';
        header('Location:' . SITEURL . 'admin/manage-admin.php');
    }
}
