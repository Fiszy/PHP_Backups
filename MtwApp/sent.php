<table width="1050" border="1" align="center" cellspacing="0" style="margin-left:100px;">
        <tr>
            <th> Receiver:</th>
            <th> Subject </th>
            <th> Date:</th>
            <th> Reply</th>
        </tr>
<?php

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

    $get_receiver = " SELECT * from users where id = '$receiver' ";
    $receiver_info = mysqli_query($conn,$get_receiver);
    $row= mysqli_fetch_array($receiver_info);
    $receiver_name = $row['receiver'];
    ?>
    <tr>
        <td><a href="user_profile.php?u_id=<?php echo $receiver ?>"> <?php echo $receiver_name?></a></td>
        <td><a href="my_messages.php?sent&msg_id=<?php echo $msg_id?>"> <?php echo $msg_sub?></a></td>
        <td><?php echo $msg_sub?></td>
        <td><a href="my_messages.php?sent&msg_id=<?php echo $msg_id?>"> View Reply </a></td>
    </tr>
<?php 
}
?>
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

    echo " <br><hr>
    <h2> $subject </h2>
    <p> <b> Message: </b> $topic </p>
    <p> <b> Reply: </b> $reply </p>
    ";
}
?>