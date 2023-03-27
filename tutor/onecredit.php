<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['tlogin']) == 0)
    {   
header('location:index.php');
}
else{
$reg = $_GET["id"];
if (isset($_POST['submit'])) {
  $studentregno = $_POST['studentregno'];
  $studentname = $_POST['studentname'];
  $department = $_POST['department'];
  $semester = $_POST['semester'];
  $tocourse = $_POST['tocourse'];
  $course = $_POST['course'];
  $batch = $_POST['batch'];

  $sql = mysqli_query($bd, "update courseenrolls set course = $tocourse, semester=$semester where studentRegno=$studentregno and course=$course and semester=$semester");
  if ($sql) {
    $_SESSION['msg'] =  "Changed Successfully !! ";
  } else {
    $_SESSION['msg'] = "Error : Not changed";
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
    <title>Tutor | Certificates</title>
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
                        <h1 class="page-head-line"> Change One Credit Course</h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Replace with new Course
                        </div>
<font color="red" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>

<?php $sql = mysqli_query($bd, "select * from students where StudentRegno='".$reg."'");
              $cnt = 1;
              while ($row = mysqli_fetch_array($sql)) { ?>
                        <div class="panel-body">
                       <form name="deptsemverify" method="post">
                       <div class="form-group">
                                    <label for="sname">Student Name </label>
                                    <input type="text" class="form-control" id="studentname" name="studentname"
                                        value="<?php echo htmlentities($row['studentName']); ?>" readonly />
                                </div>

                                <div class="form-group">
                                    <label for="studentregno">Student Reg No </label>
                                    <input type="text" class="form-control" id="studentregno" name="studentregno"
                                        value="<?php echo htmlentities($row['StudentRegno']); ?>" readonly />
                                </div>

                                <div class="form-group">
                                    <label for="batch">Batch </label>
                                    <input type="text" class="form-control" id="batch" name="batch" readonly
                                        value="<?php echo htmlentities($row['batch']); ?>" required />
                                </div>

                                <div class="form-group">
                                    <label for="Department">Department </label>
                                    <input type="text" class="form-control" name="department" readonly
                                        value="<?php echo htmlentities($row['department']); ?>" />
                                </div>

                                <?php } ?>

                                <label for="semester">Semester </label>
                                <select class="form-select" 
                                        name="semester" id="semester"  required="required">
                                        <?php
                      $sql = mysqli_query($bd, "select semester from semester");
                      while ($row = mysqli_fetch_array($sql)) {
                      ?>
                                        <option value="<?php echo $row['semester']; ?>" >
                                            <?php echo $row['semester']; ?></option>
                                            <?php } ?>
                                    </select>

                                    <label for="Course">From Course</label>
                                    <select class="form-select" 
                                        name="tocourse" id="tocourse"  required="required">
                                        <?php
                      $sql = mysqli_query($bd, "select a.courseCode as ccode , a.courseName as cname from course a inner join courseenrolls b on a.id=b.course where a.credit = '1' and a.type='OneCredit' and b.studentRegno='".$reg."'");
                      while($row = mysqli_fetch_array($sql)) {
                      ?>
                                        <option value="<?php echo $row['ccode']; ?>" >
                                            <?php echo $row['cname'];?></option>
                                            <?php
                                          } ?>
                                    </select><br><br>

                                  
                                    
                                <label for="Course">To Course </label>
                                    <select class="form-select" 
                                        name="tocourse" id="tocourse"  required="required">
                                        <?php
                      $sql = mysqli_query($bd, "select courseCode as ccode , courseName as cname from course where credit = '1' and type='OneCreditRA' ");
                      while ($row = mysqli_fetch_array($sql)) {
                      ?>
                                        <option value="<?php echo $row['ccode']; ?>" >
                                            <?php echo $row['cname']; ?></option>
                                            <?php } ?>
                                    </select><br><br>

                                    <label for="Staff">Staff Name </label>
                                    <select class="form-select" 
                                        name="staff" id="staff"  required="required">
                                        <?php
                      $sql = mysqli_query($bd, "select a.staff1 as stf, b.tutorname as tut  from course a inner join tutors b on (a.staff1=b.username and a.staff2=b.username and a.staff3=b.username) or (a.staff1=b.username and a.staff2=b.username) or (a.staff1=b.username) where a.credit = '1' and a.type='OneCreditRA'");
                      while ($row = mysqli_fetch_array($sql)) {
                      ?>
                                        <option value="<?php echo $row['stf']; ?>" >
                                            <?php echo $row['tut']; ?></option>
                                            <?php } ?>
                                    </select><br><br>


 
  <button type="submit" name="submit" class="btn btn-default">Submit </button>
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
</html>
<?php } ?>