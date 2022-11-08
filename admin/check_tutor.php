<?php 
require_once("includes/config.php");
if(!empty($_POST["tut"])) {
	$tut= $_POST["tut"];
	
		$result =mysqli_query($bd, "SELECT username FROM tutors where username='$tut' ");
		$count=mysqli_num_rows($result);
if($count>0)
{
echo "<span style='color:red'> tutor with this username Already Registered.</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	

}
}


?>
