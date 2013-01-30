<?php 
	require 'pages/admin.redirect.php';
	require_once('classes/class.guards.php');
	require_once('classes/class.status.php');
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
				.attr('id','newguard')
				.load('form.newguard.html')
				.dialog({
					'title':'Add New Guard',
					'buttons':{
						'OK':function(e){
							$('div#newguard form').trigger('submit');
							// $(this).dialog('close');
						}
					},
					close: function(ev, ui) { $(this).remove(); }
				});
			});
		});
		$(document).on('submit','div#newguard form',
			function(event){
				var $form = $(this);
				$.post('newguard.php',
				$form.serialize(),
				function(result){
					result = $.parseJSON(result);
					if(result.status == 'success'){
						alert(result.message);
						$form.parent('div#newguard').remove();
						window.location.href = 'admin.guards.php';
					}else{
						alert(result.message);
					}
				});
				return false;
			}
		);
		
		$(document).on('focus','table#jquery tbody td.date input[type=text]',
			function(event){
			// event.stopPropagation();
			$this = $(this);
			$this.datepicker({ dateFormat: "yy-mm-dd",defaultDate: $this.val(),changeYear: true ,changeMonth: true  });
			// $(this).trigger('blur').trigger('click');
		});
		$(document).on('click','table#jquery tbody td span',
			function(event){
				$this = $(this);
				if( $this.parent('td').hasClass('educ'))
				{
					selectable($this,{id:$this.parents('tr').prop('id'), name:$this.parent('td').attr('var'), statusid:$this.parent('td').attr('val'),url: 'ajax.educ.status.php' });
				}
				else if( $this.parent('td').hasClass('civil') )
				{
					selectable($this,{id:$this.parents('tr').prop('id'), name:$this.parent('td').attr('var'), statusid:$this.parent('td').attr('val'),url: 'ajax.civil.status.php' });
				}
				else
				{
					editable($this,{id:$this.parents('tr').prop('id'), name:$this.parent('td').attr('var'), value:$this.text()});
				}
				event.stopPropagation();
		});
		$(document).on('blur','form#jap input[type=text],form#stat select',
			function(event){
			$this = $(this);
			validationTimer = setTimeout(function(){
				validationTimer = null;
				// Perform Validation on 'blurred'.
				$.post('ajax.guard.save.php', 
				{
				'value' : $this.val(),
				'name' : $this.prop('name'),
				'id' : $this.siblings('input[type=hidden]').val()
				},
				function(data){
					data = $.parseJSON(data);
					// alert(data.status);
					if(data.status=='success'){
						var span;
						if( $('form#stat').has($this) ){
							// console.log($this);
							span = $('<span></span>').text( $('option:selected',$this).text() );
						}else{
							span = $('<span></span>').text( $this.val() );
						}
						$this.parents('td').first().prepend(span);
						$this.parent('form').remove();
					}
				});
				
			},200);
			// validationTimer();
		});
		$(document).on('click','.ui-datepicker-calendar',
			function(event){
			if(validationTimer){
				window.clearTimeout(validationTimer);
				validationTimer = null;
			}
		});
		var validationTimer;
		var editable = function(object, options)
		{
			var td = object.parent('td');
			var text = $('<input/>').attr({'type':'text','name':options.name,'value':options.value});
			var hidden = $('<input/>').prop({'type':'hidden','name':'id','value':options.id});
			var form = $('<form></form>').prop({'id':'jap'}).prepend( text ).append( hidden );
			object.remove(); td.prepend(form); form.children('input[type=text]').focus();
		}
		
		var selectable = function(object, options)
		{
			// console.log(options);
			var td = object.parent('td');
			var form;
			$.get(options.url,
				{id:options.statusid},
				function(html){
					form = $('<form>').prop({'id':'stat'}).html(html);
					var hidden = $('<input/>').prop({'type':'hidden','name':'id','value':options.id});
					form.append(hidden);
					object.remove(); td.prepend(form); form.children('select').focus();
				}
			)
			// var form = $('<form>').prop({'id':'stat'}).load(options.url+'?id='+options.statusid);
			// var hidden = $('<input/>').prop({'type':'hidden','name':'id','value':options.id});
			// form.append(hidden);
			// object.remove(); td.prepend(form); form.children('select').focus();
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
					<th>Contact Number</th>
					<th>Date Of Birth</th>
					<th>Civil Status</th>
					<th>Educational Status</th>
					<th>License Number</th>
					<th>License Expiry Date</th>
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
					<td var="mobile_num"><span><?php echo $guard->mobile_num;?></span></td>
					<td class="date" var="date_of_birth"><span><?php echo $guard->date_of_birth;?></span></td>
					<td class="civil" val="<?php echo $guard->status;?>" var="status"><span><?php echo Status::get_status_name( $guard->status )->status;?></span></td>
					<td class="educ" val="<?php echo $guard->educational_attainment;?>" var="educational_attainment"><span><?php echo Status::get_status_name( $guard->educational_attainment )->status;?></span></td>
					<td var="license_num"><span><?php echo $guard->license_num;?></span></td>
					<td class="date" var="license_expiry_date"><span><?php echo $guard->license_expiry_date;?></span></td>
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