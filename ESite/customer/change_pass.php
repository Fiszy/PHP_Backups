<?php

@session_start();


if (isset($_GET['change_password'])) {
    $customer_email = $_SESSION['customer_email'];
    $get_customer = " SELECT * from customers where customer_email = '$customer_email' ";
    $run_customer = mysqli_query($conn,$get_customer);
    $row = mysqli_fetch_array($run_customer);

    $id = $row['customer_id'];
    $pass = $row['customer_pass'];
}

?>
<br><br>
<h1 align="center"> Update Password</h1> <br>


<form action="" method="post" enctype="multipart/form-data" >
    <table align="center" width="600" border="2" cellspacing="0" height="150" bgcolor="#085797" style="margin-left:70px;">
     <tr>
         <td align="center"> Current Password</td>
         <td> <input type="password" name="c_pass"> </td>
     </tr>
     <tr>
         <td align="center"> New Password</td>
         <td> <input type="password" name="n_pass"> </td>
     </tr>
     <tr>
         <td align="center"> Confirm Password</td>
         <td> <input type="password" name="con_pass"> </td>
     </tr>
     <tr>
         <td align="center" colspan="2"> <input type="submit" name="submit" value="Update Password"> </td>
     </tr>
    </table>
</form> 

<?php

if (isset($_POST['submit'])) {
    
    $update_id = $id;
    $c_pass = $_POST['c_pass'];
    $n_pass = $_POST['n_pass'];
    $con_pass = $_POST['con_pass'];

    if ($c_pass == $pass) {
        if ($n_pass == $con_pass) {
            $update_details = "UPDATE customers set customer_pass='$con_pass' where customer_id = '$update_id' ";
            $run_update = mysqli_query($conn,$update_details);
            if ($run_update) {
                echo " <script> alert('Your Password Has Been Changed!') </script> ";
                echo " <script> window.open('my_account.php','_self') </script> ";
            }
        } else {
             echo "<script> alert('Your New Password didnot Match!') </script> ";
        } 
    } else {
            echo "<script> alert('Your Current Password is not Correct!') </script> ";
    }



    
}

?>