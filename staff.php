<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == "") {
  header('location:index.php');
}

if (isset($_POST['submit'])) {
}
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
            <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>


            <div class="panel-body">
              <form name="dept" method="post">
                <div class="form-group">
                    <?php
                    $sql = mysqli_query($bd, "select * from courseenrolls a inner join course b on a.course = b.id where a.studentRegno = " . $_SESSION['login'] . " and a.semester = ". $_SESSION['semester'] ." ");
                    // echo mysqli_num_rows($sql);
                    while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                  <label for="Course"><?php echo $row["courseCode"] .":". $row["courseName"] ; ?></label>
                  <select class="form-select" name="staffs[]" id="staffs[]" required="required">
                      <option value="<?php echo htmlentities($row['staff1']); ?>"><?php echo htmlentities($row['staff1']); ?></option>
                      <?php 
                        if(!empty($row["staff2"])){ ?>
                          <option  value="<?php echo htmlentities($row['staff2']); ?>"><?php echo htmlentities($row['staff2']); ?></option>
                        <?php }
                        if(!empty($row["staff3"])){ ?>
                          <option value="<?php echo htmlentities($row['staff3']); ?>"><?php echo htmlentities($row['staff3']); ?></option>
                      <?php } ?>
                  </select>
                  <?php } ?>
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



  </div>
  </div>
  <?php include('includes/footer.php'); ?>
  <script src="assets/js/jquery-1.11.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>


</body>

</html>