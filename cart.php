<?php  /* Connecting file*/
include('includes/connect.php');
include('functions/common.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales website-Cart details</title>
    <!-- link the CSS file for logo-->
<link rel="stylesheet" href="style.css">
<style>
    .cart_image{
    width: 80px;
    height: 80px;
    object-fit: contain;
}
</style>
</head>
<!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<!-- font awesome link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<body>
    <!--navigation bar-->
    <div class="container-fluid p-0"> <!-- will take 100% of the width-->
    <!--first-->
    <nav class="navbar navbar-expand-lg bg-success">
  <div class="container-fluid">
 <img src="./images/sales logo.png" alt="" class="saleslogo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="display.php">Products</a>
</li>
<li class="nav-item">
            <a class="nav-link" href="./users/user_registration.php">Register</a>
</li>
<li class="nav-item">
            <a class="nav-link" href="#">contact</a>
</li>
<li class="nav-item">
            <a class="nav-link" href="cart.php"><i class="fa fa-thin fa-cart-shopping"></i><sup><?php cart_number(); ?></sup></a> <!-- Add another fa before to make it visible-->
</li>
 
      </ul>
    </div>
  </div>
</nav>


<!-- Calling add to cart function-->
<?php
add_cart();
?>


<!-- second-->
<nav class="navbar navbar-expand-lg bg-secondary">
    <ul class="navbar-nav me-auto">
<?php
//if statement to display welcome concatinated with the name of the username//
if(!isset($_SESSION['username'])){
  echo "  <li class='nav-item'>
  <a class='nav-link' href='#'>Welcome Customer</a>
</li>";
} else{
  echo "<li class='nav-item'>
  <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
</li>";
}

if(!isset($_SESSION['username'])){
  echo "<li class='nav-item'>
  <a class='nav-link' href='./users/user_login.php'>Login</a>
</li>";
} else{
  echo "<li class='nav-item'>
  <a class='nav-link' href='./users/logout.php'>Logout</a>
</li>";
}
?>

    </ul> <!--making navigation mergin auto-->
</nav>

<!--third-->
<div class="bg-secondary">
    <h3 class="text-center bg-white">Inventory</h3>
</div>

<!--Fourth-->
<div class="container">
    <div class="row">
        <form action="" method="post">
        <table class="table table-bordered text-center">
        <!--    <thead>
                <tr>
                    <th class="text-success">Product title</th>
                    <th class="text-success">Product image</th>
                    <th class="text-success">Quantity</th>
                    <th class="text-success">Total price</th>
                    <th class="text-success">Remove</th>
                    <th colspan="2" class="text-success">Operations</th>
                </tr>
            </thead>
            <tbody> -->
                <!-- PHP code for dynamic data of cart-->
                <?php
                    global $con;
                    $ip = getIPAddress();
                    $total_sum=0;
                    $cart_query="Select * from cart_table where ip_address='$ip'";
                    $result_query=mysqli_query($con,$cart_query);
                    $rows_counted=mysqli_num_rows($result_query);
                    if($rows_counted>0){
                        echo " <thead>
                        <tr>
                            <th class='text-success'>Product title</th>
                            <th class='text-success'>Product image</th>
                            <th class='text-success'>Quantity</th>
                            <th class='text-success'>Total price</th>
                            <th class='text-success'>Remove</th>
                            <th colspan='2' class='text-success'>Operations</th>
                        </tr>
                    </thead>
                    <tbody>";
                    while($row=mysqli_fetch_array($result_query)){
                      $product_id=$row['product_id'];
                      $select_products="Select * from products where product_id='$product_id'";
                      $result_products=mysqli_query($con,$select_products);
                      while($row_product_price=mysqli_fetch_array($result_products)){
                        $product_price=array($row_product_price['product_price']); //Stores the price of every product added to cart in an array//
                        $price_table=$row_product_price['product_price'];
                        $inventory_title=$row_product_price['inventory_title'];
                        $product_image=$row_product_price['product_image'];
                        $product_values=array_sum($product_price); //sums the total values in the array above//
                        $total_sum+=$product_values;
                  
                
                ?>


                <tr>
                    <td><?php echo $inventory_title?></td> <!-- add echo so that it can be displayed-->
                    <td><img src="./admin_area/product_images/<?php echo $product_image?>" alt="" class="cart_image"></td>
                    <td><input type="text" name="quantity" id="" class="form-input w-50"></td>
                     
                    <!-- PHP code to add quantity to cart-->
                    <?php
              $ip = getIPAddress();
              if(isset($_POST['update_cart'])){
                $quantity=$_POST['quantity'];
                $update_cart="update cart_table set Quantity=$quantity where ip_address='$ip'";
                $result_products_amount=mysqli_query($con,$update_cart);
                $total_sum=$total_sum*$quantity;
              }

                    
                    ?>

                    <td><?php echo $price_table?>/-</td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id  ?>"></td>
                    <td>
                        <input type="submit" value="Update cart" class="bg-success px-3 py-2 border-0 mx-3" name="update_cart">
                       <!-- <button class="bg-success px-3 py-2 border-0 mx-3">Update</button> -->
                      <!--  <button class="bg-success px-3 py-2 border-0 mx-3">Remove</button> -->
                      <input type="submit" value="Delete" class="bg-success px-3 py-2 border-0 mx-3" name="delete_cart">
                    </td>
                </tr>
                <?php

                  }
                } 
            } 
         
            else{
                echo "<h2 class='text-center text-success'>No items in cart</h2>";
            }
            

                ?>
            </tbody>
        </table>
        <!--Subtotal-->
        <div class="d-flex mb-3">
            <?php
              global $con;
              $ip = getIPAddress();
              $cart_query="Select * from cart_table where ip_address='$ip'";
              $result_query=mysqli_query($con,$cart_query);
              $rows_counted=mysqli_num_rows($result_query);
              if($rows_counted>0){
                echo"<h4 class='px-3'> Subtotal: <strong class='text-success'>$total_sum/-</strong></h4>
                <input type='submit' value='Continue shopping' class='bg-success px-3 py-2 border-0 mx-3' name='continue_shopping'>
                <button class='bg-success px-3 py-2 border-0'><a href='./users/checkout.php' class='text-dark text-decoration-none'>Checkout</button>";  //Href(anchor tag) can come after the button before the name to make it work//
              }
              else{
                echo "<input type='submit' value='Continue shopping' class='bg-success px-3 py-2 border-0 mx-3' name='continue_shopping'>";
              }

              if(isset($_POST['continue_shopping'])){
                echo "<script>window.open('index.php','_self')</script>";  //_self because when the button is clicked it opens on the same tab//
              }


            ?>
        </div>
    </div>
</div>
</form>

<!-- Removing products from cart function-->
<?php
function remove_products(){
    global $con;
    if(isset($_POST['delete_cart'])){
        foreach($_POST['removeitem'] as $remove_id){
            echo $remove_id;
            $delete_query="Delete from cart_table where product_id=$remove_id";
            $run_delete_query=mysqli_query($con,$delete_query);
            if($run_delete_query){
                echo "<script>window.open('cart.php','_self')</script>";
            }
        }
    }


}
echo $remove_product=remove_products();

?>



<!-- last-->
<!-- Include footer ( all rights reserved)-->
   <?php
    include("./includes/footer.php")
   ?>
</div>




<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html> 