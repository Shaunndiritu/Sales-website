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
    <title>Payments page</title>
      <!-- bootstrap CSS link -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<style>
    .payment_img{
        width: 50%;
        margin: auto;
        display: block;
    }
</style>

<body>
    <!-- Php code to access the user id-->
    <?php
    $user_ip=getIPAddress();
    $get_users="select * from users_table where user_ip='$user_ip'";
    $result_query=mysqli_query($con,$get_users);
    $run_query=mysqli_fetch_array($result_query);
    $user_id=$run_query['user_id'];

    ?>
    <div class="container">
        <h1 class="text-center text-success">Payment Options</h1>
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col-md-6">
            <a href="http://www.paypal.com" target= "_blank"><img src="../images/online_payment.jfif" alt="" class="payment_img"></a>

            </div>
            <div class="col-md-6">
             <a href="orders.php?user_id=<?php echo $user_id  ?>"><h2 class="text-center">Pay Later</h2></a>

            </div>
        </div>
    </div>
</body>
</html>