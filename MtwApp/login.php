<?php include 'includes/config.php';?>
<?php

session_start();

if (isset($_POST['login'])) {
$email  = mysqli_real_escape_string($conn,$_POST['email']) ;
$pass   = mysqli_real_escape_string($conn,$_POST['pass']) ;

$login_query = " SELECT * from users where user_email = '$email' and user_pass = '$pass' AND status = 'verified' ";
$fire = mysqli_query($conn,$login_query);
$check_user = mysqli_num_rows($fire);
if ($check_user == 1) {
    $_SESSION['user_email'] = $email;
    echo " <script> window.open('home.php','_self') </script> ";
} else {
    echo " <script> alert('Incorrect Email or Password!') </script> ";
    echo " <script> window.open('index.php','_self') </script> ";
}

}

?>