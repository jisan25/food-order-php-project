<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1> <br><br>

        <?php
        if (isset($_SESSION['category_added'])) {
            echo $_SESSION['category_added'];
            unset($_SESSION['category_added']);
        }

        if (isset($_SESSION['upload_error'])) {
            echo $_SESSION['upload_error'];
            unset($_SESSION['upload_error']);
        }
        ?>
        <br><br>

        <!-- add category form starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add Category Form Ends -->
        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
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
                    $ext = end(explode('.', $image_name));
                    $image_name = "category/food_category_" . rand(000, 999) . '.' . $ext;


                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/" . $image_name;
                    $upload = move_uploaded_file($source_path, $destination_path);
                    if ($upload == false) {
                        $_SESSION['upload_error'] = "<div class='error'>Failed to Upload Image.</div>";
                        header("Location:" . SITEURL . "admin/add-category.php");
                        die();
                    }
                }
            } else {
                $image_name = "";
            }

            $sql = "INSERT INTO tbl_category SET 
            title='$title', image_name='$image_name', featured='$featured', active='$active'";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                $_SESSION['category_added'] = "<div class='success'>Category Added Successfully.<div>";
                header("Location:" . SITEURL . "admin/manage-category.php");
            } else {
                $_SESSION['category_added'] = "<div class='success'>Failed to Add Category<div>";
                header("Location:" . SITEURL . "admin/add-category.php");
            }
        }

        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>