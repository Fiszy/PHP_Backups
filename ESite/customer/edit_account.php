<?php

@session_start();
// require 'includes/config.php';

if (isset($_GET['edit_account'])) {
    $customer_email = $_SESSION['customer_email'];
    $get_customer = " SELECT * from customers where customer_email = '$customer_email' ";
    $run_customer = mysqli_query($conn,$get_customer);
    $row = mysqli_fetch_array($run_customer);

    $id = $row['customer_id'];
    $name = $row['customer_name'];
    $email = $row['customer_email'];
    $pass = $row['customer_pass'];
    $country = $row['customer_country'];
    $city = $row['customer_city'];
    $contact = $row['customer_contact'];
    $address = $row['customer_address'];
    $img = $row['customer_image'];
}

?>

<form action="" method="post" enctype="multipart/form-data" >
    <table align="center" width="600" border="2" cellspacing="0" height="400" bgcolor="#085797" style="margin-left:70px;">
     <tr >
         <td colspan="2" align="center"> <h1> Update Your Account</h1> </td>
     </tr>
     
     <tr>
         <td align="center"> Name </td>
         <td> <input type="text" name="c_name" value=" <?php echo $name; ?> "> </td>
     </tr>
     <tr>
         <td align="center"> Email </td>
         <td> <input type="email" name="c_email" value="<?php echo $email; ?>"></td>
     </tr>
     <tr>
         <td align="center"> Password</td>
         <td> <input type="password" name="c_pass" value="<?php echo $pass; ?>"> </td>
     </tr>
     <tr>
        
        <td align="center" > <b>Your Country </b> </td> 
            <td> <select name="c_country" disabled >
                    <option > <?php echo $country; ?> </option>
                    <option > Afghanistan </option>
                    <option > India</option>
                    <option > Iran </option>
                    <option > Japan </option>
                    <option > China</option>
                    <option > Pakistan</option>
                    <option > Saudia Arabia</option>
                    <option > USA</option>
                    <option > UK</option>
                    <option > UAE</option>
                    </select> 
            </td>
     </tr>
     <tr>
         <td align="center">City</td>
         <td> <input type="text" name="c_city" value="<?php echo $city; ?>"> </td>
     </tr>
     <tr>
         <td align="center">Contact</td>
         <td> <input type="tel" name="c_contact" value="<?php echo $contact; ?>"> </td>
     </tr>
     <tr>
         <td align="center">Address</td>
         <td> <input type="text" name="c_addr" value="<?php echo $address; ?>"> </td>
     </tr>
     <tr>
         <td align="center">Image</td>
         <td> <input type="file" name="c_image" size="40"> <img src="customer_images/<?php echo $img; ?>" width="100" height="100" >  </td>
     </tr>
     <tr>
         
         <td colspan="2"> <input type="submit" name="submit" value="Update" ></td>
     </tr>
    </table>
</form>

<?php

if (isset($_POST['submit'])) {

    $update_id = $id;

    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_pass = $_POST['c_pass'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_addr'];
    $c_image = $_FILES['c_image']['name'];
    $c_temp_image = $_FILES['c_image']['tmp_name'];
    

    $update_details = "UPDATE customers set customer_name='$c_name', customer_email='$c_email',customer_pass='$c_pass',
    customer_city='$c_city',customer_contact='$c_contact',customer_address='$c_address',customer_image='$c_image' where customer_id = '$update_id' ";
    $run_update = mysqli_query($conn,$update_details);
    if ($run_update) {
        move_uploaded_file($c_temp_image,"customer_images/$c_image");
        echo " <script> alert('Your Account Details Has been updated!') </script> ";
        echo " <script> window.open('my_account.php','_self') </script> ";
    }
}


?>