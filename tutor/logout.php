<?php
session_start();
include("includes/config.php");
$_SESSION['tlogin']=="";
date_default_timezone_set('Asia/Kolkata');
$ldate=date( 'd-m-Y h:i:s A', time () );
mysqli_query($bd, "UPDATE tutorlog  SET logout = '$ldate' WHERE username = '".$_SESSION['tlogin']."' ORDER BY id DESC LIMIT 1");
session_unset();
$_SESSION['errmsg']="You have successfully logout";
?>
<script language="javascript">
document.location="index.php";
</script>
