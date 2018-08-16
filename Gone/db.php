<?php

$host = "localhost";
$user = "root";
$pass = "";
$db_name = "chat";

$conn = new mysqli($host,$user,$pass,$db_name);

function formatdate($date) {
    return date ('g:j a', strtotime($date));
}


?>