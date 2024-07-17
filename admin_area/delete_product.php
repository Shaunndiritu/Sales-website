<?php

if(isset($_GET['delete_products'])){
    $delete_id=$_GET['delete_products'];
    // echo "$delete_id";

    //Query to delete the products from inventory//
    $delete_products="Delete from products where product_id=$delete_id";
    $result_deleted_products=mysqli_query($con,$delete_products);
    if($result_deleted_products){
        echo"<script>alert('Product deleted successfully')</script>";
        echo"<script>window.open('./index.php','_self')</script>";
    }
}


?>