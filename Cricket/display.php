<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>

<?php

$conn = mysqli_connect('localhost','root','','cricket');

$query = " SELECT * from cricket ";
$detail = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($detail)) {
    $afridi_vote = $row['Afridi']; 
    $kohli_vote = $row['Kohli']; 
    $gayle_vote = $row['Gayle']; 

    $result = $afridi_vote+$kohli_vote+$gayle_vote;
    $per_afridi = round($afridi_vote*100/$result).'%';
    $per_kohli = round($kohli_vote*100/$result).'%';
    $per_gayle = round($gayle_vote*100/$result).'%';

    echo "<div class='records'>
        <img class='dp' src='images/afridi.jpg' > &nbsp;&nbsp;&nbsp; $afridi_vote &nbsp;&nbsp; ($per_afridi) <hr> <br>
        <img class='dp' src='images/kohli.jpg' > &nbsp;&nbsp;&nbsp; $kohli_vote &nbsp;&nbsp; ($per_kohli) <hr> <br>
        <img class='dp' src='images/gayle.jpg' > &nbsp;&nbsp;&nbsp; $gayle_vote &nbsp;&nbsp; ($per_gayle) <hr><br>
    </div>";

}

?>
    
</body>
</html>