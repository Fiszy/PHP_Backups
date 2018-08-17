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
            <td colspan="4"> <h2> View All Categories </h2> </td>
        </tr>
    
        <tr align="center">
            <th> Category ID </th>
            <th> Category Title</th>
            <th> Delete </th>
            <th> Edit</th>
        </tr>

        <?php
        $get_categories = " SELECT * from categories";
        $run_categories = mysqli_query($conn,$get_categories);
        while ($row_categories = mysqli_fetch_array($run_categories)) {
            $categories_id = $row_categories['category_id'];
            $categories_title = $row_categories['category_title'];
        ?>

        <tr align="center">
            <td> <?php  echo $categories_id ?> </td>
            <td> <?php  echo $categories_title ?></td>
            <td> <a href="index.php?edit_category= <?php echo $categories_id; ?>"> Edit </a> </td>
            <td> <a href="index.php?delete_category= <?php echo $categories_id; ?>"> Delete </a> </td>
        </tr>

        <?php } ?>

    </table> 
</body>
</html>