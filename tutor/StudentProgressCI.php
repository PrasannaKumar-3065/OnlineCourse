<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['tlogin']) == "")
    {   
header('location:index.php');
}
if(isset($_GET['del']))
      {
              mysqli_query($bd, "update students set CI = NULL where StudentRegno = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Student record deleted !!";
      } 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Class Incharge | Students</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
   
<?php if($_SESSION['tlogin']!="")
{
 include('includes/menubar.php');
}
 ?>
   
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Class Incharge Students </h1>
                    </div>
                </div>
                <div class="row" >
                 
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Student Progress
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Reg No </th>
                                            <th>Student Name </th>
                                             <th>Reg Date</th>
                                             <th>Action</th>
                                        </tr>
                                    </thead>
                                    
<?php
$sql=mysqli_query($bd, "select * from students where CI = '".$_SESSION["tlogin"]."' ");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['StudentRegno']);?></td>
                                            <td><?php echo htmlentities($row['studentName']);?></td>
                                            <td><?php echo htmlentities($row['creationdate']);?></td>
                                            <td>              
<a href="mystudents.php?id=<?php echo $row['StudentRegno']?>&del=delete" onClick="return confirm('Are you sure you want to remove student from your Class Incharge ward?')">
                                            <button class="btn btn-danger">Remove</button>
</a>
<a href="showcourses.php?id=<?php echo $row['StudentRegno']?>">
<button type="submit" name="submit" id="submit" class="btn btn-default">Registerd Courses</button>
</a>
<a href="onecredit.php?id=<?php echo $row['StudentRegno']?>">
<button type="submit" name="submit" id="submit" class="btn btn-default">Change One Credit Courses</button>
</a>

<a href="showcertificatescihod.php?id=<?php echo $row['StudentRegno']?>">
<button type="submit" name="submit" id="submit" class="btn btn-default">Certificates</button>
</a>
                                   </td>
                                        </tr>
                                        <tr id="<?php echo $row['StudentRegno']?>"></tr>
<?php 
$cnt++;
} ?>
                                        
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>





        </div>
    </div>
    
  <?php include('includes/footer.php');?>
    
    <script src="assets/js/jquery-1.11.1.js"></script>
    
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
