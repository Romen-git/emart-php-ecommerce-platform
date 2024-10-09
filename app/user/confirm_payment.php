<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
session_start();
if (isset($_GET['orderid'])) {
    $orderid = $_GET['orderid'];
    $result = Database::search("SELECT * FROM `orders` WHERE `id`='$orderid'");
    $rowfetch = $result->fetch_assoc();
    $invoicenum=$rowfetch['invoice'];
    $amount=$rowfetch['amount'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>

<body class="bg-secondary">
    <h1 class="text-center text-light">Confirm Payment</h1>
    <div class="container my-5">
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoicenum" value="<?php echo $invoicenum?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="paymentmode" id="" class="form-select w-50 m-auto">
                    <option value="">Select payment method</option>
                    <option value="">Paypal</option>
                    <option value="">Cash on delivery</option>
                    <option value="">Pay offline</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">

                <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirmpayment">
            </div>
        </form>
    </div>
</body>

</html>