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
                 <form name="addfrm" method="POST" action="" >
                
				 <tr align="left" height="30px">
					<td style ="padding:2px" colspan="2" height="30px">
					 <div id="table-row">
					Partylist ID:&nbsp;&nbsp; <input name="partylist_id" readonly size="20" />
                     
					</td >
                    <td style ="padding:2px" colspan="2" height="30px">
					 <div id="table-row">
					Partlist Description:&nbsp;&nbsp; <input type="text" name="partylist_desc" size="25" />
                     
					</td ><br />
                   
                   	<tr align="left" height="30px">
					<td style ="padding:2px" colspan="2" height="30px">
					 <div id="table-row">
					Partylist Name: <input type="text" name="partylist_name" size="20" />
                     
					</td ><br />
                    </tr>   
                
        </table>
        
        </div>
        
        <div>
	<table align="center">
		<tr>
			<td>
       
			 <input  type="submit" name="add" value="Add"  />
             <input type="submit" name="delete" value="Delete All" />
             <a href="partylist.php"> <input  type="submit" name="cancel" value="Back" /></a>
            
   			 </form>
            </td>
            
			
			
		</tr>
        <?php 
						
			if(isset($_POST['delete'])){
				$delete1 = "TRUNCATE TABLE evoting.party_list";
				
				$deleteall = mysql_query($delete1); 
				
				if($deleteall) {
					echo ("Delete Successful!");
				}else{
					die ("Error Deleting Records!");
				}
			}
			
				?>
		
		<?php 
						
			if(isset($_POST['add'])){
			$p_name = $_POST['partylist_name'];
			
			if($p_name != "") {
				
						$sql = "INSERT INTO evoting.party_list (partylist_id, partylist_name, partylist_desc)   VALUES('', '" . $_POST['partylist_name']. "', '" . $_POST['partylist_desc']. "') ";
				
			$row = mysql_query($sql);
			
		echo ("New Partylist Successfully Added!");
		
			}else{
				
			die ("Error Adding Partylist!")	;
			}
				}
		?>
	</table>
    

    </div>
</body>
</html>
