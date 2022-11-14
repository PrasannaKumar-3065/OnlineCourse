<?php 
require_once("includes/config.php");
if(isset($_GET["tut"])) {
	$tut= $_GET["tut"];
	
		$result =mysqli_query($bd,"SELECT username FROM tutors where username='".$tut."' ");
		$count=mysqli_num_rows($result);
if($count>0)
{
echo "<span style='color:red'> tutor with this username Already Registered.</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	

}
}


?>
