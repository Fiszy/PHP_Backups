<?php require 'includes/config.php'; ?>

<?php
    if (isset($_GET['edit_brand'])) {
        $brand_id = $_GET['edit_brand'];
        $edit_brand = " SELECT * from brands where brand_id = '$brand_id'";
        $run_brand = mysqli_query($conn,$edit_brand);
        $row_brand = mysqli_fetch_array($run_brand);
        $title = $row_brand['brand_title'];
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
        <b> Edit this Brand: </b>
        <input type="text" name="title" value= <?php echo $title; ?>>
        <input type="submit"  name="update" value ="Update">
    </form>

    <?php

    if (isset($_POST['update'])) {
        $title = $_POST['title'];
        $update_cat = " UPDATE brands set brand_title='$title' where brand_id = '$brand_id'";
        $query = mysqli_query($conn,$update_cat);
        if ($query) {
        echo " <script> alert('Updated Successfully!') </script> ";
        echo " <script> window.open('index.php?view_brands','_self') </script> ";
        }
    }
    ?>
</body>
</html>