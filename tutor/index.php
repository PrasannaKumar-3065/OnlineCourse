<?php

session_start();
error_reporting(1);
include("includes/config.php");
if(isset($_POST['submit']))
{
    $username=$_POST['username'];
    $password=md5($_POST['password']);
$query=mysqli_query($bd, "SELECT * FROM tutors WHERE username='$username' and password='$password' ");
if(mysqli_num_rows($query)>0)
{
$num=mysqli_fetch_array($query);
$extra="select.php";//
$_SESSION['tlogin']=$username;
$_SESSION['id']=$num['username'];
$_SESSION['tname']=$num['tutorname'];
$_SESSION['department']=$num['department'];
$uip=get_client_ip();
$status=1;
$flag = mysqli_num_rows(mysqli_query($bd,"select * from tutorlog where username='".$username."' "));
$log=mysqli_query($bd, "insert into tutorlog(username,userip,status) values('".$_SESSION['tlogin']."','$uip','$status')");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if($flag < 1){
    header("location:change-password.php");
}
else{
header("location:StudentProgress.php");
}
exit();
}
else
{
$_SESSION['errmsg']="Invalid username or Password";
header("index.php");
// $extra="index.php";
// $host  = $_SERVER['HTTP_HOST'];
// $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
// header("location:http://$host$uri/$extra");
}
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Tutor Login</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <?php include('includes/header.php');?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Please Login To Enter </h4>

                </div>

            </div>
             <span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
            <form name="admin" method="post">
            <div class="row">
                <div class="col-md-6">
                     <label>Enter User Name: </label>
                        <input type="text" name="username" class="form-control"  />
                        <label>Enter Password :  </label>
                        <input type="password" name="password" class="form-control"  />
                        <hr />
                        <button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> &nbsp;Log Me In </button>&nbsp;
                </div>
                </form>

            </div>
        </div>
    </div>
 
    <?php include('includes/footer.php');?>
   
    <script src="assets/js/jquery-1.11.1.js"></script>

    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
