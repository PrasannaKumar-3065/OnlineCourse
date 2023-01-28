<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {



    if (isset($_GET['del'])) {
        mysqli_query($bd, "delete from tutors where id = " . $_GET['id'] . " ");
        $_SESSION['delmsg'] = "tutor record deleted !!";
    }

    if (isset($_GET['pass'])) {
        $password = "12345";
        $newpass = md5($password);
        mysqli_query($bd, "update tutors set password='" . $newpass . "' where id = " . $_GET['id'] . " ");
        $_SESSION['delmsg'] = "Password Reset. New Password is 12345";
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Staff Creation</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
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
                    <h1 class="page-head-line">Staffs </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Staff
                        </div>

                        <div class="panel-body">
                            <form class="" action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="coursefile">Excel File Import: </label>
                                    <input type="file" value="" name="excel" /><br>
                                    <button name="import" type="submit" class="btn btn-primary mt-3">Import</button>
                                    <a href="tutor.php">Add individually</a>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <font color="red" align="center">
                    <?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
                </font>
                <div class="col-md-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Staffs
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Staff Name </th>
                                            <th>Department </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = mysqli_query($bd, "select * from tutors");
                                            $cnt = 1;
                                            while ($row = mysqli_fetch_array($sql)) {
                                            ?>


                                        <tr>
                                            <td><?php echo htmlentities($row['id']); ?></td>
                                            <td><?php echo htmlentities($row['tutorname']); ?></td>
                                            <td><?php echo htmlentities($row['department']); ?></td>
                                            <td>
                                                <a href="asstdeptbat.php?id=<?php echo $row['id'] ?>&del=delete"
                                                    onClick="return confirm('Are you sure you want to delete?')">
                                                    <button class="btn btn-danger">Delete</button>
                                                </a>
                                                <a href="assign.php?id=<?php echo $row['id'] ?>">
                                                    <button class="btn btn-primary">Assign students</button>
                                                </a>
                                                <a href="asstdeptbat.php?id=<?php echo $row['id'] ?>&pass=update"
                                                    onClick="return confirm('Are you sure you want to reset password?')">
                                                    <button type="submit" name="submit" id="submit"
                                                        class="btn btn-default">Reset Password</button>
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

                </div>
            </div>





        </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <script src="assets/js/jquery-1.11.1.js"></script>

    <script src="assets/js/bootstrap.js"></script>
</body>

</html>

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


            $tutorname = $row[0];
            $tutor = $row[1];
            $type = $row[2];
            $department = $row[3];
            $semester = $row[4];
            $credit = $row[5];
            $noofSeats = $row[6];
            $regulation = $row[7];
            mysqli_query($bd, "INSERT INTO tutors() VALUES()");
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


<?php } ?>