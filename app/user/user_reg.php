<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!--username field-->
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="username">
                    </div>
                    <!--email field-->
                    <div class="form-outline mb-4">
                        <label for="useremail" class="form-label">Email</label>
                        <input type="email" id="useremail" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" name="useremail">
                    </div>
                    <!--img field-->
                    <div class="form-outline mb-4">
                        <label for="userimage" class="form-label">User Image</label>
                        <input type="file" id="userimage" class="form-control" required="required" name="userimage">
                    </div>
                    <!--password field-->
                    <div class="form-outline mb-4">
                        <label for="userpassword" class="form-label">Password</label>
                        <input type="password" id="userpassword" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="userpassword">
                    </div>
                    <!--confirm password field-->
                    <div class="form-outline mb-4">
                        <label for="confirmuserpassword" class="form-label">Confirm Password</label>
                        <input type="password" id="confirmuserpassword" class="form-control" placeholder="Confirm password" autocomplete="off" required="required" name="confirmuserpassword">
                    </div>
                    <!--address field-->
                    <div class="form-outline mb-4">
                        <label for="useraddress" class="form-label">Address</label>
                        <input type="text" id="useraddress" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" name="useraddress">
                    </div>
                    <!--contact field-->
                    <div class="form-outline mb-4">
                        <label for="usercontact" class="form-label">Contact</label>
                        <input type="text" id="usercontact" class="form-control" placeholder="Enter your mobile number" autocomplete="off" required="required" name="usercontact">
                    </div>
                    <div class="mt-2 pt-2 mb-0">
                        <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="userregister">
                        <p class="small fw-bold mt-2 pt-1">Already have an account? <a href="user_login.php" class="text-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['userregister'])) {
    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $userpassword = $_POST['userpassword'];
    $hashpassword = password_hash($userpassword, PASSWORD_DEFAULT);
    $confirmuserpassword = $_POST['confirmuserpassword'];
    $useraddress = $_POST['useraddress'];
    $usercontact = $_POST['usercontact'];
    $userimage = $_FILES['userimage']['name'];
    $userimagetmp = $_FILES['userimage']['tmp_name'];
    $userip = getIPAddress();


    //select
    $selectresult = Database::search("SELECT * FROM `user` WHERE `username`='$username' OR `email`='$useremail'");
    $rowscount = $selectresult->num_rows;
    if ($rowscount > 0) {
        echo "<script>alert('Username and email already exist')</script>";
    } else if ($userpassword != $confirmuserpassword) {
        echo "<script>alert('Passwords do not match')</script>";
    } else {
        move_uploaded_file($userimagetmp, "./user_images/$userimage");
        $result = Database::iud("INSERT INTO `user` (`username`,`email`,`password`,`image`,`ip`,`address`,`mobile`) VALUES ('$username','$useremail','$hashpassword','$userimage','$userip','$useraddress','$usercontact')");
    }

    //selecting cart items
    $resultcart = Database::search("SELECT * FROM `cart_details` WHERE `ip_address`='$userip'");
    $rowcount = $resultcart->num_rows;
    if ($rowcount > 0) {
        $_SESSION['username'] = $username;
        echo "<script>alert('You have items in the cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }else{
        echo "<script>window.open('../index.php','_self')</script>";
    }
}
?>