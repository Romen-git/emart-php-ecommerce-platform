<?php
//database connection
//include_once('./includes/connect.php');

//getting products
function getproducts()
{
    //check if isset or not
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $product_result = Database::search("SELECT * FROM `products` ORDER BY rand() LIMIT 0,9");

            while ($row = $product_result->fetch_assoc()) {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $image1 = $row['image1'];
                $price = $row['price'];
                $categories_id = $row['categories_id'];
                $brands_id = $row['brands_id'];
                $id = $row['id'];
                $id = $row['id'];

                echo "<div class='col-md-4 mb-2'>
                <div class='card'>
                    <img src='./admin/product_images/$image1' class='card-img-top' alt='$title'>
                    <div class='card-body'>
                        <h5 class='card-title'>$title</h5>
                        <p class='card-text'>$description</p>
                        <p class='card-text'>Price: $price/-</p>
                        <a href='index.php?addtocart=$id' class='btn btn-info'>Add to cart</a>
                        <a href='product_details.php?product_id=$id' class='btn btn-secondary'>View more</a>
                    </div>
                </div>
            </div>";
            }
        }
    }
}

//getting all products
function getallproducts()
{
    //check if isset or not
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $product_result = Database::search("SELECT * FROM `products` ORDER BY rand()");

            while ($row = $product_result->fetch_assoc()) {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $image1 = $row['image1'];
                $price = $row['price'];
                $categories_id = $row['categories_id'];
                $brands_id = $row['brands_id'];
                $id = $row['id'];
                $id = $row['id'];

                echo "<div class='col-md-4 mb-2'>
                <div class='card'>
                    <img src='./admin/product_images/$image1' class='card-img-top' alt='$title'>
                    <div class='card-body'>
                        <h5 class='card-title'>$title</h5>
                        <p class='card-text'>$description</p>
                        <p class='card-text'>Price: $price/-</p>
                        <a href='index.php?addtocart=$id' class='btn btn-info'>Add to cart</a>
                        <a href='product_details.php?product_id=$id' class='btn btn-secondary'>View more</a>
                    </div>
                </div>
            </div>";
            }
        }
    }
}

//get unique categories
function getuniquecatagories()
{
    //check if isset or not
    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];

        $product_result = Database::search("SELECT * FROM `products` WHERE `id`=$category_id ");
        $num_rows = $product_result->num_rows;
        if ($num_rows == 0) {
            echo "<h2 class='text-center text-danger'>No stock for this category</h2>";
        }

        while ($row = $product_result->fetch_assoc()) {
            $id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $image1 = $row['image1'];
            $price = $row['price'];
            $categories_id = $row['categories_id'];
            $brands_id = $row['brands_id'];
            $id = $row['id'];
            $id = $row['id'];

            echo "<div class='col-md-4 mb-2'>
                <div class='card'>
                    <img src='./admin/product_images/$image1' class='card-img-top' alt='$title'>
                    <div class='card-body'>
                        <h5 class='card-title'>$title</h5>
                        <p class='card-text'>$description</p>
                        <p class='card-text'>Price: $price/-</p>
                        <a href='index.php?addtocart=$id' class='btn btn-info'>Add to cart</a>
                        <a href='product_details.php?product_id=$id' class='btn btn-secondary'>View more</a>
                    </div>
                </div>
            </div>";
        }
    }
}
//get unique brands
function getuniquebrands()
{
    //check if isset or not
    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];

        $product_result = Database::search("SELECT * FROM `products` WHERE `id`=$brand_id ");
        $num_rows = $product_result->num_rows;
        if ($num_rows == 0) {
            echo "<h2 class='text-center text-danger'>No stock for this brand</h2>";
        }

        while ($row = $product_result->fetch_assoc()) {
            $id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $image1 = $row['image1'];
            $price = $row['price'];
            $categories_id = $row['categories_id'];
            $brands_id = $row['brands_id'];
            $id = $row['id'];
            $id = $row['id'];

            echo "<div class='col-md-4 mb-2'>
                <div class='card'>
                    <img src='./admin/product_images/$image1' class='card-img-top' alt='$title'>
                    <div class='card-body'>
                        <h5 class='card-title'>$title</h5>
                        <p class='card-text'>$description</p>
                        <p class='card-text'>Price: $price/-</p>
                        <a href='index.php?addtocart=$id' class='btn btn-info'>Add to cart</a>
                        <a href='product_details.php?product_id=$id' class='btn btn-secondary'>View more</a>
                    </div>
                </div>
            </div>";
        }
    }
}

//brands in sidenav
function getbrands()
{
    $resultset = Database::search("SELECT * FROM `brands`");

    while ($row_data = $resultset->fetch_assoc()) {
        $brand_title = $row_data['title'];
        $brand_id = $row_data['id'];
        echo "<li class='nav-item '>
                        <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
                    </li>";
    }
}
//categories in sidenav
function getcategories()
{
    $resultset = Database::search("SELECT * FROM `categories`");

    while ($row_data = $resultset->fetch_assoc()) {
        $cat_title = $row_data['title'];
        $cat_id = $row_data['id'];
        echo "<li class='nav-item '>
                        <a href='index.php?category=$cat_id' class='nav-link text-light'>$cat_title</a>
                    </li>";
    }
}

//searching products
function searchproduct()
{
    //check if isset or not
    if (isset($_GET['search_data_product'])) {
        $searchdatavalue = $_GET['search_data'];
        $product_result = Database::search("SELECT * FROM `products` WHERE `keywords` LIKE '%$searchdatavalue%'");
        $num_rows = $product_result->num_rows;
        if ($num_rows == 0) {
            echo "<h2 class='text-center text-danger'>No results match</h2>";
        }

        while ($row = $product_result->fetch_assoc()) {
            $id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $image1 = $row['image1'];
            $price = $row['price'];
            $categories_id = $row['categories_id'];
            $brands_id = $row['brands_id'];
            $id = $row['id'];
            $id = $row['id'];

            echo "<div class='col-md-4 mb-2'>
                <div class='card'>
                    <img src='./admin/product_images/$image1' class='card-img-top' alt='$title'>
                    <div class='card-body'>
                        <h5 class='card-title'>$title</h5>
                        <p class='card-text'>$description</p>
                        <p class='card-text'>Price: $price/-</p>
                        <a href='index.php?addtocart=$id' class='btn btn-info'>Add to cart</a>
                        <a href='product_details.php?product_id=$id' class='btn btn-secondary'>View more</a>
                    </div>
                </div>
            </div>";
        }
    }
}

//view details
function viewdetails()
{
    //check if isset or not
    if (isset($_GET['product_id'])) {
        if (!isset($_GET['category'])) {
            if (!isset($_GET['brand'])) {
                $product_id = $_GET['product_id'];
                $product_result = Database::search("SELECT * FROM `products` WHERE `id`='$product_id'");

                while ($row = $product_result->fetch_assoc()) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $image1 = $row['image1'];
                    $image2 = $row['image2'];
                    $image3 = $row['image3'];
                    $price = $row['price'];
                    $categories_id = $row['categories_id'];
                    $brands_id = $row['brands_id'];
                    $id = $row['id'];
                    $id = $row['id'];

                    echo "<div class='col-md-4 mb-2'>
                <div class='card'>
                    <img src='./admin/product_images/$image1' class='card-img-top' alt='$title'>
                    <div class='card-body'>
                        <h5 class='card-title'>$title</h5>
                        <p class='card-text'>$description</p>
                        <p class='card-text'>Price: $price/-</p>
                        <a href='index.php?addtocart=$id' class='btn btn-info'>Add to cart</a>
                        <a href='index.php' class='btn btn-secondary'>Go Home</a>
                    </div>
                </div>
            </div>
            <div class='col-md-8'>
                        <!--images-->
                        <div class='row'>
                            <div class='col-md-12'>
                                <h4 class='text-center text-info mb-5'>
                                    Related products
                                </h4>
                            </div>
                            <div class='col-md-6'>
                            <img src='./admin/product_images/$image2' class='card-img-top' alt='$title'>
                            </div>
                            <div class='col-md-6'>
                            <img src='./admin/product_images/$image3' class='card-img-top' alt='$title'>
                            </div>
                        </div>
                    </div>";
                }
            }
        }
    }
}

//get ip address
function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//add to cart
function cart()
{
    if (isset($_GET['addtocart'])) {
        $getip = getIPAddress();
        $getproductid = $_GET['addtocart'];
        $result = Database::search("SELECT * FROM `cart_details` WHERE `ip_address`='$getip' AND `products_id`='$getproductid'");
        $num_rows = $result->num_rows;
        if ($num_rows > 0) {
            echo "<script>alert('This item already in the cart')</script>";
            echo "<script>window.open('index.php',_self)</script>";
        } else {
            $result = Database::iud("INSERT INTO `cart_details` (`products_id`,`ip_address`,`qty`) VALUES ('$getproductid','$getip','0')");
            echo "<script>alert('Item is added to cart')</script>";
            echo "<script>window.open('index.php',_self)</script>";
        }
    }
}

//get cart item numbers
function cartitem()
{
    if (isset($_GET['addtocart'])) {
        $getip = getIPAddress();

        $result = Database::search("SELECT * FROM `cart_details` WHERE `ip_address`='$getip'");
        $cartnum_rows = $result->num_rows;
    } else {
        $getip = getIPAddress();

        $result = Database::search("SELECT * FROM `cart_details` WHERE `ip_address`='$getip'");
        $cartnum_rows = $result->num_rows;
    }
    echo $cartnum_rows;
}

//total price
function totalcartprice()
{
    $getip = getIPAddress();
    $total = 0;
    $result = Database::search("SELECT * FROM `cart_details` WHERE `ip_address`='$getip'");
    while ($row = $result->fetch_array()) {
        $product_id = $row['products_id'];
        $productresult = Database::search("SELECT * FROM `products` WHERE `id`='$product_id'");
        while ($pricerow = $productresult->fetch_array()) {
            $productprice = array($pricerow['price']);
            $productvalues = array_sum($productprice);
            $total += $productvalues;
        }
    }
    echo $total;
}

//get user order details
function getuserorder()
{
    $username = $_SESSION['username'];
    $result = Database::search("SELECT * FROM `user` WHERE `username`='$username'");
    while ($row = $result->fetch_array()) {
        $userid = $row['id'];
        if (!isset($_GET['edit_account'])) {
            if (!isset($_GET['my_orders'])) {
                if (!isset($_GET['delete_account'])) {
                    $getorderresult = Database::search("SELECT * FROM `orders` WHERE `user_id`='$userid' AND `status`='pending'");
                    $rowcount = $getorderresult->num_rows;
                    if ($rowcount > 0) {
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>$rowcount</span> pending orders</h3>
                        <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";
                    }
                } else {
                    echo "<h3 class='text-center text-success mt-5 mb-2'>You have zero pending orders</h3>
                        <p class='text-center'><a href='../index.php' class='text-dark'>Explore products</a></p>";
                }
            }
        }
    }
}
