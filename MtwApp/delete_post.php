<?php

$conn = mysqli_connect('localhost','root','','mtwapp');

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $delete_post = " DELETE from posts where post_id = '$post_id' ";
    $run_delete = mysqli_query($conn,$delete_post);
    if ($run_delete) {
        echo " <script> alert('Post has been Deleted Successfully') </script> ";
        echo " <script> window.open('home.php','_self') </script> ";
    } 
}

?>