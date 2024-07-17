<?php
if(isset($_GET['delete_sales_reps'])){
    $delete_sales_reps=$_GET['delete_sales_reps'];


    $delete_sales_reps_query="delete from sales_reps where sales_rep_id=$delete_sales_reps";
    $result_delete_sales_reps=mysqli_query($con,$delete_sales_reps);
    if($result_delete_sales_reps){
        echo"<script>alert('Sales representative has been deleted successfully')</script>";
        echo"<script>window.open('./index.php?view_sales_reps','_self')</script>";
    }
}


?>