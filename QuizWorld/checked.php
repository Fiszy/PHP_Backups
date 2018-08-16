<?php
session_start();
$con = mysqli_connect('localhost','root','','quizdb');
   ?>

<!DOCTYPE html>
<html>
   <head>
      <title></title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   </head>
   <body>
     <div class="container text-center" ><br><br>
    	<h1 class="text-center text-success text-uppercase animateuse" > ThapaTechnical Quiz World</h1><br><br><br><br>
      <table class="table text-center table-bordered table-hover">
      	<tr><th colspan="2" class="bg-dark"> <h1 class="text-white"> Results </h1></th></tr>
      	<tr><td>Questions Attempted</td>
           
           <?php
         $counter = 0;
         $Resultans = 0;
            if(isset($_POST['submit'])){
              if(!empty($_POST['quizcheck'])) {
              $checked_count = count($_POST['quizcheck']);
              ?>
            <td>
              <?php
              echo "Out of 5, You have attempt ".$checked_count." option."; ?>
              </td>
              <?php
              $selected = $_POST['quizcheck'];
              $q1= " select ans_id from questions ";
              $ansresults = mysqli_query($con,$q1);
              $i = 1;
              while($rows = mysqli_fetch_array($ansresults)) {
                $flag = $rows['ans_id'] == $selected[$i];
                    if($flag){			
                      $counter++;
                      $Resultans++;
                    }else{
                      $counter++;
                    }					
                  $i++;		
            	}
            	?>
    		<tr>
    			<td>Your Total score</td>
    			<td colspan="2">
	    	<?php 
	            echo " Your score is ". $Resultans.".";
	            }
	            else{
	            echo "<b>Please Select Atleast One Option.</b>";
	            }
	            } 
	          ?>
	          </td>
            </tr>
            <?php 
            $name = $_SESSION['username'];
            $finalresult = " insert into user(username,totalques, answerscorrect) values ('$name','5','$Resultans') ";
            $queryresult= mysqli_query($con,$finalresult); 
            ?>
      </table>
      	<a href="logout.php" class="btn btn-success"> LOGOUT </a>
      </div>
   </body>
</html>
