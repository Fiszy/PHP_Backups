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
    <link rel="stylesheet" href="css/home_style.css">
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
                    $user_country = $row_user['user_country'];
                    $user_image = $row_user['user_image'];
                    $user_reg_date = $row_user['user_reg_date'];
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
                    </center>
                    <div id='user_mention'>
                    <p> <strong>Name:</strong> $user_name </p>
                    <p> <strong>Country:</strong> $user_country </p>
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

    <div id="content_timeline" style="width:950px">
        <?php

@session_start();
// require 'includes/config.php';

if (isset($_GET['change_picture'])) {
    $user_email = $_SESSION['user_email'];
    $get_customer = " SELECT * from users where user_email = '$user_email' ";
    $run_customer = mysqli_query($conn,$get_customer);
    $row = mysqli_fetch_array($run_customer);

    $id = $row['id'];
    $img = $row['user_image'];
}

?>
<h1 > Update Image</h1> <br>
<img src="users/images/<?php echo $img; ?>" width="180" height="180" style="border-radius:50%;" > <br> <br>

<form action="" method="post" enctype="multipart/form-data" >
    <table class="cp" >
     <tr>
         <td> <input type="file" name="c_image" size="40"></td> 
         <td> <input type="submit" name="submit" value="Change" ></td>
     </tr>
    </table>
</form> 

<?php

if (isset($_POST['submit'])) {

    $update_id = $id;
    $c_image = $_FILES['c_image']['name'];
    $c_temp_image = $_FILES['c_image']['tmp_name'];
    $update_details = "UPDATE users set user_image='$c_image' where id = '$update_id' ";
    $run_update = mysqli_query($conn,$update_details);
    if ($run_update) {
        move_uploaded_file($c_temp_image,"users/images/$c_image");
        echo " <script> window.open('home.php','_self') </script> ";
    }
}


?>
    </div> 
</body>
</html>


