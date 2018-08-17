<?php require 'includes/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table width="770"  align="center" bgcolor="#ffcccc" border="2" cellspacing="0" style="margin-left:10px">
        <tr align="center">
            <td colspan="11"> <h2> View All Orders </h2> </td>
        </tr>
        <tr align="center">
            <th> Order No </th>
            <th> Customer Email</th>
            <th> Invoice No </th>
            <th> Product ID </th>
            <th> QTY </th>
            <th> Status </th>
            <th> Delete </th>
        </tr>
        <?php
        $i=0;
        $get_orders = " SELECT * from pending_orders";
        $orders = mysqli_query($conn,$get_orders);
        while ($row_get_orders = mysqli_fetch_array($orders)) {
            $order_no = $row_get_orders['order_id'];
            $customer_id = $row_get_orders['customer_id'];
            $invoice_no = $row_get_orders['invoice_no'];
            $product_id = $row_get_orders['product_id'];
            $qty = $row_get_orders['qty'];
            $order_status = $row_get_orders['order_status'];
            $i++;
        ?>
        <tr align="center">
            <td> <?php  echo $i; ?> </td>
            <td> <?php 
                $query = " SELECT * from customers where customer_id = '$customer_id' ";
                $run_query = mysqli_query($conn,$query);
                $row_query = mysqli_fetch_array($run_query);
                $customer_email = $row_query['customer_email'];
                if ($customer_email) {
                    echo $customer_email;
                }
            ?></td>
            <td> <?php  echo $invoice_no ?></td>
            <td> <?php  echo $product_id ?></td>
            <td> <?php  echo $qty ?></td>
            <td> <?php  echo $order_status ?></td>
            <td> <a href="index.php?delete_order=<?php echo $order_no; ?>"> Delete </a> </td>
        </tr>
        <?php } ?>
    </table> 
</body>
</html>