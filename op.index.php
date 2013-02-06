<?php 
	require 'pages/admin.redirect.php';
	require_once('classes/class.equipments.php');
	require_once('classes/class.manufacturer.php');
	require_once('classes/class.audit.php');
	Audit::audit_log($_SESSION['adminid'], 'Went to Operations Home page');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>King Henry Security Agency Inc. | Logistics</title>
		<link href="css/style.css" rel= "stylesheet" type="text/css" />
		<link href="css/custom.css" rel= "stylesheet" type="text/css" />
		<link href="css/start/jquery-ui-1.10.0.custom.min.css" rel= "stylesheet" type="text/css" />
		<script src="js/jquery-1.9.0.js"></script>
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
		<script src="js/admin-logi.js"></script>
		<script>
		
		</script>
	</head>
	<body>
	<div id="body">
	<?php include_once('static/header.admin.php');?>
	<?php include_once('static/nav.admin.php');?>
	<div id="content">
	<table width="300" align="center" class = "home_page" >
		<tr>
			<td colspan="3" align="center" style="font:Verdana, Geneva, sans-serif; font-size:18px;  color:#0000FF;"><h3>List of Equipments</h3>
		</td>
		</tr>
		<tr>
		<td height="5px">
		</td>
		</tr>
		<tr style="width:100%;" align="center">
		<td width="100%">
		
		</td>
		</tr>
		<tr>
		<td><button id="addnew">Add New</button></td>
		</tr>
    </table>
	</div>	
	<div align="center">
		Copyright 2013 <br/>
		King Henry Security Agency<br />
		Integrated Information System
	</div>
	</div>
	</body>
</html>