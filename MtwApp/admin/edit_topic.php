<?php

include 'includes/config.php';

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $select_topic = "  SELECT * from topics where topics_id = '$edit_id' ";
    $run = mysqli_query($conn,$select_topic);
    $row_topic = mysqli_fetch_array($run);
    $topics_name      = $row_topic['topics_name'];
    $topics_id      = $row_topic['topics_id'];
    
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
                    <h2>Edit Topic Name</h2> <hr>
                    <table>
                        <tr>
                            <td align="right"> Topic</td>
                            <td>
                                <input type="text" name="u_name" value="<?php echo $topics_name ; ?>"> </td>
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
    $update_user = " UPDATE topics set topics_name = '$u_name' where topics_id = '$topics_id' ";
    $fire2 = mysqli_query($conn,$update_user);
    if ($fire2) {
         echo " <script> alert('Updated Successfully') </script> ";
         echo " <script> window.open('index.php?view_topics','_self') </script> ";
    } else {
        echo " <script> alert('Update Failed') </script> ";
    }

}