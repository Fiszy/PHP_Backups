<?php

if (isset($_POST['submit'])) {
    $name = $_POST['username'];
    $passw = $_POST['pass'];
    $checkbox = $_POST['checkbox'];
    $conn = mysqli_connect("localhost","root","","talha");
    if (!$conn){
        echo "Database Connectivity Error";

    } else{
        
        $sql = "INSERT INTO users (name,password)
    VALUES ('$name','$passw')";
    $query = mysqli_query ($conn, $sql);
}
} else {
    echo "File Not Found!! ";    
}
?>






