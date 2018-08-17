<?php

@session_start();
// require 'includes/config.php';

if (isset($_GET['change_picture'])) {
    $customer_email = $_SESSION['customer_email'];
    $get_customer = " SELECT * from customers where customer_email = '$customer_email' ";
    $run_customer = mysqli_query($conn,$get_customer);
    $row = mysqli_fetch_array($run_customer);

    $id = $row['customer_id'];
    $img = $row['customer_image'];
}

?>
<h1 align="center"> Update Image</h1> <br>
<img src="customer_images/<?php echo $img; ?>" width="180" height="180" style="border-radius:50%;" > <br> <br>

<form action="" method="post" enctype="multipart/form-data" >
    <table style="margin-left:270px;">
     <tr>
         <td> <input type="file" name="c_image" size="40"></td> 
     </tr>
     <tr>
         <td> <input type="submit" name="submit" value="Change" ></td>
     </tr>
    </table>
</form> 

<?php

if (isset($_POST['submit'])) {

    $update_id = $id;
    $c_image = $_FILES['c_image']['name'];
    $c_temp_image = $_FILES['c_image']['tmp_name'];
    $update_details = "UPDATE customers set customer_image='$c_image' where customer_id = '$update_id' ";
    $run_update = mysqli_query($conn,$update_details);
    if ($run_update) {
        move_uploaded_file($c_temp_image,"customer_images/$c_image");
        echo " <script> window.open('my_account.php','_self') </script> ";
    }
}


?>