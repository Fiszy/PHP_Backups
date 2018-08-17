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
            <td colspan="11"> <h2> View All Customers </h2> </td>
        </tr>
    
        <tr align="center">
            <th> Customer ID </th>
            <th> Customer Name </th>
            <th> Customer Email </th>
            <th> Customer Country </th>
            <th> Customer Image </th>
            <th> Delete </th>
            
        </tr>

        <?php
        $i=0;
        $get_customer = " SELECT * from customers";
        $customer = mysqli_query($conn,$get_customer);
        while ($row_get_brand = mysqli_fetch_array($customer)) {
            $customer_id = $row_get_brand['customer_id'];
            $customer_name = $row_get_brand['customer_name'];
            $customer_email = $row_get_brand['customer_email'];
            $customer_pass = $row_get_brand['customer_pass'];
            $customer_country = $row_get_brand['customer_country'];
            $customer_city = $row_get_brand['customer_city'];
            $customer_contact = $row_get_brand['customer_contact'];
            $customer_address = $row_get_brand['customer_address'];
            $customer_image = $row_get_brand['customer_image'];
            $i++;
        ?>

        <tr align="center">
        
            <td> <?php  echo $i; ?> </td>
            <td> <?php  echo $customer_name ?></td>
            <td> <?php  echo $customer_email ?></td>
            <td> <?php  echo $customer_country ?></td>
            <td align="center"> <img src="../customer/customer_images/<?php echo $customer_image; ?>" height="50" width="50"></td>
            <td> <a href="index.php?delete_customer=<?php echo $customer_id; ?>"> Delete </a> </td>
        </tr>

        <?php } ?>

    </table> 
</body>
</html>