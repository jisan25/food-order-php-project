<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1> <br><br>

        <?php
        if (isset($_SESSION['food-added'])) {
            echo $_SESSION['food-added'];
            unset($_SESSION['food-added']);
        }

        if (isset($_SESSION['img_upload_failed'])) {
            echo $_SESSION['img_upload_failed'];
            unset($_SESSION['img_upload_failed']);
        }
        ?>
        <br><br>

        <!-- Add Category For Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Food Title">
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Food Description"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" placeholder="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title']; ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
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
                        <input type="radio" name="featured" value="yes"> Yes
                        <input type="radio" name="featured" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes"> Yes
                        <input type="radio" name="active" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add Category Form Ends -->
        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No";
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }


            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {
                    $tmp = explode('.', $image_name);
                    $file_extension = end($tmp);
                    $image_name = "food/food_" . rand(000, 999) . '.' . $file_extension;


                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/" . $image_name;
                    $upload = move_uploaded_file($source_path, $destination_path);
                    if ($upload == false) {
                        $_SESSION['img_upload_failed'] = "<div class='error'>Failed to Upload Image.</div>";
                        header("Location:" . SITEURL . "admin/add-food.php");
                        die();
                    }
                }
            } else {
                $image_name = "";
            }

            $sql2 = "INSERT INTO tbl_food SET 
            title='$title', description='$description', price=$price, image_name='$image_name', cat_id=$category, featured='$featured', active='$active'";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == true) {
                $_SESSION['food-added'] = "<div class='success'>Food Added Successfully.<div>";
                header("Location:" . SITEURL . "admin/manage-food.php");
            } else {
                $_SESSION['food-added'] = "<div class='success'>Failed to Add Food<div>";
                header("Location:" . SITEURL . "admin/add-food.php");
            }
        }

        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>