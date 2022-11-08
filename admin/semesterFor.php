<?php
session_start();
error_reporting(1);
include("includes/config.php");
if(isset($_POST['submit']))
{
    $batch = $_POST["batch"];
    if($batch != null){
        $query=mysqli_query($bd, "update students set semester = semester+1 where batch = '".$batch."' ");
        if($query != 0){
            $_SESSION['msg'] = "Semester moved up sucessfully";
        }
    }
    else{
        $_SESSION["msg"] = "invalid or empty batch!";
    }
}
if(isset($_POST['submit2']))
{
    $batch = $_POST["batch"];
    if($batch != null){
        $query=mysqli_query($bd, "update students set semester = semester-1 where batch = '".$batch."' ");
        if($query != 0){
            $_SESSION['msg'] = "Semester moved down sucessfully";
        }
    }
    else{
        $_SESSION["msg"] = "invalid or empty batch!";
    }
}

if(isset($_POST['submit1']))
{
    header("change-password.php");
}
if(isset($_POST['submit3']))
{
    header("change-password.php");
}
?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>student verification</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <?php include('includes/header.php');?>

    <?php include('includes/menubar.php');?>

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">Student Reg no. Verification</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Semester Edit
                        </div>
                        <font color="red" align="center">
                            <?php echo htmlentities($_SESSION['errmsg']); echo htmlentities($_SESSION['msg']);  echo htmlentities($_SESSION['msg']=""); echo htmlentities($_SESSION['errmsg']="");?>
                        </font>


                        <div class="panel-body">
                            <form action="semesterFor.php" method="post">

                                <div class="form-group">
                                    <label>Enter batch</label>
                                    <input type="text" class="form-control" id="batch" name="batch"
                                        value="<?php echo htmlentities($row['studentName']); ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Confirm move up semester?</label>
                                </div>
                                <button type="submit" name="submit" class="btn btn-default">Confirm</button>
                                <button type="submit" name="submit1" class="btn btn-default">Cancel</button>
                                <hr />
                                <div class="form-group">
                                    <label>Confirm move down semester?</label>
                                </div>
                                <button type="submit" name="submit2" class="btn btn-default">Confirm</button>
                                <button type="submit" name="submit3" class="btn btn-default">Cancel</button>
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