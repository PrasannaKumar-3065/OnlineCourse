<?php
include("includes/config.php");
$sql = mysqli_query($bd, "Select * from course where semester = 6 ");
$sql1 = mysqli_query($bd, "select * from students where semester = 6");
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
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Enroll History</title>
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<link href="assets/css/style.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<div class="panel-body">
    <div class="table-responsive table-bordered">
        <table style="border: 1px solid black;">
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
                            <td style="border: 1px solid black; text-align: center;"><i class="material-icons">done</i></td>
                            <?php }else{?><td style="border: 1px solid black;"></td><?php }} ?>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>