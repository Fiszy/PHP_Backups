<?php
    require 'includes/config.php';
    @session_start();
    // function getRealIpAddr() {
    //     if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    //         $ip = $_SERVER['HTTP_CLIENT_IP'];
    //     } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    //         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    //     } else {
    //         $ip = $_SERVER['REMOTE_ADDR'];
    //     }
    //     return $ip;
    // }
?>


<!-- login -->
<div>
    <form action="checkout.php" method="POST">
        <table width="800px" bgcolor="#242729" height="250" align="center" cellpadding="15px;" cellspacing="10">
            <tr align="center">
                <td colspan="4"><h2> Login or Register </h2></td>
            </tr>
            <tr>
                <td align="right" ><b> Your Email: </b></td> 
                <td> <input type="text" name="user_email" placeholder=" Enter Your Email" ></td>
            </tr>
            <tr>
            <td align="right"><b> Your Password: </b>   </td>
            <td><input type="password" name="user_password" placeholder=" Enter Your Password"></td>
            </tr>
            <tr align="center" >
                <td colspan="4"> <a href="checkout.php?forgot_pass" style="color:Yellow;" > Forgot Password? </a> </td>
            </tr>
            <tr align="center">
                <td colspan="4"><input type="submit" name="submit" value="Login"></td>
            </tr>
             <h2 style="float:right; padding:10px; " ><a href="register.php" style="text-decoration:none; color:yellow;"> New? Register Here </a></h2> <br><br>
        </table>
    </form>
</div>


<?php
    if (isset($_POST['submit'])) {
        $user_email = $_POST['user_email'];
        $user_pass = $_POST['user_password'];
        $login_query = " SELECT * from customers where customer_email = '$user_email' AND customer_pass = '$user_pass' ";
        $fire13 = mysqli_query($conn,$login_query);
        $check_account = mysqli_num_rows($fire13);
        $get_ip = getRealIpAddr();
        $cartip = " SELECT * from cart where ip_add = '$get_ip' ";
        $fire14 = mysqli_query($conn,$cartip);
        $check_cartip = mysqli_num_rows($fire14);
        if ($check_account==0) {
            echo "<script> alert('Email or Password Wrong! Try Again Please!') </script> ";
            exit();
        }
        if ($check_account == 1 AND $check_cartip == 0) {
            $_SESSION['customer_email'] = $user_email;
            echo " <script> window.open('customer/my_account.php','_self') </script> ";
        } else {
            $_SESSION['customer_email'] = $user_email;
            // echo " <script> window.open('payments_options.php','_self') </script> ";
            echo " <script> alert('Successfully Login! You can Order Now!') </script> ";
            echo " <script> window.open('payments_options.php','_self') </script> ";
        }
        
    }
?>

<?php 
        if (isset($_GET['forgot_pass'])) { 
            echo "
                <div align='center' style='margin-top:25px;'>
                    <b> Enter Your Email: </b> &nbsp;
                    <form method='POST'> 
                        <input type='email' name='forgot_email' placeholder='Enter Your Email' size='30' required> 
                        <input type='submit' name='forgot_submit' value='Submit'>
                    </form> 
                </div>
            ";
        }
        if (isset($_POST['forgot_submit'])) { 
            $forgot_email = $_POST['forgot_email'];
            $query_forgot = " SELECT * from customers where customer_email = '$forgot_email' ";
            $run_forgot = mysqli_query($conn,$query_forgot);
            $row_forgot = mysqli_num_rows($run_forgot);
            if ($row_forgot == 1) {
                $fetch_forgot = mysqli_fetch_array($run_forgot);
                $fetch_pass = $fetch_forgot['customer_pass'];
                $fetch_name = $fetch_forgot['customer_name'];

                $from = 'admin@mtwshop.com';
                $subject = 'Your Password';
                $message = '
                <html> 
                    <h3> Dear $fetch_name </h3>
                    <p> You Requested for your Password at <a href="#"> www.mtwshop.com </a>. </p>
                    <b> Your Password is:   </b> <span style="color:red"> $fetch_pass </span>.
                    <h3> Thankyou For Using <a href="#"> www.mtwshop.com </a> </h3>
                </html>
                ';
                mail($forgot_email,$subject,$message,$from);
                echo " <script> alert('Password Sent to your Email! Please Check your Inbox!') </script> ";
                echo " <script> window.opn('checkout.php','_self') </script> ";
            } elseif (($row_forgot == 0)) {
                echo " <script> alert('This Email Doesnot Exist ') </script> ";
                exit();
            } 
        } 
               
?>