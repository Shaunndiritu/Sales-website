<h3 class="text-center text-success">Sales Representatives</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-success text-center">
        <tr>
            <th>Serial Number</th>
            <th>Sales Rep Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-dark">

    <?php
    //fetching sales representatives from the database and displaying them
    $select_sales_reps="select * from sales_reps";
    $result=mysqli_query($con,$select_sales_reps);
    $number=0;
    while($row=mysqli_fetch_assoc($result)){
        $sales_rep_id=$row['sales_rep_id'];
        $sales_rep_name=$row['sales_rep_name'];
        $number++;
    ?>
        <tr class="text-center">
            <td><?php echo $number; ?></td>
            <td><?php echo $sales_rep_name; ?></td>
            <td><a href='index.php?edit_sales_reps=<?php echo $sales_rep_id; ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
          <td><a href='index.php?delete_sales_reps=<?php echo $sales_rep_id; ?>'type="button" class="" data-toggle="modal" data-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>
        </tr>

    <?php
    } 
    ?>    
    </tbody>
</table>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4>Are you sure you want to delete?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> <a href="./index.php?view_sales_reps" class="text-dark text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a href='index.php?delete_sales_reps=<?php echo $sales_rep_id; ?>' class="text-light text-decoration-none">Yes</a></button>
      </div>
    </div>
  </div>
</div>