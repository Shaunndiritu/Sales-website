<?php  /* Connecting file*/
include('../includes/connect.php');
include('../functions/common.php');
session_start();
if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];
   // echo $order_id;
   $select_data="Select * from orders where order_id='$order_id'";
   $result=mysqli_query($con,$select_data);
   $row_fetch=mysqli_fetch_assoc($result);
   $invoice_number=$row_fetch['invoice_number'];
   $amount=$row_fetch['amount']; 
}

if(isset($_POST['Confirm'])){
    $invoice_number=$_POST['invoice_number'];
    $amount=$_POST['amount'];
    $payment_mode=$_POST['payment_mode'];
    $insert_query="insert into user_payments (order_id,invoice_number,amount,payment_mode) values ($order_id,$invoice_number,$amount,'$payment_mode')";
    $result=mysqli_query($con,$insert_query);
    if($result){
        echo "<h3 class='text-center'>Payment completed successfully</h3>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";  //You can 
    }
    $update_orders="update orders set order_status='complete' where order_id=$order_id";
    $result_orders=mysqli_query($con,$update_orders);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- Bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body class="bg-success">
    <div class="container my-5">
    <h1 class="text-center text-dark">Confirm Payment</h1>
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value=<?php echo $invoice_number  ?>>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value=<?php echo $amount  ?>>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option>Select Payment Mode</option>
                    <option>Mpesa</option>
                    <option>Banking</option>
                    <option>Paypal</option>
                    <option>Cash on Delivery</option>
                  <!--  <option>Pay offline</option> -->
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-secondary py-2 px-3 border-0" value="Confirm" name="Confirm">
            </div>
        </form>
    </div>
    
</body>
</html>