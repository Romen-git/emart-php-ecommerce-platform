<?php
include_once('../includes/connect.php');
include('../functions/common_functions.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!--username field-->
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="username">
                    </div>

                    <!--password field-->
                    <div class="form-outline mb-4">
                        <label for="userpassword" class="form-label">Password</label>
                        <input type="password" id="userpassword" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="userpassword">
                    </div>

                    <div class="mt-2 pt-2 mb-0">
                        <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="userlogin">
                        <p class="small fw-bold mt-2 pt-1">Don't have an account? <a href="user_reg.php" class="text-danger">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['userlogin'])) {
    $username = $_POST['username'];
    $userpassword = $_POST['userpassword'];

    $result = Database::search("SELECT * FROM `user` WHERE `username`='$username'");
    $row_count = $result->num_rows;
    $rowdata = $result->fetch_assoc();
    $userip = getIPAddress();

    //cart item
    $cartresult = Database::search("SELECT * FROM `cart_details` WHERE `ip_address`='$userip'");
    $row_countcart = $cartresult->num_rows;
    if ($row_count > 0) {
        $_SESSION['username'] = $username;
        if (password_verify($userpassword, $rowdata['password'])) {
            //echo "<script>alert('Login successful')</script>";
            if ($row_count == 1 and $row_countcart == 0) {
                $_SESSION['username'] = $username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            } else {
                $_SESSION['username'] = $username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('payment.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Inavlid credentials')</script>";
        }
    } else {
        echo "<script>alert('Inavlid credentials')</script>";
    }
}
?>