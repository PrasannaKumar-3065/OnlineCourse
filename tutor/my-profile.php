<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['tlogin']) == "") {
  header('location:index.php');
}

  if (isset($_POST['submit'])) {
    $photo = $_FILES["photo"]["name"];
    move_uploaded_file($_FILES["photo"]["tmp_name"], "tutorphoto/" . $_FILES["photo"]["name"]);
    $img = file_get_contents(
      'tutorphoto/' . $photo
    );
    $data = base64_encode($img);
    $ret = mysqli_query($bd, "update tutors set image ='$data'  where username='" . $_SESSION['tlogin'] . "'");
    if ($ret) {
      
      $_SESSION['msg'] = "Tutor Record updated Successfully !!";
    } else {
      $_SESSION['msg'] = "Error : Tutor Record not update";
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
    <title>Tutor Profile</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
  </head>

  <body>
    <?php include('includes/header.php'); ?>

    <?php if ($_SESSION['tlogin'] != "") {
      include('includes/menubar.php');
    }
    ?>

    <div class="content-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-head-line">My Profile</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                My Profile
              </div>
              <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>
              <?php $sql1 = mysqli_query($bd, "select * from tutors where username= '".$_SESSION['tlogin']."' ");
              if ($row = mysqli_fetch_assoc($sql1)) {?>

                <div class="panel-body">
                  <form name="dept" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="studentname">Username</label>
                      <input type="text" class="form-control" id="studentname" name="studentname" value="<?php echo htmlentities($row['username']); ?>" readonly />
                    </div>

                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="studentregno" name="studentregno" value="<?php echo htmlentities($row['tutorname']); ?>"  readonly />

                    </div>

                    <div class="form-group">
                      <label for="role">Role</label>
                      <input type="text" class="form-control" id="role" name="role" value="<?php echo htmlentities($row['role']); ?>"  readonly />

                    </div>

                    
                    <div class="form-group">
                      <label for="department">Department</label>
                      <input type="text" class="form-control" id="department" name="department" value="<?php echo htmlentities($row['department']); ?>"  readonly />

                    </div>

                    <div class="form-group">
                      <label for="Pincode">Tutor Photo</label>
                      <?php if ($row['image'] == "") { ?>
                        <img src="studentphoto/noimage.png" width="200" height="200"><?php } else { ?>
                        <img src="data:image/jpeg;base64,<?php echo $row['image']; ?>" width="200" height="200">
                        <!-- <embed src="data:application/pdf;base64,<?php echo $row['image']; ?>" type="application/pdf"   height="700px" width="500"> -->
                      <?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="Pincode">Upload New Photo </label>
                      <input type="file" class="form-control" id="photo" name="photo" value="<?php echo htmlentities($row['image']); ?>" />
                    </div>


                  

                  <button type="submit" name="submit" id="submit" class="btn btn-default">Update</button>
                  <?php } ?>
              </form>
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