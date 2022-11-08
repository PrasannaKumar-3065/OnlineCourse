<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{

  $ref=mysqli_query($bd, "SELECT count(*) as allcount FROM pecourse where courseName='".$_POST['coursename']."' && courseCode='".$_POST['coursecode']."' && semester='".$_POST['semester']."' && department='".$_POST['department']."' && regulation='".$_POST['regulation']."' && credit='".$_POST['credit']."' && noofelectives='".$_POST['noofelectives']."' && batch='".$_POST['batch']."' && electivepos='".$_POST['electivepos']."' ");
  $col=mysqli_fetch_array($ref);
  $allcount=$col['allcount'];
  if($allcount==0){
    $coursecode=$_POST['coursecode'];
    $coursename=$_POST['coursename'];
    $department=$_POST['department'];
    $semester=$_POST['semester'];
    $noofelectives=$_POST['noofelectives'];
    $electivepos=$_POST['electivepos'];
    $credit=$_POST['credit'];
    $seatlimit=$_POST['seatlimit'];
    $batch=$_POST['batch'];
    $regulation=$_POST['regulation'];
    $ret=mysqli_query($bd, "insert into pecourse(courseCode,courseName,department,semester,noofelectives,electivepos,credit,noofSeats,regulation,batch) values('$coursecode','$coursename','$department','$semester','$noofelectives','$electivepos','$credit','$seatlimit','$regulation','$batch')");
    if($ret)
    {
    $_SESSION['msg']="Course Created Successfully !!";
    }
    else
    {
      $_SESSION['msg']="Error : Course not created";
    }
  }
  else{
    $_SESSION['msg']="This course was already created. please enter another course.";
  }
}
if(isset($_GET['del']))
      {
              mysqli_query($bd, "delete from pecourse where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Course deleted !!";
      }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | PECourse</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
    
<?php if($_SESSION['alogin']!="")
{
 include('includes/menubar.php');
}
 ?>
   
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Course  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           Course 
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


            </div>

            <form name="coursefile" method="POST">
<div class="form-group">
    <label for="coursefile">Excel File Import: </label>
    <input type="file" class="form-control" id="coursefile" name="coursefile" required />
    <button class="btn btn-primary mt-3">Import</button>
  </div>

</form>



        </div>
    </div>
    
  <?php include('includes/footer.php');?>
    
    <script src="assets/js/jquery-1.11.1.js"></script>
    
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
