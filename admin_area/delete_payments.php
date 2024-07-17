<?php
if(isset($_GET['delete_payments'])){
    $delete_payments=$_GET['delete_payments'];

     //Query to delete the orders from order table//
     $delete_user_payments="Delete from user_payments where payment_id=$delete_payments";
     $result_deleted_payments=mysqli_query($con,$delete_user_payments);
     if($result_deleted_payments){
         echo"<script>alert('Payment deleted successfully')</script>";
         echo"<script>window.open('./index.php?list_payments','_self')</script>";
     }

}
?>