<?php

require ("../include/connection.php");
mysql_select_db($dbase2,$con) or die ("Could not connect: ".mysql_error());


	//session_start();	
	
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
		CHANGE PASSWORD
	</div>
    <div align="right" style="margin-right:20px">
    
   </div>
    

	<div  class="banner" style="overflow:scroll; background-color:#090;" align="center">
	 <table align="center" border="0" width="100%" style="" cellspacing="0" cellpadding="0">
              <?php 
			  $pass = mysql_query("SELECT * from khsa.admin limit 1");
			  while($result = mysql_fetch_object($pass)){
			
			  ?>
                 <form name="changepass" method="POST" action="" >
                
				 <tr align="left" height="30px">
					<td style ="padding:2px" height="30px" align="center">
					 <div id="table-row">
					Username:&nbsp;&nbsp; &nbsp;</td></div>
                   <div id="table-row">  <td align="left"><input name="username" value="<?php echo $result->username; ?>"  size="25" />
                     </td >
                     </div>
                   </tr><br/> 
                    
                  	<tr align="left" height="30px">
             		<td style ="padding:2px" height="30px" align="center">
					 <div id="table-row">
					Old Password:</td></div> 
                    <div id="table-row"><td align="left"> <input type="password"  name="oldpass" size="25" />
                     </div>
					</td >
                   </tr><br />
                   	<tr align="left" height="30px">
					<td style ="padding:2px" height="30px" align="center">
					 <div id="table-row">
					New Password: </td></div>
                     <div id="table-row"><td align="left"> <input type="password" name="newpass" size="25" />
                     </div>
					</td >
                    <td><input type="hidden"  value="<?php echo $result->id; ?>"  name="id" /> </td>
                    </tr>   <br />
            		
        </table>
        
        </div>
        </
        
        <div>
	<table align="center">
		<tr>
			<td>
       
			 <input  type="submit" name="change" value="Confirm"  />
           <a href="main.php"> <input  type="submit" name="cancel" value="Back" /></a>
            
   			 </form>
            </td>
            
			
			
		</tr>

		<?php 
						
			if(isset($_POST['change'])){
			
				$id = $_POST['id'];
				$username = $_POST['username'];
				$oldpass = $_POST['oldpass'];
				$newpass = $_POST['newpass'];
				$oldpass = md5($oldpass);
				$newpass = md5($newpass);
				
				
				$sql1 = mysql_query("SELECT * FROM khsa.admin");
				while($result1 = mysql_fetch_object($sql1)){
					if($username == "" or $oldpass == "" or $_POST['newpass'] == ""){
						die ("Don't Leave Empty Field!");
					}else{
			if($result1->username == $username and $result1->password == $oldpass){
				
			$sql = "UPDATE `khsa`.`admin` SET `password` = MD5( '".$_POST['newpass']."' ) WHERE `admin`.`id` = $id ; ";
			$row = mysql_query($sql);
			
				 echo("Password Successfull Changed!");
				 
			}else{
					die ("Error Changing Password"); 
			}
				}
					}
				}
			}
			  
		 
		/* 	
			if(!$row){	
		die ("Error Changing Password!");
		
			}else{
				
			 echo("Password Successfull Changed!");
			} */
				
			
		?>
	</table>
    

    </div>
</body>
</html>
