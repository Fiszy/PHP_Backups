<!-- Configuation Database Connect File -->
<?php require 'config.php'; ?>

<!-- HTML Code For Sign up Form and Show data -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>CRUD</title>
</head>
<body>
    <!-- navbar -->
    <?php require 'include/navbar.php'; ?>
    <!-- main body -->
    <div class="container">
        <div class="row">
                <!-- Show data  -->
                <div class="col-lg-8" style="margin-top:30px;">
                <h3>USER DATA</h3>
                <hr>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>USERNAME</th>
                        <th>FULLNAME</th>
                        <th>EMAIL</th>
                        <th>DELETE</th>
                        <th>UPDATE</th>
                    </tr>
                    </thead>
                    <tbody>
                            <!-- PHP code for Fetch Data from Database and Display in Tables -->
                            <?php
                            $query = "SELECT * FROM users";
                            $fire = mysqli_query($conn,$query);
                            if (mysqli_num_rows($fire)>0){
                                while ($users = mysqli_fetch_assoc($fire)){ ?>
                            <tr>
                                <td> <?php echo $users['username']; ?> </td>
                                <td> <?php echo $users['fullname']; ?></td>
                                <td> <?php echo $users['email']; ?> </td>
                                <td ><a href=" <?php $_SERVER['PHP_SELF']; ?>?del=<?php echo $users['id']; ?> "class="btn btn-sm btn-danger" >Delete</a></td>
                                <td ><a href="update.php?upd=<?php echo $users['id']; ?>"class="btn btn-sm btn-success">Update</a></td>
                            </tr>
                                    <?php  
                                }
                            } else { ?>
                                    <tr>
                                        <td colspan="5" class="text-center">
                                        <h2 class="text-muted"> There is no Data to Show!!</h2>
                                        </td>
                                    </tr>
                                <?php } ?>              
                            
                    </tbody>
                </table>
                </div>

                <!-- Sign up -->
                <div class="col-lg-4">
                    <h3 style="margin-top:30px;"> SIGN UP </h3>
                    <hr>
                    <form action="insert.php" method="post">
                        <div class="form-group">
                            <label for="fullname">FULLNAME</label>
                            <input  name = "fullname" class="form-control" required placeholder="FULLNAME" type="text">
                        </div>
                        <div class="form-group">
                            <label for="email">EMAIL</label>
                            <input  name = "email" class="form-control" required placeholder="EMAIL" type="text">
                        </div>
                        <div class="form-group">
                            <label for="username">USERNAME</label>
                            <input  name = "username" class="form-control" required placeholder="USERNAME" type="text">
                        </div>
                        <div class="form-group">
                            <label for="password">PASSWORD</label>
                            <input  name = "password" class="form-control" required placeholder="PASSWORD" type="text">
                        </div>
                        <div class="form-group">
                            <button name ="submit" class="btn btn-success btn-block">Sign up</button>
                        </div>
                        <?php
                            if (isset($_GET['msg'])) {
                                echo $_GET['msg'];
                            }
                        ?>
                    </form>
                </div>
        </div>
    </div>
</body>
</html>

<!-- PHP code for Delete Data from Database and Display in Tables -->
<?php

    if (isset($_GET['del'])){
        $id = $_GET['del'];
        $query = "DELETE FROM users WHERE id = $id";
        $fire = mysqli_query($conn,$query);
        
    }

?>