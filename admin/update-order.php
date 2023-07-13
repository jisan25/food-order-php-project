<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_order WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count) {
                $row = mysqli_fetch_assoc($res);
                $food = $row['food'];
                $qty = $row['qty'];
                $price = $row['price'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            } else {
                header("Location:" . SITEURL . "admin/manage-order.php");
            }
        } else {
            header("Location:" . SITEURL . "admin/manage-order.php");
        }
        if (!$_GET['id']) {
            header("Location:" . SITEURL . "admin/manage-order.php");
        }

        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name:</td>
                    <td>
                        <b><?php echo $food; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>
                        <b>$ <?php echo $price ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == "ordered") {
                                        echo "selected";
                                    } ?> value="ordered">ordered</option>
                            <option <?php if ($status == "on delivery") {
                                        echo "selected";
                                    } ?> value="on delivery">on delivery</option>
                            <option <?php if ($status == "delivered") {
                                        echo "selected";
                                    } ?> value="delivered">delivered</option>
                            <option <?php if ($status == "cancelled") {
                                        echo "selected";
                                    } ?> value="cancelled">cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="email" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address:</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
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
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $price * $qty;
    $status = $_POST['status'];
    $customer_name = $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];



    $sql2 = "UPDATE tbl_order SET 
    qty = $qty, 
    total = $total, 
    status = '$status', 
    customer_name = '$customer_name', 
    customer_contact = '$customer_contact', 
    customer_email = '$customer_email', 
    customer_address = '$customer_address'
    WHERE id = $id";

    $res2 = mysqli_query($conn, $sql2);
    if ($res2) {
        $_SESSION['order-updated'] = '<div class="success">Order Updated Successfully</div>';
        header("Location:" . SITEURL . "admin/manage-order.php");
    } else {
        $_SESSION['order-updated'] = '<div class="error">Failed to Update Order.</div>';
        header("Location:" . SITEURL . "admin/manage-order.php");
    }
}
?>

<?php include('partials/footer.php'); ?>