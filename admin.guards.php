<?php 
	require 'pages/admin.redirect.php';
	require_once('classes/class.guards.php');
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
						window.location.href = 'admin.client.php';
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
			$.post('ajax.client.save.php', 
			{
			'value' : $(this).children('input[type=text]').val(),
			'name' : $(this).children('input[type=text]').prop('name'),
			'id' : $(this).children('input[type=hidden]').val()
			},
			function(data){
				data = $.parseJSON(data);
				// alert(data.status);
			});
		
			var span = $('<span></span>').text( $(this).children('input[type=text]').val() );
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
	<table width="300" align="center" class = "home_page" >
		<tr>
			<td colspan="3" align="center" style="font:Verdana, Geneva, sans-serif; font-size:18px;  color:#0000FF;"><h3>List of Clients</h3>
		</td>
		</tr>
		<tr>
		<td height="5px">
		</td>
		</tr>
		<tr style="width:100%;" align="center">
		<td width="100%" style="overflow:auto;">
			<table id="jquery" cellpadding=5 border=1 cellspacing=0 style="width:500px; background-color:transparent; border:0px  #000 solid; padding:5px;text-align:center;">
				<thead>
					<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Middle Initial</th>
					<th>Address</th>
					<th>City</th>
					<th>Contact Number</th>
					<th>Date Of Birth</th>
					<th>Civil Status</th>
					<th>Educational Status</th>
					<th>License Number</th>
					<th>License Expiry Date</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach(Guard::get_list() as $guard){?>
					<tr id="<?php echo $guard->Client_ID;?>">
					<td var="first_name"><span><?php echo $guard->first_name;?></span></td>
					<td var="last_name"><span><?php echo $guard->last_name;?></span></td>
					<td var="middle_name"><span><?php echo $guard->middle_name;?></span></td>
					<td var="address"><span><?php echo $guard->address;?></span></td>
					<td var="Contact_No"><span><?php echo $guard->Contact_No;?></span></td>
					<td var="Contact_Person"><span><?php echo $guard->Contact_person;?></span></td>
					<td var="Owner"><span><?php echo $guard->Owner;?></span></td>
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