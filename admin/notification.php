
<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_POST['submit']))
{
    $id = $_GET['id'];
    $sql = mysqli_query($bd,"Select * from notification where id = ".$id." ");
    $row = mysqli_fetch_assoc($sql);
    if(mysqli_num_rows($sql)>0){
        $sql2 = mysqli_query($bd,"Select * from students where StudentRegno = ".$row["rollno"]." ");
        $row1 = mysqli_fetch_assoc($sql2);
        if(mysqli_num_rows($sql2)>0){
            $sql1 = mysqli_query($bd,"Delete from courseenrolls where studentRegno = '".$row1["StudentRegno"]."' and semester = ".$row1["semester"]." and batch ='".$row1["batch"]."' "); 
            $sql1 = mysqli_query($bd,"Delete from totalcredits where studentRegno = '".$row1["StudentRegno"]."' and semester = ".$row1["semester"]."  and batch ='".$row1["batch"]."' ");
            $sql1 = mysqli_query($bd,"update noncgpa set status = 'Approved_by_HOD', course = 0, semester = 0 where semester = ".$row1["semester"]." and name = ".$row1["StudentRegno"]." and status='Completed' ");
            $sql1 = mysqli_query($bd,"update notification set status = 'Approved' where id = ".$id." ");
        }        
    }
}
if(isset($_POST['cancel'])){
    $id = $_GET['id'];
    $sql = mysqli_query($bd,"Update notification set status = 'Denied' where id = ".$id." ");
    if($sql){
        $_SESSION['msg'] = "message discarded";
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
    <title>Admin | Requests for re registering</title>
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
                        <h1 class="page-head-line">Requests for re register</h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           Notification
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>

                        <div class="panel-body">
                        <?php 
                            $sql = mysqli_query($bd,"select * from notification where status = 'pending' ");
                            if(mysqli_num_rows($sql)>0){
                            while($res = mysqli_fetch_assoc($sql)){
                        ?>
                        <form method="post" action="notification.php?id=<?php echo $res['id'];?>">
                        <div class="form-group">
                            <h4><?php echo $res["from_user"]?>: </h4>
                            <h6><?php echo " ".$res["message"];?></h6> <h5><?php echo " for semester - 
                            
                            ".$res["semester"];?></h5>
                        </div>
                        <button type="submit" name="submit" class="btn btn-default">Approve</button>
                        <button type="submit" name="cancel" class="btn btn-default">Reject</button>
                        <hr />
                        <?php }}else{
                            $_SESSION['msg'] = "No messages available";
                        }?>

</form>
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
<?php } ?>