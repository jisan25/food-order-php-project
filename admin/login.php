<?php include('../config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

    <div class="login text-center">
        <h1>Login</h1> <br><br>

        <?php
        if (isset($_SESSION['logged-in'])) {
            echo $_SESSION['logged-in'];
            unset($_SESSION['logged-in']);
        }
        if (isset($_SESSION['not-logged-in'])) {
            echo $_SESSION['not-logged-in'];
            unset($_SESSION['not-logged-in']);
        }
        ?>
        <br><br>
        <!-- Login Form Starts Here -->
        <form action="" method="POST" class="text-center">
            <label for="">Username:</label> <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            <label for="">Password:</label><br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" name="submit" value="Login" class="btn btn-primary"><br>
        </form>
        <br>
        <p>Created By - <a href="www.google.com">Shihabun Jisan</a></p>
    </div>

</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    $sql = "SELECT * FROM tbl_admin WHERE username='$username' and password='$password'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count) {
        $_SESSION['logged-in'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username;
        header("Location:" . SITEURL . "admin/");
    } else {
        $_SESSION['logged-in'] = "<div class='error text-center'>Username or Password did not match.</div>";
        header("Location:" . SITEURL . "admin/login.php");
    }
}
?>