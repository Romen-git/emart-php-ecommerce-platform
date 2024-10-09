<?php
include('../includes/connect.php');
if (isset($_POST['insert_cat'])) {
    $cat_title = $_POST['cat_title'];

    $resultset = Database::search("SELECT * FROM `categories` WHERE `categories`.`title`='".$cat_title."'");
    //$cat_data = $resultset->fetch_assoc();
    $num = $resultset->num_rows;

    if ($num > 0) {
        echo "<script>";
        echo "alert('" . addslashes('exist') . "');";
        echo "</script>";
    } else {
        $result = Database::iud("INSERT INTO `categories`(`title`) VALUES (' $cat_title ')");
        if ($result == true) {
            echo "<script>alert('Success');</script>";
        }
    }
}
?>
<h2 class="text-center">Insert Categories</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert categories" aria-label="categories" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">

        <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_cat" value="Insert Categories">

    </div>
</form>