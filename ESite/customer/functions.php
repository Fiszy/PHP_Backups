<!-- Configuation Database Connect File -->
 <?php 
 $db = mysqli_connect('localhost','root','','esite');
 ?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <script src="main.js"></script>
</head>
</html>> 
<?php

function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Getting dafault for customers

function getDefault() {
    global $db;
    $c  = $_SESSION['customer_email'];
    $get_c = " SELECT * from customers where customer_email = '$c' ";
    $run_c = mysqli_query($db,$get_c);
    $row_c = mysqli_fetch_array($run_c);
    $customer_id = $row_c['customer_id'];
    if (!isset($_GET['my_orders'])) {
        if (!isset($_GET['edit_account'])) {
            if (!isset($_GET['change_password'])) {
                if (!isset($_GET['delete_account'])) {
                    $get_order = " SELECT * from customer_orders where customer_id = '$customer_id' AND order_status = 'pending'";
                    $run_order = mysqli_query($db,$get_order);
                    $count_orders = mysqli_num_rows($run_order);
                    if ($count_orders > 0) {
                        echo " <div style='padding='10px' align='left'> 
                            <h1 style='color:red; text-decoration:underline;'> Important </h1> <br>
                            <h4 > You have (". $count_orders .") Pending Orders </h4>
                            <h4 > Please See Your Order Details  <a style='color:yellow' href='my_account.php?my_orders' >Here</a> <br>
                             Or You can <a style='color:yellow' href='my_account.php?pay_offline'>Pay Offline</a> now. </h4>
                        </div> ";
                    } else {
                        echo " <div style='padding='10px' align='left'> 
                            <h1 style='color:red; text-decoration:underline;'> Important </h1> <br>
                            <h4 > You have No Pending Orders </h4>
                            <h4 > You can see Your Order History  <a style='color:yellow' href='my_account.php?my_orders' >Here</a> 
                        </div> ";
                    }
                }           
            }
        } 
    }
    
}

function my_orders() {
     if (!isset($_GET['my_orders'])) {
        $c  = $_SESSION['customer_email'];
        $get_c = " SELECT * from customers where customer_email = '$c' ";
        $run_c = mysqli_query($db,$get_c);
        $row_c = mysqli_fetch_array($run_c);
        $customer_id = $row_c['customer_id'];
        echo "
            <table>
                <th> Order No </th>
                <th> Invoice No</th>
                <th> Due Amount </th>
                <th> Total Products</th>
                <th> Order Date</th>
                <th> Paid/Unpaid </th>
                <th> Status </th>
            
            
            
            </table>
        
        
        ";
     }
}

function cart() {
    global $db;
    if (isset($_GET['add_cart'])) {
        $ip_addr = getRealIpAddr();
        $product_cart_id = $_GET['add_cart'];
        $check_product = " Select * from cart where ip_add = '$ip_addr' AND product_id= '$product_cart_id' ";
        $fire6  = mysqli_query($db,$check_product);
        if (mysqli_num_rows($fire6) > 0 ) {
            echo "";
        } else {
            $q = "INSERT into cart (product_id,ip_add) VALUES('$product_cart_id','$ip_addr')";
            $fire7 = mysqli_query($db,$q);
            header('location:index.php');
        }
    }
}

function items() {
    global $db;
    if (isset($_GET['add_cart'])) {
        $ip_addr = getRealIpAddr();
        $get_items = "Select * from cart where ip_add='$ip_addr'";
        $fire8 = mysqli_query($db,$get_items);
        $count_items = mysqli_num_rows($fire8);
    } else {
        global $db;
        $ip_addr = getRealIpAddr();
        $get_items = "Select * from cart where ip_add='$ip_addr'";
        $fire8 = mysqli_query($db,$get_items);
        $count_items = mysqli_num_rows($fire8);
    }
    echo $count_items;
}

function totalprice() {
    global $db;
    $ip_addr = getRealIpAddr();
    $total = 0;
    $select_price = "Select * from cart where ip_add = '$ip_addr'"; 
    $fire9 = mysqli_query($db,$select_price);
    while ($result9 = mysqli_fetch_array($fire9)) {
        $product_price_id = $result9['product_id'];
        $pro_price = "Select * from products where product_id = '$product_price_id'";
        $fire10 = mysqli_query($db,$pro_price);
        while($result10 = mysqli_fetch_array($fire10)) {
            $product_price = array($result10['product_price']);
            $values = array_sum($product_price);
            $total += $values;
        }
    }
    echo $total." PKR ";
}

function getPro() {
        global $db;
        if (!isset($_GET['cat'])) {
            if (!isset($_GET['brand'])) {
                $get_products = "Select * from products order by rand() LIMIT 0,6";
                $fire = mysqli_query($db,$get_products);
                if ($fire) {
                    while ($result = mysqli_fetch_array($fire)) {
                        $product_id = $result['product_id'];
                        $product_title = $result['product_title'];
                        $category_id = $result['category_id'];
                        $brand_id = $result['brand_id'];
                        $product_desc = $result['product_desc'];
                        $product_price = $result['product_price'];
                        $product_img = $result['product_img1'];

                        echo "
                        <div id='single_product' > 
                            <h3> $product_title </h3>
                            <a href='#'><img src='admin/product_images/$product_img' width='190' height='190px'/></a> <br>
                            <p> <b> Price: $product_price PKR </b> </p>
                            <a href='details.php?pro_id=$product_id' style='float: left;'> Details </a>
                            <a href='index.php?add_cart=$product_id' ><button style='float: right;'> Add to Cart </button> </a>
                        </div>
                        ";
                    }
                }
            }
        }            
}

function allPro() {
        global $db;
        if (!isset($_GET['cat'])) {
            if (!isset($_GET['brand'])) {
                $get_all_products = "Select * from products";
                $fire3 = mysqli_query($db,$get_all_products);
                if ($fire3) {
                    while ($result = mysqli_fetch_array($fire3)) {
                        $all_product_id = $result['product_id'];
                        $all_product_title = $result['product_title'];
                        $all_category_id = $result['category_id'];
                        $all_brand_id = $result['brand_id'];
                        $all_product_desc = $result['product_desc'];
                        $all_product_price = $result['product_price'];
                        $all_product_img = $result['product_img1'];

                        echo "
                        <div id='single_product' > 
                            <h3> $all_product_title </h3>
                            <a href='#'><img src='admin/product_images/$all_product_img' width='190' height='190px'/></a> <br>
                            <p> <b> Price: $all_product_price PKR </b> </p>
                            <a href='details.php?pro_id=$all_product_id' style='float: left;'> Details </a>
                            <a href='index.php?add_cart=$all_product_id' ><button style='float: right;'> Add to Cart </button> </a>
                        </div>
                        ";
                    }
                }
            }
        }            
}

function search() {
    global $db;
    if (isset($_GET['search'])) {
        $user_query = $_GET['user_query'];
        $get_all_products = "Select * from products where product_keywords like '%$user_query%' ";
        if (empty($get_all_products)) {
            echo "<h1 class='prodisplay'> There is no Product Here! <br> Coming Soon.<h1>";
        } else {
            $fire4 = mysqli_query($db,$get_all_products);
            if ($fire4) {
                while ($result = mysqli_fetch_array($fire4)) {
                    $all_product_id = $result['product_id'];
                    $all_product_title = $result['product_title'];
                    $all_category_id = $result['category_id'];
                    $all_brand_id = $result['brand_id'];
                    $all_product_desc = $result['product_desc'];
                    $all_product_price = $result['product_price'];
                    $all_product_img = $result['product_img1'];

                    echo "
                    <div id='single_product' > 
                        <h3> $all_product_title </h3>
                        <a href='#'><img src='admin/product_images/$all_product_img' width='190' height='190px'/></a> <br>
                        <p> <b> Price: $all_product_price PKR </b> </p>
                        <a href='details.php?pro_id=$all_product_id' style='float: left;'> Details </a>
                        <a href='index.php?add_cart=$all_product_id' ><button style='float: right;'> Add to Cart </button> </a>
                    </div>
                    ";
                }
            }
        }
    }               
}

function detail() {
    global $db;
    if (isset($_GET['pro_id'])) {
        $p_id = $_GET['pro_id'];
        $get_all_p = "Select * from products where product_id = '$p_id' ";
        $fire5 = mysqli_query($db,$get_all_p);
        if ($fire5) {
            while ($result = mysqli_fetch_array($fire5)) {
                $all_product_id = $result['product_id'];
                $all_product_title = $result['product_title'];
                $all_category_id = $result['category_id'];
                $all_brand_id = $result['brand_id'];
                $all_product_desc = $result['product_desc'];
                $all_product_price = $result['product_price'];
                $all_product_img = $result['product_img1'];
                $all_product_img2 = $result['product_img2'];
                $all_product_img3 = $result['product_img3'];

                echo "
                <div id='single_product' > 
                    <h3> $all_product_title </h3>
                    <a href='#'><img src='admin/product_images/$all_product_img' width='190' height='190px'/></a> 
                    <a href='#'><img src='admin/product_images/$all_product_img2' width='250' height='250px'/></a> 
                    <a href='#'><img src='admin/product_images/$all_product_img3' width='250' height='250'/></a> 
                    <p> <b> Price: $all_product_price PKR </b> </p>
                    <b style='float:left;'> Description: </b>
                    <p> $all_product_desc  </p> 
                    <a href='index.php' style='float: left;'> Go Back </a>
                    <a href='index.php?add_cart=$all_product_id' ><button style='float: right;'> Add to Cart </button> </a>
                </div>
                
                ";
            }
        }
    }               
}

function getCatPro() {
        global $db;
        if (isset($_GET['cat'])) {
            $get_cat_id = $_GET['cat'];
            $get_cat_products = "Select * from products where category_id = '$get_cat_id'";
            $fire1 = mysqli_query($db,$get_cat_products);
            if ($fire1) {
                $count = mysqli_num_rows($fire1);
                if ($count > 0) {
                    while ($result1 = mysqli_fetch_array($fire1)) {
                        $product_cat_id = $result1['product_id'];
                        $product_cat_title = $result1['product_title'];
                        $category_cat_id = $result1['category_id'];
                        $brand_cat_id = $result1['brand_id'];
                        $product_cat_desc = $result1['product_desc'];
                        $product_cat_price = $result1['product_price'];
                        $product_cat_img = $result1['product_img1'];

                        echo "
                        <div id='single_product' > 
                            <h3> $product_cat_title </h3>
                            <a href='admin/product_images/$product_cat_img' class='minipic' ><img src='admin/product_images/$product_cat_img' width='190' height='190px'/></a> <br>
                            <p> <b> Price: $product_cat_price PKR </b> </p>
                            <a href='details.php?pro_id=$product_cat_id' style='float: left;'> Details </a>
                            <a href='index.php?add_cart=$product_cat_id' ><button style='float: right;'> Add to Cart </button> </a>
                        </div>
                        ";
                    }
                } else {
                    echo "<h1 class='prodisplay'> There is no Product Here! <br> Coming Soon.<h1>";
                }
            }  
        }            
}

function getBrandPro() {
        global $db;
        if (isset($_GET['brand'])) {
            $get_brand_id = $_GET['brand'];
            $get_brand_products = "Select * from products where brand_id = '$get_brand_id'";
            $fire2 = mysqli_query($db,$get_brand_products);
            if ($fire2) {
                $count1 = mysqli_num_rows($fire2);
                if ($count1 > 0) {
                    while ($result1 = mysqli_fetch_array($fire2)) {
                        $product_brand_id = $result1['product_id'];
                        $product_brand_title = $result1['product_title'];
                        $category_brand_id = $result1['category_id'];
                        $brand_brand_id = $result1['brand_id'];
                        $product_brand_desc = $result1['product_desc'];
                        $product_brand_price = $result1['product_price'];
                        $product_brand_img = $result1['product_img1'];

                        echo "
                        <div id='single_product' > 
                            <h3> $product_brand_title </h3>
                            <a href='admin/product_images/$product_brand_img' class='minipic' ><img src='admin/product_images/$product_brand_img' width='190' height='190px'/></a> <br>
                            <p> <b> Price: $product_brand_price PKR </b> </p>
                            <a href='details.php?pro_id=$product_brand_id' style='float: left;'> Details </a>
                            <a href='index.php?add_cart=$product_brand_id' ><button style='float: right;'> Add to Cart </button> </a>
                        </div>
                        ";
                    }
                } else {
                    echo "<h1 class='prodisplay'> There is no Product Here! <br> Coming Soon.<h1>";
                }
            }  
        }            
}

function getCategories() {
                         global $db;
                        $categories = "Select * from categories";
                        $fire  = mysqli_query($db,$categories);
                        while ($result = mysqli_fetch_array($fire)) {
                            $cat_id = $result['category_id'];
                            $cat_title = $result['category_title'];
                           echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
                         }
                        
}

function getBrands() {
                         global $db;
                        $brands = "Select * from brands";
                        $fire  = mysqli_query($db,$brands);
                        while ($result = mysqli_fetch_array($fire)) {
                            $brand_id = $result['brand_id'];
                            $brand_title = $result['brand_title'];
                           echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
                         }
                        
}

?>