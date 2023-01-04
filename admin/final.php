<?php
include("includes/config.php");
function result($name,$value,$bd)
    {
        $sql1 = mysqli_query($bd,"Select * from courseenrolls where studentRegno=".$name." and course=".$value." ");
        if(mysqli_num_rows($sql1) > 0){
            return 1;
        }
        else{
            return 0;
        }
    } 
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Enroll History</title>
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<link href="assets/css/style.css" rel="stylesheet" />
<script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/table2excel.js"></script>
    <script src="assets/js/bootstrap.js"></script>
<style>
@font-face {
  font-family: 'Material Icons';
  font-style: normal;
  font-weight: 400;
  src: url(https://fonts.gstatic.com/s/materialicons/v139/flUhRq6tzZclQEJ-Vdg-IuiaDsNc.woff2) format('woff2');
}

.material-icons {
  font-family: 'Material Icons';
  font-weight: normal;
  font-style: normal;
  font-size: 24px;
  line-height: 1;
  letter-spacing: normal;
  text-transform: none;
  display: inline-block;
  white-space: nowrap;
  word-wrap: normal;
  direction: ltr;
  -webkit-font-feature-settings: 'liga';
  -webkit-font-smoothing: antialiased;
}
</style>

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
<?php include('includes/menubar.php');?>

<?php if($_SESSION['alogin']!="")
{
 include('includes/menubar.php');
}
 ?>
  <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Student Reg no. Verification</h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Final Format
                        </div>
<font color="red" align="center"><?php echo htmlentities($_SESSION['errmsg']);?><?php echo htmlentities($_SESSION['errmsg']="");?></font>


                        <div class="panel-body">
                       <form action="final1.php" name="regnoverify" method="post">
   <div class="form-group">
    <label>Batch</label>
    <input type="text" class="form-control" name="batch" placeholder="batch" required />
  </div>
  <div class="form-group">
    <label>semester</label>
    <input type="text" class="form-control" name="semester" placeholder="semester" required />
  </div>
  <div class="form-group">
    <label>department</label>
    <input type="text" class="form-control" name="dept" placeholder="department" required />
  </div>
 
  
  <button type="submit" name="submit" class="btn btn-default">Verify</button>
                           <hr />
   



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