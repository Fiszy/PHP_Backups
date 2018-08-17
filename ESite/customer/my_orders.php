<?php

//  require 'includes/config.php';
//  session_start(); 

     
        $c  = $_SESSION['customer_email'];
        $get_c = " SELECT * from customers where customer_email = '$c' ";
        $run_c = mysqli_query($db,$get_c);
        $row_c = mysqli_fetch_array($run_c);
        $customer_id = $row_c['customer_id'];
     
?>
<br> 
<h2 align="center" style=" width: 739px; background: #f12711;  background: -webkit-linear-gradient(to right, #f5af19, #f12711); background: linear-gradient(to right, #f5af19, #f12711);"> All Orders Details </h2> <br>
        <table width="740" align="center" border="1" cellspacing="0"  bgcolor="#6699ff" >
            
            <tr>
                <th> Order No </th>
                <th> Invoice No</th>
                <th> Due Amount </th>
                <th> Total Products</th>
                <th> Order Date</th>
                <th> Paid/Unpaid </th>
                <th> Status </th>
            </tr>


            <?php
                $get_orders = " SELECT * from customer_orders where customer_id = '$customer_id' ";
                $run_order = mysqli_query($conn,$get_orders);
                $i = 0;
                while ($row_orders = mysqli_fetch_array($run_order)) {
                    $order_id = $row_orders['order_id'];
                    $due_amount = $row_orders['due_amount'];
                    $invoice_no = $row_orders['invoice_no'];
                    $total_products = $row_orders['total_products'];
                    $order_date = $row_orders['order_date'];
                    $order_status = $row_orders['order_status'];
                    $i++;

                    if ($order_status == 'Pending') {
                        $order_status = 'Unpaid';
                    } else {
                        $order_status = 'Paid';
                    }

                    $order_confirm = "" ;
                    if ($order_status == 'Unpaid') {
                        $order_confirm = "<a href='confirm.php?order_id=$order_id'> Confirm </a> (if Paid)" ;
                    } 
                    if ($order_status == 'Paid') {
                        $order_confirm = "Success" ;
                    }


                    echo "
                        <tr align='center'>
                            <td> $i  </td>
                            <td> $invoice_no </td>
                            <td> $due_amount </td>
                            <td> $total_products </td>
                            <td> $order_date </td>
                            <td> $order_status  </td>
                            <td> $order_confirm </td>
                    </tr>
                    ";
                }
            ?>
            
        </table>
        