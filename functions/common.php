<?php
//Connecting database by including connect file//
 //include('./includes/connect.php');

//Getting inventory//
function getinventory(){
    global $con;
     //If statement to check if sales reps and category are set//
     if(!isset($_GET['category'])){   //'category' is the variable used in the url when you click on category
     if(!isset($_GET['sales_rep'])){
    $select_query="Select * from products order by rand() LIMIT 0,9"; //Rand is used to display random products eveytime you refresh // after rand() you can write LIMIT 0,9 to signify 9 items per page
    $result_query=mysqli_query($con,$select_query);
    while($row=mysqli_fetch_assoc($result_query)){
      $product_id=$row['product_id'];
      $inventory_title=$row['inventory_title'];
      $inventory_description=$row['inventory_description'];
      $category_id=$row['category_id'];
      $sales_rep_id=$row['sales_rep_id'];
      $product_price=$row['product_price'];
      echo "<div class='col-md-4 mb-2'>
      <div class='card'>
<div class='card-header'>
<b>$inventory_title</b>
</div>
<div class='card-body'>
  <p class='card-text'>$inventory_description</p>
  <p class='card-text'>Price: $product_price/-</p>
  <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
  <a href='inventory_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
</div>
</div>
</div>";
    }

} 
}
}

//Get all products in inventory
function get_all_products(){
    global $con;
     //If statement to check if sales reps and category are set//
     if(!isset($_GET['category'])){   //'category' is the variable used in the url when you click on category
     if(!isset($_GET['sales_rep'])){
    $select_query="Select * from products order by rand()"; //Rand is used to display random products eveytime you refresh // after rand() you can write LIMIT 0,9 to signify 9 items per page
    $result_query=mysqli_query($con,$select_query);
    while($row=mysqli_fetch_assoc($result_query)){
      $product_id=$row['product_id'];
      $inventory_title=$row['inventory_title'];
      $inventory_description=$row['inventory_description'];
      $category_id=$row['category_id'];
      $sales_rep_id=$row['sales_rep_id'];
      $product_price=$row['product_price'];
      echo "<div class='col-md-4 mb-2'>
      <div class='card'>
<div class='card-header'>
<b>$inventory_title</b>
</div>
<div class='card-body'>
  <p class='card-text'>$inventory_description</p>
  <p class='card-text'>Price: $product_price/-</p>
  <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
  <a href='inventory_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
</div>
</div>
</div>";
    }

} 
}
}

//Getting unique categories
function getunique_categories(){
    global $con;
     //If statement to check if category are set//
     if(isset($_GET['category'])){
        $category_id=$_GET['category'];
    $select_query="Select * from products where category_id=$category_id"; 
    $result_query=mysqli_query($con,$select_query);
    $rows_fetched=mysqli_num_rows($result_query);
    if($rows_fetched==0){
      echo "<h3 class='text-center text-success'>No products in this category</h3>";
    }
    while($row=mysqli_fetch_assoc($result_query)){
      $product_id=$row['product_id'];
      $inventory_title=$row['inventory_title'];
      $inventory_description=$row['inventory_description'];
      $category_id=$row['category_id'];
      $sales_rep_id=$row['sales_rep_id'];
      $product_price=$row['product_price'];
      echo "<div class='col-md-4 mb-2'>
      <div class='card'>
<div class='card-header'>
<b>$inventory_title</b>
</div>
<div class='card-body'>
  <p class='card-text'>$inventory_description</p>
  <p class='card-text'>Price: $product_price/-</p>
  <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
  <a href='inventory_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
</div>
</div>
</div>";
    }

} 
}

//Getting unique sales representatives
function getunique_salesreps(){
  global $con;
   //If statement to check if category are set//
   if(isset($_GET['sales_rep'])){
      $sales_rep_id=$_GET['sales_rep'];
  $select_query="Select * from products where sales_rep_id=$sales_rep_id"; 
  $result_query=mysqli_query($con,$select_query);
  $rows_fetched=mysqli_num_rows($result_query);
  if($rows_fetched==0){
    echo "<h3 class='text-center text-success'>No products are represented by the sales representative</h3>";
  }
  while($row=mysqli_fetch_assoc($result_query)){
    $product_id=$row['product_id'];
    $inventory_title=$row['inventory_title'];
    $inventory_description=$row['inventory_description'];
    $category_id=$row['category_id'];
    $sales_rep_id=$row['sales_rep_id'];
    $product_price=$row['product_price'];
    echo "<div class='col-md-4 mb-2'>
    <div class='card'>
<div class='card-header'>
<b>$inventory_title</b>
</div>
<div class='card-body'>
<p class='card-text'>$inventory_description</p>
<p class='card-text'>Price: $product_price/-</p>
<a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
<a href='inventory_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
</div>
</div>
</div>";
  }

} 
}

//Sales representative function//
function getsalesreps(){ 
    global $con;
    $select_sales_reps="Select * from sales_reps"; /*Don't put from 'sales_reps' just put from sales_reps*/
$result_sales_reps=mysqli_query($con,$select_sales_reps);
while($row_data=mysqli_fetch_assoc($result_sales_reps)){
  $sales_rep_title=$row_data['sales_rep_name'];
  $sales_rep_id=$row_data['sales_rep_id'];
  echo " <li class='nav-item'>
  <a href='index.php?sales_rep=$sales_rep_id' class='nav-link text-light'>$sales_rep_title</a>
</li>";
}

}

//category functions//
function getcategories(){
    global $con;
    $select_categories="Select * from categories"; /*Don't put from 'sales_reps' just put from sales_reps*/
$result_categories=mysqli_query($con,$select_categories);
while($row_data=mysqli_fetch_assoc($result_categories)){
  $category_title=$row_data['category_title'];
  $category_id=$row_data['category_id'];
  echo " <li class='nav-item'>
  <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a> 
</li>"; /*Inserts the category id and sales reps Id respectfully when you hover over either*/
}
}

//Search inventory
function search_inventory(){
  global $con;
  if(isset($_GET{'search_inventory'})){
    $search_inventory=$_GET['search_data'];
    $search_query="Select * from products where product_keyword like '%$search_inventory%'";
 $result_query=mysqli_query($con,$search_query);
 $rows_fetched=mysqli_num_rows($result_query);
 if($rows_fetched==0){
    echo "<h3 class='text-center text-success'>No such product</h3>";
      }
 while($row=mysqli_fetch_assoc($result_query)){
   $product_id=$row['product_id'];
   $inventory_title=$row['inventory_title'];
   $inventory_description=$row['inventory_description'];
   $category_id=$row['category_id'];
   $sales_rep_id=$row['sales_rep_id'];
   $product_price=$row['product_price'];
   echo "<div class='col-md-4 mb-2'>
   <div class='card'>
<div class='card-header'>
<b>$inventory_title</b>
</div>
<div class='card-body'>
<p class='card-text'>$inventory_description</p>
<p class='card-text'>Price: $product_price/-</p>
<a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
<a href='inventory_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
</div>
</div>
</div>";
 }

} 
}


//view more button function//
function view_more(){
  global $con;
  //If statement to check if sales reps and category are set//
  if(isset($_GET['product_id'])){
  if(!isset($_GET['category'])){   //'category' is the variable used in the url when you click on category
  if(!isset($_GET['sales_rep'])){
    $product_id=$_GET['product_id'];
 $select_query="Select * from products where product_id=$product_id";
 $result_query=mysqli_query($con,$select_query);
 while($row=mysqli_fetch_assoc($result_query)){
   $product_id=$row['product_id'];
   $inventory_title=$row['inventory_title'];
   $inventory_description=$row['inventory_description'];
   $category_id=$row['category_id'];
   $sales_rep_id=$row['sales_rep_id'];
   $product_price=$row['product_price'];
   $product_image=$row['product_image'];
   echo "<div class='col-md-4 mb-2'>
   <div class='card'>
<div class='card-header'>
<b>$inventory_title</b>
</div>
<div class='card-body'>
<p class='card-text'>$inventory_description</p>
<p class='card-text'>Price: $product_price/-</p>
<a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
<a href='index.php' class='btn btn-secondary'>Home</a>
</div>
</div>
</div>

<div class='col-md-8'>
            <div class='col-md-6'>
                <h4 class='text-center text-success mb-2'>Related Information</h4>
            </div>
            <div class='col-md-6'>
           <img src='./admin_area/product_images/$product_image' class='img-thumbnail' width='300' alt='$inventory_title'>

            </div>
           </div>";
 }

} 
}
}
}


//Get Ip address (has been referenced from the internet)//
function getIPAddress() {  
  //whether ip is from the share internet  
   if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  //Remove the double empty on the ifs' statements and remain with one empty
              $ip = $_SERVER['HTTP_CLIENT_IP'];  
      }  
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
              $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
   }  
//whether ip is from the remote address  
  else{  
           $ip = $_SERVER['REMOTE_ADDR'];  
   }  
   return $ip;  
}  
//$ip = getIPAddress();  
//echo 'User Real IP Address - '.$ip;  

//Add to cart function//
function add_cart(){
    if(isset($_GET['add_to_cart'])){
      global $con;
      $ip = getIPAddress();   //$ip is the variable that stores the ip address
      $get_product_id=$_GET['add_to_cart'];
      $select_query="Select * from cart_table where ip_address='$ip' and product_id=$get_product_id";
      $result_query=mysqli_query($con,$select_query);
      $rows_fetched=mysqli_num_rows($result_query);
    if($rows_fetched>0){
    echo "<script>alert('Item already in cart')</script>";
    echo "<script>window.open('index.php','_self')</script>";
      } else{
        $insert_query="insert into cart_table (product_id,ip_address,quantity) values ($get_product_id,'$ip',0)";
        $result_query=mysqli_query($con,$insert_query);
        echo "<script>alert('Item Succesfully added to cart')</script>";
        echo "<script>window.open('index.php','_self')</script>"; 
      }


}
}


//changing cart number from static to dyanmic//
function cart_number(){
  if(isset($_GET['add_to_cart'])){
    global $con;
    $ip = getIPAddress();   //$ip is the variable that stores the ip address
    $select_query="Select * from cart_table where ip_address='$ip'";
    $result_query=mysqli_query($con,$select_query);
    $cart_items_fetched=mysqli_num_rows($result_query);
    } else{
      global $con;
    $ip = getIPAddress();   //$ip is the variable that stores the ip address
    $select_query="Select * from cart_table where ip_address='$ip'";
    $result_query=mysqli_query($con,$select_query);
    $cart_items_fetched=mysqli_num_rows($result_query); 
    }
    echo $cart_items_fetched;
}


//total cart price//
function total_cart_amount(){
  global $con;
  $ip = getIPAddress();
  $total_sum=0;
  $cart_query="Select * from cart_table where ip_address='$ip'";
  $result_query=mysqli_query($con,$cart_query);
  while($row=mysqli_fetch_array($result_query)){
    $product_id=$row['product_id'];
    $select_products="Select * from products where product_id='$product_id'";
    $result_products=mysqli_query($con,$select_products);
    while($row_product_price=mysqli_fetch_array($result_products)){
      $product_price=array($row_product_price['product_price']); //Stores the price of every product added to cart in an array//
      $product_values=array_sum($product_price); //sums the total values in the array above//
      $total_sum+=$product_values;
    
  }
}
   echo $total_sum;
}


//get user order details//
function get_user_order_details(){
  global $con;
  $username=$_SESSION['username'];
  $get_details="Select * from users_table where username='$username'";
  $result_query=mysqli_query($con,$get_details);
  while($row_query=mysqli_fetch_array($result_query)){
    $user_id=$row_query['user_id'];
    if(!isset($_GET['edit_account'])){
      if(!isset($_GET['my_orders'])){
        if(!isset($_GET['delete_account'])){ 
          $get_orders="Select * from orders where user_id=$user_id and order_status='pending'";
          $result_order_query=mysqli_query($con,$get_orders);
          $row_count=mysqli_num_rows($result_order_query);
          if($row_count>0){
            echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-success'>$row_count</span> pending orders</h3>
            <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";
          } else{
            echo "<h3 class='text-center text-success mt-5 mb-2'>You have zero pending orders</h3>
            <p class='text-center'><a href='../index.php' class='text-dark'>Browse Inventory</a></p>";
          }
    }
  }
}
}
}
?>