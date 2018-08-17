<!-- Configuation Database Connect File -->
<?php require 'includes/config.php'; ?>
<?php require 'functions.php';  session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles.css">
    <title>ESite</title>
</head>
<body>
    <div class="main_wrapper">
        <div class="header_wrapper">
           <a href="../index.php"><img src="images/logo2.png" height="100px" width="300px" style="float: left;"  alt=""> </a>
            <img src="images/banner.gif" height="100px" width="700px" style="float: right;"  alt="">
        </div>
        <div id="navbar" > 
            <ul>
                <li><a href="../index.php"> Home </a></li>
                <li><a href="../all_products.php"> All Products </a></li>
                <li><a href="../cart.php"> Shopping Cart </a></li>
                <li><a href="../contact.php"> Contact us </a></li>
            </ul>
            <form action="results.php" method="get" enctype="multipart/form-data" >
                <input type="search" name="user_query" id="search" placeholder="Search a Product" >
                <input type="submit" value="Search" name="search" id="searchsub" >
            </form>
        </div>
        <div class="content_wrapper" > 
             <div id="right_content_area">
             <?php cart() ?>
                <div class="headline"  >
                    <div id="headline_content">
                       <?php
                         if (isset($_SESSION['customer_email'])) {
                                echo " <b> Welcome </b>". "<b style='color:Yellow; ' >". $_SESSION['customer_email']."</b> ";
                            } else {
                                echo "<b> Welcome Guest! </b> ";
                            }
                        ?>
                      &nbsp;
                        <?php
                            if (!isset($_SESSION['customer_email'])) {
                                echo "<a href='../checkout.php' style='color:Orange; text-decoration:none' > Login </a> ";
                            } else {
                                echo "<a href='../logout.php' style='color:Orange; text-decoration:none;'> Logout </a> ";
                            }
                        ?>
                         </span>
                    </div>
                </div> <br> <br>
               
                <div id="product_box">
                <?php  $order_id = $_GET['order_id']; ?>

                   
                   <center> <form action="" method="post" >
                        <table align="center" width="500" border="2px" height="400" cellspacing="0" bgcolor="#085797">
                            <tr align="center">
                                <td colspan="5"> <h2> Please Confirm Your Payment </h2> </td>
                            </tr>
                            <tr>
                                <td align="center"> Invoice No </td>
                                <td align="center"> <input type="text" name="invoice_no"> </td>
                            </tr>
                            <tr>
                                <td align="center"> Amount Desposit </td>
                                <td align="center"> <input type="number" name="amount"> </td>
                            </tr>
                            <tr>
                                <td align="center"> Select Payment Mode </td>
                                <td align="center"> <select name="payment_mode" id="">
                                    <option>Select Payment Mode</option>
                                    <option> Bank Transfer </option>
                                    <option> Easypaise/UBL Omni</option>
                                    <option> Western Union </option>
                                    <option> Paypal </option>
                                </select> </td>
                            </tr>
                            <tr>
                                <td align="center"> Transction/Reference ID </td>
                                <td align="center"> <input type="text" name="tr"> </td>
                            </tr>
                            <tr>
                                <td align="center"> Easypaise/UBL Omni Code </td>
                                <td align="center"> <input type="text" name="code"> </td>
                            </tr>
                            <tr>
                                <td align="center"> Payment Date </td>
                                <td align="center"> <input type="date" name="date"> </td>
                            </tr>
                            <tr align="center" align="right">
                                <td colspan="5" > <input type="submit" name="confirm" value="Confirm Payment" > </td>
                            </tr>
                        </table> <br>
                    </form> </center>
                    
                    <?php
                        
                         if (isset($_POST['confirm'])) {
                             $order_id = $_GET['order_id'];
                             $invoice = $_POST['invoice_no'];
                             $amount = $_POST['amount'];
                             $payment_method = $_POST['payment_mode'];
                             $tr = $_POST['tr'];
                             $code = $_POST['code'];
                             $date = $_POST['date'];
                    
                             $sql = " INSERT into payments(inovice_no,amount,payment_mode,ref_no,code,payment_date  ) VALUES ('$invoice','$amount','$payment_method','$tr','$code','$date')";
                             $run_payment = mysqli_query($conn,$sql);
                             
                             if ($run_payment) {
                                 $status_now = "Complete"; 
                                 echo " <h2 align='center' > Payment Received, Your Order Will be Completed in 24 Hours!  </h2> ";
                                 $update_order = "UPDATE customer_orders set order_status = '$status_now' where order_id= '$order_id' ";
                                 $update_pending_orders = "UPDATE pending_orders set order_status = '$status_now' where order_id= '$order_id' ";
                                 $run_update = mysqli_query($conn,$update_order);
                                 $run_update_pending =  mysqli_query($conn,$update_pending_orders);
                             }
                             
                         }

                    ?>

                    
                </div>
             </div>
             <div id="left_content_area">
                <div class="categories">
                    <h2> Manage Account: </h2>
                    <ul>
                        <?php
                            if (isset($_SESSION['customer_email'])) {
                                $user_session = $_SESSION['customer_email'];
                                $get_customer_pic = " Select * from customers where customer_email = '$user_session' ";
                                $firepic = mysqli_query($conn,$get_customer_pic);
                                $spec = mysqli_fetch_array($firepic);
                                $pic = $spec['customer_image'];
                                echo " <img class='dp' src= 'customer_images/$pic' width='180' height='180'> <br>
                                 <a  href='change_picture.php' style='color: white;'>Change Picture</a> <br><br> "; 
                            } else {
                                echo " <img class='dp' src= 'customer_images/guest.jpg' width='180' height='180'>  <br><br>"; 
                            } 


                        ?>
                        <li><a href="my_account.php?my_orders">My Orders</a></li>
                        <li><a href="my_account.php?edit_account"> Edit Account</a></li>
                        <li><a href="my_account.php?change_password">Change Password</a>  </li>
                        <li><a href="my_account.php?delete_account">Delete Account</a> </li>
                        <li><a href="../logout.php"> Logout</a></li>
                        
                    </ul>
                    
                </div>
             </div>
        </div>
        <div class="footer" > 
            <h1> &copy; 2018  <a href="#"> MtwShop </a></h1>
        </div>
    </div>
</body>
</html>