<?php
include('../includes/connect.php');  /* php code to link database to insert category*/
if(isset($_POST['insert_sales_rep'])){
    $Sales_rep_title=$_POST['Sales_rep_title'];

    //select data from database to check if inputed category exists//
    $select_query="Select * from sales_reps where sales_rep_name='$Sales_rep_title'";
    $result_select=mysqli_query($con,$select_query);
    $number=mysqli_num_rows($result_select); //counting number of rows available to check if it's greater than 0//
    if($number>0){
        echo "<script>alert('This Sales representative already exists')</script>";
    } else{
    //If data does not exist already it will be added by this code//
    $insert_query="insert into sales_reps (sales_rep_name) values ('$Sales_rep_title')"; 
    $result=mysqli_query($con,$insert_query);
    if($result){
        echo "<script>alert('Sales representative has been inserted succesfully')</script>";
    }
}
}
?>
<h2 class="text-center">Insert Sales Representatives</h2>

<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-success" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" name="Sales_rep_title" placeholder="insert sales reps" aria-label="sales reps" aria-describedby="basic-addon1">
</div>
<div class="input-group w-90 mb-2 m-auto">

 <input type="submit" class="bg-success border-0 p-2 my-3" name="insert_sales_rep" value="Insert sales reps">

</div>

</form>