<?php

$conn = mysqli_connect('localhost','root','','cricket');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Voting</title>
</head>
<body>
    <div class="main_wrapper">
    <div class="main">
        <div class="form">
            <br>
            <h2 style="color:white;"> Players Voting System </h2> <hr> <br>
            <form action="" method="post">
                <input type="submit" value="Afridi" name="afridi"> &nbsp;&nbsp;&nbsp;
                <input type="submit" value="Kohli" name="kohli"> &nbsp;&nbsp;&nbsp;
                <input type="submit" value="Gayle" name="gayle"> &nbsp;&nbsp;&nbsp;
            </form> <br><br>
        </div>
    </div>


<?php
if (isset($_COOKIE['mtw'])) {
    echo " <h2 style='text-align:center; color:Yellow;'> Can't Vote Again! </h2> ";
} 


if (isset($_POST['afridi'])) {
    $name = 'mtw';
    $value = 'true';
    setcookie($name,$value,time()+(1*365*24*60*60));
    $shahid_query = " UPDATE cricket set Afridi = Afridi+1 ";
    $run = mysqli_query($conn,$shahid_query);
    if ($run) {
        echo " <h2 class='msg'> You Casted Vote for Shahid Afridi </h2> ";
    }
}
if (isset($_POST['kohli'])) {
    $name = 'mtw';
    $value = 'true';
    setcookie($name,$value,time()+(1*365*24*60*60));
    $kohli_query = " UPDATE cricket set Kohli = Kohli+1 ";
    $run = mysqli_query($conn,$kohli_query);
    if ($run) {
        echo " <h2 class='msg'> You Casted Vote for Virat Kohli  </h2>" ;
    }
}
if (isset($_POST['gayle'])) {
     $name = 'mtw';
    $value = 'true';
    setcookie($name,$value,time()+(1*365*24*60*60));
    $gayle_query = " UPDATE cricket set Gayle = Gayle+1 ";
    $run = mysqli_query($conn,$gayle_query);
    if ($run) {
        echo " <h2 class='msg'> You Casted Vot for Chris Gayle  </h2> ";
    }
}

include 'display.php';

?>
</div>
</body>
</html>