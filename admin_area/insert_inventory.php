<?php
include('../includes/connect.php');
if(isset($_POST['Insert_inventory'])){
    $inventory_title=$_POST['Inventory_title'];
    $Inventory_description=$_POST['Inventory_description'];
    $Product_keyword=$_POST['Product_keyword'];
    $product_category=$_POST['product_category'];
    $product_Sales_reps=$_POST['product_Sales_reps'];
    $Product_price=$_POST['Product_price'];
    $product_status='True';

    //accessing image//
    $product_image=$_FILES['product_image']['name'];

    //accessing image tmp name//
    $temp_image=$_FILES['product_image']['tmp_name'];

    //Checking if insert inventory is empty//
    if($inventory_title=='' or $Inventory_description=='' or $Product_keyword=='' or $product_category=='' or $product_Sales_reps=='' or $Product_price=='' or $product_image==''){
        echo "<script>alert('Please input all fields')</script>"; //Basic java code//
        exit();
    } else{
        move_uploaded_file($temp_image,"./product_images/$product_image");
        //insert Query to insert inventory to database//
        $insert_inventory="insert into products (inventory_title,inventory_description,product_keyword,category_id,sales_rep_id,product_price,product_image,Date,Status)
        values ('$inventory_title','$Inventory_description','$Product_keyword','$product_category','$product_Sales_reps','$Product_price','$product_image',NOW(),'$product_status')";
        $result_query=mysqli_query($con,$insert_inventory);
        if($result_query){
            echo "<script>alert('Product succesfully inserted')</script>";
        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert inventory- Admin dashboard</title>

    <!-- link the CSS file for logo-->
    <link rel="stylesheet" href="style.css">

    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <!-- font awesome link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="bg-success">
    <div class="container mt-3">
        <h1 class="text-center">Insert inventory</h1>
        <!-- Form for inputting inventory-->
        <form action="" method="post" enctype="multipart/form-data">
            <!--title-->
            <div class="form-outline mb-4 m-auto">
                <label for="Inventory_title" class="form-label">Inventory title</label>
                <input type="text" name="Inventory_title" id="Inventory_title" class="form-control" placeholder="Enter inventory title" autocomplete="off" required="required"> <!--autocomplete="off" makes sure you are not promted with previous entries to ensure privacy-->

            </div>
            
            <!--Description-->
            <div class="form-outline mb-4 m-auto">
                <label for="inventory_description" class="form-label">Inventory description</label>
                <input type="text" name="Inventory_description" id="inventory_description" class="form-control" placeholder="Enter inventory description" autocomplete="off" required="required"> 
            </div>  
             <!-- Keyword-->
            <div class="form-outline mb-4 m-auto">
                <label for="Product_keyword" class="form-label">Product Keyword</label>
                <input type="text" name="Product_keyword" id="Product_keyword" class="form-control" placeholder="Enter product keyword" autocomplete="off" required="required"> 
            </div>  

            <!--Categories list-->
            <div class="form-outline mb-4 m-auto">
                <select name="product_category" id="" class="form-select">
                    <option value="">Select a category</option>
                    <?php
                    $select_query="select * from categories";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $category_title=$row['category_title'];
                        $category_id=$row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";

                    }
                    ?>

                </select>
            </div> 
             <!--Sales reps list-->
             <div class="form-outline mb-4 m-auto">
                <select name="product_Sales_reps" id="" class="form-select">
                    <option value="">Select a sales representative</option>
                    <?php
                    $select_query="select * from sales_reps";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $sales_rep_name=$row['sales_rep_name'];
                        $sales_rep_id=$row['sales_rep_id'];
                        echo "<option value='$sales_rep_id'>$sales_rep_name</option>";

                    }
                    ?>

                </select>
            </div> 

         <!--Product price-->
         <div class="form-outline mb-4 m-auto">
                <label for="Product_price" class="form-label">Product price</label>
                <input type="text" name="Product_price" id="Product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required"> 
            </div>

             <!-- images-->
             <div class="form-outline mb-4 m-auto">
                <label for="product_image" class="form-label">Product Image</label>
                <input type="file" name="product_image" id="product_image" class="form-control" required="required"> 
            </div>  

         <!--Insert into inventory-->
         <div class="form-outline mb-4 m-auto">
         <input type="Submit" name="Insert_inventory" class="btn btn-secondary mb-3 px-3" value="Insert to inventory">
        </div>
        </form>
    </div>
    
</body>
</html>