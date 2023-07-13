<?php include('partials/menu.php'); ?>




<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        $sql = "SELECT * FROM tbl_category WHERE active='yes'";
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
                        <img src="<?php echo SITEURL . 'images/' . $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

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


<?php include('partials/footer.php'); ?>