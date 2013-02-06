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
			<tr>
			<td colspan="3" align="center" style="font:Verdana, Geneva, sans-serif; font-size:18px;  color:#0000FF;"><h3>List of Security Guards</h3>
		</td>
		</tr>
			<h4> You can search it by:</h4>
			<?php
			include_once('classes/class.guards.php');
			include_once('classes/class.status.php');
			?>
			<form method="post" action="guard.list.php">
				<p>
					<b>Location : </b>
					<select name="address_city">
					<option>--</option>
					<?php
					foreach(Guard::get_locations() as $row)
					{ ?>
					<option><?php echo $row->address_city;?></option>
					<?php
					}
					?>
					</select>&nbsp;
					<b>Gender : </b>
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
					&nbsp;&nbsp;&nbsp;&nbsp;<b>Age :</b>&nbsp;
					<input type="text" pattern="\d*" min="21" max="60" name="DOBfrom" size=2 maxlength="2" />&nbsp;
					<b>To</b>&nbsp;
					<input type="text" pattern="\d*" min="21" max="60" name="DOBto" size=2 maxlength="2" />
					<!--<select name="sign">
					<option>--</option>
					<option>=</option>
					<option>></option>
					<option><</option>
					</select>&nbsp;<input type="text" name="age" size=2 maxlength=2 />-->
					<br/><br/><b>Educational Attainment : </b>
					<select name="educational_attainment">
					<option>--</option>
					<?php
					foreach(Guard::get_educs() as $row)
					{ ?>
					<option value="<?php echo $row->id;?>"><?php echo $row->status;?></option>
					<?php
					}
					?>
					</select>
					&nbsp;&nbsp;&nbsp;&nbsp;<b>Years of Experience :</b>&nbsp;
					<input type="text" name="Years_of_experience" size=2 maxlength="2" />&nbsp;
					
					
				
				
					
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
					<!--<th>Date Of Birth</th>-->
					<th>Years of Experience </th>
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
			if( count($rows) >0 )
				foreach($rows as $row)
				{
					$now = new DateTime(date('Y-m-d h:i:s'));
					$ref = new DateTime($row->date_of_birth);
					$diff = $now->diff($ref);
					echo '<tr>';
					echo '<td>' . $row->last_name . ' ' . $row->first_name . '</td>';
					echo '<td>' . $row->address_city . '</td>';
					echo '<td>' . $row->Gender . '</td>';
					echo '<td>' . $diff->y . '</td>';
					echo '<td>' . Status::get_status_name( $row->educational_attainment )->status . '</td>';
					// echo '<td>' . date('Y-m-d', strtotime( $row->date_of_birth )) . '</td>';
					echo '<td>' . $row->Years_of_experience . '</td>';
					echo '</tr>';
				}
			else{
				echo '<tr><td align="center" colspan=5>NO DATA</td></tr>';
			}
			?>
				</tbody>
			</table>
			</div>
		</div>
	</body>
</html>