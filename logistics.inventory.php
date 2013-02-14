<?php 
	require 'pages/admin.redirect.php';
	require_once('classes/class.equipments.php');
	require_once('classes/class.manufacturer.php');
	require_once('classes/class.audit.php');
	Audit::audit_log($_SESSION['adminid'], 'Went to Admin Client page');
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
		$(document).on('focus','table#jquery tbody td.date input[type=text]',
			function(event){
			// event.stopPropagation();
			$this = $(this);
			$this.datepicker({ dateFormat: "yy-mm-dd",defaultDate: $this.val(),changeYear: true ,changeMonth: true , onClose : function(){ $('.ui-datepicker').remove(); } });
			// $(this).trigger('blur').trigger('click');
		});
		
		$(document).on('click','table#jquery tbody td span',clickEvent);
		$(document).on('blur','body',
			function(event){
			$this = $( event.target );
			validationTimer = setTimeout(function(){
				validationTimer = null;
				if( $('.ui-datepicker').length == 0 )
				{
					if( ($('form#jap input[type=text]').length + $('form#stat select').length) > 0 ){
						$.post('ajax.equip.save.php', 
						{
						'value' : $this.val(),
						'name' : $this.prop('name'),
						'id' : $this.siblings('input[type=hidden]').val()
						},
						function(data){
							data = $.parseJSON(data);
							if(data.status=='success'){
								var span;
								if( $('form#stat select').length > 0 ){
									span = $('<span></span>').text( $('option:selected',$this).text() );
								}else{
									span = $('<span></span>').text( $this.val() );
								}
								$this.parents('td').first().prepend(span);
								$this.parent('form').remove();
							}
						});
					}
				}
			},200);
		});

		$(function(){
			$('button#addnew').click(function(ev){
				var $div = $('<div>').attr('id','newInv');
				$.get('form.newequipment.php', {}, function(html){
					$div.html(html).dialog({
						'title':'Add New Inventory',
						'buttons':{
							'OK':function(e){
								$('div#newInv form').trigger('submit');
							}
						},
						close: function(ev, ui) { $(this).remove(); },
						width: '500px',
						modal: true
					});
					$div.find('.datepicker').datepicker({ dateFormat: "yy-mm-dd",changeYear: true ,changeMonth: true });
				});
			});
		});
		$(document).on('submit','div#newInv form',
			function(event){
				var $form = $(this);
				$.post('newequip.php',
				$form.serialize(),
				function(result){
					result = $.parseJSON(result);
					if(result.status == 'success'){
						alert(result.message);
						$form.parent('div#newInv').remove();
						$('.ui-datepicker').remove();
						window.location.href = 'logistics.inventory.php';
					}else{
						alert(result.message);
					}
				});
				return false;
			}
		);
		</script>
	</head>
	<body>
	<div id="body">
	<?php include_once('static/header.admin.php');?>
	<?php include_once('static/nav.admin.php');?>
	<div id="content">
	<table width="300" align="center" class = "home_page" >
		<tr>
			<td colspan="3" align="center" style="font:Verdana, Geneva, sans-serif; font-size:18px;  color:#0000FF;"><h3>List of Equipments</h3>
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
					<th>Equipment ID</th>
					<th>Equipment Description</th>
					<th>Equipment Serial No.</th>
					<th>Manufacturer Name</th>
					<th>Ammunition quantity</th>
					<th>Equipment expiry</th>
					<th>Equipment Status</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach(Equipment::get_list() as $equip){?>
					<tr id="<?php echo $equip->Equipment_ID;?>">
					<td><?php echo $equip->Equipment_ID;?></td>
					<td var="Equipment_Desc"><span><?php echo $equip->Equipment_Desc;?></span></td>
					<td var="Equipment_Serial_No"><span><?php echo $equip->Equipment_Serial_No;?></span></td>
					<td var="Manufacturer_ID" class="manu"><span><?php echo (Manufacturer::get_name($equip->Manufacturer_ID)) ;?></span></td>
					<td var="Ammo_quantity"><span><?php echo $equip->Ammo_quantity;?></span></td>
					<td class="date" var="Equipment_expiry"><span><?php echo $equip->Equipment_expiry;?></span></td>
					<td var="Equipment_Status" class="equistat"><span><?php echo $equip->Equipment_Status;?></span></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</td>
		</tr>
		<tr>
		<td><button id="addnew">Add New</button></td>
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