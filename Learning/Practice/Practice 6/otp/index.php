<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OTP System</title>
</head>
<body>
    <form action="sms.php" method="post">
       <select name="option">
       <option value="+92">+92 Pakistan</option>
       <option value="+91">+91 India</option>
       </select> <br><br>

       <input type="text" name="mobile" placeholder="Mobile number"> <br><br>
       <textarea name="msg"></textarea> <br><br>
       <input type="submit" name="submit" value="Submit Now">
       
    </form>
    
</body>
</html>