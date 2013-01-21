<?php

require ("../include/connection.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/adminstyle.css" type="text/css" rel="stylesheet">
<title><?php echo $title ?></title>
</head>

<body>
<form name="search" method="get" action="search.php">
Seach for Last name: <input type="text" name="find" /><br />
<input type="submit" name="search" value="Search" />
</form>


<?php
$find = $_GET['find'];
//open connection
//$conn = mysql_connect("localhost", "root", "admin") or die(mysql_error());
//select database
mysql_select_db($dbase2, $con);
//the sql statement
$sql = "SELECT * FROM students where student_id like '%$find%' or last_name like '%$find%' or first_name like '%$find%'  ";
//execute the statement
$data = mysql_query($sql, $con) or die(mysql_error());
while ($result = mysql_fetch_array($data)) {
    //giving names to the fields
    $id = $result['student_id'];
    $lname = $result['last_name'];
    $fname= $result['first_name'];
    $enable = $result['is_enable'];
   
}
?> 




	<table style="background-color:green">
    <tr>
    	<td>Student Id</td>
        <td>Last Name</td>
        <td>First Name</td>
        <td>Activate</td>
    </tr>
    <tr>
    	<td><?php echo $id ?></td> 
   	 	<td><?php echo $lname ?></td>
    	<td><?php echo $fname ?></td>
    	<td>
        <select>
        <option><?php echo $enable ?></option>
  		<option>1</option>
		</select>
        
        </td>
	</tr>
	</table>

</body>
</html>