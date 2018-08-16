<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Gone</title>
</head>
<body onload="ajax()">
    <div class="container">
        <h2 align="center" style="color:red; width:100%; border-bottom: 1px solid brown; font-size:30px;"> Gone Application </h2> <br>
        <div class="chat_box">
           <div id="chat"></div>
        </div>
        <form action="index.php" method="POST">
            <input type="text" name="name" required placeholder="Enter Your Name"> <br> <br>
            <textarea name="msg" cols="100" rows="200" required placeholder="Enter Message" ></textarea> <br> <br>
            <input type="submit" name="submit" value="Send" >
        </form>
        <?php

        if (isset($_POST['submit'])) {
            $msg = $_POST['msg'];
            $name = $_POST['name'];
            $insert = " INSERT into chat(name,msg) values ('$name','$msg') ";
            $run_insertion = $conn->query($insert);
            if ($run_insertion) {
                echo "<embed  loop='false' src='chat.mp3' hidden='true' autoplay='true'>";
            }
        }

        ?>
    </div>

    <script>
        function ajax() {
            var req = new XMLHttpRequest();
            req.onreadystatechange =function () {
                if (req.readyState == 4 && req.status == 200) {
                    document.getElementById('chat').innerHTML = req.responseText;
                }
            }
            req.open('GET','chat.php',true);
            req.send();
        }
        setInterval(function(){ajax();},1000);
    </script>

</body>
</html>