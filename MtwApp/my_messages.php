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
    <link rel="stylesheet" href="css/messages.css">
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
                <form action="results.php" method="GET" id="form1">
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

    <div id="msg">
        <p align="center">
            <a href="my_messages.php?inbox"> Inbox</a> ||
            <a href="my_messages.php?sent"> Sent Items</a> 
        </p> <br>
<?php
if (isset($_GET['sent'])) {
    include 'sent.php';
}
if (isset($_GET['inbox'])) { ?>
    <table width="1050" border="1" align="center" cellspacing="0" style="margin-left:100px;">
        <tr>
            <th> Sender:</th>
            <th> Subject </th>
            <th> Date:</th>
            <th> Reply</th>
        </tr>
<?php

if (isset($_GET['u_id'])){
    $u_id = $_GET['u_id'];

$select_msg = "SELECT * from messages where receiver = '$u_id' order by 1 DESC";
$run_msg = mysqli_query($conn,$select_msg);
$count_msg = mysqli_num_rows($run_msg);
while($row_msg= mysqli_fetch_array($run_msg)) {
    $msg_id = $row_msg['msg_id'];
    $sender = $row_msg['sender'];
    $receiver = $row_msg['receiver'];
    $msg_sub = $row_msg['msg_sub'];
    $msg_topic = $row_msg['msg_topic'];
    $reply = $row_msg['reply'];
    $status = $row_msg['status'];
    $msg_date = $row_msg['msg_date'];

    $get_sender = " SELECT * from users where id = '$sender' ";
    $sender_info = mysqli_query($conn,$select_msg);
    $row= mysqli_fetch_array($sender_info);
    $sender_name = $row['user_name'];
    ?>
    <tr>
        <td><a href="user_profile.php?u_id=<?php echo $sender?>"> <?php echo $sender_name?></a></td>
        <td><a href="my_messages.php?inbox&msg_id=<?php echo $msg_id?>"> <?php echo $msg_sub?></a></td>
        <td><?php echo $msg_sub?></td>
        <td><a href="my_messages.php?inbox&msg_id=<?php echo $msg_id?>"> Reply </a></td>
    </tr>
<?php 
}
} ?>
</table>


<?php
if (isset($_GET['msg_id'])) {
    $get_id = $_GET['msg_id'];
    $sel_msg = "SELECT * from messages where msg_id = '$get_id'";
    $msg_query = mysqli_query($conn,$sel_msg);
    $row_msg_query= mysqli_fetch_array($msg_query);
    $subject = $row_msg['msg_sub'];
    $topic = $row_msg['msg_topic'];
    $reply = $row_msg['msg_reply'];

    $update_unread = " UPDATE messages set status ='read' where msg_id='$get_id' ";
    $update_unread = mysqli_query($conn,$update_unread);

    echo " <center><br><hr>
    <h2> $subject </h2>
    <p> <b> Message: </b> $topic </p>
    <p> <b> Reply: </b> $reply </p>
    
    <form action='' method='POST'>
    <textarea name='reply' cols='30' rows='3'></textarea>
    <input type='submit' name='msg_reply' value='Reply to this'>
    </form>
    </center>
    
    ";
    if (isset($_POST['msg_reply'])) {
        $replied = $_POST['reply'];
        if ($reply != 'no_reply') {
            echo " <h2 align='center'> This Messages was Already Replied</h2> ";
            exit();
        } else {
            $update_reply = "UPDATE messages set reply='$replied' where msg_id = '$get_id' AND reply = 'no_reply' ";
            $run_update_reply = mysqli_query($conn,$update_reply);
            echo " <h2 align='center'> Messages was Replied</h2> ";
        }
    }
}
?>
<?php } ?>
</div> 
</body>
</html>

