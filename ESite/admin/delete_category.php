<?php require 'includes/config.php'; ?>
<?php


if (isset($_GET['delete_category'])) {
    $delete_id = $_GET['delete_category'];
    $delete_category = " DELETE from categories where category_id = '$delete_id' ";
    $run_delete = mysqli_query($conn,$delete_category);
    if ($run_delete) {
        echo " <script> alert('Deleted Successfully!') </script> ";
        echo " <script> window.open('index.php?view_category','_self') </script> ";
    }
}


?>