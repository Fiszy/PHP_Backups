<!-- Configuation Database Connect File -->
<?php require 'includes/config.php'; ?>
<?php require 'functions.php'; session_start() ?>

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
             <?php cart() ?>
                <div class="headline">
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
                        
                        <span> : Total Items: <?php items(); ?>  Total Price: <?php totalprice(); ?> - <a href="all_products.php" style="color:yellow"> Products </a> &nbsp;
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
                    <form action="cart.php" method="POST" enctype="multipart/form-data" >
                        <table class="gotocart" align = "center" > 
                            <tr align = "center">
                                <td> <b> Remove </b> </td>
                                <td> <b> Product(s) </b></td>
                                <td> <b> Quantity </b></td>
                                <td> <b> Total Price </b></td>
                            </tr>

                        <?php  
                        $ip_addr = getRealIpAddr();
                        $total = 0;
                        $select_price = "Select * from cart where ip_add = '$ip_addr'"; 
                        $fire9 = mysqli_query($conn,$select_price);
                        while ($result9 = mysqli_fetch_array($fire9)) {
                            $product_price_id = $result9['product_id'];
                            $pro_price = "Select * from products where product_id = '$product_price_id'";
                            $fire10 = mysqli_query($conn,$pro_price);
                            while($result10 = mysqli_fetch_array($fire10)) {
                                $product_price = array($result10['product_price']);
                                $product_price_final = $result10['product_price'];
                                $product_title = $result10['product_title'];
                                $product_image = $result10['product_img1'];
                                $values = array_sum($product_price);
                                $total += $values;
                        ?>
                            <tr>
                                <td> <input type="checkbox" name="remove[]" value="<?php echo $product_price_id; ?>" > </td>
                                <td> <?php echo $product_title; ?> <br> <img src="admin/product_images/<?php echo $product_image ?>" height="80px" width="80px;"> </td>
                                <td>  <input type="number" name="qty" size="1" style="text-align:center" > </td>
                                <td> <?php echo $product_price_final." PKR "; ?> </td>
                            </tr> 
                        <?php  }
                        }?>
                        <tr>
                                <td  colspan="3" align="right"> <b> Subtotal: </b> </td>
                                <td> <b> <?php  echo $total." PKR "; ?> </b> </td>
                        </tr>
                        <tr></tr>
                        <tr></tr>
                        <tr></tr>
                        <tr>
                            <td  > <input type="submit" name="removeitem" value="Remove item (s)" > </td>
                            <td colspan="" > <input type="submit" name="update" value="Update Cart" >
                             <?php

                             if (isset($_POST['update'])) {
                                $qty = $_POST['qty'];
                                $insert_qty = " UPDATE cart set qty ='$qty' where ip_add = '$ip_addr' ";
                                $fire12 = mysqli_query($conn,$insert_qty);
                                if ($fire12) {
                                    echo " <script> alert('Quantity Updated Successfully!!') </script> ";
                                    $total = $total*$qty;
                                }
                               
                            }
                             ?>
                             </td>
                            <td> <input type="submit" name="continue" value="Continue Shopping"></td>
                            <td> <a href="checkout.php" style="text-decoration:none; color:Yellow"> <b>Checkout</b> </a></td>
                        </tr>
                        </table>
                    </form>

                    <?php 
                    if (isset($_POST['removeitem'])) {
                        foreach ($_POST['remove'] as $remove_id ) {
                            $delete_products = " DELETE from cart where product_id = '$remove_id' ";
                            $fire11 = mysqli_query($conn,$delete_products);
                            if ($fire11) {
                                echo " <script> window.open('cart.php','_self') </script> ";
                            }
                        }
                    }
                    if (isset($_POST['continue'])) {
                        echo " <script> window.open('index.php','_self') </script> ";
                    }
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