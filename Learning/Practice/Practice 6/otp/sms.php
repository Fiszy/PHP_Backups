<?php
    if (isset($_POST['submit'])) {

        $mobile = $_POST['mobile'];
        $option = $_POST['option'];
        $msg = $_POST['msg'];
        
       
        // Authorisation details.
        $username = "muhammadtalhawaseem@gmail.com";
        $hash = "5aa58d453c7704ac2106e68b4aafbf075c0e2512b3c0bed5e6f8052c208fbb24";
    
        // Config variables. Consult http://api.txtlocal.com/docs for more info.
        $test = "1";
    
        // Data for text message. This is the text message data.
        $sender = "Mtw Abbaxi"; // This is who the message appears to be from.
        $numbers = $mobile; // A single number or a comma-seperated list of numbers
        $message = $msg;
        // 612 chars or less
        // A single number or a comma-seperated list of numbers
        $message = urlencode($message);
        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
        $ch = curl_init('http://api.txtlocal.com/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch); // This is the result from the API
        if (result){
            echo "Message Sent Successfully";
        }
        curl_close($ch);
    





    }


?>