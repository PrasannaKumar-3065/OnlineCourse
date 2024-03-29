<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['tlogin']) == "")
    {   
header('location:index.php');
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Class Incharge | Credit Transfer APPROVED</title>
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
                        <h1 class="page-head-line">Credit Transfer Approved</h1>
                    </div>
                </div>
                <div class="row" >


                 
                <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
                <font color="red" align="center"><?php echo htmlentities($_SESSION['errmsg']);?><?php echo htmlentities($_SESSION['errmsg']="");?></font>
                <div class="col-md-12">

               
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Student Certificates
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student Regno</th>
                                            <th>Platform</th>
                                            <th>Title</th>
                                            <th>Proof</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    
<?php
$sql = mysqli_query($bd,"select * from students a inner join noncgpa b on a.StudentRegno = b.name where b.type= 'Credit Transfer' and b.status = 'Approved_by_CI' and a.CI = '" . $_SESSION['tlogin'] . "' ");
$cnt=1;
$credit = 0;
$sem = 0;
while($row=mysqli_fetch_array($sql))
{
?>
                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['name']);?></td>
                                            <td><?php echo htmlentities($row['platform']);?></td>
                                            <td><?php echo htmlentities($row['title']);?></td>
                                            <td><embed src="data:application/pdf;base64,<?php echo $row['proof']; ?>" type="application/pdf" height="300px"> </td>
                                            <?php 
                                            $color = ""; if($row["status"] == "Approved_by_CI"){$color = "text-success";}else{$color = "text-danger";} ?>
                                            <td class="<?php echo $color;?>"><?php echo $row["status"]; ?></td>
                                            
                                        </tr>              
<?php 
$cnt++;
}?>
       

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