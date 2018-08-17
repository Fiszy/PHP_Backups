<?php

if (isset($_POST['submit'])) {
    $name = $_POST['username'];
    $passw = $_POST['pass'];
    $checkbox = $_POST['checkbox'];
    // echo "You Entered: <br/> Username: '.$name.' <br/> Password: '.$passw.' "; 
    $conn = mysqli_connect("localhost","root","","talha");
    if (!$conn){
        echo "Database Connectivity Error";

    } else{
        $sql = "SELECT * FROM users";
        $query = mysqli_query($conn,$sql);
        echo "
        <table border='1'>
        <tr>
            <th>UserName</th>
            <th>Password</th>
        </tr>
       
        ";
        while($row= mysqli_fetch_array($query)){
            // echo $row['id']." ".$row['name']." ".$row['email']." ".$row['password']."<br/>";   
            echo "<tr>".
             "<td>".$row['name']."</td>".
            "<td>".$row['password']."</td>".
           "</tr>";
        } 
        echo "e
            
        </table>
        ";       
}
} else {
    echo "File Not Found!! ";    
}
?>






