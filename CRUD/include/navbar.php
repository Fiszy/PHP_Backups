<div class="container">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="index.php">MY CRUD APP</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
        </li>
        <?php 
            if (isset($_SESSION['is_login']))   { ?>
                <li class="nav-item">
                <a class="nav-link" href="#"><?php echo $_SESSION['username']; ?></a>
                </li> 
                <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
                </li> 
           <?php  } else { ?>
                <li class="nav-item">
                <a class="nav-link" href="signin.php">Login</a>
                </li>
            <?php  } ?>
        </ul>
    </div>
    </nav>
</div> 