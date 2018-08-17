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
    <table width="760" height="500" align="center" bgcolor="#ffcccc" border="2" cellspacing="0" style="margin-left:15px; margin-top:50px; " >
        <tr align="center">
            <td colspan="4"> <h2> View All Brands </h2> </td>
        </tr>
    
        <tr align="center">
            <th> Brand ID </th>
            <th> Brand Title</th>
            <th> Delete </th>
            <th> Edit</th>
        </tr>

        <?php
        $get_brand = " SELECT * from brands";
        $run_brand = mysqli_query($conn,$get_brand);
        while ($row_get_brand = mysqli_fetch_array($run_brand)) {
            $brand_id = $row_get_brand['brand_id'];
            $brand_title = $row_get_brand['brand_title'];
        ?>

        <tr align="center">
            <td> <?php  echo $brand_id ?> </td>
            <td> <?php  echo $brand_title ?></td>
            <td> <a href="index.php?edit_brand= <?php echo $brand_id; ?>"> Edit </a> </td>
            <td> <a href="index.php?delete_brand= <?php echo $brand_id; ?>"> Delete </a> </td>
        </tr>

        <?php } ?>

    </table> 
</body>
</html>