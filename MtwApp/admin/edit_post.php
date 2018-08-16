<?php

include 'includes/config.php';

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $select_post = "  SELECT * from posts where post_id = '$edit_id' ";
    $run = mysqli_query($conn,$select_post);
    $row_post = mysqli_fetch_array($run);
    $post_id      = $row_post['post_id'];
    $post_title   = $row_post['post_title'];
    $post_content = $row_post['post_content'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/profile.css">
    <title>Document</title>
</head>
<body>
    <div id="content_timeline">
        <div class="form2 animated jello">
                <form action="" method="POST" id="signupform" >
                    <h2>Edit Post</h2> <hr>
                    <table>
                        <tr>
                            <td align="right"> Title </td>
                            <td><input type="text" name="u_name" value="<?php echo $post_title ; ?>"> </td>
                        </tr>
                        <tr>
                            <td align="right"> Description </td>
                            <td> <textarea name="desc" id="desc" cols="30" rows="10"> <?php echo $post_content ; ?> </textarea>  </td>
                        </tr>
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
    $desc     = mysqli_real_escape_string($conn,$_POST['desc']) ;
    $update_post = " UPDATE posts set post_title = '$u_name', post_content= '$desc' where post_id = '$post_id' ";
    $fire2 = mysqli_query($conn,$update_post);
    if ($fire2) {
         echo " <script> alert('Updated Successfully') </script> ";
         echo " <script> window.open('index.php?view_posts','_self') </script> ";
    } else {
        echo " <script> alert('Update Failed') </script> ";
    }

}