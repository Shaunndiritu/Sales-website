<?php
if(isset($_GET['delete_orders'])){
    $delete_orders=$_GET['delete_orders'];

     //Query to delete the orders from order table//
     $delete_user_orders="Delete from orders where order_id=$delete_orders";
     $result_deleted_orders=mysqli_query($con,$delete_user_orders);
     if($result_deleted_orders){
         echo"<script>alert('Order deleted successfully')</script>";
         echo"<script>window.open('./index.php?list_orders','_self')</script>";
     }

}
?>