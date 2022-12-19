<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == "") {
  header('location:index.php');
}

  if (isset($_POST['submit'])) {
    $photo = $_FILES["photo"]["name"];
    move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $_FILES["photo"]["name"]);
    $img = file_get_contents(
      'uploads/' . $photo
    );
    $data = base64_encode($img);
    $ret = mysqli_query($bd, "insert into  noncgpa(name,courseName,type,proof) values ('" . $_SESSION['login'] . "', 'NPTL','T1','$data')");
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

    <?php if ($_SESSION['login'] != "") {
      include('includes/menubar.php');
    }
    ?>

    <div class="content-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-head-line">Certificates</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                My Certificates
              </div>
              <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>
              <form name="dept" method="post" enctype="multipart/form-data">
              <?php $sql1 = mysqli_query($bd, "select * from noncgpa where name= '".$_SESSION['login']."' ");
              while ($row = mysqli_fetch_assoc($sql1)) { ?>

                <div class="panel-body">
                    <div class="form-group">
                      <label for="Pincode"><?php echo $row["title"] ?> Proof</label>
                      <?php if ($row['proof'] == "") { ?>
                        <img src="studentphoto/noimage.png" width="200" height="200"><?php } else { ?>
                        <!-- <img src="data:image/jpeg;base64,<?php echo $row['proof']; ?>" width="200" height="200"> -->
                        <embed src="data:application/pdf;base64,<?php echo $row['proof']; ?>" type="application/pdf"   height="200px" width="500">
                      <?php } ?>
                    </div>
                  <?php } ?>
                  <div class="form-group">
                      <label for="Pincode">Upload New Photo </label>
                      <input type="file" class="form-control" id="photo" name="photo" value="<?php echo htmlentities($row['proof']); ?>" />
                    </div>


                  

                  <button type="submit" name="submit" id="submit" class="btn btn-default">Update</button>
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