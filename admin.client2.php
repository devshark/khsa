<?php
ini_set('display_errors','On');
error_reporting(E_ALL);
	require 'pages/admin.redirect.php';
	require_once('classes/class.clientguard.php');
	require_once('classes/class.equipments.php');
	require_once('classes/class.audit.php');
	Audit::audit_log($_SESSION['adminid'], 'Went to Admin Client page');
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
		$(function() {
		$( "#tabs" ).tabs();
		});
		</script>
		
		<script>
		$(function(){
			$('button#addnew')
			.click(function(){
				$('<div>')
				.attr('id','newclient')
				.load('form.newclient.html')
				.dialog({
					'title':'Add New Client',
					'buttons':{
						'OK':function(e){
							$('div#newclient form').trigger('submit');
							// $(this).dialog('close');
						}
					},
					close: function(ev, ui) { $(this).remove(); }
				});
			});
		});
		$(document).on('submit','div#newclient form',
			function(event){
				var $form = $(this);
				$.post('newclient.php',
				$form.serialize(),
				function(result){
					result = $.parseJSON(result);
					if(result.status == 'success'){
						alert(result.message);
						$form.parent('div#newclient').remove();
						window.location.href = window.location.href;
					}else{
						alert(result.message);
					}
				});
				return false;
			}
		);
		$(document).on('click','table#jquery tbody td span',
			function(event){
			event.stopPropagation();
			// alert($(this).prop('var'));
			editable($(this),{id:$(this).parents('tr').prop('id'), name:$(this).parent('td').attr('var'), value:$(this).text()});
		});
		$(document).on('blur','form#jap',
			function(event){
			var description = $(this).children('input[type=text]').val();
			$.post('ajax.equip.save.php', 
			{
			equips : $(this).children('input[type=text]').val(),
			id : $(this).children('input[type=hidden]').val()
			},
			function(data){
				data = $.parseJSON(data);
				if(data.status == 'success'){
					description = data.message;
					console.log(data.message);
					var span = $('<span></span>').text( description );
					$(this).parent('td').prepend(span);
					$(this).remove();
				}else{
					alert(data.message);
				}
				window.location.href = window.location.href;
			});
			var span = $('<span></span>').text( description );
			$(this).parent('td').prepend(span);
			$(this).remove();
		});
		var editable = function(object, options)
		{
			var td = object.parent('td');
			var text = $('<input/>').attr({'type':'text','name':options.name,'value':options.value});
			var hidden = $('<input/>').prop({'type':'hidden','name':'id','value':options.id});
			var form = $('<form></form>').prop({'id':'jap'}).prepend( text ).append( hidden );
			object.remove(); td.prepend(form); form.children('input[type=text]').focus();
		}
		</script>
	</head>
	<body>
	<div id="body">
	<?php include_once('static/header.admin.php');?>
	<?php include_once('static/nav.admin.php');?>
	<div id="content">
		<div id="tabs">
		<ul>
				<li><a href="#tabs-1">Assigned Guard</a></li>
		</ul>
	
		<div id="tabs-1">
	<table width="300" align="center" class = "home_page" >
	
		<tr>
			<td colspan="3" align="center" style="font:Verdana, Geneva, sans-serif; font-size:18px;  color:#0000FF;"><h3>List of Client and Assigned Guard</h3>
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
					<th>Client Name</th><th>Assigned Guard</th><th>Equipment</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach(Deployment::get_list() as $deploy){?>
					<tr id="<?php echo $deploy->id;?>">
					<td><?php echo Client::get_name( $deploy->clientid );?></td>
					<td><?php echo Guard::get_name( $deploy->guardid );?></td>
					<td><span><?php echo Equipment::compile_by_deployid( $deploy->id ) ?: 'No Issued Equipment';?></span></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</td>
		</tr>
	 </table>
	</div>
	
</div>	


	
	</body>
	<div align="center">
		Copyright 2013 <br/>
		King Henry Security Agency<br />
		Integrated Information System
	</div>
</html>