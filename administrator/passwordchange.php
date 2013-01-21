<?php 
	session_start();	
	require ('../include/connection.php');
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

<?php if(!isset($_post['log-in'])){
$user = $_SESSION['name'];
$admin_query = mysql_query("select * from admin WHERE id = $_SESSION[userid]");
$admin = mysql_fetch_object($admin_query);			
$_SESSION['name'] = $admin->name;		 
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title ?></title>
<link href="../css/adminstyle.css"  rel= "stylesheet" type="text/css" />
</head>
	
<body class="body">
<center>
	<div class="wrapper" align="center">
		<table class="header" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<?php if($header != ""){?>
							<img class="header_image" src="<?php echo $header; ?>" />
					<?php }else{?>
						<font class="header_font">KING HENRY SECURITY AGENCY, INC.</font><br />
						<font style="color:#000; font-size:14px;">INTEGRATED INFORMATION SYSTEM</font>
					<?php }?>
				</td>
			</tr>
		</table>
		<div class="top_nav_wrapper" align="center">
		<table class="top_nav" cellspacing="0" cellpadding="0">
			<tr>
				<td nowrap="nowrap">
                
					<?php if(@$home == "Home"){?>
					<a href="main.php" id="top_nav-link" title="Home">
						&nbsp;&nbsp;Home&nbsp;&nbsp;
						</a>
				 <?php }else{?>
                 	<a href="main.php" title="Home">
							&nbsp;&nbsp;Home&nbsp;&nbsp;
						</a>   
						
					<?php } ?>
                    
                    <font class="slash">|</font>
					<?php if(@$home == "Security Guards"){?>
						<a href="sec_guards.php" id="top_nav-link" title="Security Guards">
							&nbsp;&nbsp;Security Guards&nbsp;&nbsp;
						</a>
					<?php }else{?>
						<a href="sec_guards.php" title="Security Guards">
							&nbsp;&nbsp;Security Guards&nbsp;&nbsp;
						</a>                        
                        <?php }?>	
				
                     <font class="slash">|</font>
					<?php if(@$home == "Requirements"){?>
						<a href="requirements.php" id="top_nav-link" title="Requirements">
							&nbsp;&nbsp;Requirements&nbsp;&nbsp;
						</a>
					<?php }else{?>
						<a href="requirements.php" title="Requirements">
							&nbsp;&nbsp;Requirements&nbsp;&nbsp;
						</a>                        
                        <?php }?>
                                      
                 <font class="slash">|</font>
					
					<?php if(@$home == "Clients"){?>
						<a href="clients.php" id="top_nav-link" title="Clients">
							&nbsp;&nbsp;Clients&nbsp;&nbsp;
						</a>
					<?php }else{?>
						<a href="clients.php" title="Clients">
							&nbsp;&nbsp;Clients&nbsp;&nbsp;
						</a>
					<?php }?>
                                       
                       <font class="slash">|</font>
					<?php if(@$home == ""){?>
						<a href="passwordchange.php" id="top_nav-link" title="password">
							&nbsp;&nbsp;Change password&nbsp;&nbsp;
						</a>
					<?php }else{?>
						<a href="passwordchange.php" title="password">
							&nbsp;&nbsp;Change password&nbsp;&nbsp;
						</a>
					<?php }?>		
                    								
					<font class="slash">|</font>
					<?php if(@$home == "logout"){?>
						<a href=""logout.php"" id="top_nav-link" title="logout">
							&nbsp;&nbsp;Logout&nbsp;&nbsp;
						</a>
					<?php }else{?>
						<a href="logout.php" title="logout">
							&nbsp;&nbsp;Logout&nbsp;&nbsp;
						</a>
					<?php }?>
				</td>
			</tr>
		</table>
		</div>
		<br /><br />
		<div style="border:#0000 1px solid; padding:2px; background:#FFFFFF" align="center">
			<table class="body_content" cellpadding="0" cellspacing="0">
				<tr>
					<td width="200px" valign="top">
						<?php
							include "sidebar.php";
						?>
                        <?php 
						include "sidebar2.php";
						?>
					</td>
					<td valign="top">
						<?php
						
			 				if(@$_GET['page'] == "changepassword" or @$_GET['page'] == ""){
								include "changepassword.php";
								
							}else if(@$_GET['page'] == "changepassword"){
								include "changepassword.php";
							}						
						?>
					</td>
				</tr>
			</table>
		</div>
		<br /><br />
		<div align="center">
			Copyright 2012 <br/>
            Pateros Technological College<br />
            Electronic Voting System
		</div>

</div>
</center>
</body>
</html>