<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>
        <br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn btn-secondary">
                    </td>

                </tr>
            </table>
        </form>
        <?php

        // if form is submitted

        if (isset($_POST['submit'])) {
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);  // Password Encryption with MD5

            // 2. SQL Query to Save the data into database
            $sql = "INSERT INTO tbl_admin (fullname, username, password) VALUES ('$full_name', '$username', '$password')";

            // 3. Executing Query and Saving Data into Database
            $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            // $res = mysqli_query($conn, $sql);

            // 4. Check wehethe (Query is Executed) data is inserted or not and display appropriate message
            if ($res) {
                $_SESSION['admin-added'] = "<div class='success'>Admin Added Successfully</div>";
                header("Location:" . SITEURL . "admin/manage-admin.php");
            } else {
                $_SESSION['admin-added'] = "<div class='error'>Failed to Add Admin</div>";
                header("Location:" . SITEURL . "admin/manage-admin.php");
            }
        }

        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>