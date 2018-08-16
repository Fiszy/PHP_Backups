<?php include 'db.php'; ?>
<?php
        $query = "SELECT * from chat ORDER by id DESC";
        $run = $conn->query($query);
        while ($row = $run->fetch_array()):
            ?>
        
        <div class="chat_data">
            <span style="color:green" > <?php echo $row['name']; ?> </span> :
            <span style="color:brown"> <?php  echo $row['msg']; ?></span>
             <span style="float:right"> <?php echo formatdate($row['date']); ?></span> 
        </div>
<?php endwhile; ?>
