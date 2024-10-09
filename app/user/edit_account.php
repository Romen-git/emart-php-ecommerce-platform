<?php
if (isset($_GET['edit_account'])) {
    $username = $_SESSION['username'];
    $result = Database::search("SELECT * FROM `user` WHERE `username`='$username'");
    $rowfetch = $result->fetch_assoc();
    $userid = $rowfetch['id'];
    $username = $rowfetch['username'];
    $useremail = $rowfetch['email'];
    $useraddress = $rowfetch['address'];
    $usermobile = $rowfetch['mobile'];

    if (isset($_POST['userupdate'])) {
        $updateid=$userid;
        $username = $_POST['username'];
        $useremail = $_POST['useremail'];
        $useraddress = $_POST['useraddress'];
        $usermobile = $_POST['usermobile'];
        $userimage=$_FILES['userimage']['name'];
        $userimagetmp=$_FILES['userimage']['tmp_name'];
        move_uploaded_file($userimagetmp,"./user_images/$userimage");

        //update
        $updateresult = Database::iud("UPDATE `user` SET `username`='$username',`email`='$useremail',`address`='$useraddress',`mobile`='$usermobile',`image`='$userimage' WHERE `id`='$updateid'");
   if($updateresult){
    echo "<script>alert('Updated successfully')</script>";
    echo "<script>window.open('logout.php','_self')</script>";

   }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>

<body>
    <h3 class="text-center text-success mb-4"></h3>
    <form action="" method="post" enctype="multipart/form-data" class="text-center">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="username" value="<?php echo $username ?>">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" name="useremail" value="<?php echo $useremail ?>>
        </div>
        <div class=" form-outline mb-4 w-50 m-auto d-flex">
            <input type="file" class="form-control m-auto" name="userimage">
            <img src="./user_images/<?php echo $userimage ?>" alt="" style="width: 100px;object-fit: contain;">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="useraddress" value="<?php echo $useraddress ?>>
        </div>
        <div class=" form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="usermobile" value="<?php echo $usermobile ?>>
        </div>
        <input type=" submit" class="bg-info py-2 px-3 border-0" value="Update" name="userupdate">
    </form>
</body>

</html>