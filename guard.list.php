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
			<h3>&nbsp;&nbsp;&nbsp;&nbsp;Below is the List of Guards:</h3><br/>
			<?php
			include_once('classes/class.guards.php');
			?>
			<form method="post" action="guard.list.php">
				<p>
					Location : 
					<select name="City">
					<option>--</option>
					<?php
					foreach(Guard::get_locations() as $row)
					{ ?>
					<option><?php echo $row->City;?></option>
					<?php
					}
					?>
					</select>&nbsp;
					Gender : 
					<select name="Gender">
					<option>--</option>
					<?php
					foreach(Guard::get_genders() as $row)
					{ ?>
					<option><?php echo $row->Gender;?></option>
					<?php
					}
					?>
					</select>
					&nbsp;Age :
					<select name="sign">
					<option>--</option>
					<option>=</option>
					<option>></option>
					<option><</option>
					</select>&nbsp;<input type="text" name="age" size=2 maxlength=2 />
					<br/><br/>Educational Attainment :
					<select name="educ_attainment">
					<option>--</option>
					<?php
					foreach(Guard::get_educs() as $row)
					{ ?>
					<option><?php echo $row->educ;?></option>
					<?php
					}
					?>
					</select>
				</p>
				
				<p><input type="submit" name="btnSearch" value="Search" /></p>
			</form>
			
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
			$rows = array();
			if(isset($_POST['btnSearch']))
			{
				$rows = Guard::filter($_POST);
			}
			else{
				$rows = Guard::get_list();
			}
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