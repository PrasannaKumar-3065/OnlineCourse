<?php
include("includes/config.php");
error_reporting(0);
?>
<?php if($_SESSION['tlogin']!="")
{?>
<header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <strong>Welcome: </strong><?php echo htmlentities($_SESSION['tname']);?>
                    &nbsp;&nbsp;



                    <strong>Last Login:<?php
        $ret=mysqli_query($bd, "SELECT  * from tutorlog where username='".$_SESSION['tlogin']."' order by id desc limit 1,1");
                    $row=mysqli_fetch_array($ret);
                    echo $row['userip']; ?> at <?php echo $row['loginTime'];?></strong>
                </div>

            </div>
        </div>
    </header>
    <?php } ?>

    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
			
			
                <a class="navbar-brand" href="#" style="color:#fff; font-size:30px;8px; line-height:24px; ">
		
                  NATIONAL ENGINEERING COLLEGE
                </a>

            </div>
		
		
            <div class="left-div">
                <img src="nec.png" style:"display:none; height=80px; width=80px;">
		
        </div>


		
            </div>
        </div>
