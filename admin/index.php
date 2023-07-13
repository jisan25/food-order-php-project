<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <br><br>

        <?php
        // if (isset($_SESSION['login'])) {
        //     echo $_SESSION['login'];
        //     unset($_SESSION['login']);
        // }
        ?>
        <br><br>
        <div class="col-4 text-center">
            <?php
            // query for total categories
            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn, $sql);
            $total_categories = mysqli_num_rows($res);
            ?>
            <h1><?php echo $total_categories; ?></h1><br>
            Categories
        </div>
        <div class="col-4 text-center">
            <?php
            $sql2 = "SELECT * FROM tbl_food";
            $res2 = mysqli_query($conn, $sql2);
            $total_foods = mysqli_num_rows($res2);
            ?>
            <h1><?php echo $total_foods; ?></h1><br>
            Foods
        </div>
        <div class="col-4 text-center">
            <?php
            $sql3 = "SELECT * FROM tbl_order";
            $res3 = mysqli_query($conn, $sql3);
            $total_orders = mysqli_num_rows($res3);
            ?>
            <h1><?php echo $total_orders; ?></h1><br>
            Orders
        </div>
        <div class="col-4 text-center">
            <?php
            $sql4 = "SELECT SUM(total) as total FROM tbl_order WHERE status='delivered'";
            $res4 = mysqli_query($conn, $sql4);
            $row4 = mysqli_fetch_assoc($res4);
            $total_revenue = $row4['total'];

            ?>
            <h1>$<?php if ($total_revenue) {
                        echo $total_revenue;
                    } else {
                        echo 0;
                    }
                    ?></h1><br>
            Revenue
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>