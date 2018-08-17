<!-- ========================================================================================================= -->

<!-- <img src="<?php $row['imgupload']  ?>" alt="">
<?php include 'Header.php';?>  -->
<?php require 'Header.php';?>  -->

<!-- ===============================================COOKIE========================================================== -->


$name = "test-cookie";
$content = "talha first cookie";
$expiry = time()+(60*60*24);
setcookie($name,$content,$expiry);

<!-- ===============================================Random Password Generator========================================================== -->


$random _chars = ("fsdgdfhrtgfhfghjndfyihrthkrtlerhogesd2gd0ge123?>?}{}{>?AD");
$pass = substr($random_chars,0,8);
echo $pass;

date("d/m/y H:i:s A");  // data and time

<!-- ===============================================MAIL========================================================== -->

$to = 
$subject = 
$message =
$ headers =
mail($to,$subject,$message,$headers);

<!-- ===============================================sql injection========================================================== -->
mysqli_real_escape_string   // use to escape different characters.