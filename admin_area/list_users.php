<h3 class="text-center text-success">Users List</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-success text-center">

    <?php
    $get_all_users="select * from users_table";
    $result_users=mysqli_query($con,$get_all_users);
    $row_count=mysqli_num_rows($result_users);
    echo "  <tr>
    <th>Serial Number</th>
    <th>Usernamer</th>
    <th>User Email</th>
    <th>User Image</th>
    <th>User Address</th>
    <th>User Mobile</th>
    <th>Delete</th>
</tr>
</thead>
<tbody class='bg-secondary'>";

if($row_count==0){
    echo "<h2 class='text-success text-center mt-5'>No users are available yet</h2>";
}else{
    $number=0;
    while($row_fetched=mysqli_fetch_assoc($result_users)){
        $user_id=$row_fetched['user_id'];
        $username=$row_fetched['username'];
        $user_email=$row_fetched['user_email'];
        $user_image=$row_fetched['user_image'];
        $user_address=$row_fetched['user_address'];
        $user_telephone=$row_fetched['user_telephone'];
        $number++;  //serial number incrimented everytime the loop runs//
        echo " <tr class='text-center'>
        <td>$number</td>
        <td>$username</td>
        <td>$user_email</td>
        <td><img src='../users/users_profile/$user_image' alt='$username' class='product_image'/></td>
        <td>$user_address</td>
        <td>$user_telephone</td>
        <td><a href='' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
    </tr>";
    }
}

    ?>

    </tbody>
</table>