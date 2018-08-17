<?php
    session_start();
    if ($_SESSION['admin_email']) {
        $username = $_SESSION['admin_email'];
    } else {
        header('location:login.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/style.css" media="all">
    <title>Admin</title>
</head>
<body>
    <div class="wrapper">
        <div class="header">
           <a href="index.php"><img src="images/header.jpg" alt=""></a> 
        </div>
        <div class="left">
            <h2 align="center" style="color:red; margin-top:25px;"> 
                <?php
                    echo @$_GET['logged_in'];

                ?>
             </h2>
            <?php
            if (isset($_GET['insert_products'])) {
                include 'insert_product.php';          
            }
             if (isset($_GET['view_products'])) {
                include 'view_products.php';          
            }
            if (isset($_GET['insert_category'])) {
                include 'insert_category.php';          
            }
            if (isset($_GET['view_category'])) {
                include 'view_categories.php';          
            }
            if (isset($_GET['insert_brands'])) {
                include 'insert_brands.php';          
            }
            if (isset($_GET['view_brands'])) {
                include 'view_brands.php';          
            }
            if (isset($_GET['view_orders'])) {
                include 'view_orders.php';          
            }
            if (isset($_GET['view_payments'])) {
                include 'view_payments.php';          
            }
            if (isset($_GET['edit_product'])) {
                include 'edit_product.php';          
            }
            if (isset($_GET['delete_product'])) {
                include 'delete_product.php';          
            }
            if (isset($_GET['edit_category'])) {
                include 'edit_category.php';          
            }
            if (isset($_GET['delete_category'])) {
                include 'delete_category.php';          
            }
            if (isset($_GET['edit_brand'])) {
                include 'edit_brand.php';          
            }
            if (isset($_GET['delete_brand'])) {
                include 'delete_brand.php';          
            }
            if (isset($_GET['view_customers'])) {
                include 'view_customers.php';          
            }
            if (isset($_GET['delete_customer'])) {
                include 'delete_customer.php';          
            }
            if (isset($_GET['delete_order'])) {
                include 'delete_order.php';          
            }
            
            ?>



        </div>
        <div class="right">
            <h2> Manage Products </h2>
            <a href="index.php?insert_products"> Insert New Product</a> <br>
            <a href="index.php?view_products"> View All Products</a>  <br>
            <a href="index.php?insert_category"> Insert Category</a> <br>
            <a href="index.php?view_category"> View All Categories</a> <br>
            <a href="index.php?insert_brands"> Insert New Brand</a> <br>
            <a href="index.php?view_brands"> View All Brands</a> <br>
            <a href="index.php?view_customers"> View Customers</a> <br>
            <a href="index.php?view_orders"> View Orders</a> <br>
            <a href="index.php?view_payments"> View Payments</a> <br>
            <a href="logout.php"> Admin Logout</a>
        
        
        </div>
    </div>
    
    
</body>
</html>