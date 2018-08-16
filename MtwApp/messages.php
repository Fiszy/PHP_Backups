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

                    $msg = " SELECT * from messages where receiver = '$user_id' AND status ='unread' ";
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

    <div id="content_timeline">
            <div id="message">
                <?php

                if (isset($_GET['u_id'])) {
                    $u_id = $_GET['u_id'];
                    $sel = " SELECT * from users where id = '$u_id' ";
                    $run = mysqli_query($conn,$sel);
                    $row = mysqli_fetch_array($run);
                    $user_name = $row['user_name'];
                    $user_image = $row['user_image'];
                    $registration = $row['user_reg_date'];
                }
                ?>
                <h2 style="color:white;"> Send a Message to <span style="color:red;"> <?php echo $user_name; ?> </span> </h2> <hr> <br>
                <form action="messages.php?u_id= <?php echo $u_id ?>" method="POST" id="f">
                    <input type="text" name="msg_title" placeholder="Message Subject..." size="64" > <br> <br>
                    <textarea name="msg" id="" cols="50" rows="5" placeholder=" Write a Message..." ></textarea> <br> <br>
                    <button name="message"> Send Message  </button> <br> <br>
                    <img src="users/images/<?php echo $user_image ?>" style="border:2px solid black; border-radius:5px" width="100" height="100"> <br> <br>
                    <h3 style="color:white;"> <strong style="color:red;text-decoration:underline"> <?php echo $user_name ?>  </strong>, register since:
                    <span style="color:red; text-decoration:underline"> <?php echo $registration; ?></span>  </h3> <br>
                </form>

                <?php

                if (isset($_POST['message'])) {
                    $msg_title = $_POST['msg_title'];
                    $msg = $_POST['msg'];

                    $insert_msg = " INSERT into messages (sender,receiver,msg_sub,msg_topic,reply,status,msg_date) values ('$user_id','$u_id','$msg_title','$msg','no_reply','unread',NOW()) ";
                    $run_insert = mysqli_query($conn,$insert_msg);
                    if ($run_insert) {
                       echo "  <h3 style='color:white;'> Message was sent to <span style='color:red;'> $user_name</span>  successfully!! </h3>  <hr>";
                    } else {
                         echo "  <h3 style='color:white;'> Message was not sent </h3>  <hr>";
                    }
                }

                ?>


            </div>
    </div> 
</body>
</html>

