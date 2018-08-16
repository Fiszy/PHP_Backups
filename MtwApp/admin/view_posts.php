<table align="center" width="750" bgcolor="skyblue" cellspacing="0" style="margin-left:20px" border="1">
    <tr bgcolor="orange" >
        <th>S.N</th>
        <th>Title</th>
        <th>Author</th>
        <th>Date</th>
        <th>Delete</th>
        <th>Edit</th>
    </tr>
    <?php

    include 'includes/config.php';
    $select_posts = " SELECT * from posts  order by 1 DESC ";
    $run_posts = mysqli_query($conn,$select_posts);
    $i=0;
    while ($row_users = mysqli_fetch_array($run_posts)) {
        $post_id = $row_users['post_id'];
        $title = $row_users['post_title'];
        $post_date = $row_users['post_date'];
        $user_id = $row_users['user_id'];
        $i++;
        $select_user = " SELECT * from users where id = '$user_id' ";
        $run_user = mysqli_query($conn,$select_user);
        while ($row_users = mysqli_fetch_array($run_user)){
            $user_name = $row_users['user_name'];
        }
         ?>
        <tr align="center">
            <td> <?php  echo $i; ?> </td>
            <td> <?php  echo $title; ?></td>
            <td> <?php  echo $user_name; ?></td>
            <td> <?php  echo $post_date; ?></td>
            <td> <a href="delete_post.php?delete= <?php echo $post_id; ?>"> Delete </a></td>
            <td> <a href="edit_post.php?edit= <?php echo $post_id; ?>"> Edit </a></td>
        </tr>
   <?php } ?>

   

</table>