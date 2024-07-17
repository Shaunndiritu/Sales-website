<?php
include('../includes/connect.php');  /* php code to link database to insert category*/
if(isset($_POST['insert_cat'])){   //Insert_cat is the name attribute given to the insert category button(bottom of the code) NB: Not the value (value is the name displayed on top of the button)
    $category_title=$_POST['cat_title'];

    //select data from database to check if inputed category exists//
    $select_query="Select * from categories where category_title='$category_title'";
    $result_select=mysqli_query($con,$select_query);
    $number=mysqli_num_rows($result_select); //counting number of rows available to check if it's greater than 0//
    if($number>0){
        echo "<script>alert('This category already exists')</script>";
    } else{
    //If data does not exist already it will be added by this code//
    $insert_query="insert into categories (category_title) values ('$category_title')"; 
    $result=mysqli_query($con,$insert_query);
    if($result){
        echo "<script>alert('Category has been inserted succesfully')</script>";
    }
}
}
?>
<h2 class="text-center">Insert Categories</h2>
<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-success" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" name="cat_title" placeholder="insert categories" aria-label="categories" aria-describedby="basic-addon1">
</div>
<div class="input-group w-90 mb-2 m-auto">

 <input type="submit" class="bg-success boarder-0 p-2 my-3" name="insert_cat" value="Insert categories">

</div>

</form>