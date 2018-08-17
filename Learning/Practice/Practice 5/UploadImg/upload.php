<!-- ==========================================IMAGE UPLOAD=========================================================== -->
<?php
 $conn = mysqli_connect('localhost','root','','img');
    
        if(isset($_POST['uploadimg'])){
            $filename  =  $_FILES['imgupload']['name'];
            $tmpname   =  $_FILES['imgupload']['tmp_name'];
            $filesize  =  $_FILES['imgupload']['size'];
            $fileerror =  $_FILES['imgupload']['error'];
            $filetype  =  $_FILES['imgupload']['type'];

            $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
            $aname = $filename."_".date("mdYHis").".".$file_ext;  
            
            if (!empty($filename)) {
                if ($filesize < 1000000) {
                    if ($file_ext == "jpg" || $file_ext == "jpeg" || $file_ext == "png" ) {
                            $final_file = "images/".$aname;
                            $upload =  move_uploaded_file($tmpname,$final_file);
                        if ($upload){
                            $query = "INSERT INTO users(uimg) VALUES('$final_file')";  // uimg is column in database
                            $fire = mysqli_query($conn,$query); 
                                if ($fire) {
                                    echo "Upload Successfully";
                            }
                            }
                    } else {
                                echo "Please Enter Only JPG,PNG,JPEG";
                            }
                } else {
                    echo "Your Image is too Large. Please Select Image which size is < 1mb";
                }
            } else {
                echo "Please Select an Image ";
            }
    }
    
?>
