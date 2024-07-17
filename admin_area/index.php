<?php 
 include('../includes/connect.php');
 include('../functions/common.php');
 session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <!--bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Link CSS file for image editing( if it doesnt work when written in style css-->
    <link rel="stylesheet" href="../style.css">
    <style>
        .Administrator_image{
    width: 100px;
    object-fit: contain;
     }

    .product_image{
        width:100px;
        object-fit:contain;
    } 
    </style>

</head>
<body>
    <!-- navigation bar-->
    <div class="container-fluid p-0">
        <!-- first-->
        <nav class="navbar navbar-expand-lg navbar-light bg-success">
            <div class="container-fluid">
                <img src="../images/sales logo.png" alt="" class="saleslogo">
                <nav class="navbar navbar-expand-lg">
                    <ul class= "navbar-nav">
                    <?php
if(!isset($_SESSION['admin_name'])){
  echo "  <li class='nav-item'>
  <a class='nav-link' href='#'>Welcome Customer</a>
</li>";
} else{
  echo "<li class='nav-item'>
  <a class='nav-link' href='#'>Welcome ".$_SESSION['admin_name']."</a>
</li>";
}

?>

        
                    </ul>

                </nav>
            </div>  <!--Container fluid takes 100% of the width-->
        </nav>

        <!--Second-->
        <div class="bg-light">
            <h2 class="text-center p-2">Manage Inventory</h2>
        </div>
        <!--Third-->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-4">
                    <a href="#"><img src="../images/maleuser.jpg" alt="" class="Administrator_image"></a>
                    <p class="text-light text-center"><?php
if(!isset($_SESSION['admin_name'])){
  echo "  <li class='nav-item'>
  <a class='nav-link' href='#'>Welcome Admin</a>
</li>";
} else{
  echo "<li class='nav-item'>
  <a class='nav-link' href='#'>".$_SESSION['admin_name']."</a>
</li>";
}

?></p>
                </div>
                <!-- button*10>a.nav-link.text-light.bg-success.my-2 (code written to display the buttons below)-->
                <div class="button text-center">
                    <button class="my-3"><a href="insert_inventory.php" class="nav-link text-light bg-success my-2">Insert products</a></button>
                    <button><a href="index.php?view_products" class="nav-link text-light bg-success my-2">View products</a></button>
                    <button><a href="index.php?insert_category" class="nav-link text-light bg-success my-2">Insert categories</a></button>
                    <button><a href="index.php?view_category" class="nav-link text-light bg-success my-2">View categories</a></button>
                    <button><a href="index.php?insert_sales_rep" class="nav-link text-light bg-success my-2">Insert sales rep</a></button>
                    <button><a href="index.php?view_sales_reps" class="nav-link text-light bg-success my-2">View sales rep</a></button>
                    <button><a href="index.php?list_orders" class="nav-link text-light bg-success my-2">Orders</a></button>
                    <button><a href="index.php?list_payments" class="nav-link text-light bg-success my-2">Payments</a></button>
                    <button><a href="index.php?list_users" class="nav-link text-light bg-success my-2">Users list</a></button>
                    <button><a href="" class="nav-link text-light bg-success my-2"><?php if(!isset($_SESSION['admin_name'])){
  echo "<a class='nav-link' href='admin_login.php'>Login</a>";
} else{
  echo "
  <a class='nav-link' href='admin_logout.php'>Logout</a>";
} ?></a></button>
                </div>
            </div>


        </div>


    </div>

<!-- Fourth-->
<div class="container my-3"> <!--my-5 otherwise called margin 5 is used to create spacing vertically from the top nav bar-->
    <?php
    //This is sets mean that whenever the certain thing is clicked eg insert category, eg edit products//
    if(isset($_GET['insert_category'])){

        include('insert_category.php');
    }
    if(isset($_GET['insert_sales_rep'])){

        include('insert_sales_reps.php');
    }
    if(isset($_GET['view_products'])){

        include('view_products.php');
    }
    if(isset($_GET['edit_products'])){

        include('edit_products.php');
    }
    if(isset($_GET['delete_products'])){

        include('delete_product.php');
    }
    if(isset($_GET['view_category'])){

        include('view_category.php');
    }
    if(isset($_GET['view_sales_reps'])){

        include('view_sales_reps.php');
    }
    if(isset($_GET['edit_category'])){

        include('edit_categories.php');
    }
    if(isset($_GET['edit_sales_reps'])){

        include('edit_sales_reps.php');
    }
    if(isset($_GET['delete_category'])){

        include('delete_category.php');
    }
    if(isset($_GET['delete_sales_reps'])){

        include('delete_sales_reps.php');
    }
    if(isset($_GET['list_orders'])){

        include('list_orders.php');
    }
    if(isset($_GET['delete_orders'])){

        include('delete_orders.php');
    }
    if(isset($_GET['list_payments'])){

        include('list_payments.php');
    }
    if(isset($_GET['delete_payments'])){

        include('delete_payments.php');
    }
    if(isset($_GET['list_users'])){

        include('list_users.php');
    }
    ?>
</div>

<!--Last Child-->
<?php
    include("../includes/footer.php")
   ?>


<!--bootstrap JS link-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>