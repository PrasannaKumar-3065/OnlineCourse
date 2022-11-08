<?php
session_start();
include("includes/config.php");
if(strlen($_SESSION['login'])==0)
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
  
<?php if($_SESSION['login']!="")
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
			<form action="" method="POST">
                            <div class="table-responsive table-bordered">
                                <table class="table" id="enrolltable">
                                    <thead>
                                        <tr> 
                                            <th>#</th>
                                            <th>Course Name </th>
                                            <th>Course Code</th>
					                        <th>Credit Value</th>
                                            <th>Department</th>
                                            <th>Semester</th>
                                            <th>Enrollment Date</th>
                                             
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($bd, "select course.courseName as courname,course.courseCode as ccode,course.credit as credit,courseenrolls.department as dept,courseenrolls.enrollDate as edate ,courseenrolls.semester as sem from courseenrolls join course on course.id=courseenrolls.course  where courseenrolls.studentRegno='".$_SESSION['login']."' order by courseenrolls.semester");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['courname']);?></td>
                                            <td><?php echo htmlentities($row['ccode']);?></td>
                                            <td><?php echo htmlentities($row['credit']);?></td>
					                        <td><?php echo htmlentities($row['dept']);?></td>
                                            <td><?php echo htmlentities($row['sem']);?></td>
                                             <td><?php echo htmlentities($row['edate']);?></td>
                                            <td>

                                            </td>
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
                                </table>

				<div>
				   <form>
					<button type="submit" id="downloadexcel" name="export" class="btn-btn-info" value="Export to Excel">Export to excel</button>
				   </form>
				</div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div

        </div>
    </div>

<script>
    document.getElementById('downloadexcel').addEventListener('click', function() {
           var table2excel = new Table2Excel();	
	   table2excel.export(document.querySelectorAll('#enrolltable'));
	});
</script>   
  <?php include('includes/footer.php');?>
   
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/table2excel.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>