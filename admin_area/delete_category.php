<?php
if(isset($_GET['delete_category'])){
    $delete_category=$_GET['delete_category'];
    //echo $delete_category;

    $delete_query="delete from categories where category_id=$delete_category";
    $result_delete=mysqli_query($con,$delete_query);
    if($result_delete){
        echo"<script>alert('Category has been deleted successfully')</script>";
        echo"<script>window.open('./index.php?view_category','_self')</script>";
    }
}


?>