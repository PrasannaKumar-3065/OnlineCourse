<?php
session_start();
include('includes/config.php');
if ($_SESSION['alogin']!="" or strlen($_SESSION['dept'])==0 or strlen($_SESSION['bat'])==0 ) {
  header('location:index.php');
} else {
  date_default_timezone_set('Asia/Kolkata'); // change according timezone
  $currentTime = date('d-m-Y h:i:s A', time());
  if (isset($_POST['submit'])) {
    $tutorname=$_POST['tutorname'];
    $c = $_POST['student'];
   
        foreach($c as $a){
          $student = $a;
          $ref = mysqli_query($bd, "SELECT * FROM students where StudentRegno='" . $a . "' && tutorname= ".$_POST['tutorname']." ");
          $col = mysqli_num_rows($ref);
          if ($col == 0){
            
            //$res = mysqli_query($bd, "UPDATE totalcredits SET creditsum=creditsum+$cdt where studentname='" . $_POST['studentname'] . "' &&  semester='" . $_POST['sem'] . "' && batch='" . $_POST['batch'] . "' && studentRegno='" . $_POST['studentregno'] . "' && department='" . $_POST['department'] . "' ");
              
              $ret = mysqli_query($bd, "UPDATE students SET tutorname=$tutorname where StudentRegno= '".$a."' ");
              if ($ret) {
                $_SESSION['msg'] = " Tutor Assigned Successfully !! ";
              } else {
                $_SESSION['msg'] = "Error : Not Assigned";
              }
          }
          else{
                $_SESSION['msg'] = "Tutor Already Assigned for selected student";
          }
        }
        

    // } else {
    //   foreach($c as $a){
    //     $ref = mysqli_query($bd, "SELECT * FROM courseenrolls where studentname='" . $_POST['studentname'] . "' && semester='" . $_POST['sem'] . "' && course=" . $a . " && department='" . $_POST['department'] . "' && studentRegno='" . $_POST['studentregno'] . "' && batch='" . $_POST['batch'] . "' ");
    //     $col = mysqli_num_rows($ref);
    //     if ($col == 0) {
          
    //       $tab = mysqli_query($bd, "SELECT credit from course where id='" . $a . "'");
    //       $row = mysqli_fetch_assoc($tab);
    //       $cr = $row["credit"];
    //       $studentregno = $_POST['studentregno'];
    //       $studentname = $_POST['studentname'];
    //       $dept = $_POST['department'];
    //       $course = $a;
    //       $sem = $_POST['sem'];
    //       $batch = $_POST['batch'];
    //       $res = mysqli_query($bd, "INSERT INTO totalcredits(creditsum,studentname,semester,batch,studentRegno,department) values($cr,'$studentname','$sem','$batch','$studentregno','$dept')");
    //       if ($res) {

    //         $ret = mysqli_query($bd, "insert into courseenrolls(studentRegno,studentname,department,course,semester,batch) values('$studentregno','$studentname','$dept','$course','$sem','$batch')");
    //         if ($ret) {
    //           $_SESSION['msg'] .= $a."Enroll Successfully !!";
    //         } else {
    //           $_SESSION['msg'] = "Error : Not Enroll";
    //         }
    //       } else {
    //         $_SESSION['msg'] = "Error in credit insertion process";
    //       }
    //     }
    //     foreach($e as $el){
    //       $cc1 = mysqli_fetch_assoc(mysqli_query($bd,"SELECT credit from course where id='" . $el . "'"));
    //       $cred = isset($cc1['credit']); 
    //       $ret = mysqli_query($bd, "insert into courseenrolls(studentRegno,studentname,department,course,semester,batch) values('$studentregno','$studentname','$dept','$el','$sem','$batch')");
    //       $_SESSION['msg'] .= $el . "Enroll Successfully !! ";
    //       if($ret){
    //         $o = mysqli_query($bd, "UPDATE totalcredits SET creditsum=creditsum+".$cred." where studentname='" . $_POST['studentname'] . "' &&  semester='" . $_POST['sem'] . "' && batch='" . $_POST['batch'] . "' && studentRegno='" . $_POST['studentregno'] . "' && department='" . $_POST['department'] . "' ");
    //         if(!$o){
    //           $_SESSION['msg'] .= "Credit update failed".$el;
    //         }
    //       }
  
    //     }
    //   }
    // }
    }

}

?>
 
  <html xmlns="http://www.w3.org/1999/xhtml">
  <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>tutor assign</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
  </head>

  <body>
    <?php include('includes/header.php'); ?>
    <!-- LOGO HEADER END-->
    <?php if ($_SESSION['alogin'] != "") {
      include('includes/menubar.php');
    }
    ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-head-line">Assign Students for Tutors </h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                Assign Students
              </div>
              <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>

              <div class="form-group">
                  <label for="tutorname">Tutor Name </label>
                                <select class="form-select" aria-label="Default select example" name="tutorname" id="tutorname"  required="required">
                              <?php 
                            $sql=mysqli_query($bd ,"select * from tutors where and department='".$_SESSION['dept']."' and batch='".$_SESSION['bat']."' ");
                            while($row=mysqli_fetch_array($sql))
                            {
                            ?>
                            <option value="<?php echo htmlentities($row['id']);?>" ><?php echo htmlentities($row['tutorname']);?></option>
                            <?php 
                          } ?>
                                </select>
                  </div>


                  <div class="form-group">
                    <label for="students">Student Regno </label>
                    <br>
                    <select class="form-select" multiple aria-label="multiple select example" name="student[]" id="student[]" onchange="courseAvailability(this.value)" required="required">
                      
                      <?php
                      $sql = mysqli_query($bd, "select * from students where department='" . $_SESSION['dept'] . "' and batch=". $_SESSION['bat']." ");
                      while ($row = mysqli_fetch_array($sql)) {
                      ?>s
                        <option value="<?php echo $row['StudentRegno']; ?>" selected><?php echo $row['StudentRegno']; ?></option>
                      <?php } ?>
                    </select>
                    <span id="course-availability-status1" style="font-size:12px;">
                  </div>

                  <button type="submit" name="submit" id="submit" class="btn btn-default">Enroll</button>
                  </form>
                </div>
            </div>
          </div>

        </div>

      </div>





    </div>
    </div>


  </body>

  </html>
