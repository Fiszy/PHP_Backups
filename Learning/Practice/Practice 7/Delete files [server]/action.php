<?php

if (isset($_POST['submit'])) {
    $path = "images/ES.pdf";
    if (!unlink($path)) {
        echo "you have an error";
    } else {
        header('location:index.html?deletesuccess');
    }
}

?>