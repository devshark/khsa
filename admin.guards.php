<?php 
	require 'pages/admin.redirect.php';
	require_once('classes/class.guards.php');
	require_once('classes/class.status.php');
	require_once('classes/class.requirements.php');
	require_once('classes/class.audit.php');
	Audit::audit_log($_SESSION['adminid'], 'Went to Guards page');
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
		<script src="js/admin.guards.js"></script>
		
	</head>
	<body>
	<div id="body">
	<?php include_once('static/header.admin.php');?>
	<?php include_once('static/nav.admin.php');?>
	<div id="content">
	
	<div id="tabs">
		<ul>
				<li><a href="#tabs-1">Guard List</a></li>
				<li><a href="#tabs-2">Requirements</a></li>
				<li><a href="#tabs-3">Work Experience</a></li>
		</ul>
	<div id="tabs-1">
		<table width="300" align="center" class = "home_page" >
		<tr>
			<td colspan="3" align="center" style="font:Verdana, Geneva, sans-serif; font-size:18px;  color:#0000FF;"><h3>List of Security Guards</h3>
		</td>
		</tr>
		<tr>
		<td height="5px">
		</td>
		</tr>
		<tr style="width:100%;" align="center">
		<td width="100%">
			<div  style="overflow:auto;width:550px;height:600px;white-space: nowrap;">
			<table id="jquery" cellpadding=5 border=1 cellspacing=0 style="width:500px; background-color:transparent; border:0px  #000 solid; padding:5px;text-align:center;">
				<thead>
					<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Middle Initial</th>
					<th>Address</th>
					<th>City</th>
					<th>Gender</th>
					<th>Contact Number</th>
					<th>Date Of Birth</th>
					<th>Civil Status</th>
					<th>Educational Status</th>
					<th>License Number</th>
					<th>License Expiry Date</th>
					<th>SSS Number</th>
					<th>Philhealth Number</th>
					<th>Pag-ibig Number</th>
					<th>TIN Number</th>
					<th>Guard Status</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach(Guard::get_list() as $guard){ /*var_dump( $guard );*/ ?>
					<tr id="<?php echo $guard->id;?>">
					<td var="first_name"><span><?php echo $guard->first_name;?></span></td>
					<td var="last_name"><span><?php echo $guard->last_name;?></span></td>
					<td var="middle_name"><span><?php echo $guard->middle_name;?></span></td>
					<td var="address"><span><?php echo $guard->address;?></span></td>
					<td var="address_city"><span><?php echo $guard->address_city;?></span></td>
					<td var="gender"><span><?php echo $guard->Gender;?></span></td>
					<td var="mobile_num"><span><?php echo $guard->mobile_num;?></span></td>
					<td class="date" var="date_of_birth"><span><?php echo $guard->date_of_birth;?></span></td>
					<td class="civil" val="<?php echo $guard->status;?>" var="status"><span><?php echo Status::get_status_name( $guard->status )->status;?></span></td>
					<td class="educ" val="<?php echo $guard->educational_attainment;?>" var="educational_attainment"><span><?php echo Status::get_status_name( $guard->educational_attainment )->status;?></span></td>
					<td var="license_num"><span><?php echo $guard->license_num;?></span></td>
					<td class="date" var="license_expiry_date"><span><?php echo $guard->license_expiry_date;?></span></td>
					<td var="SSS_No"><span><?php echo $guard->SSS_No;?></span></td>
					<td var="Philhealth"><span><?php echo $guard->Philhealth;?></span></td>
					<td var="PAG_IBIG"><span><?php echo $guard->PAG_IBIG;?></span></td>
					<td var="TIN_Number"><span><?php echo $guard->TIN_Number;?></span></td>
					<td var="guard_status"><span><?php echo Status::get_status_name( $guard->guard_status )->status;?></span></td>
							
					</tr>
					<?php } ?>
				</tbody>
			</table>
			</div>
		</td>
		</tr>
		<tr>
		<td><button id="addnew">Add New</button></td>
		</tr>
		<tr>
		<td><a href="reports.guards.php">Export to Excel</a></td>
		</tr>
    </table>
	</div>

	<div id="tabs-2">
		<table width="300" align="center" class = "home_page" >
		<tr>
			<td colspan="3" align="center" style="font:Verdana, Geneva, sans-serif; font-size:18px;  color:#0000FF;"><h3>List of Security Guard Requirements</h3>
		</td>
		</tr>
		<tr>
		<td height="5px">
		</td>
		</tr>
		<tr style="width:100%;" align="center">
		<td width="100%">
			<div  style="overflow:auto;width:550px;height:600px;white-space: nowrap;">
			<table id="jquery" cellpadding=5 border=1 cellspacing=0 style="width:500px; background-color:transparent; border:0px  #000 solid; padding:5px;text-align:center;">
				<thead>
					<tr>
					<th>Name</th>
					<th>picture</th>
					<th>license</th>
					<th>SBR</th>
					<th>SOSIA_certificate</th>
					<th>Training_certificate</th>
					<th>NBI_clearance</th>
					<th>PNP_clearance</th>
					<th>DI_clearance</th>
					<th>court_clearance</th>
					<th>brgy_clearance</th>
					<th>drug_test</th>
					<th>neuro_test</th>
					<th>school_diploma</th>
					<th>birth_certificate</th>
					<th>marriage_certificate</th>
					<th>employment_certificate</th>
					<th>SSS_static_record</th>
					<th>Requirement Status</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach(Req::get_list() as $req){ /*var_dump( $guard );*/ ?>
					<tr id="<?php echo $req->guard->id;?>">
					<td><span><?php echo $req->guard->first_name;?> <?php echo $req->guard->middle_name;?> <?php echo $req->guard->last_name;?></span></td>
					<td>
						<input type="checkbox" <?php echo $req->get_checklist()->picture == 1 ? 'checked value="0"' : ' value="1"';?> name="picture" />
					</td>
					<td>
						<input type="checkbox" <?php echo $req->get_checklist()->license == 1 ? 'checked value="0"' : ' value="1"';?> name="license" />
					</td>
					<td>
						<input type="checkbox" <?php echo $req->get_checklist()->SBR == 1 ? 'checked value="0"' : ' value="1"';?> name="SBR" />
					</td>
					<td>
						<input type="checkbox" <?php echo $req->get_checklist()->SOSIA_certificate == 1 ? 'checked value="0"' : ' value="1"';?> name="SOSIA_certificate" />
					</td>
					<td>
						<input type="checkbox" <?php echo $req->get_checklist()->Training_certificate == 1 ? 'checked value="0"' : ' value="1"';?> name="Training_certificate" />
					</td>
					<td>
						<input type="checkbox" <?php echo $req->get_checklist()->NBI_clearance == 1 ? 'checked value="0"' : ' value="1"';?> name="NBI_clearance" />
					</td>
					<td>
						<input type="checkbox" <?php echo $req->get_checklist()->PNP_clearance == 1 ? 'checked value="0"' : ' value="1"';?> name="PNP_clearance" />
					</td>
					<td>
						<input type="checkbox" <?php echo $req->get_checklist()->DI_clearance == 1 ? 'checked value="0"' : ' value="1"';?> name="DI_clearance" />
					</td>
					<td>
						<input type="checkbox" <?php echo $req->get_checklist()->court_clearance == 1 ? 'checked value="0"' : ' value="1"';?> name="court_clearance" />
					</td>
					<td>
						<input type="checkbox" <?php echo $req->get_checklist()->brgy_clearance == 1 ? 'checked value="0"' : ' value="1"';?> name="brgy_clearance" />
					</td>
					<td>
						<input type="checkbox" <?php echo $req->get_checklist()->drug_test == 1 ? 'checked value="0"' : ' value="1"';?> name="drug_test"/>
					</td>
					<td>
						<input type="checkbox" <?php echo $req->get_checklist()->neuro_test == 1 ? 'checked value="0"' : ' value="1"';?> name="neuro_test" />
					</td>
					<td>
						<input type="checkbox" <?php echo $req->get_checklist()->school_diploma == 1 ? 'checked value="0"' : ' value="1"';?> name="school_diploma" />
					</td>
					<td>
						<input type="checkbox" <?php echo $req->get_checklist()->birth_certificate == 1 ? 'checked value="0"' : ' value="1"';?> name="birth_certificate" />
					</td>
					<td>
						<input type="checkbox" <?php echo $req->get_checklist()->marriage_certificate == 1 ? 'checked value="0"' : ' value="1"';?> name="marriage_certificate" />
					</td>
					<td>
						<input type="checkbox" <?php echo $req->get_checklist()->employment_certificate == 1 ? 'checked value="0"' : ' value="1"';?> name="employment_certificate" />
					</td>
					<td>
						<input type="checkbox" <?php echo $req->get_checklist()->SSS_static_record == 1 ? 'checked value="0"' : ' value="1"';?> name="SSS_static_record" />
					</td>
					<td class="req_status" name="<?php echo $req->guard->id;?>">
						<?php echo Req::get_req_status( $req->guard->id ); ?>
					</td>
					
					</tr>
					<?php } ?>
				</tbody>
			</table>
			</div>
		</td>
		</tr>
    </table>
	</div>
	
		<div id="tabs-3">
		<table width="300" align="center" class = "home_page" >
		<tr>
			<td colspan="3" align="center" style="font:Verdana, Geneva, sans-serif; font-size:18px;  color:#0000FF;"><h3>Employment Record</h3>
		</td>
		</tr>
		<tr>
		<td height="5px">
		</td>
		</tr>
		<tr style="width:100%;" align="center">
		<td width="100%">
			<div  style="overflow:auto;width:550px;height:600px;white-space: nowrap;text-align:left;">
			<dl>
			<?php foreach(Guard::get_list() as $guard){ /*var_dump( $guard );*/ ?>
				<dt><strong><?php echo $guard->first_name;?> <?php echo $guard->middle_name;?> <?php echo $guard->last_name;?></strong></dt>
				<dd>
					<p>Years of Experience : <?php echo $guard->Years_of_experience;?></p>
					<?php foreach(Guard::get_xp( $guard->id ) as $xp ){ ?>
					<p><?php echo $xp->Company_name?> (<?php echo $xp->Date_from;?> - <?php echo $xp->Date_to;?>)</p>
					<?php } ?>
				</dd>
			<?php } ?>
			</dl>
			</div>
		</td>
		</tr>
    </table>
	</div>
	</div>
	</div>
	</div>
	</div>
	<?php include_once('static/footer.php'); ?>
	</body>
</html>