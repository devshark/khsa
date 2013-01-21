<?php
session_start();
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
			<h3>&nbsp;&nbsp;&nbsp;&nbsp;Below is the List of Guards:</h3>
			<table border=1 cellspacing=0 cellpadding=5>
				<thead>
					<tr>
					<th>Name</th>
					<th>Location</th>
					<th>Gender</th>
					<th>Age</th>
					<th>Educational Attainment</th>
					<th>Date Of Birth</th>
					</tr>
				</thead>
				<tbody>
			<?php
			require_once('classes/class.guards.php');
			$rows = Guard::get_list();
			foreach($rows as $row)
			{
				$now = new DateTime(date('Y-m-d h:i:s'));
				$ref = new DateTime($row->DOB);
				$diff = $now->diff($ref);
				echo '<tr>';
				echo '<td>' . $row->Last_Name . ' ' . $row->First_Name . '</td>';
				echo '<td>' . $row->City . '</td>';
				echo '<td>' . $row->Gender . '</td>';
				echo '<td>' . $diff->y . '</td>';
				echo '<td>' . $row->educ_attainment . '</td>';
				echo '<td>' . date('Y-m-d', strtotime( $row->DOB )) . '</td>';
				echo '</tr>';
			}
			?>
				</tbody>
			</table>
			</div>
		</div>
	</body>
</html>