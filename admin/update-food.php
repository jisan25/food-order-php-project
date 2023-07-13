<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <?php
        $id = $_GET['id'];
        if (!$id) {
            header("Location:" . SITEURL . "admin/manage-food.php");
        }
        $sql = "SELECT * FROM tbl_food WHERE id = $id";
        $res = mysqli_query($conn, $sql);
        if ($res == true) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $current_image = $row['image_name'];
                $category_id = $row['cat_id'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                $_SESSION['no-food-found'] = '<div class="error">Food Not Found</div>';
                header("Location:" . SITEURL . "admin/manage-food.php");
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
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Food Description"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" placeholder="price" value="<?php echo $price; ?>">
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
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            $sql3 = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res3 = mysqli_query($conn, $sql3);
                            $count3 = mysqli_num_rows($res3);
                            if ($count3 > 0) {
                                while ($row = mysqli_fetch_assoc($res3)) {
                                    $cat_id = $row['id'];
                                    $cat_title = $row['title']; ?>
                                    <option <?php if ($category_id == $cat_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $cat_id; ?>"><?php echo $cat_title; ?></option>
                                <?php }
                            } else { ?>
                                <option value="0">No Category Found</option>
                            <?php

                            }

                            ?>
                        </select>
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
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $category_id = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != "") {
            $tmp = explode('.', $image_name);
            $ext = end($tmp);
            $image_name = "food/food_" . rand(000, 999) . '.' . $ext;


            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/" . $image_name;
            $upload = move_uploaded_file($source_path, $destination_path);
            if ($upload == false) {
                $_SESSION['img_upload_failed'] = "<div class='error'>Failed to Upload Image.</div>";
                header("Location:" . SITEURL . "admin/manage-food.php");
                die();
            }
            if ($current_image != '') {
                $remove_path = "../images/" . $current_image;
                $remove = unlink($remove_path);
                if ($remove == false) {
                    $_SESSION['img-remove-from-folder-failed'] = "<div class='error'>Failed to remove current Image.</div>";
                    header("Location:" . SITEURL . "admin/manage-food.php");
                    die();
                }
            }
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }

    $sql2 = "UPDATE tbl_food SET title = '$title', description = '$description', price = $price, cat_id = $category_id, featured = '$featured', 
    active = '$active', image_name = '$image_name' WHERE id = $id";

    $res2 = mysqli_query($conn, $sql2);
    if ($res2) {
        $_SESSION['food_updated'] = '<div class="success">Food Updated Successfully</div>';
        header("Location:" . SITEURL . "admin/manage-food.php");
    } else {
        $_SESSION['food_updated'] = '<div class="error">Failed to Update Food.</div>';
        header("Location:" . SITEURL . "admin/manage-food.php");
    }
}
?>

<?php include('partials/footer.php'); ?>