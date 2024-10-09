<?php
include_once('../includes/connect.php');
include('../functions/common_functions.php');

if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];
}
//getting total items and price of all
$getip = getIPAddress();
$totalprice = 0;
$cartpriceresult = Database::search("SELECT * FROM `cart_details` WHERE `ip_address`='$getip'");
$invoiceno = mt_rand();
$status = 'pending';
$countproducts = $cartpriceresult->num_rows;
while ($rowprice = $cartpriceresult->fetch_array()) {
    $productid = $rowprice['products_id'];
    $selectproductresult = Database::search("SELECT * FROM `products` WHERE `id`='$productid'");
    while ($rowproductprice = $cartpriceresult->fetch_array()) {
        $productprice = array($rowproductprice['price']);
        $productvalues = array_sum($productprice);
        $totalprice += $productvalues;
    }
}

//getting qty from cart

$getcartresult = Database::search("SELECT * FROM `cart_details`");
$getitemqty = $getcartresult->fetch_array();
$qty = $getitemqty['qty'] ?? 1;
$subtotal = $totalprice * $qty;

$orderresult = Database::iud("INSERT INTO `orders` (`user_id`,`amount`,`invoice`,`totalproducts`,`orderdate`,`status`) VALUES ('$userid','$subtotal','$invoiceno','$countproducts',NOW(),'$status')");
if ($orderresult) {
    echo "<script>alert('Orders are submitted successfully')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}

//orders pending
$pendingorderresult = Database::iud("INSERT INTO `orderpending` (`user_id`,`invoice`,`products_id`,`qty`,`status`) VALUES ('$userid','$invoiceno','$productid',$qty,'$status')");

//delete items
$emptycartresult = Database::iud("DELETE FROM `cart_details` WHERE `ip_address`='$getip'");
