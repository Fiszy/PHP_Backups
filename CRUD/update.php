<!-- Configuation Database Connect File -->
<?php require 'config.php'; ?>

<!-- Update PHP Code -->
<?php
if (isset($_GET['upd'])){
    $id = $_GET['upd'];
    $query = "SELECT * FROM users WHERE id = $id";
    $fire = mysqli_query($conn,$query) or die("CAn not fetch data.".mysqli_error($conn));
    $users = mysqli_fetch_assoc($fire);
}
?>
<?php
    if(isset($_POST['submit'])){
        $msg = "";
        $fullname = strip_tags(trim($_POST['fullname']));
        $username = strip_tags(trim($_POST['username']));
        $password = strip_tags(trim($_POST['password']));
        $email    = strip_tags(trim($_POST['email']));

        $fullname_valid = $username_valid = $password_valid =$email_valid = false;

        // <!-- full name Validation --!>
        if (!empty($fullname)) {
            if (strlen($fullname) > 2 && strlen($fullname) < 30) {
                if (!preg_match('/^a-zA-Z\s/',$fullname)) {
                    // All test passed
                    $fullname_valid = true;
                } else {
                    $msg .= " [!] Fullname require Only Alphabets <br>";
                }
            } else {
                $msg .= " [!] Fullname must be 2 to 30 chars long <br>";
            } 
        } else {
            $msg .= " [!] Please Enter Fullname <br>";
        }

        // Email validation
        if (!empty($email)) {
            if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
                    $email_valid = true;
            } else {
                $msg .= " [!] Invalid Email <br>";
            } 
        } else {
            $msg .= " [!] Please Enter Email <br>";
        }

        // username validation
        if (!empty($username)) {
            if (strlen($username) > 2 && strlen($username) <= 15) {
                if (!preg_match('/^a-zA-Z\d_/',$username)) {
                    // All test passed
                        $username_valid = true;
                } else {
                    $msg .= " [!] username require Only Alphabets & Digits <br>";
                }
            } else {
                $msg .= " [!] username must be 2 to 15 chars long <br>";
            } 
        } else {
            $msg .= " [!] Please Enter username <br>";
        }

        // password validation
        if (!empty($password)) {
            if (strlen($password) > 5 && strlen($username) <= 15) {
                    // All test passed
                    $password_valid = true;
                    $password = md5($password);
            } else {
                $msg .= " [!] Password must be 5 to 15 chars long <br>";
            } 
        } else {
            $msg .= " [!] Please Enter Password <br>";
        }

        if ($fullname_valid && $username_valid && $email_valid && $password_valid) {
            $query = "UPDATE users SET fullname= '$fullname',username='$username',email= '$email',password='$password' WHERE id=$id";
            $fire = mysqli_query($conn,$query);
            if ($fire)
            { 
                $msg = " Data Updated Successfully";
                header('location:index.php?msg='.$msg);
            } 
        } else {
            header('location:update.php?msg='.$msg);
        }     
    } 
?>

<!-- Update form HTML Code -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/bootstrap.css">
        <title>CRUD</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                    <div class="col-lg-4 col-lg-offset-4">
                        <h3 style="margin-top:30px;"> Update Data </h3>
                        <hr>
                        <form action="<?php $_SERVER['PHP_SELF']  ?>" method="post">
                            <div class="form-group">
                                <label for="fullname">FULLNAME</label>
                                <input value="<?php echo $users['fullname']; ?>" name = "fullname" class="form-control" placeholder="FULLNAME" type="text">
                            </div>
                            <div class="form-group">
                                <label for="email">EMAIL</label>
                                <input value="<?php echo $users['email']; ?>" name = "email" class="form-control" placeholder="EMAIL" type="text">
                            </div>
                            <div class="form-group">
                                <label for="username">USERNAME</label>
                                <input value="<?php echo $users['username']; ?>" name = "username" class="form-control" placeholder="USERNAME" type="text">
                            </div>
                            <div class="form-group">
                                <label for="password">NEW PASSWORD</label>
                                <input value="" name = "password" class="form-control" placeholder="PASSWORD" type="text">
                            </div>
                            <div class="form-group">
                                <button name ="submit" class="btn btn-success btn-block">Submit</button>
                            </div>
                            <?php
                            if (isset($_GET['msg'])) {
                                echo $_GET['msg'];
                            }
                        ?>
                        </form>
                    </div>
            </div>
        </div>
    </body>
</html>