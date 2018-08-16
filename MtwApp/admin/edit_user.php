<?php

include 'includes/config.php';

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $select_user = "  SELECT * from users where id = '$edit_id' ";
     $run = mysqli_query($conn,$select_user);
     $row_user = mysqli_fetch_array($run);

    $user_id = $row_user['id'];
    $user_name = $row_user['user_name'];
    $user_email = $row_user['user_email'];
    $user_pass = $row_user['user_pass'];
    $user_gender = $row_user['user_gender'];
    $user_country = $row_user['user_country'];
    $user_image = $row_user['user_image'];
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
                                <select name="u_country"  id="">
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
                                <select name="u_gender"  id="">
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
         echo " <script> window.open('index.php?view_users','_self') </script> ";
    } else {
        echo " <script> alert('Update Failed') </script> ";
    }

}