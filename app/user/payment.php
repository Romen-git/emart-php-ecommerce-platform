<?php
include_once('../includes/connect.php');
include('../functions/common_functions.php');

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


<body>
    <!--access user id-->
    <?php 
    $userip=getIPAddress();
    $getuserresult = Database::search("SELECT * FROM `user` WHERE `ip`='$userip'");
    $getuserrowdata=$getuserresult->fetch_array();
    $userid=$getuserrowdata['id'];
    ?>
    <div class="container">
        <h2 class="text-center text-info">Payment Options</h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col-md-6">
                <a href="https://www.paypal.com" target="_blank"><img src="../images/payment.png" alt="" style="width: 100%;margin: auto;display: block;"></a>
            </div>
            <div class="col-md-6">
                <a href="order.php?userid=<?php echo $userid?>" ><h2 class="text-center">Pay offline</h2></a>
            </div>
        </div>
    </div>
</body>

</html>