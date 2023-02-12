<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {

  if (isset($_POST['submit'])) {

    $ref = mysqli_query($bd, "SELECT count(*) as allcount FROM course where courseName='" . $_POST['coursename'] . "' && courseCode='" . $_POST['coursecode'] . "' && semester='" . $_POST['semester'] . "' && department='" . $_POST['department'] . "' && regulation='" . $_POST['regulation'] . "' && credit='" . $_POST['credit'] . "' && type='" . $_POST['type'] . "' && batch ='" . $_POST['batch'] . "' ");
    $col = mysqli_fetch_array($ref);
    $allcount = $col['allcount'];
    if ($allcount == 0) {
      $coursecode = $_POST['coursecode'];
      $coursename = $_POST['coursename'];
      $department = $_POST['department'];
      $type = $_POST['type'];
      $semester = $_POST['semester'];
      $credit = $_POST['credit'];
      $seatlimit = $_POST['seatlimit'];
      $regulation = $_POST['regulation'];
      $batch = $_POST['batch'];
      $staff1 = $_POST['staff1'];
      $staff2 = $_POST['staff2'];
      $staff3 = $_POST['staff3'];
      $ret = mysqli_query($bd, "insert into course(courseCode,courseName,type,department,batch,semester,staff1,staff2,staff3,credit,noofSeats,regulation) values('$coursecode','$coursename','$type','$department','$batch','$semester','$staff1','$staff2','$staff3','$credit','$seatlimit','$regulation')");
      if ($ret) {
        $_SESSION['msg'] = "Course Created Successfully !!";
      } else {
        $_SESSION['msg'] = "Error : Course not created";
      }
    } else {
      $_SESSION['msg'] = "This course was already created. please enter another course.";
    }
  }
  if (isset($_GET['del'])) {
    mysqli_query($bd, "delete from course where id = '" . $_GET['id'] . "'");
    $_SESSION['delmsg'] = "Course deleted !!";
  }


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Course</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/js/autocomplete.js" rel="script" />
</head>

<body>
    <?php include('includes/header.php'); ?>

    <?php if ($_SESSION['alogin'] != "") {
      include('includes/menubar.php');
    }
    ?>

    <div class="content-wrapper">
        <div class="container">
            <div class="row">


                <div class="col-md-12">
                    <h1 class="page-head-line">Course </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">

                    <?php
            if (isset($_SESSION['message'])) {
              echo "<h4>" . $_SESSION['message'] . "</h4>";
              unset($_SESSION['message']);
            }
            ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Course
                        </div>
                        <font color="green" align="center">
                            <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
                        </font>


                        <div class="panel-body">
                            <form name="dept" method="post">
                                <div class="form-group">
                                    <label for="coursecode">Course Code </label>
                                    <input type="text" class="form-control" id="coursecode" name="coursecode"
                                        placeholder="Course Code" required />
                                </div>

                                <div class="form-group">
                                    <label for="coursename">Course Name </label>
                                    <input type="text" class="form-control" id="coursename" name="coursename"
                                        placeholder="Course Name" required />
                                </div>

                                <div class="form-group">
                                    <label for="Type">Type </label>
                                    <input type="text" class="form-control" id="type" name="type"
                                        placeholder="Type of Course" required />
                                </div>

                                <div class="form-group">
                                    <label for="department">Department Name </label>
                                    <input type="text" class="form-control" id="department" name="department"
                                        placeholder="Department Name" required />
                                </div>

                                <div class="form-group">
                                    <label for="batch">Batch </label>
                                    <input type="text" class="form-control" id="batch" name="batch" placeholder="batch"
                                        required />
                                </div>

                                <div class="form-group">
                                    <label for="semester">Semester </label>
                                    <input type="text" class="form-control" id="semester" name="semester"
                                        placeholder="Semester" required />
                                </div>

                                <div class="form-group">
                                    <label for="credit">Credit </label>
                                    <input type="number" class="form-control" id="credit" name="credit"
                                        placeholder="Credit Value" required />
                                </div>

                                <div class="form-group">
                                    <label for="seatlimit">Seat limit </label>
                                    <input type="number" class="form-control" id="seatlimit" name="seatlimit"
                                        placeholder="Seat limit" required />
                                </div>

                                <div class="form-group">
                                    <label for="regulation">Regulation </label>
                                    <input type="text" class="form-control" id="regulation" name="regulation"
                                        placeholder="regulation" required />
                                </div>

                                <div class="form-group">
                                    <label for="staff1">Staff 1 </label>
                                    <input type="text" class="form-control" id="staff1" name="staff1" onBlur="staff_1()"
                                        placeholder="staff 1" required />
                                    <span id="user-availability-status1" style="font-size:12px;">
                                </div>

                                <div class="form-group">
                                    <label for="staff2">Staff 2 </label>
                                    <input type="text" class="form-control" id="staff2" name="staff2" onBlur="staff_2()"
                                        placeholder="staff 2" />
                                    <span id="user-availability-status1" style="font-size:12px;">
                                </div>

                                <div class="form-group">
                                    <label for="staff3">Staff 3 </label>
                                    <input type="text" class="form-control" id="staff3" name="staff3" onBlur="staff_3()"
                                        placeholder="staff 3" />
                                    <span id="user-availability-status1" style="font-size:12px;">
                                </div>

                                <button type="submit" name="submit" class="btn btn-default">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Course File
                        </div>

                        <div class="panel-body">
                            <form class="" action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="coursefile">Excel File Import: </label>
                                    <input type="file" value="" name="excel" /><br>
                                    <button name="import" type="submit" class="btn btn-primary mt-3">Import</button>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>


            <font color="red" align="center">
                <?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
            </font>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manage Course
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive table-bordered">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Course Code</th>
                                        <th>Course Name </th>
                                        <th>Type</th>
                                        <th>Department Name</th>
                                        <th>Semester</th>
                                        <th>Credit</th>
                                        <th>Seat limit</th>
                                        <th>Regulation</th>
                                        <th>Batch</th>
                                        <th>Staff1</th>
                                        <th>Staff2</th>
                                        <th>Staff3</th>
                                        <th>Creation Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                    $sql = mysqli_query($bd, "select * from course order by semester");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($sql)) {
                    ?>


                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo htmlentities($row['courseCode']); ?></td>
                                        <td><?php echo htmlentities($row['courseName']); ?></td>
                                        <td><?php echo htmlentities($row['type']); ?></td>
                                        <td><?php echo htmlentities($row['department']); ?></td>
                                        <td><?php echo htmlentities($row['semester']); ?></td>
                                        <td><?php echo htmlentities($row['credit']); ?></td>
                                        <td><?php echo htmlentities($row['noofSeats']); ?></td>
                                        <td><?php echo htmlentities($row['regulation']); ?></td>
                                        <td><?php echo htmlentities($row['batch']); ?></td>
                                        <td><?php echo htmlentities($row['staff1']); ?></td>
                                        <td><?php echo htmlentities($row['staff2']); ?></td>
                                        <td><?php echo htmlentities($row['staff3']); ?></td>
                                        <td><?php echo htmlentities($row['creationDate']); ?></td>
                                        <td>
                                            <a href="edit-course.php?id=<?php echo $row['id'] ?>">
                                                <button class="btn btn-primary"><i class="fa fa-edit "></i>
                                                    Edit</button> </a>
                                            <a href="cccourse.php?id=<?php echo $row['id'] ?>&del=delete"
                                                onClick="return confirm('Are you sure you want to delete?')">
                                                <button class="btn btn-danger">Delete</button>
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

                <?php
          if (isset($_POST["import"])) {

            $fileName = $_FILES["excel"]["name"];
            $fileExtension = explode('.', $fileName);
            $fileExtension = strtolower(end($fileExtension));
            $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

            $targetDirectory = "uploads/" . $newFileName;
            move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

            error_reporting(0);
            ini_set('display_errors', 0);

            require 'excelReader/excel_reader2.php';
            require 'excelReader/SpreadsheetReader.php';

            $reader = new SpreadsheetReader($targetDirectory);
            foreach ($reader as $key => $row) {


              $courseCode = $row[0];
              $courseName = $row[1];
              $type = $row[2];
              $department = $row[3];
              $batch = $row[4];
              $semester = $row[5];
              $credit = $row[6];
              $noofSeats = $row[7];
              $regulation = $row[8];
              $staff1 = $row[9];
              $staff2 = $row[10];
              $staff3 = $row[11];
              mysqli_query($bd, "INSERT INTO course(id,courseCode,courseName,type,department,batch,semester,credit,noofSeats,regulation,staff1,staff2,staff3) VALUES('', '$courseCode','$courseName','$type','$department','$batch', '$semester','$credit','$noofSeats','$regulation','$staff1','$staff2','$staff3')");
            }

            echo
            "
			<script>
			alert('Succesfully Imported');
			document.location.href = '';
			</script>
			";
          }
          ?>
            </div>
        </div>





    </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <script src="assets/js/jquery-1.11.1.js"></script>

    <script src="assets/js/bootstrap.js"></script>


</body>
<script>
function staff_1() {
    $("#loaderIcon").show();
    jQuery.ajax({
        url: "check_staff.php",
        data: 'tut=' + $("#staff1").val(),
        type: "POST",
        success: function(data) {
            $("#user-availability-status1").html(data);
            $("#loaderIcon").hide();
        },
        error: function() {}
    });
}

function staff_2() {
    $("#loaderIcon").show();
    jQuery.ajax({
        url: "check_staff.php",
        data: 'tut=' + $("#staff2").val(),
        type: "POST",
        success: function(data) {
            $("#user-availability-status1").html(data);
            $("#loaderIcon").hide();
        },
        error: function() {}
    });
}

function staff_3() {
    $("#loaderIcon").show();
    jQuery.ajax({
        url: "check_staff.php",
        data: 'tut=' + $("#staff3").val(),
        type: "POST",
        success: function(data) {
            $("#user-availability-status1").html(data);
            $("#loaderIcon").hide();
        },
        error: function() {}
    });
}
</script>

</html>
<?php } ?>