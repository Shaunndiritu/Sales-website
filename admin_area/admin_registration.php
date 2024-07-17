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
    <title>Admin Registration</title>
        <!--bootstrap CSS link-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid m-3">
<h2 class="text-center mb-5">Admin Registration</h2>
<div class="row d-flex justify-content-center">
    <div class="col-lg-6 col-xl-5">
        <img src="../images/Admin registration.jpg" alt="Admin Registration" class="Img-fluid">
    </div>
    <div class="col-lg-6 col-xl-4">
        <form action="" method="post">
            <div class="form-outline mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="admin_name" name="admin_name" placeholder="Enter username" required="required" class="form-control">
            </div>
            <div class="form-outline mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="admin_email" name="admin_email" placeholder="Enter email address" required="required" class="form-control">
            </div>
            <div class="form-outline mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="admin_password" name="admin_password" placeholder="Enter password" required="required" class="form-control">
            </div>
            <div class="form-outline mb-4">
                <label for="confirm_password" class="form-label">Confirm password</label>
                <input type="password" id="admin_password" name=" confirm_admin_password" placeholder="Confirm password" required="required" class="form-control">
            </div>
            <div>
                <input type="submit" class="bg-success py-2 px-3 border-0" name="admin_registration" Value="Register">
                <p class="small fw-bold mt-2 pt-1">Already an account? <a href="admin_login.php" class="link-success">Login</a></p>
            </div>
        </form>
    </div>
</div>
    </div>
</body>
</html>

<!-- PHP code for inserting Admin in database-->
<?php
if(isset($_POST['admin_registration'])){  //user_register is the name attribute given to the register button. NB: not the value value is what is displayed on the button//
    $admin_name=$_POST['admin_name']; // These are the variables passed on the name attribute or the table names on the database
    $admin_email=$_POST['admin_email'];
    $admin_password=$_POST['admin_password'];
    $hash_password=password_hash($admin_password,PASSWORD_DEFAULT);  //hashed password variable//
    $confirm_admin_password=$_POST['confirm_admin_password'];
    //$user_address=$_POST['user_address'];
    //$user_telephone=$_POST['user_telephone'];
    //$user_image=$_FILES['user_image']['name']; //For images always use $_FILES anything else use $_POST//
    //$user_image_tmp=$_FILES['user_image']['tmp_name']; //We should also create the tmp_name for the image//
    //$user_ip=getIPAddress(); 

    //Checking to see if the admin already exists//
    $select_query="select * from admin_table where admin_name='$admin_name' or admin_email='$admin_email'";
    $result=mysqli_query($con,$select_query);
    $rows_counted=mysqli_num_rows($result);
    if($rows_counted>0){
        echo "<script>alert('Username and email already exists')</script>";
    }
    else if($admin_password!=$confirm_admin_password){
        echo "<script>alert('Password does not match')</script>";
    }
    else{
        //insert query//
   // move_uploaded_file($user_image_tmp,"./users_profile/$user_image"); //Moves the images to the users_profile folder//
    $insert_query="insert into admin_table (admin_name,admin_email,admin_password)
      values('$admin_name','$admin_email','$hash_password')";
    $result_query=mysqli_query($con,$insert_query);
    if($result_query){
        echo "<script>alert('Data inserted succesfully')</script>";
    } else{
        die(mysqli_error($con));
    } 
    }

}
?>