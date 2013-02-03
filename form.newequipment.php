<form method="post">
<table>
	<tr>
	<td>Equipment Description : </td>
	<td><input type="text" name="Equipment_Desc" /></td>
	</tr>
	<tr>
	<td>Equipment Serial Number : </td>
	<td><input type="text" name="Equipment_Serial_No" /></td>
	</tr>
	<tr>
	<td>Manufacturer : </td>
	<td><?php include_once('ajax.manufacturer.php'); ?></td>
	</tr>
	<tr>
	<td>Ammunition : </td>
	<td><input type="text" name="Ammo_quantity" /></td>
	</tr>
	<tr>
	<td>Equipment Expiry Date : </td>
	<td><input type="text" class="datepicker" name="Equipment_expiry" /></td>
	</tr>
	<tr>
	<td>Equipment Status : </td>
	<td><select name="Equipment_Status">
	<option>Brand New</option>
	<option>Good</option>
	<option>Defective</option>
	</select></td>
	</tr>
</table>
</form>
