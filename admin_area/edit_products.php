<?php   //No need to include connect.php and functions because this file is called from index.php//
if(isset($_GET['edit_products'])){
    $edit_id=$_GET['edit_products'];
    //echo $edit_id;
    $get_products="select * from products where product_id=$edit_id";
    $result=mysqli_query($con,$get_products);
    $row=mysqli_fetch_assoc($result);
    $inventory_title=$row['inventory_title'];
    $inventory_description=$row['inventory_description'];
    $product_keyword=$row['product_keyword'];
    $category_id=$row['category_id'];
    $sales_rep_id=$row['sales_rep_id'];
    $product_image=$row['product_image'];
    $product_price=$row['product_price'];

    //Fetching category name from the database//
    $select_category="Select * from categories where category_id=$category_id";
    $result_category=mysqli_query($con,$select_category);
    $row_category=mysqli_fetch_assoc($result_category);
    $category_title=$row_category['category_title'];

    //Fetching sales reps from the database//
    $select_sales_reps="Select * from sales_reps where sales_rep_id=$sales_rep_id";
    $result_sales_reps=mysqli_query($con,$select_sales_reps);
    $row_sales_reps=mysqli_fetch_assoc($result_sales_reps);
    $sales_rep_name=$row_sales_reps['sales_rep_name'];

}


?>

<div class="container mt-5">
    <h1 class="text-center">Edit Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="inventory_title" class="form-label">Inventory Title</label>
            <input type="text" id="inventory_title" name="inventory_title" value="<?php echo $inventory_title ?>" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="inventory_description" class="form-label">Inventory Desciption</label>
            <input type="text" id="inventory_description" name="inventory_description" value="<?php echo $inventory_description ?>"  class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keyword" class="form-label">Product keyword</label>
            <input type="text" id="product_keyword" name="product_keyword" value="<?php echo $product_keyword ?>"  class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
        <label for="product_category" class="form-label">Product Category</label> 
            <select name="product_category" class="form-select">
                <option value="<?php echo $category_title ?>"><?php echo $category_title ?></option>
                <?php
              $select_category_all="Select * from categories";
              $result_category_all=mysqli_query($con,$select_category_all);
             while($row_category_all=mysqli_fetch_assoc($result_category_all)){
                $category_title=$row_category_all['category_title'];
                $category_id=$row_category_all['category_id'];
                echo "<option value='$category_id'>$category_title</option>";

             }
              
              ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
        <label for="product_sales_reps" class="form-label">Product Sales Representatives</label>
            <select name="product_sales_reps" class="form-select">
                <option value="<?php echo $sales_rep_name ?>"><?php echo $sales_rep_name ?></option>
              <?php
              $select_sales_reps_all="Select * from sales_reps";
              $result_sales_reps_all=mysqli_query($con,$select_sales_reps_all);
             while($row_sales_reps_all=mysqli_fetch_assoc($result_sales_reps_all)){
                $sales_rep_name=$row_sales_reps_all['sales_rep_name'];
                $sales_rep_id=$row_sales_reps_all['sales_rep_id'];
                echo "<option value='$sales_rep_id'>$sales_rep_name</option>";

             }
              
              ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image" class="form-label">Product Image</label>
            <div class="d-flex">
            <input type="file" id="product_image" name="product_image" class="form-control w-90 m-auto" required="required">
            <img src="./product_images/<?php echo $product_image ?>" alt="" class="product_image">  
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product price</label>
            <input type="text" id="product_price" name="product_price" value="<?php echo $product_price ?>"  class="form-control" required="required">
        </div>
        <div class="text-center">
            <input type="submit" name="edit_product" value="Update Product" class="btn btn-success px-3 mb-3">
        </div>
    </form>
</div>

<!-- Editing the products in admin-->

<?php
if(isset($_POST['edit_product'])){
    $inventory_title=$_POST['inventory_title'];
    $inventory_description=$_POST['inventory_description'];
    $product_keyword=$_POST['product_keyword'];
    $product_category=$_POST['product_category'];
    $product_sales_reps=$_POST['product_sales_reps'];
    $product_price=$_POST['product_price'];
    $product_image=$_FILES['product_image'];
    
    $temp_image=$_FILES['product_image']['tmp_name'];

    //To check if any fields are empty//

    if($inventory_title=='' or $inventory_description=='' or $product_keyword=='' or $product_category=='' or $product_sales_reps=='' or $product_image=='' or $product_price==''){
      echo "<script>alert('Please fill in all the fields')</script>";
    }else{
        move_uploaded_file($temp_image,"./product_images/$product_image");
     
       //query to update products in inventory//
        $update_products="Update products set inventory_title='$inventory_title',inventory_description='$inventory_description',product_keyword='$product_keyword', category_id='$product_category',sales_rep_id='$product_sales_reps',product_price='$product_price',product_image='$product_image',Date=NOW()
        where product_id=$edit_id";
        $result_update=mysqli_query($con,$update_products);
        if($result_update){
            echo"<script>alert('Product updated successfully')</script>";
            echo"<script>window.open('./insert_inventory.php','_self')</script>"; 
        }
    }
}

?>