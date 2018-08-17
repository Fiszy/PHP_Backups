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
    <form action="" method="post" style="margin-top: 150px; margin-left: 220px;">
        <b> Insert New Brand: </b>
        <input type="text" name="brand_title">
        <input type="submit"  name="insert" value ="Insert">
    </form>

    <?php
    if (isset($_POST['insert'])) {
        $brand_title = $_POST['brand_title'];
        $insert_brand = " INSERT into brands (brand_title) values ('$brand_title') ";
        $run_brand = mysqli_query($conn,$insert_brand);
        if ($run_brand) {
            echo " <script> alert('Inserted Successfully!') </script> ";
            echo " <script> window.open('index.php?view_brands','_self') </script> ";
        }
    }

    ?>
    
</body>
</html>