<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
      $username=$_SESSION['username'];
      $get_user="select * from users_table where username='$username'";
      $result_query=mysqli_query($con,$get_user);
      $row_fetched=mysqli_fetch_assoc($result_query);
      $user_id=$row_fetched['user_id'];
      //echo $user_id
   



    ?>
<h3 class="text-success text-center">All Orders</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-success">
    <tr>
        <th>Serial Number</th>
        <th>Amount Due</th>
        <th>Total Products</th>
        <th>Invoice number</th>
        <th>Date</th>
        <th>Complete/Incomplete</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody class="bg-secondary text-dark">

    <?php
    $get_orders="Select * from orders where user_id=$user_id";
    $result_orders=mysqli_query($con,$get_orders);
    $number=1;
    while($row_orders=mysqli_fetch_assoc($result_orders)){
        $order_id=$row_orders['order_id'];
        $amount=$row_orders['amount'];
        $invoice_number=$row_orders['invoice_number'];
        $total_products=$row_orders['total_products'];
        $order_id=$row_orders['order_id'];
        $order_status=$row_orders['order_status'];
        if($order_status=='pending'){
            $order_status='Incomplete';   
        }else{
            $order_status='Complete';
        }
        $order_date=$row_orders['order_date'];
        echo " <tr>
        <td>$number</td>
        <td>$amount</td>
        <td>$total_products</td>
        <td>$invoice_number</td>
        <td>$order_date</td>
        <td>$order_status</td>";
        ?>
        <?php
        if($order_status=='Complete'){
            echo "<td>Paid</td>";
        }else{
           echo"<td><a href='confirm_payment.php?order_id=$order_id' class='text-dark'>Confirm</a></td>
           </tr>"; 
        }
    $number++;


    }


    ?>
      <!--  <tr>
            <td>1</td>
            <td>100</td>
            <td>3</td>
            <td>20000</td>
            <td>313</td>
            <td>Complete</td>
            <td>Confirm</td>
        </tr> -->
    </tbody>
</table> 
</body>
</html>