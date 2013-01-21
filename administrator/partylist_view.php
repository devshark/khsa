<?php

require ("../include/connection.php");
mysql_select_db($dbase2,$con) or die ("Could not connect: ".mysql_error());


session_start();	
	
	$header = ("../images/banner.png"); //insert path here for banner ex. "images/apache.png"
	
	if(!isset($_SESSION['userid'])){
		header("location:index.php");
		
	}
	
	$login_time = $_SESSION['time-in']; //this is user logged in time in your site
	$timeoutseconds = 60 * 60; // this is particular user session time 15 mins into secs
	$timestamp = time(); // present your systemtime in seconds
	$timeout = $timestamp - $timeoutseconds;
	
	if($login_time < $timeout){
?>
		<script language="javascript">
			alert("Your session has timeout! You're automatically log-out!");
			document.location.href = "<?php echo "logout.php";?>";
		</script>
<?php 
	}else{
		$_SESSION['time-in'] = time();
	}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/adminstyle.css" type="text/css" rel="stylesheet" />
<title><?php echo $title ?></title>


</head>

<body class="body">




<div align="center" style="background-color:#090; border:#060 solid; width:600px;">
	<div id="home_title" align="left">
		ADD PARTYLIST
	</div>
    <div align="right" style="margin-right:20px">
    
   </div>
    

	<div  class="banner" style="overflow:scroll; background-color:#090;" align="center">
	 <table align="center" border="0" width="100%" style="" cellspacing="0" cellpadding="0">
                                 
					<tr align="center">
					<td >
						<div id="table-header-title">
							Number
						</div>
					</td> 
					<td>
						<div id="table-header-title">
							Name
						</div>
					</td>
                    <td style="width:inherit">
						<div id="table-header-title">
							Description
						</div>
					</td>
                    	<?php
				
					$party = mysql_query("SELECT * from evoting.party_list order by partylist_id asc");
										
					while($result = mysql_fetch_object($party)){	
					
				?> 
                <tr align="center" style="background:#FFFFFF;" >				
					<td style="border:#000 .5px solid">
                        
						<?php echo $result->partylist_id;?>
					</td>
					<td style ="border:#000 .5px solid">
						<?php echo $result->partylist_name;?>
					</td >
                    <td style="border:#000 .5px solid">
						<?php echo $result->partylist_desc;?>
					</td>
                    <?php } ?>
                    </tr>
        </table>
        
        </div>
        
        <div>
	<table align="center">
		<tr>
			<td>
       
			<a href="partylistadd.php" > <input  type="submit" name="add" value="Add/Delete"  onclick=""/></a>
             <a href="main.php"> <input  type="submit" name="cancel" value="Cancel" /></a>
            
   			</td>
    
    </tr>
    </table>
   

    </div>
</body>
</html>
