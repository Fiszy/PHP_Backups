<!-- Configuation Database Connect File -->
<?php require 'includes/config.php'; ?>
<?php require 'functions.php'; ?>
<?php  session_start(); ?>

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
             <?php cart(); ?>
                <div class="headline"  >
                    <div id="headline_content">
                        <b> Welcome Guest! </b> 
                        <b style=" color:yellow" > Shopping Cart  </b>
                        <span> - Total Items: <?php items(); ?>  -Total Price: <?php totalprice(); ?> - <a href="cart.php" style="color:yellow"> Go to Cart </a> &nbsp;
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
                <div>
                    <div> 
                        <form action="" method="post" enctype="multipart/form-data" >
                                    <table width="800px" height="655" bgcolor="#242729" align="center" cellpadding="10px;" cellspacing="30"> 
                                        <tr align="center">
                                            <td colspan="2"> <h2 > Create An Account </h2> <hr> </td>
                                        </tr> 
                                        <tr>
                                            <td align="right" > <b>Your Name: </b> </td> 
                                            <td> <input type="text" name="c_name" required placeholder="Enter Full Name">  </td>  
                                        </tr>
                                        <tr>
                                            <td align="right" > <b>Your Email: </b> </td> 
                                            <td> <input type="email" name="c_email" required placeholder="Enter Your Email ">  </td> 
                                        </tr>
                                        <tr>
                                            <td align="right" > <b>Your Password: </b> </td> 
                                            <td> <input type="pass" name="c_pass" required   placeholder="Enter Your Password ">  </td> 
                                        </tr>
                                        <tr>
                                            <td align="right" > <b>Your Country: </b> </td> 
                                            <td> <select name="c_country" >
                                                    <option > Select a Country </option>
                                                    <option > Afghanistan </option>
                                                    <option > India</option>
                                                    <option > Iran </option>
                                                    <option > Japan </option>
                                                    <option > China</option>
                                                    <option > Pakistan</option>
                                                    <option > Saudia Arabia</option>
                                                    <option > USA</option>
                                                    <option > UK</option>
                                                    <option > UAE</option>
                                                    </select> </td>
                                        </tr>
                                        <tr>
                                            <td align="right" > <b>Your City: </b> </td> 
                                            <td> <input type="text" name="c_city" required placeholder="Enter Your City ">  </td> 
                                        </tr>
                                        <tr>
                                            <td align="right" > <b>Your Mobile No: </b> </td> 
                                            <td> <input type="tel" name="c_number" required placeholder="Enter Your Mobile Number ">  </td> 
                                        </tr>
                                        <tr>
                                            <td align="right" > <b>Your Address: </b> </td>
                                            <td> <input type="text" name="c_addr" required placeholder="Enter Your Address ">  </td> 
                                        </tr>
                                        <tr>
                                            <td align="right" > <b>Your Profile Pic: </b></td>
                                            <td> <input type="file" name="c_image" required >  </td>
                                        </tr>
                                        <tr align="center">
                                            <td colspan="2"> <input type="submit" name="register" value="Register"> </td>
                                        </tr>
                                    </table>
                            </form>
                    </div>

                        <?php
                            if (isset($_POST['register'])) {
                                $c_name = $_POST['c_name'];
                                $c_email = $_POST['c_email'];
                                $c_pass = $_POST['c_pass'];
                                $c_country = $_POST['c_country'];
                                $c_number = $_POST['c_number'];
                                $c_city = $_POST['c_city'];
                                $c_addr = $_POST['c_addr'];
                                $c_image = $_FILES['c_image']['name'];
                                $c_image_tmp = $_FILES['c_image']['tmp_name'];
                                $c_ip = getRealIpAddr();
                                $insert_customer = " INSERT into customers (customer_name,customer_email,customer_pass,customer_country,customer_city,
                                customer_contact,customer_address,customer_image,customer_ip) 
                                VALUES ('$c_name','$c_email','$c_pass','$c_country','$c_city','$c_number','$c_addr','$c_image','$c_ip') ";
                                $fire15 = mysqli_query($conn,$insert_customer);
                                if ($fire15) {
                                    move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");
                                    $_SESSION['customer_email'] = $c_email;
                                    $cartip = " SELECT * from cart where ip_add = '$c_ip' ";
                                    $fire14 = mysqli_query($conn,$cartip);
                                    $check_cartip = mysqli_num_rows($fire14);
                                    if ($check_cartip == 1) {
                                        $_SESSION['customer_email'] = $c_email;
                                        echo " <script> alert('Account Created Successfully! Go and Kill the Waves.') </script> ";
                                        echo " <script> window.open('checkout.php','_self') </script> ";
                                    } else {
                                        echo " <script> window.open('index.php','_self') </script> ";
                                    }
                                } else {
                                    echo " <script> alert('Error! Please Try Again!') </script> ";
                                }
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