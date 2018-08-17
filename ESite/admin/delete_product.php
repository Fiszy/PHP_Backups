<?php require 'includes/config.php'; ?>
<?php


if (isset($_GET['delete_product'])) {
    $delete_id = $_GET['delete_product'];
    $delete_product = " DELETE from products where product_id = '$delete_id' ";
    $run_delete = mysqli_query($conn,$delete_product);
    if ($run_delete) {
        echo " <script> alert('Deleted Successfully!') </script> ";
        echo " <script> window.open('index.php?view_products','_self') </script> ";
    }
}


?>