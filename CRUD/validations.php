<?php

// strip tags , html tags ko remove kr dega

$fullname = strip_tags($_POST['fullname']);
$username = strip_tags($_POST['username']);
$password = strip_tags($_POST['password']));
$email    = strip_tags($_POST['email']);
// also use mysqli_real_escape_string($conn,$_POST['fullname']);

//  trim function space ko left and right sy remove kr dega

    if (empty(trim($fullname))){
        echo "Full name is Required!!";
    }
    if (empty(trim($username))){
        echo "User name is Required!!";
    }
    if (empty(trim($password))){
        echo "password is Required!!";
    }
    if (empty(trim($email))){
        echo "email is Required!!";
    }

// preg match function use kro tw wo string ka pattern btati 

    if (preg_match('/^a-zA-Z\s/',$fullname)) {
        echo "Only alphabets are allowed";
    } else {
        echo "Full name looks good";
    }

// mail validation filter vaiable

    if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
        echo "email looks Good";
    } else {
        echo "Invalid Email";
    }

// string length

    if (strlen($fullname) > 2 && strlen($fullname) < 30) {
        echo "Full name is ok";
    } else {
        echo "Full name is not ok";
    }

?>