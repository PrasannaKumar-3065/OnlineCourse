<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql = mysqli_query($bd, "select * from tutors where id = " . $id . " ");
        if ($rows = mysqli_fetch_assoc($sql)) {
            $_SESSION["temp"] = $rows["username"];
        }
    }

    if (isset($_POST["submit"])) {
        $roll1 = $_POST["num1"];
        $roll2 = $_POST["num2"];
        $sql = mysqli_query($bd, "update students set tutorname='".$_SESSION["temp"]."' where StudentRegno between ".$roll1." and ".$roll2.";");
        if ($sql) {
            $_SESSION["delmsg"] = "Tutor assigned for students from " . $roll1 . " to " . $roll2;
        } else {
            $_SESSION["delmsg"] = "Tutor assigned failed";
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
        <title>Admin | Tutors</title>
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
                        <h1 class="page-head-line">Course Enroll </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Course Enroll
                            </div>
                            <font color="green" align="center"><?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?></font>
                            <div class="panel-body">
                                <form action="assign.php" method="POST">
                                    <div class="form-group">
                                        <label for="studentregno">Tutor Name</label>
                                        <input type="text" class="form-control" id="studentregno" name="studentregno" value="<?php echo $_SESSION["temp"]; ?>" readonly />
                                    </div>

                                    <div class="form-group">
                                        <label for="studentregno">from rollno</label>
                                        <input type="text" class="form-control" id="num1" name="num1" />
                                    </div>

                                    <div class="form-group">
                                        <label for="studentregno">to rollno</label>
                                        <input type="text" class="form-control" id="num2" name="num2" />
                                    </div>
                                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Assign</button>
                                    <button class="btn btn-danger" onclick="redirect()">Cancel</button>
                                </form>

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
<?php } ?>