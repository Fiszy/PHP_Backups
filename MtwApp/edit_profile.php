<?php include 'includes/config.php';  ?>
<?php include 'functions/functions.php'; ?>

<?php

session_start();
if (!$_SESSION['user_email']) {
    header('location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/profile.css">
    <title>Welcome!</title>
</head>
<body>
    <div class="container">
        <div id="header_wrap">
            <div id="header">
                <ul id="menu">
                    <li> <a href="home.php"> Home</a> </li>
                    <li> <a href="members.php"> Members</a></li>
                    <?php
                        $get_topics = " SELECT * from topics ";
                        $run_topics = mysqli_query($conn,$get_topics);
                        while ($row = mysqli_fetch_array($run_topics)) {
                            $topic_id = $row['topics_id'];
                            $topic_name = $row['topics_name'];
                            echo " <li> <a href='topic.php?topic=$topic_id'>$topic_name</a></li> ";
                        }
                    ?>
                </ul>
                <form action="results.php" method="get" id="form1">
                        <input type="text" name="user_query" placeholder="Search a Topic">
                        <input type="submit" name="search" value="Search">
                </form>
            </div>
        </div>
        <div class="content">
            <div id="user_timeline">
                <div id="user_details">
                    <?php
                    $user = $_SESSION['user_email'];
                    $get_user = " SELECT * from users where user_email = '$user' ";
                    $run_user = mysqli_query($conn,$get_user);
                    $row_user = mysqli_fetch_array($run_user);

                    $user_id = $row_user['id'];
                    $user_name = $row_user['user_name'];
                    $user_email = $row_user['user_email'];
                    $user_pass = $row_user['user_pass'];
                    $user_gender = $row_user['user_gender'];
                    $user_country = $row_user['user_country'];
                    $user_image = $row_user['user_image'];
                    $user_reg_date = $row_user['user_reg_date'];
                    $user_birthday = $row_user['user_birthday'];
                    $user_last_login = $row_user['user_last_login'];
                    $user_image = $row_user['user_image'];

                    $user_posts = " SELECT * from posts where user_id = '$user_id' ";
                    $run_posts = mysqli_query($conn,$user_posts);
                    $posts = mysqli_num_rows($run_posts);

                    $msg = " SELECT * from messages where receiver = '$user_id' AND status ='unread' order by 1 DESC ";
                    $run_msg = mysqli_query($conn,$msg);
                    $count_msg = mysqli_num_rows($run_msg);

                    echo "
                    <center>
                    <img src='users/images/$user_image' width='200' height='200'> <br>
                     <a class='cp' href='change_picture.php?change_picture'> Change Picture </a>
                    </center>
                    <div id='user_mention'>
                    <p> <strong>Name: <br></strong> $user_name </p>
                    <p> <strong>Country: <br></strong> $user_country </p>
                    <p> <strong>Last Login:<br></strong> $user_last_login </p>
                    <p> <strong>Member Since:</strong> $user_reg_date </p>
                    <p> <a href='my_messages.php?inbox&u_id=$user_id'> Messages ($count_msg) </a> </p>
                    <p> <a href='my_posts.php?u_id=$user_id'> My Posts ($posts)</a> </p>
                    <p> <a href='edit_profile.php?u_id=$user_id'> Edit my Account </a> </p>
                    <p> <a href='logout.php'> Logout </a> </p>
                    </div> "
                    ?>
                </div>  
            </div>
        </div>
    </div>

    <?php $user_i = $_GET['u_id']; ?>


   <div id="content_timeline">
        <div class="form2 animated jello">
                <form action="" method="POST" id="signupform" >
                    <h2>Edit this Profile</h2> <hr>
                    <table>
                        <tr>
                            <td align="right"> Name</td>
                            <td>
                                <input type="text" name="u_name" value="<?php echo $user_name; ?>"> </td>
                        </tr>
                        <tr>
                            <td align="right"> Password </td>
                            <td>
                                <input type="text" name="u_password" required value="<?php echo $user_pass; ?>"> </td>
                        </tr>
                        <tr>
                            <td align="right"> Email </td>
                            <td>
                                <input type="email" name="u_email" required value="<?php echo $user_email; ?>"> </td>
                        </tr>
                        <tr>
                            <td align="right"> Country </td>
                            <td>
                                <select name="u_country" disabled id="">
                                    <option> <?php echo $user_country; ?></option>
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
                                <select name="u_gender" disabled id="">
                                    <option value="<?php echo $user_name; ?>">Male</option>
                                    <option value="Mail">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"> Birthday </td>
                            <td>
                                <input type="date" name="u_birthday" value="<?php echo $user_birthday; ?>"> </td>
                        </tr>
                    </table>
                    <br>
                <button type="submit" name="update" class="btnsign">Update</button>
                </form>
            </div>
    </div>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    $u_name     = mysqli_real_escape_string($conn,$_POST['u_name']) ;
    $u_password = mysqli_real_escape_string($conn,$_POST['u_password']) ;
    $u_email    = mysqli_real_escape_string($conn,$_POST['u_email']) ;
    $u_birthday = mysqli_real_escape_string($conn,$_POST['u_birthday']) ;
    $passlen    = strlen($u_password); 


    if ($passlen < 8)  {
        echo " <script> alert('Password Should be 8 Characters') </script> ";
        exit();
    }

    $update_user = " UPDATE users set user_name = '$u_name', user_pass= '$u_password',user_email = '$u_email', user_birthday= '$u_birthday' where id = '$user_id' ";
    $fire2 = mysqli_query($conn,$update_user);
    if ($fire2) {
         echo " <script> alert('Updated Successfully') </script> ";
         echo " <script> window.open('home.php','_self') </script> ";
    } else {
        echo " <script> alert('Update Failed') </script> ";
    }

}

