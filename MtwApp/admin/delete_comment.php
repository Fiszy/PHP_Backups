<?php

include 'includes/config.php';
if (isset($_GET['delete'])) {
    $get_id = $_GET['delete'];
    $delete = " DELETE from comments where comment_id = '$get_id' ";
    $run = mysqli_query($conn,$delete);
    if ($run) {
            echo " <script> alert('Comment has been Deleted') </script> ";
            echo " <script> window.open('index.php?view_comments','_self') </script> ";
    }
}


?>