<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Register</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<?php
include("includes/config.php");
session_start();
    if(isset($_POST["submit"])){
        $count = 0;
        $id = 0;
        $type= "";
        $student = array();
        $course = array();
        $sql = mysqli_query($bd,"select * from students where batch = '".$_POST["batch"]."' ");
        $sql1 = mysqli_query($bd,"SELECT * FROM course WHERE courseCode = '".$_POST["code"]."' ");
        while($row = mysqli_fetch_assoc($sql1)){
            $id = $row["id"];
            $type = $row["type"];
        }
        while($row = mysqli_fetch_assoc($sql)){
                $sql2 = mysqli_query($bd, "insert into courseenrolls(studentRegno,studentname,department,course,semester,batch) values(".$row["StudentRegno"].", '".$row["studentName"]."', '".$row["department"]."',".$id.", ".$row["semester"].", '".$row["batch"]."');");
                if($sql2>0){
                   $count+= 1; 
                }
                else{
                    $_SESSION["msg"] .= $count." ";
                }
        }
        $_SESSION["msg"] = "Course registered for ".$count." students for batch ". $_POST["batch"];
    }
?>
<body>
<?php include('includes/header.php');
 include('includes/menubar.php');
 ?>

  
<div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Register</h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           register 
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form action="registercourse.php" method="post">
   <div class="form-group">
    <label for="semester">Course Code</label>
    <input type="text" class="form-control" id="code" name="code" placeholder="Course code" required />
  </div>
  <div class="form-group">
    <label for="semester">Batch</label>
    <input type="text" class="form-control" id="batch" name="batch" placeholder="Enter Batch" required />
  </div>
 <button type="submit" name="submit" class="btn btn-default">Submit</button>
</form>
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