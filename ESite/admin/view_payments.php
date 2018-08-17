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
            <th> Payment No </th>
            <th> Inovice_no </th>
            <th> Amount </th>
            <th> Payment Mode </th>
            <th> Reference No </th>
            <th> Code </th>
            <th> Payment date </th>
            
        </tr>

        <?php
        $i=0;
        $get_payments = " SELECT * from payments";
        $payments = mysqli_query($conn,$get_payments);
        while ($row_get_payments = mysqli_fetch_array($payments)) {
            $payment_id = $row_get_payments['payment_id'];
            $inovice_no = $row_get_payments['inovice_no'];
            $amount = $row_get_payments['amount'];
            $payment_mode = $row_get_payments['payment_mode'];
            $ref_no = $row_get_payments['ref_no'];
            $payment_date = $row_get_payments['payment_date'];
            $code = $row_get_payments['code'];
            $i++;
         
        
        ?>

        <tr align="center">
            <td> <?php  echo $i; ?> </td>
            <td> <?php  echo $inovice_no; ?></td>
            <td> <?php  echo $amount; ?></td>
            <td> <?php  echo $payment_mode; ?></td>
            <td> <?php  echo $ref_no; ?></td>
            <td> <?php  echo $code; ?></td>
            <td> <?php  echo $payment_date; ?></td>
            
            <!-- <td> <a href="index.php?delete_customer= <?php  //  echo $customer_id; ?>"> Delete </a> </td> -->
        </tr>

        <?php } ?>

    </table> 
</body>
</html>