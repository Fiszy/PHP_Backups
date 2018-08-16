<?php include 'includes/config.php';  session_start(); ?>

<!DOCTYPE html>
<html lang="en" >
  <head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <form action="" method="POST">
      <div class="login-form">
      <div class="field">
        <input type="email" name="admin_email" placeholder="email@example.com" required>
      </div>
      <div class="field with-btn">
        <input type="password" name="admin_pass" placeholder="********" required>
      </div>
      <button type="submit" name="btn">Login</button>
      <p class="message">
        <a href="gmail.com"> Forgot Password? </a>
      </p>
    </div>
  </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  </body>
</html>


<?php

if (isset($_POST['btn'])) {
  $admin_email = $_POST['admin_email'];
  $admin_pass = $_POST['admin_pass'];
  $query = "SELECT * from admins where admin_email= '$admin_email' AND admin_pass= '$admin_pass' ";
  $run = mysqli_query($conn,$query);
  $rows = mysqli_num_rows($run);
  if ($rows == 1) {
      $_SESSION['admin_email'] = $admin_email;
      header('location:index.php?logged_in=You Successfully logged in!');
  } else {
    echo " <script> alert('Email or Password Incorrect!') </script> ";
  }

  
}

?>
