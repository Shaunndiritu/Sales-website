<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete account</title>
</head>
<body>
    <h3 class="text-success mb-4 text-center">Delete Account</h3>
    <form action="" method="post" class="mt-5">
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto" name="delete" Value="Delete Account">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto" name="dont_delete" Value="Don't Delete Account">
        </div>
    </form>

    <?php
$username_session=$_SESSION['username'];
if(isset($_POST['delete'])){
    //delete query//
    $delete_query="Delete from users_table where username='$username_session'";
    $result_query=mysqli_query($con,$delete_query);
    if($result_query){
        session_destroy();
        echo "<script>('Account deleted succcessfully')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
}

if(isset($_POST['dont_delete'])){
    echo "<script>window.open('profile.php','_self')</script>";
}




    ?>
</body>
</html>