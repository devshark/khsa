<?php
// error_reporting(E_ALL);
require_once('classes/class.guards.php');
require_once('classes/class.client.php');
?>
<!--
<link href="css/start/jquery-ui-1.10.0.custom.min.css" rel= "stylesheet" type="text/css" />
<script src="js/jquery-1.9.0.js"></script>
<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
-->
<script>
var source = <?php
$guard = array();
foreach(Guard::get_list('10') as $wan){
	$guard[count($guard)] = array();
	$guard[count($guard)-1]['label'] = $wan->first_name.' '.$wan->last_name;
	$guard[count($guard)-1]['value'] = $wan->id;
}
echo json_encode($guard);
?>;
$(function(){
	$('input').autocomplete({source:source, autoFocus:true});
	$('input[name=btnAssign]').click(function(ev){
		ev.preventDefault();
		$this = $(this);
		var textbox = $this.siblings('input[name=guardid]');
		var selected = $this.siblings('select').find('option:selected');
		var guardid = textbox.val();
		if( guardid == 'undefined' || guardid.trim() == '' ){
			alert('No Guard Chosen.');
			return false;
		}
		var guardname = null;
		for(var i=0; i<source.length; i++){
			if(source[i].value == guardid){
				guardname = source[i].label;
				source.splice(i,1);
				break;
			}
		}
		if( guardname == null ){
			alert('Guard not available.');
			return false;
		}
		$tr = $('<tr>')
		.append('<td class="C" var="'+selected.val()+'">'+selected.text()+'</td>')
		.append('<td class="G" var="'+guardid+'">'+guardname+'</td>');
		$('table#assigned tbody')
		.append($tr);
		textbox.val('');
	});
});
</script>
<form method="post">
<select name="clientid">
<?php foreach(Client::get_list() as $client){ ?>
<option value="<?php echo $client->Client_ID;?>"><?php echo $client->Client_Name;?></option>
<?php } ?>
</select>
<input type="text" name="guardid" />
<input type="submit" name="btnAssign" value="Assign" />
</form>

<table id="assigned" align="center" width="100%">
	<thead>
		<tr>
			<th>Client</th>
			<th>Guard</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>