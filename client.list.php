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
			<h3>&nbsp;&nbsp;&nbsp;&nbsp;Below is the List of Clients:</h3>
			<ul>
			<?php
			require_once('classes/class.client.php');
			$rows = Client::get_list();
			foreach($rows as $row)
			{
				echo '<li>' . $row->Client_Name . '</li>';
			}
			?>
			</ul>
			</div>
		</div>
	</body>
</html>