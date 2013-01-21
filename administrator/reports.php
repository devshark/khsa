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
		PRINT REPORTS
	</div>
    <div align="right" style="margin-right:20px">
    
   </div>
    

	<div  class="banner" style="overflow:scroll; background-color:#090;" align="center">
	 <table align="center" border="0" width="100%" style="" cellspacing="0" cellpadding="0">
                          
				 <tr align="left" height="30px">
					<td style ="padding:2px" height="30px" align="center">
					 <div id="table-row">
					Candidate List</td></div>
                   <div id="table-row">  <td align="left"><a href="printcandidate.php" title="candidates list"><input type="Button" name="candidate"  value="Print Report" size="25" /></a>
                     </td >
                     </div>
                   </tr><br/> 
                    <tr align="left" height="30px">
					<td style ="padding:2px" height="30px" align="center">
					 <div id="table-row">
					Students List</td></div>
                     <div id="table-row"><td align="left"> <a href="printtotalstudents.php" title="tally sheet"><input type="Button" name="tallysheet" value="Print Report" size="25" /></a>
                     </div>
					</td >
                 
                    </tr> 
                  	<tr align="left" height="30px">
             		<td style ="padding:2px" height="30px" align="center">
					 <div id="table-row">
					Voters List</td></div> 
                    <div id="table-row"><td align="left"> <a href="printvoters.php" title="voters list"><input type="Button" name="voters" value="Print Report" size="25" /></a>
                    </div>
					</td >
                   </tr><br />
                   <tr align="left" height="30px">
             		<td style ="padding:2px" height="30px" align="center">
					 <div id="table-row">
					Students not voted List</td></div> 
                    <div id="table-row"><td align="left"> <a href="notvote.php" title="voters list"><input type="Button" name="notvoters" value="Print Report" size="25" /></a>
                    </div>
					</td >
                   </tr>
                   	<tr align="left" height="30px">
					<td style ="padding:2px" height="30px" align="center">
					 <div id="table-row">
					Party List</td></div>
                     <div id="table-row"><td align="left"> <a href="printpartylist.php" title="party list"><input type="Button" name="pasrtylist"  value="Print Report"size="25" /></a>
                     </div>
					</td >
                   <tr align="left" height="30px">
					<td style ="padding:2px" height="30px" align="center">
					 <div id="table-row">
					Tally Sheet</td></div>
                     <div id="table-row"><td align="left"> <a href="tallysheet.php" title="tally sheet"><input type="Button" name="tallysheet" value="Print Report" size="25" /></a>
                     </div>
					</td >
                 
                    </tr>   
                    <tr align="left" height="30px">
					<td style ="padding:2px" height="30px" align="center">
					 <div id="table-row">
					Summary Report</td></div>
                     <div id="table-row"><td align="left"> <a href="printsummary.php" title="tally sheet"><input type="Button" name="tallysheet" value="Print Report" size="25" /></a>
                     </div>
					</td >
                 
                    </tr>  
            		
        </table>
        
        </div>
     
     
</body>
</html>
