<?php

session_start();
if (! isset($_SESSION['username'])){
    header('location:index.html');
}
$conn = mysqli_connect('localhost','root','','practice');
if ($conn){
    $name = $_POST['user'];
    $pass = $_POST['password'];

$qa = "select * from signin where name = '$name' && password = '$pass'";
$result = mysqli_query($conn,$qa);
$num = mysqli_num_rows($result);

if ($num ==1){
    header('location:home.php');
    $_SESSION['username'] = $name;
}else{
     
    echo "Sorry! Account Doesnot Exist!";  
}
    
}else{
    echo "Connectivity Error";
}




?>