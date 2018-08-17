<?php require 'includes/config.php'; ?>

<?php
    if (isset($_GET['edit_customer'])) {
        $customer_get_id = $_GET['edit_customer'];
        $customer = " SELECT * from customers where customer_id = '$customer_get_id'";
        $query = mysqli_query($conn,$customer);
        $row_customer = mysqli_fetch_array($query);
        $customer_id = $row_customer['customer_id'];
        $customer_name = $row_customer['customer_name'];
        $customer_email = $row_customer['customer_email'];
        $customer_pass = $row_customer['customer_pass'];
        $customer_country = $row_customer['customer_country'];
        $customer_city = $row_customer['customer_city'];
        $customer_contact = $row_customer['customer_contact'];
        $customer_address = $row_customer['customer_address'];
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" style="margin-top: 150px; margin-left: 220px;">
        <table>
            


        </table>
    </form>

    <?php

    // if (isset($_POST['update'])) {
    //     $title = $_POST['title'];
    //     $update_cat = " UPDATE brands set brand_title='$title' where brand_id = '$brand_id'";
    //     $query = mysqli_query($conn,$update_cat);
    //     if ($query) {
    //     echo " <script> alert('Updated Successfully!') </script> ";
    //     echo " <script> window.open('index.php?view_customers','_self') </script> ";
    //     }
    // }
    ?>
</body>
</html>