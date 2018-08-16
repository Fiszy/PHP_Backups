<?php

session_start();
header('location:index.php');
$con = mysqli_connect('localhost','root','','quizdb');
$username = $_POST['user'];
$password = $_POST['pass'];
$check = "select * from quizregistration where user='$username' && pass='$password' ";
$resultcheck = mysqli_query($con,$check);	
$row = mysqli_num_rows($resultcheck);
if($row == 1){			
}	else{
		$q = "insert into quizregistration(user, pass) values ('$username', '$password')"  ;
		$result = mysqli_query($con,$q);
	}
?>


