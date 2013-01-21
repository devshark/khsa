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
						<font class="header_font">PTC E-VOTING SYSTEM</font><br />
						<font style="color:#009900; font-size:14px;">SUPREME STUDENT CONCIL, INC.</font>
					<?php }?>
				</td>
			</tr>
		</table>
		<div class="top_nav_wrapper" align="center">
		<table class="top_nav" cellspacing="0" cellpadding="0">
			<tr>
				<td nowrap="nowrap">
                
					<?php if( $_GET['page'] == "home"){?>
						<a href="main.php" id="top_nav-link" title="home">
							&nbsp;&nbsp;Home&nbsp;&nbsp;
						</a>
				 <?php }else{?>
                 	<a href="main.php" title="home">
							&nbsp;&nbsp;Home&nbsp;&nbsp;
						</a>   
						
					<?php }?>
                    
                    <font class="slash">|</font>
					<?php if($_GET['page'] == "student"){?>
						<a href="student.php" id="top_nav-link" title="students">
							&nbsp;&nbsp;Students&nbsp;&nbsp;
						</a>
					<?php }else{?>
						<a href="student.php" title="students">
							&nbsp;&nbsp;Students&nbsp;&nbsp;
						</a>                        
                        <?php }?>	
					
					<font class="slash">|</font>
					
					<?php if($_GET['page'] == "candidates"){?>
						<a href="candidateinfo.php" id="top_nav-link" title="candidates">
							&nbsp;&nbsp;Candidate Information&nbsp;&nbsp;
						</a>
					<?php }else{?>
						<a href="candidateinfo.php" title="candidates">
							&nbsp;&nbsp;Candidate Information&nbsp;&nbsp;
						</a>
					<?php }?>
                    
                     <font class="slash">|</font>
					<?php if($_GET['page'] == "partylist"){?>
						<a href="partylist.php" id="top_nav-link" title="partylist">
							&nbsp;&nbsp;Party List&nbsp;&nbsp;
						</a>
					<?php }else{?>
						<a href="partylist.php" title="partylist">
							&nbsp;&nbsp;Party List&nbsp;&nbsp;
						</a>                        
                        <?php }?>
                                      
                  <font class="slash">|</font>
					<?php if($_GET['page'] == "tally"){?>
						<a href="votecount.php" id="top_nav-link" title="tally">
							&nbsp;&nbsp;Tally Sheet&nbsp;&nbsp;
						</a>
					<?php }else{?>
						<a href="votecount.php" title="tally">
							&nbsp;&nbsp;Tally Sheet&nbsp;&nbsp;
						</a>
					<?php }?>
                    
                       <font class="slash">|</font>
					<?php if($_GET['page'] == "password"){?>
						<a href="passwordchange.php" id="top_nav-link" title="password">
							&nbsp;&nbsp;Change password&nbsp;&nbsp;
						</a>
					<?php }else{?>
						<a href="passwordchange.php" title="password">
							&nbsp;&nbsp;Change password&nbsp;&nbsp;
						</a>
					<?php }?>		
                    								
					<font class="slash">|</font>
					<?php if($_GET['page'] == "logout"){?>
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
						
			 				if($_GET['page'] == "reports" or $_GET['page'] == ""){
								include "reports.php";
							}else if($_GET['page'] == "reports"){
								include "reports.php";
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