<form method="post">
<table>
	<tr>
	<td>Last Name : </td>
	<td><input type="text" name="last_name" /></td>
	</tr>
	<tr>
	<td>Middle Name : </td>
	<td><input type="text" name="middle_name" /></td>
	</tr>
	<tr>
	<td>First Name : </td>
	<td><input type="text" name="first_name" /></td>
	</tr>
	<tr>
	<td>Gender : </td>
	<td></td>
	</tr>
	<tr>
	<td>Address : </td>
	<td><input type="text" name="address" /></td>
	</tr>
	<tr>
	<td>Address City : </td>
	<td><input type="text" name="address_city" /></td>
	</tr>
	<tr>
	<td>Mobile Number : </td>
	<td><input type="text" maxlength="11" name="mobile_num" /></td>
	</tr>
	<tr>
	<td>Date of Birth : </td>
	<td><input type="text" class="datepicker" name="date_of_birth" /></td>
	</tr>
	<tr>
	<td>Status : </td>
	<td><?php include_once('ajax.civil.status.php'); ?></td>
	</tr>
	<tr>
	<td>Educational Attainment : </td>
	<td><?php include_once('ajax.educ.status.php'); ?></td>
	</tr>
	<tr>
	<td>License Number : </td>
	<td><input type="text" maxlength="15" name="license_num" /></td>
	</tr>
	<tr>
	<td>License Expiry Date : </td>
	<td><input class="datepicker" type="text" name="license_expiry_date" /></td>
	</tr>
</table>
</form>