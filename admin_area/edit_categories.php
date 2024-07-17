<?php
if(isset($_GET['edit_category'])){
    $edit_category=$_GET['edit_category']; //storing the vategory id fetched in a different varuable//
    //echo $edit_category;

    $get_categories="Select * from categories where category_id=$edit_category";
    $result_categories=mysqli_query($con,$get_categories);
    $row_fetched=mysqli_fetch_assoc($result_categories);
    $category_title=$row_fetched['category_title'];
}


if(isset($_POST['edit_category'])){ //when the update category button is clicked//
    $cat_title=$_POST['category_title'];

    $update_query="Update categories set category_title='$cat_title' where category_id=$edit_category";
    $result_cat=mysqli_query($con,$update_query);
    if($result_cat){
        echo"<script>alert('Category has been updated successfully')</script>";
        echo"<script>window.open('./index.php?view_category','_self')</script>";
    }
}


?>

<div class="container mt-3">
    <h1 class="text-center text-success">Edit Categories</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="category_title" class="form-label">Category Title</label>
            <input type="text" name="category_title" id="category_title" value="<?php echo $category_title; ?>" class="form-control" required="required">
        </div>
        <input type="submit" value="Update Category" class="btn btn-success px-3 mb-3" name="edit_category">
    </form>
</div>