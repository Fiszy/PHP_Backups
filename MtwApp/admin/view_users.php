<table align="center" width="700" bgcolor="skyblue" cellspacing="0" style="margin-left:30px" border="1">
    <tr bgcolor="orange" >
        <th>S.N</th>
        <th>Name</th>
        <th>Country</th>
        <th>Gender</th>
        <th>Image</th>
        <th>Delete</th>
        <th>Edit</th>
    </tr>
    <?php

    include 'includes/config.php';
    $select_users = " SELECT * from users  order by 1 DESC ";
    $run_users = mysqli_query($conn,$select_users);
    $i=0;
    while ($row_users = mysqli_fetch_array($run_users)) {
        $user_id = $row_users['id'];
        $user_name = $row_users['user_name'];
        $user_country = $row_users['user_country'];
        $user_gender = $row_users['user_gender'];
        $user_image = $row_users['user_image'];
        $user_reg_date = $row_users['user_reg_date'];
        $i++;
         ?>
        <tr align="center">
            <td> <?php  echo $i; ?> </td>
            <td> <?php  echo $user_name; ?></td>
            <td> <?php  echo $user_country; ?></td>
            <td> <?php  echo $user_gender; ?></td>
            <td> <img src="../users/images/<?php echo $user_image; ?>" height="50" width="50" style="margin-top:3px;"> </td>
            <td> <a href="delete_user.php?delete= <?php echo $user_id; ?>"> Delete </a></td>
            <td> <a href="edit_user.php?edit= <?php echo $user_id; ?>"> Edit </a></td>
        </tr>
   <?php } ?>

   

</table>