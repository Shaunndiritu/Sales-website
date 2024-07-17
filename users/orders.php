<?php 
 include('../includes/connect.php');
 include('../functions/common.php');
 
 if(isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];
 }


 //get total items and total price for all items in the cart//
 $get_ip_address=getIPAddress();
 $total_amount=0;
 $cart_query_price="select * from cart_table where ip_address='$get_ip_address'";
 $result_cart_query_price=mysqli_query($con,$cart_query_price);
 $invoice_number=mt_rand(); //mt_rand displays a random invoice number and it was copied from php math functions online//
 $status='pending';
 $count_products=mysqli_num_rows($result_cart_query_price);
 while($row_price=mysqli_fetch_array($result_cart_query_price)){
    $product_id=$row_price['product_id'];
    $select_product="select * from products where product_id=$product_id";
    $run_price=mysqli_query($con,$select_product);

    while($row_product_price=mysqli_fetch_array($run_price)){
        $product_price=array($row_product_price['product_price']); //array stores data in array//
        $total_product_price=array_sum($product_price); //array_sum adds all data in the array//
        $total_amount+=$total_product_price;
    }


 }


 //Getting quantity from cart//
 $get_cart="select * from cart_table";
 $run_cart=mysqli_query($con,$get_cart);
 $get_product_quantity=mysqli_fetch_array($run_cart);
 $quantity_fetched=$get_product_quantity['quantity'];

 if($quantity_fetched==0){
     //If quantity is equal to 0 then the quantity becomes only 1
    $quantity_fetched=1;
    $subtotal=$total_amount;

 } else{
    //if quantity is greater than 0 then it it quantity multiplied by total amount//
    $quantity_fetched=$quantity_fetched;
    $subtotal=$total_amount*$quantity_fetched;
 }

//Inserting orders into orders table// //single quotes in $status because in the database it is in varchar. Any varchar is closed with single quotes//
$insert_orders="insert into orders (user_id,amount,invoice_number,total_products,order_date,order_status) values($user_id,$subtotal,$invoice_number,$count_products,NOW(),'$status')";
$result_query=mysqli_query($con,$insert_orders);
if($result_query){
    echo "<script>alert('Orders placed successfully')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}

//insert pending orders to pending orders table//
$insert_pending_orders="insert into pending_orders (user_id,invoice_number,inventory_id,quantity,order_status) values($user_id,$invoice_number,$product_id,$quantity_fetched,'$status')";
$result_pending_orders=mysqli_query($con,$insert_pending_orders);


//Delete items from cart after it has been inserted in pending orders table and orders table//
$empty_cart="Delete from cart_table where ip_address='$get_ip_address'";
$delete_result=mysqli_query($con,$empty_cart);



?>
