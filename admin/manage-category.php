<?php include('partials/menu.php'); ?>


<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br>
        <br>
        <?php
        if (isset($_SESSION['category_added'])) {
            echo $_SESSION['category_added'];
            unset($_SESSION['category_added']);
        }
        if (isset($_SESSION['image_remove_failed'])) {
            echo $_SESSION['image_remove_failed'];
            unset($_SESSION['image_remove_failed']);
        }
        if (isset($_SESSION['delete_category'])) {
            echo $_SESSION['delete_category'];
            unset($_SESSION['delete_category']);
        }
        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        if (isset($_SESSION['update_category'])) {
            echo $_SESSION['update_category'];
            unset($_SESSION['update_category']);
        }
        if (isset($_SESSION['image_upload_error'])) {
            echo $_SESSION['image_upload_error'];
            unset($_SESSION['image_upload_error']);
        }
        if (isset($_SESSION['image-removed-folder-failed'])) {
            echo $_SESSION['image-removed-folder-failed'];
            unset($_SESSION['image-removed-folder-failed']);
        }
        ?>
        <br><br>
        <!-- Button to Add Admin -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn btn-primary">Add Category</a>
        <br>
        <br>
        <br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php

            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn, $sql);
            $count =  mysqli_num_rows($res);
            if ($count > 0) {
                $sn = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php
                            if ($image_name !== "") { ?>
                                <img style="width: 100px;" src="<?php echo SITEURL . 'images/' . $image_name; ?>">
                            <?php } else {
                                echo '<div class="error">Image not Added.</div>';
                            }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>

                        <td>
                            <a href="<?php echo SITEURL . 'admin/update-category.php?id=' . $id; ?>" class="btn btn-secondary">Update</a>
                            <a href="<?php echo SITEURL . 'admin/delete-category.php?id=' . $id . '&image_name=' . $image_name; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>

                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6">
                        <div class="error">No Category Added.</div>
                    </td>
                </tr>
            <?php
            }
            ?>



        </table>
    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>