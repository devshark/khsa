<?php 
	session_start();
	require ('../include/connection.php');
	$header = "../images/banner.png"; //insert path here for banner ex. "images/apache.png"

	$username = "";
	$password = "";
	if(isset($_POST['username'])){ $username = $_POST['username']; }
	if(isset($_POST['password'])){ $password = $_POST['password']; }
	
	if(isset($_POST['log-in'])){		
		if($username != "" and $password != ""){
			$password = md5($password);
			$admin_query = mysql_query("select * from admin");
			while($admin = mysql_fetch_object($admin_query)){
				if($admin->username == $username and $admin->password == $password){
					$_SESSION['userid'] = $admin->id;
					$_SESSION['time-in'] = time();
					header("location:main.php");
				}else{
					if($admin->username != $username){
						$error_message = "Login Failed!";	
					}
				}
			}				
		}else{
			$error_message = "!";
			if(isset($error_message)){ $error_message = "Please don't leave an empty field/s!"; }
		}
	}
	
	if(isset($_SESSION['userid'])){
		header("location:main.php");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title; ?></title>
<link rel="stylesheet" type="text/css" href="../css/adminstyle.css"/>
</head>
	
<body class="body">
	<center>
	<div class="wrapper" align="center">
		<table class="header" style="border-bottom:2px solid;" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<?php if($header != ""){?>
							<img class="header_image" src="<?php echo $header;?>" />
					<?php }else{?>
						<font class="header_font">KING HENRY SECURITY AGENCY, INC.</font><br />
						<font style="color:#000; font-size:14px;">INTEGRATED INFORMATION SYSTEM</font>
					<?php }?>
				</td>
			</tr>
		</table>
		
		<div style= "margin-top:20px; width:330px; padding:20px; border-color:#000000;">
			<div style= "color: #00F; border:5px inset #000;">
            <table width="330px" cellpadding="0" cellspacing="1px" style="color:#000;">
				<tr align="center">
					<td colspan="2" style="font-family:'Times 'Times New Roman', Times, serif', Courier, monospace; font-size:24px; color:#000; font-weight:bold;">
						ADMINISTRATOR
					</td>
				</tr>
				<tr align="center">
					<td colspan="2">
						<hr id="hr-login" size="1px" noshade="noshade"/>
					</td>
				</tr>
				<tr><td colspan="2"><br /></td></tr>
				<form method="post" action="">
				<tr>
					<td align="right" width="120px" style="padding-right:10px;">Username</td>
					<td><input type="text" name="username" value="<?php echo $username;?>" /></td>
				</tr>
                <tr height="5px">
                </tr>
				
				<tr>
					<td align="right" width="120px" style="padding-right:10px;">Password</td>
					<td><input type="password" name="password" /></td>
				</tr>
				<tr><td colspan="2"><br /></td></tr>
				<tr style="color:#FF0000; font-family:Arial, Helvetica, sans-serif;">
					<td colspan="2" style="padding-left:5px; font-size:12px; align="center">
						<?php echo @$error_message;?>
					</td>
				</tr>
				
				<tr align="center">
					<td colspan="2">
						<hr id="hr-login" size="1px" noshade="noshade"/>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="2">
						<input style = "margin-left: 20px" type="submit" name="log-in" value="Login"/>
					</td>
				</tr>
				</form>
				
			</table>
            </div>
		</div>
		
	</div>
	</center>
</body>
</html>