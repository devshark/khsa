<?php 
	require 'pages/admin.redirect.php';
	require_once('classes/class.equipments.php');
	require_once('classes/class.manufacturer.php');
	require_once('classes/class.audit.php');
	Audit::audit_log($_SESSION['adminid'], 'Went to Operations Home page');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>King Henry Security Agency Inc. | Logistics</title>
		<link href="css/style.css" rel= "stylesheet" type="text/css" />
		<link href="css/custom.css" rel= "stylesheet" type="text/css" />
		<link href="css/start/jquery-ui-1.10.0.custom.min.css" rel= "stylesheet" type="text/css" />
		<script src="js/jquery-1.9.0.js"></script>
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
		<script src="js/admin-logi.js"></script>
		<script>
		
		</script>
	</head>
	<body>
	<div id="body">
	<?php include_once('static/header.admin.php');?>
	<?php include_once('static/nav.admin.php');?>
	<div id="content">
	<div  style="overflow:auto;width:700px;height:700px;white-space: nowrap;">
	<table width="300" align="center" class = "home_page" >
		<tr>
			<td colspan="3" align="center" style="font:Verdana, Geneva, sans-serif; font-size:18px;  color:#0000FF;"><h3>Duty Detail Order</h3>
		</td>
		</tr>
		<tr>
		<td height="5px">
		</td>
		</tr>
		<tr style="width:100%;" align="left">
		<style>
		h4 {letter-spacing: 2px}
		</style>
		<td width="100%">
		<blockquote><center>KING HENRY SECURITY and INVESTIGATION AGENCY, INC.<br>
3rd floor ZEN bldg., 75 F. Legaspi St.,  Maybunga, Pasig City<br>
Telefax. No. 640-9521 HOTLINE 710-6989<br>
Email : kinghenry_hcl@yahoo.com</center><br><hr>
<br>
DUTY DETAIL ORDER NO. :<input type = "text">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp	DATE :<input type = "text"> <br><br>
1.	Reference: Section 4 and 6 of the Implementing Rules and Regulations of PD 1866<br>
2.	The following Security Officer/s/Guard/s is/are hereby assigned to render security/ supervisory duty indicated and is/are<br> hereby issued Agency owned firearms/properties.<br>

<h4>NAME/RANK&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspPLACE OF DUTY&nbsp&nbsp&nbsp&nbsp&nbspINCLUSIVE DATES&nbsp&nbsp&nbsp&nbspREMARKS</h4><br>
<input type = "text"><input type = "text"><input type = "text"><input type = "text"> <br><br><br><br><br>





3.	Specific Intructions:<br>
a.)	Security Officer in this Duty Detail Order is hereby ordered to take command responsibility over the above-mentioned<br> Detachment and all the other guards therein. He must keep the guard force fully oriented on its duties and responsibilities<br> embodied under R.A. 5487 as ammended in P.D. 1419 and the contract entered into between the client and the Agency.<br> He shall carry his/her issued firearm only in place of duty.<br>
b.)	Securty Guards in this Duty Detail Order must be in proper uniform and shall carry his issued firearm on in his place of duty.<br>
c.)	The issued firearms to the Security Officer/s Guard/s are licensed and the photocopy of which is in the possession of the<br> officer/s/guard/s.<br>
4.	This Duty Detail Order serves as authority for the aformentioned Security Officer/s Guard/s to carry their issued firearm only on<br> the covered area of responsibility.<br>
5.	This is not an authority to bear firearms outside the premises of the specified post/station nor shall the firearms described<br> herein leave the client post/station<br><br><br><br><br></blockquote>




<h5 align = "right">__________________________________________________<br>
SIGNATURE OVER PRINTED NAME
 OF ISSUING OFFICER </h5>

		</td>
		</tr>
		<tr>
		<td><button id="addnew">Print</button></td>
		</tr>
    </table>
	</div>
	</div>
	<div align="center">
		Copyright 2013 <br/>
		King Henry Security Agency<br />
		Integrated Information System
	</div>
	</div>
	</body>
	
</html>