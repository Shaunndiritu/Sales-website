<h3 class="text-center text-success">All Orders</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-success text-center">

    <?php
    $get_all_orders="select * from orders";
    $result_orders=mysqli_query($con,$get_all_orders);
    $row_count=mysqli_num_rows($result_orders);
    echo "  <tr>
    <th>Serial Number</th>
    <th>Amount</th>
    <th>Invoice Number</th>
    <th>Total Products</th>
    <th>Order Date</th>
    <th>Status</th>
    <th>Delete</th>
</tr>
</thead>
<tbody class='bg-secondary'>";

if($row_count==0){
    echo "<h2 class='text-success text-center mt-5'>No orders placed yet</h2>";
}else{
    $number=0;
    while($row_fetched=mysqli_fetch_assoc($result_orders)){
        $order_id=$row_fetched['order_id'];
        $user_id=$row_fetched['user_id'];
        $amount=$row_fetched['amount'];
        $invoice_number=$row_fetched['invoice_number'];
        $total_products=$row_fetched['total_products'];
        $order_date=$row_fetched['order_date'];
        $order_status=$row_fetched['order_status'];
        $number++;  //serial number incrimented everytime the loop runs//
        echo " <tr class='text-center'>
        <td>$number</td>
        <td>$amount</td>
        <td>$invoice_number</td>
        <td>$total_products</td>
        <td>$order_date</td>
        <td>$order_status</td>
        <td><a href='index.php?delete_orders=$order_id' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
    </tr>";
    }
}

    ?>

    </tbody>
</table>