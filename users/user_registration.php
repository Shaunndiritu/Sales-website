<?php 
 include('../includes/connect.php');
 include('../functions/common.php');  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User registration</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid my-2">
        <h2 class="text-center">New user registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <!-- Username field-->
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" class="form-control" placeholder="Enter username" autocomplete="off" required="required" name="username" />
                    </div>
                    <div class="form-outline mb-4">
                        <!-- user email field-->
                        <label for="user_email" class="form-label">User email</label>
                        <input type="email" id="user_email" class="form-control" placeholder="Enter email" autocomplete="off" required="required" name="user_email" />
                    </div>
                    <div class="form-outline mb-4">
                        <!-- user image field-->
                        <label for="user_image" class="form-label">User image</label>
                        <input type="file" id="user_image" class="form-control" required="required" name="user_image" />
                    </div>
                    <div class="form-outline mb-4">
                        <!-- user password field-->
                        <label for="user_password" class="form-label">User password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter password" autocomplete="off" required="required" name="user_password" />
                    </div>
                    <div class="form-outline mb-4">
                        <!-- confirm password field-->
                        <label for="confirm_user_password" class="form-label">Confirm password</label>
                        <input type="password" id="confirm_user_password" class="form-control" placeholder="Confirm password" autocomplete="off" required="required" name="confirm_user_password" />
                    </div>
                    <div class="form-outline mb-4">
                        <!-- User address field-->
                        <label for="user_address" class="form-label">Shipping address</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter shipping address" autocomplete="off" required="required" name="user_address" />
                    </div>
                    <div class="form-outline mb-4">
                        <!-- Contact field-->
                        <label for="user_telephone" class="form-label">Telephone number</label>
                        <input type="text" id="user_telephone" class="form-control" placeholder="Enter telephone number" autocomplete="off" required="required" name="user_telephone" />
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Register" class="bg-success py-2 px-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 ">Already have an account? <a href="user_login.php" class="text-success"> Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!-- PHP code for inserting users in database-->
<?php
if(isset($_POST['user_register'])){  //user_register is the name attribute given to the register button. NB: not the value value is what is displayed on the button//
    $username=$_POST['username']; // These are the variables passed on the name attribute or the table names on the database
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);  //hashed password variable//
    $confirm_user_password=$_POST['confirm_user_password'];
    $user_address=$_POST['user_address'];
    $user_telephone=$_POST['user_telephone'];
    $user_image=$_FILES['user_image']['name']; //For images always use $_FILES anything else use $_POST//
    $user_image_tmp=$_FILES['user_image']['tmp_name']; //We should also create the tmp_name for the image//
    $user_ip=getIPAddress(); 

    //Checking to see if the user already exists//
    $select_query="select * from users_table where username='$username' or user_email='$user_email'";
    $result=mysqli_query($con,$select_query);
    $rows_counted=mysqli_num_rows($result);
    if($rows_counted>0){
        echo "<script>alert('Username and email already exists')</script>";
    }
    else if($user_password!=$confirm_user_password){
        echo "<script>alert('Password does not match')</script>";
    }
    else{
        //insert query//
    move_uploaded_file($user_image_tmp,"./users_profile/$user_image"); //Moves the images to the users_profile folder//
    $insert_query="insert into users_table (username,user_email,user_password,user_image,user_ip,user_address,user_telephone)
      values('$username','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_telephone')";
    $result_query=mysqli_query($con,$insert_query);
    if($result_query){
        echo "<script>alert('Data inserted succesfully')</script>";
    } else{
        die(mysqli_error($con));
    } 
    }

    //selecting cart items//
    $select_items="select * from cart_table where ip_address='$user_address'";
    $result_items=mysqli_query($con,$select_items);
    $rows_counted=mysqli_num_rows($result_items);
    if($rows_counted>0){
        $_SESSION['username']=$username;
        echo "<script>alert('You have products on your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }
    else{
        echo "<script>window.open('../index.php','_self')</script>";
    }

  


}


?>