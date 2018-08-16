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

    <div id="content_timeline">
    <?php

    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
    }
    $get_posts = " SELECT * from posts where post_id = '$post_id'";
    $run_posts = mysqli_query($conn,$get_posts);
    $row_posts = mysqli_fetch_array($run_posts);

        $post_title = $row_posts['post_title'];
        $post_content = $row_posts['post_content'];
    ?>
          <form action="" method="POST" id="f" >
            <h2>Edit this Post </h2> <br>
            <input type="text" name="title" value="<?php echo $post_title ?>" size="83" required > <br> <br>
            <textarea name="content" id="" cols="73" rows="4" required style="resize: none;"><?php echo $post_content ?></textarea> <br><br>
            <select name="topic" required> 
                <option > Select Topic </option>
                <?php  getTopics(); ?>
            </select> &nbsp;
            <input type="submit" name="sub" value="Update Post"> 
        </form>

        <?php

        if (isset($_POST['sub'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $topic = $_POST['topic'];

        $update_user = " UPDATE posts set post_title = '$title', post_content= '$content',topic_id = '$topic' where post_id = '$post_id' ";
        $run = mysqli_query($conn,$update_user);
        if ($run) {
             echo "<script> alert('Post Updated Successfully') </script> ";
            echo " <script> window.open('home.php','_self') </script> ";
        }
           
   // }

    } 

        ?>
    </div> 
</body>
</html>

