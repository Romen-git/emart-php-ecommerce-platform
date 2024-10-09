<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $username = $_SESSION['username'];
    $result = Database::search("SELECT * FROM `user` WHERE `username`='$username'");
    $rowfetch = $result->fetch_assoc();
    $userid = $rowfetch['id'];
    ?>
    <h3 class="text-success">All my orders</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <tr>
                <th>SI no</th>
                <th>Amount</th>
                <th>Total products</th>
                <th>Invoice number</th>
                <th>Date</th>
                <th>Complete/Incomplete</th>
                <th>Status</th>

            </tr>
        </thead>
        <tbody class="bg-secondary">
            <?php
            $ordersresult = Database::search("SELECT * FROM `orders` WHERE `user_id`='$userid'");
            $num = 1;
            while ($roworders = $result->fetch_assoc()) {
                $orderid = $roworders['id'];
                $amount = $roworders['amount'];
                $totalproducts = $roworders['totalproducts'];
                $incoice = $roworders['invoice'];
                $orderstatus = $roworders['status'];
                if($orderstatus="pending"){
                    $orderstatus='Incomplete';
                }else{
                    $orderstatus='Complete';
                }
                $orderdate = $roworders['orderdate'];
                
                echo "<tr>
                <th>$num</th>
                <th>$amount</th>
                <th>$totalproducts</th>
                <th>$incoice</th>
                <th>$orderdate</th>
                <th>$orderstatus</th>
                <th><a href='confirm_payment.php?orderid=$orderid' class='text-light'>Confirm</a></th>
            </tr>";
            }
            $num++;

            ?>

        </tbody>

    </table>
</body>

</html>