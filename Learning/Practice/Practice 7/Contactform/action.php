<?php

if (isset($_POST['submit'])) {
    $fullname = $_POST['name'];
    $email    = $_POST['mail'];
    $subject  = $_POST['subject'];
    $msg      = $_POST['message'];

    $mail_to = "muhammadtalhawaseem@gmail.com";
    $headers = "Form".$email;
    $txt = "You have ext receivd from".$name."."."\n\n".$msg;
    
    mail($mail_to,$subject,$txt,$headers);

}


?>