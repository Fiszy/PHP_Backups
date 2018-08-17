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
                <div class="headline"  >
                    <div id="headline_content">
                        <?php
                            if (!isset($_SESSION['customer_email'])) {
                                echo "<b> Welcome Guest! </b> ";
                            } else {
                                $lo = $_SESSION['customer_email'];
                                echo "Welcome <b style='color:#00f9f2' >" .$lo. "</b>";
                            }
                        ?>
                        <?php
                            if (!isset($_SESSION['customer_email'])) {
                                echo "<b style='color:yellow' >  &nbsp;  Shopping Cart  </b>";
                            } else {
                                $lo = $_SESSION['customer_email'];
                                echo "<b style='color:yellow' > &nbsp;  Your Shopping Cart  </b>";
                            }
                        ?>
                        
                        <span> : Total Items: <?php items(); ?> &nbsp; Total Price: <?php totalprice(); ?> - <a href="cart.php" style="color:yellow"> Go to Cart </a> &nbsp;
                        <?php
                            if (!isset($_SESSION['customer_email'])) {
                                echo "<a href='checkout.php' style='color:Orange; text-decoration:none' > Login </a> ";
                            } else {
                                echo "<a href='logout.php' style='color:Orange; text-decoration:none;'> Logout </a> ";
                            }
                        ?>
                         </span>
                    </div>
                </div>
                <div id="product_box">
                    <?php 
                    detail();
                    ?>
                    
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