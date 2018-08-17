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
                 <?php
                    if (isset($_SESSION['customer_email'])) {
                        echo "<li><a href='my_account.php'> My Account </a></li>";
                    } else { }
                ?>
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
                    <?php
                    if (isset($_GET['msg'])) {
                        $msg = $_GET['msg'];
                        echo "<h2>".$msg."</h2> ";
                    }
                    getDefault();
                    if (isset($_GET['my_orders'])) {
                        include 'my_orders.php';
                    }
                    if (isset($_GET['edit_account'])) {
                        include 'edit_account.php';
                    }
                    if (isset($_GET['change_picture'])) {
                        include 'change_picture.php';
                    }
                    if (isset($_GET['change_password'])) {
                        include 'change_pass.php';
                    }
                    if (isset($_GET['delete_account'])) {
                        include 'delete_account.php';
                    }
                    if (isset($_GET['pay_offline'])) {
                        include 'pay_offline.php';
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
                                 <a  href='my_account.php?change_picture' style='color: white;'>Change Picture</a> <br><br> "; 
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