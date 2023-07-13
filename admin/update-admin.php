<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php
        if (!isset($_GET['id']) || $_GET['id'] == NULL) {
            header('Location:' . SITEURL . 'admin/manage-admin.php');
        } else {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_admin WHERE id = $id";
            $res = mysqli_query($conn, $sql);
            if ($res == true) {
                $count = mysqli_num_rows($res);
                if ($count) {
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['id'];
                    $full_name = $row['fullname'];
                    $username = $row['username'];
                } else {
                    header("Location:" . SITEURL . "admin/manage-admin.php");
                }
            }
        }

        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update" class="btn btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $id =  $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    $sql = "UPDATE tbl_admin SET fullname = '$full_name', username = '$username' WHERE id = '$id'";

    $res = mysqli_query($conn, $sql);
    if ($res) {
        $_SESSION['admin-updated'] = '<div class="success">Admin Updated Successfully</div>';
        header("Location:" . SITEURL . "admin/manage-admin.php");
    } else {
        $_SESSION['admin-updated'] = '<div class="error">Failed to Update Admin.</div>';
        header("Location:" . SITEURL . "admin/manage-admin.php");
    }
}
?>

<?php include('partials/footer.php'); ?>