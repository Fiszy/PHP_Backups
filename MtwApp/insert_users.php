<?php include 'includes/config.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/text.css">
    <title>Document</title>
</head>
<body>
    
<?php
if (isset($_POST['sign_up'])) {
    $u_name     = mysqli_real_escape_string($conn,$_POST['u_name']) ;
    $u_password = mysqli_real_escape_string($conn,$_POST['u_password']) ;
    $u_email    = mysqli_real_escape_string($conn,$_POST['u_email']) ;
    $u_country  = mysqli_real_escape_string($conn,$_POST['u_country']) ;
    $u_gender   = mysqli_real_escape_string($conn,$_POST['u_gender']) ;
    $u_birthday = mysqli_real_escape_string($conn,$_POST['u_birthday']) ;
    $status = " Unverified ";
    $posts = "yes";
    $ver_code = mt_rand();
    $passlen = strlen($u_password); 

    if ($passlen < 8)  {
        echo " <script> alert('Password Should be 8 Characters') </script> ";
        exit();
    }
    $check_email = " SELECT * from users where user_email = '$u_email' ";
    $fire1 = mysqli_query($conn,$check_email);
    $rows = mysqli_num_rows($fire1);
    if ($rows == 1) {
        echo " <script> alert('Email Already Exists') </script> ";
        exit();
    }

    $insert_user = " INSERT into users ( user_name,user_pass,user_email,user_country,user_gender,user_birthday,user_image,user_reg_date,status,ver_code,posts) values ('$u_name','$u_password','$u_email','$u_country','$u_gender','$u_birthday','default.jpg',NOW(),'$status','$ver_code','$posts') ";
    $fire2 = mysqli_query($conn,$insert_user);
    if ($fire2) {
        echo " <h3 class='text'> Hi $u_name. Congratulations! Registration is almost Complete, Check your Email for Verification Code. </h3> ";
    } else {
        echo " <script> alert('Registration Failed') </script> ";
    }

    $to = $u_email;
    $subject= " Verify your Email Address";
    $message = '
        <html lang="en">
            Hello <strong> '. $u_name .' </strong>. You have Just Created an account on www.socialnetwork.com, <br>
            <a href="http://localhost/Projects/MtwApp/verify.php?code='.$ver_code.'"> Click to Verify Your Email Address </a> <br>
            <strong> Thankyou for Creating an account! </strong>
        </html>
    ';
    $headers = "MIME-Version: 1.0"."\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
    $headers .= "From: <admin@socialnetwork.com> "; 

    mail($to,$subject,$message,$headers);


}


?>
</body>
</html>

