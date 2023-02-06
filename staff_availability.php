<?php
	session_start();
	require_once("includes/config.php");
	if(strlen($_SESSION['login'])==null){
		header('location:index.php');
	}
	else{
		if(!empty($_POST["course"]) && !empty($_POST["sid"])) {
			$count = 0;
				$cid= $_POST["course"];
				$sid = $_POST["sid"];
				$sql1 = mysqli_num_rows(mysqli_query($bd,"select * from courseenrolls where course = ".$cid." and department = '".$_SESSION["department"]."' and batch = '".$_SESSION["batch"]."' and semester = ".$_SESSION["semester"]." "));
				$sql = mysqli_fetch_assoc(mysqli_query($bd,"select * from course where course = ".$cid." "));
				if($sql["staff1"]!="" && $sql["staff2"]!="" && $sql["staff3"]!=""){
					$count = $sql1/3;
					$count +=5;
				}
				else if($sql["staff1"]!="" && $sql["staff2"]!="" && $sql["staff3"]==""){
					$count = $sql1/2;
					$count +=5;
				}
				else if($sql["staff1"]!="" && $sql["staff2"]=="" && $sql["staff3"]==""){
					$count = $sql1/1;
					$count +=5;
				}
				$sql2 = mysqli_num_rows(mysqli_query($bd, "select * from courseenrolls where course = ".$cid." and staff = '".$sid."' and department = '".$_SESSION["department"]."' and batch = '".$_SESSION["batch"]."' and semester = ".$_SESSION["semester"]." "));
				if($count >= $sql2){
					echo '<script>alert("Staff registration limit is not exceeded.");</script>';
					echo "<script>$('#submit').prop('disabled',false);</script>";
					// echo "<script>$('#submit').prop('disabled',true);</script>";
				}
				else{
					echo '<script>alert("Staff registration limit exceeded. Choose another staff");</script>';
				 	echo "<script>$('#submit').prop('disabled',true);</script>";
				}
				// if($count1>0)
				// {
				// 	echo '<script>alert("Course already registered");</script>';
				// 	echo "<script>$('#submit').prop('disabled',true);</script>";
				// } 
				// else{
				// 	echo "<script>$('#submit').prop('disabled',false);</script>";
				// 	if($count >= $noofseat){
				// 		echo "<script> alert('Seats are full for this course');</script>";
				// 		echo "<script>$('#submit').prop('disabled',true);</script>";
				// 	}
				// 	else{
				// 		echo "<script>$('#submit').prop('disabled',false);</script>";
				// 	}
				// }
		}
	}
?>
