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
    <title>Sales website</title>
    <!-- link the CSS file for logo-->
<link rel="stylesheet" href="style.css">
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
            <a class="nav-link" href="#">Register</a>
</li>
<li class="nav-item">
            <a class="nav-link" href="#">contact</a>
</li>
<li class="nav-item">
            <a class="nav-link" href="#"><i class="fa fa-thin fa-cart-shopping"></i><sup><?php cart_number(); ?></sup></a> <!-- Add another fa before to make it visible-->
</li>
<li class="nav-item">
            <a class="nav-link" href="#">Total: <?php total_cart_amount();?>/-</a>
</li>
 
      </ul>
      <form class="d-flex" role="search" action="search_inventory.php" method="get"> <!-- dflex places it in a horizontal place same as the search-->
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
      <!--  <button class="btn btn-outline-white" type="submit">Search</button> -->
      <input type="submit" value="Search" class="btn" name="search_inventory">
      </form>
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

<!-- fourth-->
<div class="row px-2">
    <div class="col-md-10">
        <!-- goods in inventory-->
        <div class="row">
        
          <!-- Displaying inventory items in sales page-->
     <?php
     //inventory function//
       view_more();
       getunique_categories();
       getunique_salesreps();
     ?>
    </div>  <!-- row end DIV-->
    </div>  <!-- Column end DIV and both row and column must be outside the bootstrap class-->

    <div class="col-md-2 bg-success p-0">
        <!-- Sales reps list-->
    <ul class="navbar-nav me-auto text-center">
    <li class="nav-item bg-secondary">
            <a class="nav-link text-light" href="#"><h4>Sales rep</h4></a>
</li>
<?php 
//sales representative function//
 getsalesreps();
?>

</ul>

<!--Categories list--> 
<ul class="navbar-nav me-auto text-center">
    <li class="nav-item bg-secondary">
            <a class="nav-link text-light" href="#"><h4>Category</h4></a>
</li>
<?php
//category function//
 getcategories();
?>

</ul>
    </div>
</div>








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