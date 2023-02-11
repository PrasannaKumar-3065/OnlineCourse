<?php
include("includes/config.php");
$sql = mysqli_query($bd, "Select * from course where department = '".$_POST["dept"]."' and semester = ".$_POST["semester"]." ");
    $sql1 = mysqli_query($bd, "select * from students where department = '".$_POST["dept"]."' and batch = '".$_POST["batch"]."' ");
    $courses = array();
    function result($name,$value,$bd)
    {
        $sql1 = mysqli_query($bd,"Select * from courseenrolls where studentRegno=".$name." and course=".$value." ");
        if(mysqli_num_rows($sql1) > 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    function staffid($bd,$id){
        $cc = mysqli_fetch_assoc(mysqli_query($bd, "select * from tutors where username = '".$id."' "));
        return $cc["tutorname"];
    }
?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Enroll History</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
<?php include('includes/header.php');?>    
<?php include('includes/menubar.php');?>

<?php if($_SESSION['alogin']!="")
{
 include('includes/menubar.php');
}
 ?>
<script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/table2excel.js"></script>
    <script src="assets/js/bootstrap.js"></script>
<div class="panel-body">    
    <div class="table-responsive table-bordered">
        <table class="table" id="enrolltable" style="border: 1px solid black;">
            <thead>
                <th style="border: 1px solid black; width: 210px;">Student</th>
                <?php while ($rows  = mysqli_fetch_assoc($sql)) { array_push($courses,$rows["id"])?>
                    <th style="border: 1px solid black; width:116px;"><?php echo $rows["courseName"]; ?></th>
                <?php } ?>
            </thead>
            <tbody>

                <?php while ($rows1 = mysqli_fetch_assoc($sql1)) { ?>
                    <tr>
                        <td style="border: 1px solid black;"><?php echo $rows1["studentName"]; ?></td>
                        <?php for ($var = 0; $var < sizeof($courses); $var++){ 
                            if(result($rows1["StudentRegno"],$courses[$var],$bd) == 1){  ?>
                            <td style="border: 1px solid black; text-align: center;">&#10003</td>
                            <?php }else{?><td style="border: 1px solid black;"></td><?php }} ?>
                    </tr>
                <?php } ?>
                <tr>
                        <td>Staffs</td>
                        <?php for ($var = 0; $var < sizeof($courses); $var++){
                            $sta = mysqli_fetch_assoc(mysqli_query($bd,"Select * from course where id = ".$courses[$var].";"));
                            ?>
                            <script>console.log('<?php echo $courses[$var]; ?>');</script>
                            <td style="border: 1px solid black; text-align: left;"><?php echo staffid($bd,$sta["staff1"]); ?>&#10;<?php echo staffid($bd,$sta["staff2"]); ?>&#10;<?php echo staffid($bd,$sta["staff3"]);?>&#10;</td><?php } ?> 
                </tr>
                        
                </tr>
            </tbody>
        </table>
       <center><button type="submit" id="downloadexcel" name="export" class="tbn btn-primary" value="Export to Excel">Export to excel</button></center>
    </div>
</div>

<script>
    document.getElementById('downloadexcel').addEventListener('click', function() {
           var table2excel = new Table2Excel();	
	   table2excel.export(document.querySelectorAll('#enrolltable'));
	});
</script>
</body>