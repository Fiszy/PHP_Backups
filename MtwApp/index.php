<?php

// session_start();
// if ($_SESSION['user_email']) {
//     echo " <script> window.open('home.php','_self') </script ";
// } else {
//      }
    
  ?>  
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/fontawesome.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
        <link rel="stylesheet" href="css/styles.css" media="all">
        <title>MtwApp</title>
    </head>
    <body>
        <div class="container">
            <div id="header_wrapper">
                <img src="images/lo.jpg" alt="">
                    <form action="login.php" method="POST" id="loginform">
                        <strong> Email: </strong>
                        <input type="email" name="email" placeholder="Email" required>
                        <strong id="pass"> Password: </strong>
                        <input type="password" name="pass"  placeholder="******" required>
                        <button name="login"> <i class="fa fa-sign-in-alt"></i> Login </button>
                    </form>
            </div>
        <div id="content">
            <div class="homeimg" >
                <img src="images/logo.jpg" class="animated jello" >
            </div>

            <div class="form2 animated jello">
                <form action="insert_users.php" method="POST" id="signupform" >
                    <h2>SIGN UP</h2> <hr>
                    <table>
                        <tr>
                            <td align="right"> Name</td>
                            <td>
                                <input type="text" name="u_name" required placeholder="Name"> </td>
                        </tr>
                        <tr>
                            <td align="right"> Password </td>
                            <td>
                                <input type="password" name="u_password" required placeholder="****"> </td>
                        </tr>
                        <tr>
                            <td align="right"> Email </td>
                            <td>
                                <input type="email" name="u_email" required placeholder="Email"> </td>
                        </tr>
                        <tr>
                            <td align="right"> Country </td>
                            <td>
                                <select name="u_country" id="">
                                    <option>Select a Country</option>
                                    <option> Afghanistan </option>
                                    <option> Pakistan </option>
                                    <option> India </option>
                                    <option> Japan </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"> Gender </td>
                            <td>
                                <select name="u_gender" id="">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"> Birthday </td>
                            <td>
                                <input type="date" name="u_birthday" required placeholder="Name"> </td>
                        </tr>
                    </table>
                    <br>
                <button type="submit" name="sign_up" class="btnsign">Sign Up</button>
                </form>
            </div>
            <div id="footer">
                <h2> &copy; www.mtwabbaxi.com </h2>
            </div>
        
        <script src="js/fontawesome.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/typed.js"></script>
    </body>
</html>



<?php include 'includes/config.php';?>

