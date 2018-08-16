<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/text.css">
    <title>Verified Sucessfully!</title>
</head>
<body>
    <?php
include 'includes/config.php';

if (isset($_GET['code'])) {
    $get_code = $_GET['code'];
    $get_user_code = "SELECT * from users where ver_code = '$get_code' ";
    $run_query = mysqli_query($conn,$get_user_code);
    $row = mysqli_fetch_array($run_query);
    $user_id = $row['id'];
    $check_user = mysqli_num_rows($run_query);
    if ($check_user == 1) {
        $update = "UPDATE users set status ='verified'  where id= $user_id";
        $update_query = mysqli_query($conn,$update);
        echo $user_id;
        echo " <h2 class='text'> Thanks for Verifing your Email! &nbsp; <a href='index.php'> Click to Login </a> </h2> ";
    } else {
        echo " Error in Registration.(Duplicate) ";
    }
} else {
    echo "<h2> Sorry! your Email is not verified! Try Again!</h2>";
}

?>
    
</body>
</html>