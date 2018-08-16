<!-- Configuation Database Connect File -->
<?php require 'config.php'; ?>
<?php
    session_start();
    if ($_SESSION['is_login']) {
        $username = $_SESSION['username'];
    } else {
        header('location:signin.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Dashboard</title>
</head>
<body background="images/back.jpg">
      <!-- navbar -->
      <?php require 'include/navbar.php'; ?>
      <center><h1> Welcome <?php echo $username;?></h1></center>
      <center><p>There is nothing to show for now. You can <a href="logout.php">Logout.</a></p></center>
    
</body>
</html>