<?php include('partials/menu.php'); ?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php

if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <!-- sql code for selecting categories -->

        <?php
        $sql = "SELECT * FROM tbl_category WHERE featured='yes' AND active='yes' LIMIT 3";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        // if category is found
        if ($count > 0) {
            // getting the result in associative array format
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>


                <a href="<?php echo SITEURL . 'category-foods.php?id=' . $id; ?>">
                    <div class="box-3 float-container">
                        <img src="<?php echo SITEURL . 'images/' . $image_name; ?>" class="img-responsive img-curve">

                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>

        <?php }
            // if no category is found
        } else {

            echo "<div class='error'>Category Not Addded.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <!-- sql code for selecting food -->

        <?php
        $sql2 = "SELECT * FROM tbl_food WHERE featured='yes' AND active='yes' LIMIT 6";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);
        // if food is found
        if ($count2 > 0) {
            // getting the result in associative array format
            while ($row = mysqli_fetch_assoc($res2)) {
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

            echo "<div class='error'>Food Not Addded.</div>";
        }
        ?>


        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="<?php echo SITEURL . 'foods.php'; ?>">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials/footer.php'); ?>