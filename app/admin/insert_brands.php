<?php
include('../includes/connect.php');
if (isset($_POST['insert_brand'])) {
    $brand_title = $_POST['brand_title'];
    echo '<script type="text/javascript">alert("Success");</script>';
    $resultset = Database::search("SELECT * FROM `brands` WHERE `brands`.`title`='$brand_title'");

    $num = $resultset->num_rows;

    if ($num > 0) {
        echo "<script>";
        echo "alert('" . addslashes('exist') . "');";
        echo "</script>";
    } else {
        $result = Database::iud("INSERT INTO `brands`(`title`) VALUES ('$brand_title')");
        if ($result == true) {
            echo "<script>alert('Success');</script>";
        }
    }
}
?>
<h2 class="text-center">Insert Brands</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert brands" aria-label="brands" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">

        <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_brand" value="Insert Brands">
    </div>
</form>