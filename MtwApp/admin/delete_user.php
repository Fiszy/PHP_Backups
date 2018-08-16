<?php

include 'includes/config.php';
if (isset($_GET['delete'])) {
    $get_id = $_GET['delete'];
    $delete = " DELETE from users where id = '$get_id' ";
    $run = mysqli_query($conn,$delete);
    $delete_posts = " DELETE from posts where user_id = '$get_id' ";
    $run_del = mysqli_query($conn,$delete_posts);
    if ($run) {
        if ($run_del) {
            echo " <script> alert('User has been Deleted') </script> ";
            echo " <script> window.open('index.php?view_users','_self') </script> ";
        }
    }
}


?>