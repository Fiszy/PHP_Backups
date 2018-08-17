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
        <b> Insert New Category: </b>
        <input type="text" name="category_title">
        <input type="submit"  name="insert" value ="Insert">
    </form>

    <?php
    if (isset($_POST['insert'])) {
        $category_title = $_POST['category_title'];
        $insert_category = " INSERT into categories (category_title) values ('$category_title') ";
        $run_categories = mysqli_query($conn,$insert_category);
        if ($run_categories) {
            echo " <script> alert('Inserted Successfully!') </script> ";
            echo " <script> window.open('index.php?view_category','_self') </script> ";
        }
    }

    ?>
    
</body>
</html>