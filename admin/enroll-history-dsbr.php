<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0 or strlen($_SESSION['dept'])==0 or strlen($_SESSION['sem'])==0 or strlen($_SESSION['bat'])==0 or strlen($_SESSION['reg'])==0) 
    {   
header('location:index.php');
}
else{



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Enroll History</title>
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
                        <h1 class="page-head-line">Enroll History  </h1>
                    </div>
                </div>
      <div class="row" >
            
                <div class="col-md-12">
                   
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Enroll History
                        </div>
                      
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                            <table class="table" id="enrolltable">
                                    <thead>
                                        <tr> 
                                            <th>#</th>
                                                <th>Course Code</th>
                                                <th>Course Name</th>
                                                <th> For more details</th>
                                             
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($bd, "select id, courseCode as ccode,courseName as cname from course  where department='".$_SESSION['dept']."' && semester='".$_SESSION['sem']."' && regulation='".$_SESSION['reg']."' order by courseCode");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['ccode']);?></td>
                                            <td><?php echo htmlentities($row['cname']);?></td>
                                            <td>
                                            <a href="checkenroll.php?id=<?php echo $row['id']?>">
<button class="btn btn-primary"><i class="fa fa-edit "></i> view</button> </a>                                        
</a>
                                            </td>
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
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
    <script src="assets/js/table2excel.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>