<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
if($_SESSION["msg"] != ""){
  $_SESSION["msg"] = "";
}
if(isset($_POST['submit']))
{
   $tutorname=$_POST['tutorname'];
   $username=$_POST['username'];
   $password=md5($_POST['password']);
   $department=$_POST['department'];

      $ret=mysqli_query($bd, "insert into tutors(tutorName,username,password,department) values('$tutorname','$username','$password','$department')");
      if($ret)
      {
      $_SESSION['msg']="tutor Registered Successfully !!";
      }
      else
      {
      $_SESSION['msg']="Error : tutor  not Register";
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
    <title>Admin | Tutor Registration</title>
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
                        <h1 class="page-head-line">Tutor Registration  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Tutor Registration
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
   <div class="form-group">
    <label for="tutorname">Tutor Name  </label>
    <input type="text" class="form-control" id="tutorname" name="tutorname" placeholder="Tutor Name" required />
    
  </div>

  <div class="form-group">
    <label for="username">User Name  </label>
    <input type="text" class="form-control" id="username" name="username" onBlur="userAvailability()" placeholder="User Name" required />
    <span id="user-availability-status1" style="font-size:12px;">
  </div>

<div class="form-group">
    <label for="password">Password  </label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required />
  </div>   

<div class="form-group">
    <label for="department">Department  </label>
    <input type="text" class="form-control" id="department" name="department" placeholder="Department Name" required />
  </div>

 <button type="submit" name="submit" id="submit" class="btn btn-default">Submit</button>
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
    

<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_tutor.php",
data:'tut='+$("#username").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>


</body>
</html>
<?php } ?>
