<?php

session_start();



?>

<html>
<head>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    <h2 class="text-center"> Welcome <?php  echo $_SESSION['username']; ?>  </h2>
    <a href="logout.php">Logout</a>
    </div>
    
</body>
</html>