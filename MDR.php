<?php
	require_once('classes/class.client.php');
?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>King Henry Security Agency Inc. | ADMIN</title>
		<link href="css/style.css" rel= "stylesheet" type="text/css" />
		<link href="css/custom.css" rel= "stylesheet" type="text/css" />
		<link href="css/start/jquery-ui-1.10.0.custom.min.css" rel= "stylesheet" type="text/css" />
		<script src="js/jquery-1.9.0.js"></script>
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
	</head>
	<body>
	<div id="body">
	<?php include_once('static/header.admin.php');?>
	<?php include_once('static/nav.admin.php');?>
	<div id="content">
	<table width="300" align="center" class = "home_page" >
	
		<tr>
			<td colspan="3" align="center" style="font:Verdana, Geneva, sans-serif; font-size:18px;  color:#0000FF;"><h3>Monthly Disposition Report</h3>
		</td>
		</tr>
		<tr>
		<td height="5px">
		</td>
		</tr>
		<tr style="width:100%;" align="center">
		<td width="100%">
			<table id="jquery" cellpadding=5 border=1 cellspacing=0 style="width:500px; background-color:transparent; border:0px  #000 solid; padding:5px;text-align:center;">
				<thead>
					<tr>
					<th>Client Name Addresses and Contact No.</th>
					<th>Name of Guards</th>
					<th>License No.</th>
					<th>Expiry Date</th>
					<th>SSS</th>
					<th>FireArms Issued</th>
					</tr>
				</thead>
				<tbody>
					<?php
						include ('include/connection2.php');
						$oSelect = "Select `clientid`, `guardid` From `khsa`.`tbldeployment`";
						$eSelect = mysql_query($oSelect);
						if ($eSelect == false)
						{
							echo "No Data To Display!";
						}
						else
						{
							while($row = mysql_fetch_array($eSelect))
							{
								$nClientId = $row['clientid'];
								$nGuardId = $row['guardid'];
								
								$oClient = "Select `Client_Name`, `Address`, `Contact_No` From `khsa`.`tblclient` Where `Client_ID` = '$nClientId'";
								$eClient = mysql_query($oClient);
								$client = mysql_fetch_array($eClient);
								
								$oGuard = "Select `last_name`, `middle_name`, `first_name`, `license_num`, `license_expiry_date`, `SSS_No` From `khsa`.`tblguards` Where `id` = '$nGuardId'";
								$eGuard = mysql_query($oGuard);
								$guard = mysql_fetch_array($eGuard);
								
								$oFire = "Select `equipment_id` `khsa`.`tbldeployment` Where `clientid` = '$nGuardId' AND `guardid` = '$nGuardId'";
								$eFire = mysql_query($oFire);
								$fire = mysql_fetch_array($eFire);
								
						?>
							<tr>
								<td><?php echo $client['Client_Name'] .", <br>".$client['Address']." <br>".$client['Contact_No']; ?></td>
								<td><?php echo $guard['first_name'] ." " . $guard['middle_name'] . " " .$guard['last_name']; ?></td>
								<td><?php echo $guard['license_num'];?></td>
								<td><?php echo $guard['license_expiry_date'];?></td>
								<td><?php echo $guard['SSS_No'];?></td>
								<td><?php echo $fire['equipment_id'];?></td>
							</tr>
						<?php
							}
						}						
					?>
				</tbody>
			</table>
		</td>
		</tr>
		<tr>
		<td><button id="addnew">Print</button></td>
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