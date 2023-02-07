<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == "") {
  header('location:index.php');
}

//$count = mysqli_num_rows(mysqli_query($bd,"select * from students where batch = '".$_SESSION["batch"]."' and semester = ".$_SESSION["semester"]." and department = '".$_SESSION["department"]."' "));

// $sql = mysqli_num_rows(mysqli_query($bd,"select * from students where batch = '".$_SESSION["batch"]."' and semester = ".$_SESSION["semester"]." and department = '".$_SESSION["department"]."' "));
// $sql2 = mysqli_num_rows(mysqli_query($bd, "select * from courseenrolls where department = '".$_SESSION["department"]."' and batch = '".$_SESSION["batch"]."' and semester = ".$_SESSION["semester"]." group by studentRegno "));
// if($sql != $sql2){
//   header('location:enroll.php?msg=wait');
// }

function staff($bd, $staffid)
{
  $sql = mysqli_fetch_assoc(mysqli_query($bd, "select tutorname from tutors where username = '" . $staffid . "';"));
  $staffname = $sql["tutorname"];
  return $staffname;
}

if (isset($_POST['submit'])) {
  $staff = $_POST["staffs"];
  foreach ($staff as $a) {
    $s = explode("+", $a);
    $sql = mysqli_query($bd, "update courseenrolls set staff = '" . $s[0] . "' where studentRegno = " . $_SESSION["login"] . " and semester = " . $_SESSION["semester"] . " and course = " . $s[1] . " ");
    if ($sql > 0) {
      $_SESSION["msg"] .= $s[0] . " registered. ";
    } else {
      $_SESSION["msg"] .= $s[0] . " not registered. ";
    }
  }
}

$flag = mysqli_num_rows(mysqli_query($bd, "select * from courseenrolls where studentRegno = " . $_SESSION["login"] . " and  semester = " . $_SESSION["semester"] . " and staff <> ' ' ;"));
if ($flag == 0) {
  ?>

  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Non CGPA upload</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <script>
      function staffAvailability(staff, course) {
        $("#loaderIcon").show();
        jQuery.ajax({

          url: "staff_availability.php",
          data: 'sid=' + staff + '&course=' + course,
          type: "POST",
          success: function (data) {
            $("#user-availability-status1").html(data);
            $("#loaderIcon").hide();
          },
          error: function () { }
        });
      }
    </script>
  </head>

  <body>
    <?php include('includes/header.php'); ?>

    <?php if ($_SESSION['login'] != "") {
      include('includes/menubar.php');
    }
    ?>

    <div class="content-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-head-line">Staff Registration </h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                Staff Registration
              </div>
              <font color="green" align="center">
                <?php echo htmlentities($_SESSION['msg']); ?>
                <?php echo htmlentities($_SESSION['msg'] = ""); ?>
              </font>


              <div class="panel-body">
                <form action="staff.php" name="dept" method="post">
                  <div class="form-group">
                    <?php
                    $sql = mysqli_query($bd, "select * from courseenrolls a inner join course b on a.course = b.id where a.studentRegno = " . $_SESSION['login'] . " and a.semester = " . $_SESSION['semester'] . " ");
                    if (mysqli_num_rows($sql) > 0) {
                      while ($row = mysqli_fetch_assoc($sql)) {

                        ?>
                        <label for="Course">
                          <?php echo $row["courseCode"] . ":" . $row["courseName"]; ?>
                        </label>
                        <select class="form-select" name="staffs[]" id="staffs[]"
                          onchange="staffAvailability(this.value, <?php $row['id']; ?>)" required="required">
                          <option value="<?php echo htmlentities($row['staff1'] . "+" . $row["course"]); ?>"><?php echo staff($bd, $row['staff1']); ?></option>
                          <?php
                          if (!empty($row["staff2"])) { ?>
                            <option value="<?php echo htmlentities($row['staff2'] . "+" . $row["course"]); ?>"><?php echo staff($bd, $row['staff2']); ?></option>
                          <?php }
                          if (!empty($row["staff3"])) { ?>
                            <option value="<?php echo htmlentities($row['staff3'] . "+" . $row["course"]); ?>"><?php echo staff($bd, $row['staff3']); ?></option>
                          <?php } ?>
                          <span id="user-availability-status1" style="font-size:12px;">
                        </select>
                      <?php } ?>
                      <span id="user-availability-status1" style="font-size:12px;">
                    </div>

                    <button type="submit" name="submit" id="submit" class="btn btn-default">Submit</button>
                  <?php } else {
                      ?>
                    <div class="panel-body">
                      <div class="form-group">
                        <label>Enroll courses to select staffs</label>
                      </div>
                      <hr />
                    </div>

                    <?php
                    } ?>
                </form>
              </div>
            </div>
          </div>

        </div>

      </div>





    </div>
    </div>



    </div>
    </div>
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>


  </body>

  </html>
<?php } else { ?>
  <html xmlns="http://www.w3.org/1999/xhtml">
  <?php include('includes/footer.php'); ?>
  <script src="assets/js/jquery-1.11.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
  </head>

  <body>
    <i class="bi bi-bell"></i>
    <?php include('includes/header.php'); ?>
    <!-- LOGO HEADER END-->
    <?php if ($_SESSION['login'] != "") {
      include('includes/menubar.php');
    }
    ?>
    <div class="content-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-head-line">Course Enroll </h1>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                Request permission
              </div>
              <?php
              ?>
              <font color="red" align="center">
                <?php echo htmlentities($_SESSION['errmsg']);
                echo htmlentities($_SESSION['errmsg'] = ""); ?>
              </font>
              <font color="green" align="center">
                <?php echo htmlentities($_SESSION['msg']);
                echo htmlentities($_SESSION['msg'] = ""); ?>
              </font>
              <div class="panel-body">
                <div class="form-group">
                  <label>Staffs already selected for this semester</label>
                </div>
                <hr />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

  </html>

<?php } ?>