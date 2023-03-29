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
            $_SESSION["cit"] = $rows["role"];
        }
    }


    if (isset($_POST["submit"])) {
        $roll1 = $_POST["role"];
       
            $sql = mysqli_query($bd, "update tutors set role= '$roll1'  where username='".$_SESSION["temp"]."' ");
            if ($sql) {
                $_SESSION["delmsg"] = "Role updated successfully";
            }else {
                $_SESSION["delmsg"] = "Role updation failed";
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
                        <h1 class="page-head-line">Staff Role Updation </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Update Role
                            </div>
                            <font color="green" align="center"><?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?></font>
                            <div class="panel-body">
                                <form action="updaterole.php" method="POST">
                                    <div class="form-group">
                                        <label for="studentregno">Tutor Name</label>
                                        <input type="text" class="form-control" id="studentregno" name="studentregno" value="<?php echo $_SESSION["temp"]; ?>" readonly />
                                    </div>

                                    <div class="form-group">
    <label for="role">Role  </label>
    <select  class="form-control" id="role" name="role" placeholder="Role of the staff" required >
    <option value="Tutor"> Tutor </option>
      <option value="CI"> Class Incharge </option>
      <option value="HOD"> HOD </option>
    </select>
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