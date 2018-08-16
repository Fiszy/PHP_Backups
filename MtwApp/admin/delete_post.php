<?php

include 'includes/config.php';
if (isset($_GET['delete'])) {
    $get_id = $_GET['delete'];
    $delete = " DELETE from posts where post_id = '$get_id' ";
    $run = mysqli_query($conn,$delete);
    if ($run) {
            echo " <script> alert('Post has been Deleted') </script> ";
            echo " <script> window.open('index.php?view_posts','_self') </script> ";
    }
}


?>