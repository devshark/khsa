<?php 
	include 'pages/admin.redirect.php';
	require_once('classes/class.audit.php');
	Audit::audit_log($_SESSION['adminid'], 'Went to Admin Main page');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>King Henry Security Agency Inc. | ADMIN</title>
		<link href="css/style.css" rel= "stylesheet" type="text/css" />
		<link href="css/custom.css" rel= "stylesheet" type="text/css" />
	</head>
	<body>
	<div id="body">
	<?php include_once('static/header.admin.php');?>
	<?php include_once('static/nav.admin.php');?>
	<div id="content">
	<iframe src="messaging.php" style="width:100%;height:800px;"></iframe>
	</div>
	</div>
	<?php include_once('static/footer.php'); ?>
	</body>
</html>