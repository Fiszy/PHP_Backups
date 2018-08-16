<?php

include 'includes/config.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/profile.css">
    <title>Document</title>
</head>
<body>
    <div id="content_timeline">
        <div class="form2 animated jello">
                <form action="" method="POST" id="signupform" >
                    <h2>Add New Topic</h2> <hr>
                    <table>
                        <tr>
                            <td align="right"> Topic</td>
                            <td>
                                <input type="text" name="u_name"> </td>
                        </tr>
                    <br>
                <button type="submit" name="update" class="btnsign"> Add Topic </button>
                </form>
            </div>
    </div>
    
</body>
</html>
<?php
if (isset($_POST['update'])) {
    $u_name     = mysqli_real_escape_string($conn,$_POST['u_name']) ;
    $update_user = " INSERT into topics (topics_name) values ('$u_name') ";
    $fire2 = mysqli_query($conn,$update_user);
    if ($fire2) {
         echo " <script> alert('Added Successfully') </script> ";
         echo " <script> window.open('index.php?view_topics','_self') </script> ";
    } else {
        echo " <script> alert('Add Failed') </script> ";
    }

}