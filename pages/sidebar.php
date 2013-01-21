<?php 
require ("../include/connection.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title ?></title>
</head>

<body>
<div id="sidebar">

<?php if($_GET['page'] == "" or $_GET['page'] == "location"){?>
		<div id="sidebar-title">Student</div>
		<div id="sidebar-inside">
			<ul>
				<li>
					<a href="main.php"> Home</a>
				</li>
			</ul>
		</div>
<?php }else if($_GET['page'] == "profile"){?>
		<div id="sidebar-title">Candidate Profile</div>
		<div id="sidebar-inside">
			<ul>
				<li>
					<a href="../../databanking/administrator/pages/main.php?page=demography&amp;subpage=population">Projected Population</a>
				</li>
				<li>
					<a href="">Mortality Rate</a>
				</li>
			</ul>
		</div>
<?php }?>

</div>
</body>
</html>
