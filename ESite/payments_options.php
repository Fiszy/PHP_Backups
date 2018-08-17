<!-- Configuation Database Connect File -->
<?php require 'includes/config.php'; ?>
<?php require 'functions.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Ruslan+Display" rel="stylesheet"> 
    <title>ESite</title>
</head>
<body>
    <div class="main_wrapper">
        <div class="header_wrapper">
           <a href="index.php"><img src="images/logo2.png" height="100px" width="300px" style="float: left;"  alt=""> </a>
            <img src="images/banner.gif" height="100px" width="700px" style="float: right;"  alt="">
        </div>
        <div id="navbar" > 
            <ul>
                <li><a href="index.php"> Home </a></li>
                <li><a href="all_products.php"> All Products </a></li>
                <?php
                    if (isset($_SESSION['customer_email'])) {
                        echo "<li><a href='customer/my_account.php'> My Account </a></li>";
                    } else { }
                ?>
                <?php
                    if (isset($_SESSION['customer_email'])) {
                        
                    } else {
                        echo "<li><a href='register.php'> Sign Up</a></li>";
                     }
                ?>
                
                <li><a href="cart.php"> Shopping Cart </a></li>
                <li><a href="contact.php"> Contact us </a></li>
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
                    <h1 align="left" style="color:YELLOW; margin-left:20px; font-family: 'Ruslan Display', cursive; letter-spacing:2px;"  >PAYMENT OPTIONS   </h1>
                </div>
               
                <div align="center" style="padding:0px; color:white;">
                    <br>
                    <br>
                    <br>
                    

                    <?php

                        $ip = getRealIpAddr();
                        $get_customer = " SELECT * from customers where customer_ip = '$ip' ";
                        $run = mysqli_query($conn,$get_customer);
                        $fetch_data = mysqli_fetch_array($run);
                        $customer_id = $fetch_data['customer_id'];
                        ?>
                        <br>
                    <h1> Payment Via Paypal </h1>
                    <hr>
                    <br>
                    <a href="https://www.paypal.com">
                        <img src="images/paypal.png" height="130" width="240">
                        <br>
                        <br>
                        <span style="color:white; font-size: 50px;"> OR </span>
                        <br>

                        <br>
                        <br>
                        <a href="order.php?order_no=<?php echo $customer_id ?>" style="color:Yellow; font-size: 35px; letter-spacing:2px;">
                            <b> PAY OFFLINE </b>
                        </a>
                        <br>
                        <br>
                        <br>
                        <br>
                        <b> if you selected "Pay Offline" Option, Please Check Your Email or Account to find invoice No for Your Order </b>
                </div>
                
             </div>
             <div id="left_content_area">
                <div class="categories">
                    <h2> Categories </h2>
                    <ul>
                        <?php  getCategories(); ?>
                    </ul>
                    <h2> Brands </h2>
                    <ul>
                        <?php getBrands() ?>
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