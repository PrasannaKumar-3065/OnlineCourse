<?php 
session_start();
include('includes/config.php');
if (strlen($_SESSION['tlogin']) == "") {
  header('location:index.php');
}

$sql = mysqli_query($bd,"select * from students where tutorname='"+$_SESSION["tlogin"]+"' ");
while($rows = mysqli_fetch_assoc()){
?>



<?php} ?>

