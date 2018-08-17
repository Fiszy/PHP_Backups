<?php  @session_start();   ?>


<form action="" method="post">
    <table align="center" width="600">
            <tr align="center">
                <td colspan="2"> <h1>Do you really want to delete your account</h1></td>
            </tr>
            <tr align="center">
                <td> 
                <input type="submit" name="yes" value="I want to Delete">
                <input type="submit" name="no" value="I want to Delete">
                </td> 
            </tr>  
    </table>
</form>

<?php

    $c = $_SESSION['customer_email'];
    if (isset($_POST['yes'])) {
    $delete_customer = " DELETE from customers where customer_email = '$c' ";
    $run = mysqli_query($conn,$delete_customer);
    if ($run) {
        session_destroy();
        echo "<script> alert('Your Account Successfully Deleted!') </script> ";
        echo " <script> window.open('../index.php','_self') </script> ";
    }

}
if (isset($_POST['no'])) {
        echo "<script> alert('Your Account not Deleted!') </script> ";
        echo " <script> window.open('my_account.php','_self') </script> ";

}





?>

