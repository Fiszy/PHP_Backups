<?php
session_start();
// include ' functions.php ';
if (!isset($_SESSION['admin_email'])) {
    header ('location:admin_login.php');
} else {

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="admin_style.css">
    <title>Welcome to Admin Panel</title>
</head>
<body>
    <div class="container">
        <div class="head">
            <a href="index.php"> <img src="images/logo.jpg"> </a>
        </div>
        <div class="sidebar">
            <ul id="menu">
                <li><a href="index.php?view_users"> View Users </a></li>
                <li><a href="index.php?view_posts"> View Posts</a></li>
                <li><a href="index.php?view_comments"> View Comments</a></li>
                <li><a href="index.php?view_topics"> View Topics</a></li>
                <li><a href="add_topic.php"> Add New Topic</a></li>
                <li><a href="admin_logout.php"> Admin Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <h2 style="color:red;  text-align:center; padding:5px;"> <?php 
                if (isset($_GET['logged_in'])) {
                     echo $_GET['logged_in'];   
                } else {

                } ?>
            </h2>
            <?php
                if (isset($_GET['view_users'])) {
                    include 'view_users.php';
                }
                if (isset($_GET['view_posts'])) {
                    include 'view_posts.php';
                }
                if (isset($_GET['view_comments'])) {
                    include 'view_comment.php';
                }
                if (isset($_GET['view_topics'])) {
                    include 'view_topics.php';
                }
                
            ?>
        </div>
    </div>
    
</body>
</html>