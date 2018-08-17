<?php 

require 'includes/config.php';
require 'functions.php';


//Getting Customer ID
if (isset($_GET['order_no'])) {
    $customer_id = $_GET['order_no'];
    $customer_email_query = " SELECT * from customers where customer_id = '$customer_id' ";
    $run_email = mysqli_query($conn,$customer_email_query);
    $fetching = mysqli_fetch_array($run_email);
    $fetch_email = $fetching['customer_email'];
    $fetch_name = $fetching['customer_name'];
}

// Getting Products Price and Number of items
    $ip_addr = getRealIpAddr();
    $total = 0;
    $i= 0;
    $select_price = "Select * from cart where ip_add = '$ip_addr'"; 
    $fire9 = mysqli_query($db,$select_price);
    $status = 'Pending';
    $invoice_no = mt_rand();
    $count_pro = mysqli_num_rows($fire9);
    while ($result9 = mysqli_fetch_array($fire9)) {
        $product_price_id = $result9['product_id'];
        $pro_price = "Select * from products where product_id = '$product_price_id'"; 
        $fire10 = mysqli_query($db,$pro_price);
        while($result10 = mysqli_fetch_array($fire10)) {
            $product_name = $result10['product_title'];
            $product_price = array($result10['product_price']);
            $values = array_sum($product_price);
            $total += $values;
            $i++;
        }
    }

    // Getting Quantity from cart

    $get_cart =  "SELECT * from cart";
    $run_cart = mysqli_query($conn,$get_cart);
    $get_qty = mysqli_fetch_array($run_cart);
    $qty = $get_qty['qty'];
    if ($qty == 0) {
        $qty = 1;
        $sub_total = $total;
    } else {
        $qty = $qty;
        $total = $total*$qty;
    }
       global $product_price_id;
        $insert_order_c = " INSERT into customer_orders (customer_id,due_amount,invoice_no,total_products,order_date,order_status) VALUES ('$customer_id','$sub_total','$invoice_no','$count_pro',NOW(),'$status')";
        $fire20 = mysqli_query($conn,$insert_order_c);
        
        $insert_order_p = " INSERT into pending_orders (customer_id,invoice_no,product_id,qty,order_status) VALUES ('$customer_id','$invoice_no','$product_price_id','$qty','$status') ";
        $fire21 = mysqli_query($conn,$insert_order_p);
        
        $empty_cart = "DELETE from cart where ip_add = '$ip_addr'";
        $fire22 = mysqli_query($conn,$empty_cart);

        $from = 'admin@mtwshop.com';
        $subject = 'Order Details';
        $message = "
        <html>
    <div align='center'>
            <p> Hello <b> $fetch_name </b>. You Have Ordered Some Products on <a href='www.mtshop.com'> www.mtshop.com</a>. You can find these Details below :  </p>
            <table width='600' bgcolor='#ffcc99' align='center' border='2'>
                <tr>
                    <td> <h2> Your Order Details from $from </h2> </td>
                </tr>
                <tr>
                    <th> S.N </th>
                    <th> Product Name </th>
                    <th> Quantity </th>
                    <th> Total Price</th>
                    <th> Invoice No</th>
                </tr>
                <tr>
                    <td>  $i </td>
                    <td> $product_name </td>
                    <td> $qty</td>
                    <td> $sub_total</td>
                    <td> $invoice_no</td>
                </tr>
            </table>
            <h3> Please Go to Your Account and Pay Your Dues so we can Further Proceed your Order! </h3>
            <h3> Thankyou For Order on
                <a href='www.mtshop.com'> www.mtshop.com </a>
            </h3>
        </div>
      </html>
        ";
        mail($fetch_email,$subject,$message,$from);
        
        
        if ($fire20) {
            if ($fire21) {
                header('location:customer/my_account.php?msg= YO! Order Submitted Successfully.');
            }
        }
?>