<table align="center" width="750" bgcolor="skyblue" cellspacing="0" style="margin-left:20px" border="1">
    <tr bgcolor="orange" >
        <th>S.N</th>
        <th>Comment</th>
        <th>Author</th>
        <th>Date</th>
        <th>Delete</th>
    </tr>
    <?php

    include 'includes/config.php';
    $select_comments = " SELECT * from comments  order by 1 DESC ";
    $run_comments = mysqli_query($conn,$select_comments);
    $i=0;
    while ($row_comments = mysqli_fetch_array($run_comments)) {
        $comment_id     = $row_comments['comment_id'];
        $comment        = $row_comments['comment'];
        $comment_author = $row_comments['comment_author'];
        $date           = $row_comments['date'];
        $i++;
         ?>
        <tr align="center">
            <td> <?php  echo $i; ?> </td>
            <td> <?php  echo $comment; ?></td>
            <td> <?php  echo $comment_author; ?></td>
            <td> <?php  echo $date; ?></td>
            <td> <a href="delete_comment.php?delete= <?php echo $comment_id; ?>"> Delete </a></td>
        </tr>
   <?php } ?>

</table>