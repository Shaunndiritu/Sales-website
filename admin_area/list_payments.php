<h3 class="text-center text-success">User Payments</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-success text-center">

    <?php
    $get_all_payments="select * from user_payments";
    $result_payments=mysqli_query($con,$get_all_payments);
    $row_count=mysqli_num_rows($result_payments);
    echo "  <tr>
    <th>Serial Number</th>
    <th>Invoice Number</th>
    <th>Amount</th>
    <th>Payment mode</th>
    <th>Date</th>
    <th>Delete</th>
</tr>
</thead>
<tbody class='bg-secondary'>";

if($row_count==0){
    echo "<h2 class='text-success text-center mt-5'>No payments have been made yet</h2>";
}else{
    $number=0;
    while($row_fetched=mysqli_fetch_assoc($result_payments)){
        $order_id=$row_fetched['order_id'];
        $amount=$row_fetched['amount'];
        $invoice_number=$row_fetched['invoice_number'];
        $payment_id=$row_fetched['payment_id'];
        $date=$row_fetched['date'];
        $payment_mode=$row_fetched['payment_mode'];
        $number++;  //serial number incrimented everytime the loop runs//
        echo " <tr class='text-center'>
        <td>$number</td>
        <td>$invoice_number</td>
        <td>$amount</td>
        <td>$payment_mode</td>
        <td>$date</td>
        <td><a href='index.php?delete_payments=$payment_id' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
    </tr>";
    }
}

    ?>

    </tbody>
</table>