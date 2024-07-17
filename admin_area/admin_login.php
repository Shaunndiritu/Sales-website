<?php 
 include('../includes/connect.php');
 include('../functions/common.php'); 
 @session_start(); //The @ before sesssion makes the session start when the page is active otherwise it won't//

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
        <!--bootstrap CSS link-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid m-3">
<h2 class="text-center mb-5">Admin Login</h2>
<div class="row d-flex justify-content-center">
    <div class="col-lg-6 col-xl-5">
        <img src="../images/Admin registration.jpg" alt="Admin Registration" class="Img-fluid">
    </div>
    <div class="col-lg-6 col-xl-4">
        <form action="" method="post">
            <div class="form-outline mb-4">
                <label for="admin_name" class="form-label">Username</label>
                <input type="text" id="admin_name" name="admin_name" placeholder="Enter username" required="required" class="form-control">
            </div>
            <div class="form-outline mb-4">
                <label for="admin_password" class="form-label">Password</label>
                <input type="password" id="admin_password" name="admin_password" placeholder="Enter password" required="required" class="form-control">
            </div>
            <div>
                <input type="submit" class="bg-success py-2 px-3 border-0" name="admin_login" Value="Login">
                <p class="small fw-bold mt-2 pt-1">Don't have an account? <a href="admin_registration.php" class="link-success">Register</a></p>
            </div>
        </form>
    </div>
</div>
    </div>
</body>
</html>

<?php
if(isset($_POST['admin_login'])){
    $admin_name=$_POST['admin_name'];
    $admin_password=$_POST['admin_password'];

    //Selecting admin name from the admin table when logging in//
    $select_query="select * from admin_table where admin_name='$admin_name'";
    $result_query=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result_query);
    $rows_data_fetched=mysqli_fetch_assoc($result_query);

    if($row_count>0){
        if(password_verify($admin_password,$rows_data_fetched['admin_password'])){
            $_SESSION['admin_name']=$admin_name; 
            if($row_count==1){
                $_SESSION['admin_name']=$admin_name;
                echo "<script>alert('Logged in successfully')</script>";
                echo "<script>window.open('index.php','_self')</script>"; 
        
            } else{
                $_SESSION['username']=$username;
                echo "<script>alert('Logged in successfully')</script>";
                echo "<script>window.open('payments.php','_self')</script>";

            }

           // echo "<script>alert('Logged in successfully')</script>"; //

        } else{
            echo "<script>alert('Incorrect logins')</script>";
        }

    } else{
        echo "<script>alert('Incorrect logins')</script>";
    }


}

?>