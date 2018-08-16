<!-- Configuation Database Connect File -->
<?php require 'config.php'; ?>

<!-- HTML Code For login Form and Show data -->
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
    <!-- navbar -->
    <?php require 'include/navbar.php'; ?>

    <div class="container">
        <div class="row">
                 <!-- Sign up -->
                <div class="col-lg-4 offset-lg-4">
                    <h3 style="margin-top:30px;"> LOGIN </h3>
                    <hr>
                    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                        <div class="form-group">
                            <label for="username">USERNAME</label>
                            <input  name = "username" class="form-control" required placeholder="USERNAME" type="text">
                        </div>
                        <div class="form-group">
                            <label for="password">PASSWORD</label>
                            <input  name = "password" class="form-control" required placeholder="PASSWORD" type="text">
                        </div>
                        <div class="form-group">
                            <button name ="login" class="btn btn-success btn-block">Login</button>
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

<?php
    session_start();
    if (!isset($_SESSION['is_login'])) {
        if (isset($_POST['login'])) {
            $username = strip_tags(trim($_POST['username']));
            $password = strip_tags(md5(trim($_POST['password'])));

            $query = "SELECT username FROM users WHERE username = '$username' && password = '$password'";
            $fire = mysqli_query($conn,$query);
            if (mysqli_num_rows($fire) == 1) {
                $_SESSION['is_login'] = true;
                $_SESSION['username'] = $username;
                header('Location: dashboard.php');
            } else {
                $msg="Invalid Username and Password";
                header('location:signin.php?msg='.$msg);
        } 
        }
    } else {
        header('location:dashboard.php');
    }
?>





