<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hashing</title>
</head>
<body>
    <?php
     $input = "talha";
     $hashed = password_hash($input,PASSWORD_DEFAULT);
    //  echo $hashed;
    if (password_verify($input,$hashed)) {
        echo "Verified";
    } else {
        echo "Error";
    }
    
    

    ?>
    
</body>
</html>