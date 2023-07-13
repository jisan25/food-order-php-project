<?php include('partials/menu.php'); ?>



<?php
if (isset($_GET['id'])) {
    $cat_id = $_GET['id'];
    $sql = "SELECT title FROM tbl_category WHERE id=$cat_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $category_title = $row['title'];
} else {
    header('Location:' . SITEURL);
}

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        $sql = "SELECT * FROM tbl_food WHERE cat_id=$cat_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        // if food is found
        if ($count > 0) {
            // getting the result in associative array format
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
        ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <img src="<?php echo SITEURL . 'images/' . $image_name; ?>" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL . 'order.php?id=' . $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

        <?php }

            // if no food is found

        } else {

            echo "<div class='error'>No Food Available in this category.</div>";
        }
        ?>




        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials/footer.php'); ?>