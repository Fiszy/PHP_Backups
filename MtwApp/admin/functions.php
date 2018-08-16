<?php

$conn = mysqli_connect('localhost','root','','mtwapp');

function getTopics() {
    global $conn;
    $get_topics = " SELECT * from topics ";
    $run_topics = mysqli_query($conn,$get_topics);
    while ($row = mysqli_fetch_array($run_topics)) {
        $topic_id = $row['topics_id'];
        $topic_name = $row['topics_name'];
        echo " <option value='$topic_id'>$topic_name</option> ";
    }

}

function insertPost() {
    if (isset($_POST['sub'])) {
        global $conn;
        global $user_id;
        $title = $_POST['title'];
        $content = $_POST['content'];
        $topic = $_POST['topic'];

        $insert_post = "INSERT into posts (user_id,topic_id,post_title,post_content,post_date) values ('$user_id','$topic','$title','$content',Now()) ";
        $run = mysqli_query($conn,$insert_post);
        if ($run) {
            $update = " UPDATE users set posts='yes' where user_id = '$user_id' ";
            $run_update = mysqli_query($conn,$update);
        }
    } 
}

function get_posts() {
    global $conn;
    $per_page = 5;

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $start_from = ($page-1)*$per_page;
    $get_posts = " SELECT * from posts order by 1 DESC LIMIT $start_from,$per_page ";
    $run_posts = mysqli_query($conn,$get_posts);
    while ($row_posts = mysqli_fetch_array($run_posts)) {
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $post_title = $row_posts['post_title'];
        $post_content = substr($row_posts['post_content'],0,200);
        $post_date = $row_posts['post_date'];

        $user = " SELECT * from users where id = '$user_id' AND posts ='yes'";
        $run_user = mysqli_query($conn,$user);
        $row_user = mysqli_fetch_array($run_user);
        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];

        echo "<div id='posts'>
        <p> <img src='users/images/$user_image' width='50' height='50'> 
        <h3> <a href='user_profile.php?u_id=$user_id'> $user_name </a> </h3> </p>
        <h2> $post_title </h2>
        <p style='float:right; color:brown; text-decoration: underline;'> $post_date </p> <br>
        <p> $post_content </p>
        <a href='single.php?post_id=$post_id' style='float:right;'> <button> See Replies or Reply to this </button> </a>
        </div> <br>";
    }
    include 'functions/pagination.php';
    
}
function single_post(){
    global $conn;

    if (isset($_GET['post_id'])) {
        $get_id = $_GET['post_id'];
        $get_posts = " SELECT * from posts where post_id = '$get_id' ";
        $run_posts = mysqli_query($conn,$get_posts);
        while ($row_posts = mysqli_fetch_array($run_posts)) {
            $post_id = $row_posts['post_id'];
            $user_id = $row_posts['user_id'];
            $post_title = $row_posts['post_title'];
            $post_content = $row_posts['post_content'];
            $post_date = $row_posts['post_date'];

            $user = " SELECT * from users where id = '$user_id' AND posts ='yes'";
            $run_user = mysqli_query($conn,$user);
            $row_user = mysqli_fetch_array($run_user);
            $user_name = $row_user['user_name'];
            $user_image = $row_user['user_image'];

            $user_com = $_SESSION['user_email'];
            $get_com = " SELECT * from users where user_email = '$user_com' ";
            $run_com = mysqli_query($conn,$get_com);
            $row_com = mysqli_fetch_array($run_com);
            $user_com_id = $row_com['id'];
            $user_com_name = $row_com['user_name'];

            echo "<div id='posts'>
            <p> <img src='users/images/$user_image' width='50' height='50'> 
            <h3> <a href='user_profile.php?u_id=$user_id'> $user_name </a> </h3> </p>
            <h2> $post_title </h2>
            <p style='float:right; color:brown; text-decoration: underline;'> $post_date </p> <br>
            <p> $post_content </p>
            </div> <br>";
            include 'comments.php';

            echo "<form action='' method='POST'>
               <textarea name='comment' id='comment' placeholder='Write your Reply' cols='50' rows='5'></textarea> <br> <br>
                <input type='submit' id='reply'  name='reply' value='Reply' >
            </form>";

            if (isset($_POST['reply'])) {
                $comment = $_POST['comment'];
                $insert = " INSERT into comments (post_id,user_id,comment,comment_author,date) values ('$post_id','$user_id','$comment','$user_com_name',NOW()) ";
                $run = mysqli_query($conn,$insert);
                echo " <script> window.open('single.php?post_id=$post_id','_self') </script> ";
            }
        } 
    }
}

function allmember(){
    global $conn;
    $user = " SELECT * from users";
    $run_user = mysqli_query($conn,$user);
    while ($row_user = mysqli_fetch_array($run_user)) {
        $user_id = $row_user['id'];
        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];
        $user_email = $row_user['user_email'];
        $user_country = $row_user['user_country'];
        $user_gender = $row_user['user_gender'];
        $user_last_login = $row_user['user_last_login'];

        echo "

        <a href=''> <img src='users/images/$user_image' width='50' height='50' title='$user_name' style='float:left; padding:2px; '> </a> ";

    }
}

function user_posts(){
    global $conn;
    if (isset($_GET['u_id'])) {
        $u_id = $_GET['u_id'];
    }
    $get_posts = " SELECT * from posts where user_id = '$u_id' order by 1 DESC";
    $run_posts = mysqli_query($conn,$get_posts);
    while ($row_posts = mysqli_fetch_array($run_posts)) {
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $post_title = $row_posts['post_title'];
        $post_content = $row_posts['post_content'];
        $post_date = $row_posts['post_date'];

        $user = " SELECT * from users where id = '$user_id' AND posts ='yes'";
        $run_user = mysqli_query($conn,$user);
        $row_user = mysqli_fetch_array($run_user);
        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];

        echo "<div id='posts'>
        <p> <img src='users/images/$user_image' width='50' height='50'> 
        <h3> <a href='user_profile.php?u_id=$user_id'> $user_name </a> </h3> </p>
        <h2> $post_title </h2>
        <p style='float:right; color:brown; text-decoration: underline;'> $post_date </p> <br>
        <p> $post_content </p> <br>
         <a href='edit_post.php?post_id=$post_id' style='float:right;'> <button> Edit </button> </a>
          <a href='delete_post.php?post_id=$post_id' style='float:right;'> <button> Delete </button> </a>
        </div> <br>";
    }

}

function user_profile(){
    if (isset($_GET['u_id'])) {
        global $conn;
        $user_id = $_GET['u_id'];
        $select = " SELECT * from users where id = '$user_id' ";
        $run = mysqli_query($conn,$select);
        $row = mysqli_fetch_array($run);

        $id = $row['id'];
        $user_name = $row['user_name'];
        $user_email = $row['user_email'];
        $user_country = $row['user_country'];
        $user_gender = $row['user_gender'];
        $user_image = $row['user_image'];
        $user_reg_date = $row['user_reg_date'];
        $user_last_login = $row['user_last_login'];

        if ($user_gender == 'Male') {
            $msg = " Send Him a Message ";
        } else {
            $msg = " Send Her a Message ";
        }

        echo "<div id='user_profile'>
            <img src='users/images/$user_image' height='150' width='150' style='float:right; margin-right:15px; margin-top:25px;'> <br>
            <p> <strong> Name: </strong> $user_name </p>
            <p> <strong> Email: </strong> $user_email </p>
            <p> <strong> Country: </strong> $user_country</p>
            <p> <strong> Gender: </strong> $user_gender</p>
            <p> <strong> Registration Date: </strong> $user_reg_date</p>
            <p> <strong> Last Login: </strong> $user_last_login</p>
             <a href='messages.php?u_id=$id'><button> $msg </button></a> 
        </div>
        ";
       
    }
}

function show_topics() {
    global $conn;
    if (isset($_GET['topic'])) {
        $id = $_GET['topic'];
    }
    $get_posts = " SELECT * from posts where topic_id = '$id'";
    $run_posts = mysqli_query($conn,$get_posts);
    if ($run_posts) {
        $count = mysqli_num_rows($run_posts);
        if ($count > 0) {
            while ($row_posts = mysqli_fetch_array($run_posts)) {
            $post_id = $row_posts['post_id'];
            $user_id = $row_posts['user_id'];
            $post_title = $row_posts['post_title'];
            $post_content = $row_posts['post_content'];
            $post_date = $row_posts['post_date'];

            $user = " SELECT * from users where id = '$user_id' AND posts ='yes'";
            $run_user = mysqli_query($conn,$user);
            $row_user = mysqli_fetch_array($run_user);
            $user_name = $row_user['user_name'];
            $user_image = $row_user['user_image'];
            

            echo "<div id='posts'>
            <p> <img src='users/images/$user_image' width='50' height='50'> 
            <h3> <a href='user_profile.php?u_id=$user_id'> $user_name </a> </h3> </p>
            <h2> $post_title </h2>
            <p style='float:right; color:brown; text-decoration: underline;'> $post_date </p> <br>
            <p> $post_content </p> <br>
            <a href='edit_post.php?post_id=$post_id' style='float:right;'> <button> Edit </button> </a>
            <a href='delete_post.php?post_id=$post_id' style='float:right;'> <button> Delete </button> </a>
            </div> <br>";
            }
        } else {
            echo "<h1 class='prodisplay'> Nothing Here! <br> Coming Soon.<h1>";
        }
    }
    
}

function results() {
    global $conn;
    if (isset($_GET['search'])) {
        $user = $_GET['user_query'];
    }
    $get_posts = " SELECT * from posts where post_title like '%$user%' OR post_content like '%$user%' ";
    $run_posts = mysqli_query($conn,$get_posts);
    if ($run_posts) {
        $count = mysqli_num_rows($run_posts);
        if ($count > 0) {
            while ($row_posts = mysqli_fetch_array($run_posts)) {
            $post_id = $row_posts['post_id'];
            $user_id = $row_posts['user_id'];
            $post_title = $row_posts['post_title'];
            $post_content = $row_posts['post_content'];
            $post_date = $row_posts['post_date'];

            $user = " SELECT * from users where id = '$user_id' AND posts ='yes'";
            $run_user = mysqli_query($conn,$user);
            $row_user = mysqli_fetch_array($run_user);
            $user_name = $row_user['user_name'];
            $user_image = $row_user['user_image'];
            

            echo "<div id='posts'>
            <p> <img src='users/images/$user_image' width='50' height='50'> 
            <h3> <a href='user_profile.php?u_id=$user_id'> $user_name </a> </h3> </p>
            <h2> $post_title </h2>
            <p style='float:right; color:brown; text-decoration: underline;'> $post_date </p> <br>
            <p> $post_content </p> <br>
            <a href='edit_post.php?post_id=$post_id' style='float:right;'> <button> Edit </button> </a>
            <a href='delete_post.php?post_id=$post_id' style='float:right;'> <button> Delete </button> </a>
            </div> <br>";
            }
        } else {
            echo "<h1 class='prodisplay'> Nothing Here! <br> Coming Soon.<h1>";
        }
    }
    
}

?>