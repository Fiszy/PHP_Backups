<table align="center" width="750" bgcolor="skyblue" cellspacing="0" style="margin-left:20px" border="1">
    <tr bgcolor="orange" >
        <th>S.N</th>
        <th>Name</th>
        <th>Delete</th>
        <th>Edit</th>
        
    </tr>
    <?php

    include 'includes/config.php';
    $select_topics = " SELECT * from topics";
    $run_topics = mysqli_query($conn,$select_topics);
    $i=0;
    while ($row_topics = mysqli_fetch_array($run_topics)) {
        $topics_id     = $row_topics['topics_id'];
        $topics_name        = $row_topics['topics_name'];
        $i++;
         ?>
        <tr align="center">
            <td> <?php  echo $i; ?> </td>
            <td> <?php  echo $topics_name; ?></td>
            <td> <a href="delete_topic.php?delete= <?php echo $topics_id; ?>"> Delete </a></td>
            <td> <a href="edit_topic.php?edit= <?php echo $topics_id; ?>"> Edit </a></td>
        </tr>
   <?php } ?>

</table>