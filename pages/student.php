<?php 
	$barangay_query = mysql_query("select * from barangay order by barangay");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
	<div id="home_title" align="left">
		Land Area and Barangay Information
	</div>
	<br />
	<center>
	<div id="banner">
		<?php 
			$land_area_query = mysql_query("select * from brgy_population where is_latest = 1");
		?>		
			<table border="1" width="100%" style="border-collapse:collapse;" cellspacing="0" cellpadding="0">
				<tr align="center">
					<td width="40%">
						<div id="table-header-title">
							Barangay
						</div>
					</td>
					<td>
						<div id="table-header-title">
							Land Area(Sq. km.)
						</div>
					</td>
					<td width="15%">
						<div id="table-header-title">
							Year
						</div>
					</td>
				</tr>
				<?php 
					while($land_area = mysql_fetch_object($land_area_query)){
						$brgy_query	=	mysql_query("select * from barangay where id = '$land_area->brgy_id'");
						$brgy		=	mysql_fetch_object($brgy_query);
				?>
						<tr align="center">
							<td><?php echo $brgy->barangay; ?></td>
							<td><?php echo $land_area->land_area;?></td>
							<td><?php echo $land_area->year;?></td>
						</tr>
				<?php
					}
				?>
			</table>
	</div>
	
	<br />

        
	<?php 
	$time = now();
	
	echo $time; ?>
	</div>
</body>
</html>
