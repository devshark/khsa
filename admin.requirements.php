<?php 
	require 'pages/admin.redirect.php';
	require_once('classes/class.requirements.php');
	// require_once('classes/class.status.php');
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
		<script>
		$(function(){
			$('table#jquery td input[type=checkbox]').change(function(ev){
				$this = $(this);
				console.log(ev);
				$.post(
					'ajax.req.save.php',
					{
						id : $this.parents('tr').first().attr('id'),
						val : $this.val(),
						name : $this.attr('name')
					},
					function(data){
						data = $.parseJSON(data);
						if(data.status=='success'){
							console.log('pass');
							$this.val( Math.abs( $this.val() -1 ) );
						}else{
							console.log('error : '+data.message);
						}
					}
				);
				return false;
			})
		});
		</script>
	</head>
	<body>
	<div id="body">
	<?php include_once('static/header.admin.php');?>
	<?php include_once('static/nav.admin.php');?>
	<div id="content">
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
					<td>
						<input type="checkbox"  name="birth_certificate" />
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
	<div align="center">
		Copyright 2013 <br/>
		King Henry Security Agency<br />
		Integrated Information System
	</div>
	</div>
	</body>
</html>