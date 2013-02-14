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
	<td><select name="Gender">
	<option>M</option>
	<option>F</option>
	</select></td>
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
	<tr>
	<td>SSS Number : </td>
	<td><input type="text" name="SSS_No" /></td>
	</tr>
	<tr>
	<td>Philhealth Number : </td>
	<td><input type="text" name="Philhealth" /></td>
	</tr>
	<tr>
	<td>PAG-IBIG Number : </td>
	<td><input type="text" name="PAG_IBIG" /></td>
	</tr>
	<tr>
	<td>TIN Number : </td>
	<td><input type="text" name="TIN_Number" /></td>
	</tr>	
	<tr>
	<td>Company 1 : </td>
	<td><input type="text" name="Company_name[]" /></td>
	</tr>	
	<tr>
	<td>Year From : </td>
	<td><input type="text" name="Date_from[]" /></td>
	</tr>	
	<tr>
	<td>Year To : </td>
	<td><input type="text" name="Date_to[]" /></td>
	</tr>
	<tr>
	<td>Company 2 : </td>
	<td><input type="text" name="Company_name[]" /></td>
	</tr>	
	<tr>
	<td>Year From : </td>
	<td><input type="text" name="Date_from[]" /></td>
	</tr>	
	<tr>
	<td>Year To : </td>
	<td><input type="text" name="Date_to[]" /></td>
	</tr>
	<tr>
	<td>Company 3 : </td>
	<td><input type="text" name="Company_name[]" /></td>
	</tr>	
	<tr>
	<td>Year From : </td>
	<td><input type="text" name="Date_from[]" /></td>
	</tr>	
	<tr>
	<td>Year To : </td>
	<td><input type="text" name="Date_to[]" /></td>
	</tr>	
	<tr>
	<td>Year of Experience: </td>
	<td><input type="text" name="Years_of_experience"/></td>
	</tr>	
</table>
</form>