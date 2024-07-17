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
    <title>User login</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid my-2">
        <h2 class="text-center">User login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <!-- Username field-->
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" class="form-control" placeholder="Enter username" autocomplete="off" required="required" name="username" />
                    </div>
                    <div class="form-outline mb-4">
                        <!-- user password field-->
                        <label for="user_password" class="form-label">User password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter password" autocomplete="off" required="required" name="user_password" />
                    </div>
                    <div class="text-center">
                        <input type="submit" value="login" class="bg-success py-2 px-3 border-0" name="user_login">
                        <p class="small fw-bold mt-2 pt-1 ">Don't have an account? <a href="user_registration.php" class="text-success"> Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['user_login'])){
    $username=$_POST['username'];
    $user_password=$_POST['user_password'];

    //Selecting username from the user table when logging in//
    $select_query="select * from users_table where username='$username'";
    $result_query=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result_query);
    $rows_data_fetched=mysqli_fetch_assoc($result_query);
    $ip_address=getIPAddress();


    //Cart items
    $select_cart_query="select * from cart_table where ip_address='$ip_address'";
    $select_cart=mysqli_query($con,$select_cart_query);
    $row_cart_count=mysqli_num_rows($select_cart);
    if($row_count>0){
        if(password_verify($user_password,$rows_data_fetched['user_password'])){
            $_SESSION['username']=$username; 
            if($row_count==1 and $row_cart_count==0){
                $_SESSION['username']=$username;
                echo "<script>alert('Logged in successfully')</script>";
                echo "<script>window.open('profile.php','_self')</script>"; 
        
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