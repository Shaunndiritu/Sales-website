<?php
if(isset($_GET['edit_account'])){
    $user_session=$_SESSION['username'];
    $select_query="Select * from users_table where username='$user_session'";
    $result_query=mysqli_query($con,$select_query);
    $fetch_rows=mysqli_fetch_assoc($result_query);
    $user_id=$fetch_rows['user_id'];
    $username=$fetch_rows['username'];
    $user_email=$fetch_rows['user_email'];
    $user_address=$fetch_rows['user_address'];
    $user_telephone=$fetch_rows['user_telephone'];


    //Update//
    if(isset($_POST['user_update'])){
    $update_id=$user_id;
    $username=$_POST['username'];
    $user_email=$_POST['user_email'];
    $user_address=$_POST['user_address'];
    $user_telephone=$_POST['user_telephone'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_tmp,"./users_profile/$user_image");


    //Update Query//
    $update_data="update users_table set username='$username',user_email='$user_email',user_image='$user_image',user_address='$user_address',user_telephone='$user_telephone' where user_id=$update_id";
    $result_update_query=mysqli_query($con,$update_data);
    if($result_update_query){
        echo "<script>alert('Data has been accepted successfully')</script>";
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
    <title>Edit account</title>
</head>
<body>
    <h3 class="text-center text-success mb-4">Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data" class="text-center">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $username  ?>" name="username">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" value="<?php echo $user_email  ?>" name="user_email">
        </div>
        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control m-auto" name="user_image">
            <img src="./users_profile/<?php echo $user_image?>" alt="" class="edit_image">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_address  ?>" name="user_address">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_telephone  ?>" name="user_telephone">
        </div>
        <input type="submit" value="update" class="bg-success py-2 px-3 border-0" name="user_update">
    </form>
</body>
</html>