<?php require 'includes/config.php'; ?>

<?php
    if (isset($_GET['edit_category'])) {
        $category_id = $_GET['edit_category'];
        $edit_category = " SELECT * from categories where category_id = '$category_id'";
        $run_category = mysqli_query($conn,$edit_category);
        $row_category = mysqli_fetch_array($run_category);
        $title = $row_category['category_title'];
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
        <b> Edit this Category: </b>
        <input type="text" name="title" value= <?php echo $title; ?>>
        <input type="submit"  name="update" value ="Update">
    </form>

    <?php

    if (isset($_POST['update'])) {
        $title = $_POST['title'];
        $update_cat = " UPDATE categories set category_title='$title' where category_id = '$category_id'";
        $query = mysqli_query($conn,$update_cat);
        if ($query) {
        echo " <script> alert('Updated Successfully!') </script> ";
        echo " <script> window.open('index.php?view_category','_self') </script> ";
        }
    }
    ?>
</body>
</html>