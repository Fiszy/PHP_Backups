<?php

session_start();
header('location:index.html');

$conn = mysqli_connect('localhost','root','','practice');
if ($conn){
    echo "Connection Established!";
}else{
    echo "Connectivity Error";
}

$name = $_POST['user'];
$pass = $_POST['password'];

$qa = "select * from signin where name = '$name'";
$result = mysqli_query($conn,$qa);
$num = mysqli_num_rows($result);

if ($num ==1){
    echo "Duplicate Data";
}else{
    $qy = " INSERT INTO signin(name,password) VALUES ('$name','$pass') ";
    mysqli_query($conn,$qy);
}


?>