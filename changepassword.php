<?php
session_start();
ini_set('display_errors','On');
// error_reporting(E_ERROR);
error_reporting(E_ALL);
if( ! isset($_SESSION['clientid']) )
{
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>King Henry Security Agency Inc.</title>
		<link href="css/style.css" rel= "stylesheet" type="text/css" />
		<link href="css/custom.css" rel= "stylesheet" type="text/css" />
	</head>
	<body>
		<div id="body">
		<?php include_once('static/header.php');?>
		<?php include_once('static/nav.php');?>
			<div id="content">
			<table width="300" align="center" class = "home_page" >
		</td>
		</tr>
			<?php
			include_once('classes/class.guards.php');
			include_once('classes/class.status.php');
			?>
			<form method="post" action="change.php">
				<tr>
					<td>Old Password</td>
					<td><input type = 'password' name = 'oldpass' size = '40'></td>
				</tr>
				<tr>
					<td>New Password</td>
					<td><input type = 'password' name = 'newpass' size = '40'></td>
				</tr>
				<tr>
					<td>Confirm Password</td>
					<td><input type = 'password' name = 'conpass' size = '40'></td>
				</tr>
				<tr>
					<td align ='center' colspan = '2'>
						<input type="submit" name="btnChange" value="Change">
						<input type="reset" name="btnCancel" value="Cancel">
					</td>
				</tr>
				
			</form>

			</div>
		</div>
	</body>
</html>