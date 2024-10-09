<?php
include_once('includes/connect.php');
include('functions/common_functions.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMart-Cart Details</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css like-->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!--navbar-->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img src="./images/logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./user/user_reg.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-sharp fa-solid fa-cart-shopping"></i><sup><?php
                                                                                                                        cartitem();
                                                                                                                        ?></sup></a>
                        </li>


                    </ul>

                </div>
            </div>
        </nav>
        <!-- nav-->
        <!-- cart-->
        <?php
        cart();
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">

                <?php
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome guest</a>
                </li>";
                } else {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . "</a>
                </li>";
                }
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='./user/user_login.php'>Login</a>
                </li>";
                } else {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='./user/logout.php'>Logout</a>
                </li>";
                }
                ?>
            </ul>

        </nav>
        <div class="bg-light">
            <h3 class="text-center">
                EMart
            </h3>
            <p class="text-center">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            </p>
        </div>

        <!--table-->
        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered text-center">


                        <!--display data-->
                        <?php
                        $getip = getIPAddress();
                        $total = 0;
                        $result = Database::search("SELECT * FROM `cart_details` WHERE `ip_address`='$getip'");
                        $countresult = $result->num_rows;
                        if ($countresult > 0) {
                            echo "<thead>
                                <tr>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Remove</th>
                                    <th colspan='2'>Operations</th>
                                </tr>
                            </thead>
                            <tbody>";
                            while ($row = $result->fetch_array()) {
                                $product_id = $row['products_id'];
                                $productresult = Database::search("SELECT * FROM `products` WHERE `id`='$product_id'");
                                while ($pricerow = $productresult->fetch_array()) {
                                    $productprice = array($pricerow['price']);
                                    $price_table = $pricerow['price'];
                                    $product_title = $pricerow['title'];
                                    $product_image1 = $pricerow['image1'];
                                    $productvalues = array_sum($productprice);
                                    $total += $productvalues;

                        ?>
                                    <tr>
                                        <td><?php echo $product_title ?></td>
                                        <td><img src="./admin/product_images/<?php echo $product_image1 ?>" alt="" class="cartimg"></td>
                                        <td><input type="text" class="form-input w-50" name="qty"></td>
                                        <?php
                                        $getip = getIPAddress();
                                        if (isset($_POST['updatecart'])) {
                                            $quantities = $_POST['qty'];
                                            $qtyresult = Database::iud("UPDATE `cart_details` SET `qty`='$quantities' WHERE `ip_address`='$getip'");
                                            $total = $total * $quantities;
                                        }
                                        ?>
                                        <td><?php echo $price_table ?>/-</td>
                                        <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                                        <td>

                                            <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 mx-3" name="updatecart">
                                            <input type="submit" value="Remove Cart" class="bg-info px-3 py-2 border-0 mx-3" name="removecart">

                                        </td>
                                    </tr>
                        <?php
                                }
                            }
                        } else {
                            echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
                        } ?>
                        </tbody>
                    </table>

                    <!--Subtotal-->
                    <div class="d-flex mb-5">
                        <?php
                        $getip = getIPAddress();

                        $result = Database::search("SELECT * FROM `cart_details` WHERE `ip_address`='$getip'");
                        $countresult = $result->num_rows;
                        if ($countresult > 0) {
                            echo "<h4 class='px-3'>Subtotal:<strong class='text-info'>$total/-</strong></h4>


                            <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continueshopping'>
                            <button class='bg-secondary p-3 py-2 border-0 '><a href='./user/checkout.php' class='text-light text-decoration-none'>Checkout</a></button>";
                        } else {
                            echo "<input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continueshopping'>";
                        }
                        if (isset($_POST['continueshopping'])) {
                            echo "<script>window.open('index.php','_self')</script>";
                        }
                        ?>

                    </div>
            </div>
        </div>
        </form>

        <!--remove item-->
        <?php
        function removecartitem()
        {
            if (isset($_POST['removecart'])) {
                foreach ($_POST['removeitem'] as $removeid) {
                    echo $removeid;
                    $result = Database::iud("DELETE FROM `cart_details` WHERE `products_id`='$removeid'");
                    if ($result) {
                        echo "<script>window.open('cart.php','_self')</script>";
                    }
                }
            }
        }
        removecartitem();
        ?>
        <!--footer-->
        <?php
        include('./includes/footer.php');
        ?>
    </div>
    <!--bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>