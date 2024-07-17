<h3 class="text-center text-success">All Products In Inventory</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-success">
        <tr>
            <th>Product Id</th>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Product Price</th>
            <th>Total Sold</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

    </thead>
    <tbody class="bg-secondary text-dark">
        <?php
        $get_products="select * from products";
        $result_query=mysqli_query($con,$get_products);
        $number=0;
        while($row=mysqli_fetch_assoc($result_query)){ //While loop because we have multiple products
          $product_id=$row['product_id'];
          $inventory_title=$row['inventory_title'];
          $product_image=$row['product_image'];
          $product_price=$row['product_price'];
          $status=$row['Status'];
          $number++;
          ?>
          <tr class='text-center'>
          <td><?php echo $number; ?></td>
          <td><?php echo$inventory_title; ?></td>
          <td><img src='./product_images/<?php echo $product_image; ?>' class='product_image'/></td>
          <td><?php echo $product_price;?>/-</td>
          <td><?php
          $get_count="select * from pending_orders where inventory_id=$product_id";
          $result_count=mysqli_query($con,$get_count);
          $rows_counted=mysqli_num_rows($result_count);
          echo $rows_counted;
          ?>
          </td>
          <td><?php echo $status; ?></td>
          <td><a href='index.php?edit_products=<?php echo $product_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
          <td><a href='index.php?delete_products=<?php echo $product_id ?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
      </tr>
      <?php
        }


        ?>
    </tbody>
</table>

