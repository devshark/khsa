<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title ?></title>
</head>

<body>
<div id="sidebar">
		
<?php 
	$page = "";
	if (isset($_GET['page'])){$page = $_GET['page'];}{?>
		<div id="sidebar-title">ADMIN PANEL</div>
		<div id="sidebar-inside">
			<ul>
				<li>
					<a href="index.php"> Home</a>
				</li>
                  <li>
                	<a href="sec_guards.php"> Security Guards </a>
                 </li>
                 <li>
                	<a href="requirements.php"> Requirements </a>
                 </li>
                 <li>
                	<a href="clients.php"> Clients</a>
                 </li>
                 <li>
                	<a href="passwordchange.php"> Change Password </a>
                </li>
			</ul>
		</div>

<?php }?>
</div>
</body>
</html>
