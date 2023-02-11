<?php session_start();
echo("<script>console.log('".$_SESSION['role']."')</script>");
include('includes/config.php'); ?>
<section class="menu-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="navbar-collapse collapse ">
                    <ul id="menu-top" class="nav navbar-nav navbar-right">
                    <?php if($_SESSION['role'] == "Tutor"){ ?>
                        <li><a href="mystudents.php">My Students</a></li>
                        <?php } else if($_SESSION['role'] == "HOD"){ ?>
                            <li><a href="studentprogresshod.php">Students Progress</a></li>
                        <?php }
                            if($_SESSION['role'] == "CI"){ ?>
                            <li><a href="studentprogressci.php">Class Incharge Students</a></li>
                            <?php } ?>
                        <li><a href="my-profile.php">My Profile</a></li>
                        <li><a href="change-password.php">Change Password</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>