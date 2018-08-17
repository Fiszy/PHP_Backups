<?php require 'includes/config.php'; ?>
<?php


if (isset($_GET['delete_customer'])) {
    $delete_customer = $_GET['delete_customer'];
    $query = " DELETE from customers where customer_id = '$delete_customer' ";
    $run_delete = mysqli_query($conn,$query);
    if ($run_delete) {
        echo " <script> alert('Deleted Successfully!') </script> ";
        echo " <script> window.open('index.php?view_customers','_self') </script> ";
    }
}


?>