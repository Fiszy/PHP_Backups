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
    
    <table align='center' width='770' bgcolor='#ffcc99' border='2' cellspacing="0" style="margin-left:10px">
        <tr align="center"  >
            <td colspan="8"> <h2> View All Products </h2> </td>
        </tr>
        <tr>
            <th> Product No </th>
            <th> Title </th>
             <th> Product Image </th>
            <th> Product Price </th>
            <th> Product Status</th>
            <th> Total Sold </th>
            <th> Edit </th>
            <th> Delete </th>
        </tr>
        <?php
        $i = 0;
        $get_products = " SELECT * from products";
        $run1 = mysqli_query($conn,$get_products);
        while ($row = mysqli_fetch_array($run1)) {
            $p_id = $row['product_id'];
            $p_title = $row['product_title'];
            $p_image = $row['product_img1'];
            $p_price = $row['product_price'];
            $p_status = $row['status'];
            $i++;
        ?>

        


        <tr align="center">
            <td> <?php  echo $i ?> </td>
            <td> <?php  echo $p_title ?></td>
            <td > <img  src="product_images/<?php echo $p_image ?>" height="50" width="50" ></td>
            <td> <?php  echo $p_price ?></td>
            <td>  <?php  echo $p_status ?></td>
            <td>
                <?php
                $get_sold = " SELECT * from pending_orders where product_id = '$p_id' ";
                $run_sold = mysqli_query($conn,$get_sold);
                $count = mysqli_num_rows($run_sold);
                echo $count;
                ?>
            </td>
            <td> <a href="index.php?edit_product= <?php echo $p_id ?>"> Edit </a> </td>
            <td> <a href="index.php?delete_product=<?php echo $p_id ?>"> Delete </a> </td>
        </tr>
        <?php  } ?>
    </table>
       


    
</body>
</html>

 