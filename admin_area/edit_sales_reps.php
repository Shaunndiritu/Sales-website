<?php
if(isset($_GET['edit_sales_reps'])){
    $edit_sales_reps=$_GET['edit_sales_reps']; //storing the sales reps id fetched in a different varuable//


    $get_sales_reps="Select * from sales_reps where sales_rep_id=$edit_sales_reps";
    $result_sales_reps=mysqli_query($con,$get_sales_reps);
    $row_fetched=mysqli_fetch_assoc($result_sales_reps);
    $sales_rep_name=$row_fetched['sales_rep_name'];
}


if(isset($_POST['edit_sales_reps'])){ //when the update category button is clicked//
    $sales_title=$_POST['sales_rep_name'];

    $update_query="Update sales_reps set sales_rep_name='$sales_title' where sales_rep_id=$edit_sales_reps";
    $result_sales=mysqli_query($con,$update_query);
    if($result_sales){
        echo"<script>alert('Sales representative has been updated successfully')</script>";
        echo"<script>window.open('./index.php?view_sales_reps','_self')</script>";
    }
}


?>

<div class="container mt-3">
    <h1 class="text-center text-success">Edit Sales Representatives</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="sales-rep_name" class="form-label">Sales representative name</label>
            <input type="text" name="sales_rep_name" id="sales_rep_name" value="<?php echo $sales_rep_name; ?>" class="form-control" required="required">
        </div>
        <input type="submit" value="Update Sales Rep" class="btn btn-success px-3 mb-3" name="edit_sales_reps">
    </form>
</div>