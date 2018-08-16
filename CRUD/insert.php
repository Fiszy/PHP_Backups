<!-- Configuation Database Connect File -->
<?php require 'config.php'; ?>

<?php
    if (isset($_POST['submit']))
    {
        $msg = "";
        $fullname = strip_tags(trim($_POST['fullname']));
        $username = strip_tags(trim($_POST['username']));
        $password = strip_tags(trim($_POST['password']));
        $email    = strip_tags(trim($_POST['email']));

        $fullname_valid = $username_valid = $password_valid =$email_valid = false;

        // <!-- full name Validation --!>
        if (!empty($fullname)) {
            if (strlen($fullname) > 2 && strlen($fullname) < 30) {
                    $fullname_valid = true;
            } else {
                $msg .= " [!] Fullname must be 2 to 30 chars long <br>";
            } 
        } else {
            $msg .= " [!] Please Enter Fullname <br>";
        }

        // Email validation
        if (!empty($email)) {
            if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
                
                $query = "SELECT email FROM users WHERE email = '$email'";
                $fire = mysqli_query($conn,$query);
                if (mysqli_num_rows($fire)>0){
                    $msg .= "Email Already Exists.<br>";
                } else {
                    $email_valid = true;
                }
            } else {
                $msg .= " [!] Invalid Email <br>";
            } 
        } else {
            $msg .= " [!] Please Enter Email <br>";
        }

        // username validation
        if (!empty($username)) {
            if (strlen($username) > 2 && strlen($username) <= 15) {
                if (!preg_match('/^a-zA-Z\d_/',$username)) {
                    // All test passed
                    $query = "SELECT username FROM users WHERE username = '$username'";
                    $fire = mysqli_query($conn,$query);
                    if (mysqli_num_rows($fire)>0){
                        $msg .= " [!] Username not Available. Try Another!! <br>";
                    } else {
                        $username_valid = true;
                    }
                    
                } else {
                    $msg .= " [!] username require Only Alphabets & Digits <br>";
                }
            } else {
                $msg .= " [!] username must be 2 to 15 chars long <br>";
            } 
        } else {
            $msg .= " [!] Please Enter username <br>";
        }

        // password validation
        if (!empty($password)) {
            if (strlen($password) > 5 && strlen($username) <= 15) {
                    // All test passed
                    $password_valid = true;
                    $password = md5($password);
            } else {
                $msg .= " [!] Password must be 5 to 15 chars long <br>";
            } 
        } else {
            $msg .=  " [!] Please Enter Password <br>";
        }

        if ($fullname_valid && $username_valid && $email_valid && $password_valid) {
            $query = "INSERT INTO users(fullname,username,email,password) VALUES('$fullname','$username','$email','$password')";
            $fire = mysqli_query($conn,$query);
            if ($fire)
            { 
                $msg = "Data Submitted Successfully";
                header('location:index.php?msg='.$msg);
            } 
        } else {
            header('location:index.php?msg='.$msg);
        }      
    }
?>