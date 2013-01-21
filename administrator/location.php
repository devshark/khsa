<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title ?></title>
</head>

<body>
	<div id="page_title">
	<font id="page-title-font">
		<?php 
			if($_GET['subpage'] == "welcome"){
				echo "WELCOME";
			}
		?>
	</font>
	</div>
	<div class="page_content">
		<?php 
			if($_GET['subpage'] == "welcome"){
				include "home.php";
			}
		?>
	</div>
</body>
</html>
