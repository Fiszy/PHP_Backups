<?php require 'includes/config.php'; ?>
<?php


if (isset($_GET['delete_order'])) {
    $delete_order = $_GET['delete_order'];
    $query = " DELETE from pending_orders where order_id = '$delete_order' ";
    $run_delete = mysqli_query($conn,$query);
    if ($run_delete) {
        echo " <script> alert('Deleted Successfully!') </script> ";
        echo " <script> window.open('index.php?view_orders','_self') </script> ";
    }
}


?>