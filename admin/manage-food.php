<?php include('partials/menu.php'); ?>


<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br>
        <br>
        <?php
        if (isset($_SESSION['img-remv-failed'])) {
            echo $_SESSION['img-remv-failed'];
            unset($_SESSION['img-remv-failed']);
        }
        if (isset($_SESSION['delete-food'])) {
            echo $_SESSION['delete-food'];
            unset($_SESSION['delete-food']);
        }
        if (isset($_SESSION['unathorized'])) {
            echo $_SESSION['unathorized'];
            unset($_SESSION['unathorized']);
        }
        if (isset($_SESSION['food-added'])) {
            echo $_SESSION['food-added'];
            unset($_SESSION['food-added']);
        }
        if (isset($_SESSION['no-food-found'])) {
            echo $_SESSION['no-food-found'];
            unset($_SESSION['no-food-found']);
        }

        if (isset($_SESSION['img_upload_failed'])) {
            echo $_SESSION['img_upload_failed'];
            unset($_SESSION['img_upload_failed']);
        }
        if (isset($_SESSION['img-remove-from-folder-failed'])) {
            echo $_SESSION['img-remove-from-folder-failed'];
            unset($_SESSION['img-remove-from-folder-failed']);
        }
        if (isset($_SESSION['food_updated'])) {
            echo $_SESSION['food_updated'];
            unset($_SESSION['food_updated']);
        }

        ?>
        <br><br>
        <!-- Button to Add Admin -->
        <a href="<?php echo SITEURL . 'admin/add-food.php'; ?>" class="btn btn-primary">Add Food</a>
        <br>
        <br>
        <br>



        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php

            $sql = "SELECT * FROM tbl_food";
            $res = mysqli_query($conn, $sql);
            $count =  mysqli_num_rows($res);
            $sn = 1;
            if ($count > 0) {
                $sn = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $price; ?></td>
                        <td>
                            <?php
                            if ($image_name == "") {
                                echo "<div class='error'>Image not Added.</div>";
                            } else { ?>
                                <img width="100px" src="<?php echo SITEURL . "images/" . $image_name; ?>">
                        </td>

                    <?php }
                    ?>
                    <td><?php echo $featured; ?></td>
                    <td><?php echo $active; ?></td>
                    <td>
                        <a href="<?php echo SITEURL . 'admin/update-food.php?id=' . $id; ?>" class="btn btn-secondary">Update</a>
                        <a href="<?php echo SITEURL . 'admin/delete-food.php?id=' . $id . '&image_name=' . $image_name; ?>" class="btn btn-danger">Delete</a>
                    </td>
                    </tr>
            <?php }
            } else {
                echo "<tr><td colspan='7' class='error'>Food not Added Yet.</td></tr>";
            } ?>
        </table>
    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>