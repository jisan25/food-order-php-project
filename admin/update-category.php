<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php
        $id = $_GET['id'];
        // redirect if id is not passed via url
        if (!$id) {
            header("Location:" . SITEURL . "admin/manage-category.php");
            die();
        }
        $sql = "SELECT * FROM tbl_category WHERE id = $id";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $count = mysqli_num_rows($res);
            if ($count) {
                $row = mysqli_fetch_assoc($res);
                $id = $row['id'];
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                $_SESSION['no-category-found'] = '<div class="error">Category Not Found</div>';
                header("Location:" . SITEURL . "admin/manage-category.php");
            }
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") { ?>
                            <img style="width: 200px;" src="<?php echo SITEURL . 'images/' . $current_image; ?>">
                        <?php
                        } else {
                            echo "<div class='error'>Image Not Added.</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="yes" <?php if ($featured == 'yes') {
                                                                            echo 'checked';
                                                                        } ?>> Yes
                        <input <?php if ($featured == 'no') {
                                    echo 'checked';
                                } ?> type="radio" name="featured" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == 'yes') {
                                    echo 'checked';
                                } ?> type="radio" name="active" value="yes"> Yes
                        <input <?php if ($active == 'no') {
                                    echo 'checked';
                                } ?> type="radio" name="active" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
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
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != "") {
            $ext = end(explode('.', $image_name));
            $image_name = "category/food_category_" . rand(000, 999) . '.' . $ext;


            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/" . $image_name;
            $upload = move_uploaded_file($source_path, $destination_path);
            if ($upload == false) {
                $_SESSION['image_upload_error'] = "<div class='error'>Failed to Upload Image.</div>";
                header("Location:" . SITEURL . "admin/manage-category.php");
                die();
            }
            if ($current_image != '') {
                $remove_path = "../images/" . $current_image;
                $remove = unlink($remove_path);
                if ($remove == false) {
                    $_SESSION['image-removed-folder-failed'] = "<div class='error'>Failed to remove current Image.</div>";
                    header("Location:" . SITEURL . "admin/manage-category.php");
                    die();
                }
            }
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }

    $sql2 = "UPDATE tbl_category SET title = '$title', featured = '$featured', active = '$active', image_name = '$image_name' WHERE id = '$id'";
    echo $sql;

    $res2 = mysqli_query($conn, $sql2);
    if ($res2 == true) {
        $_SESSION['update_category'] = '<div class="success">Category Updated Successfully</div>';
        header("Location:" . SITEURL . "admin/manage-category.php");
    } else {
        $_SESSION['update_category'] = '<div class="error">Failed to Update Category.</div>';
        header("Location:" . SITEURL . "admin/manage-category.php");
    }
}
?>

<?php include('partials/footer.php'); ?>