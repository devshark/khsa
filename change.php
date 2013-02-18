<?php	
	session_start();
	require_once('classes/class.database.php');
	$db = new Database();
	// include('include/connection.php');
	$sNewPass = $_POST['newpass'];
	$sOldPass = $_POST['oldpass'];

	$nClientId = $_SESSION['clientid'];
	
	$oSelect = "Select `pwd` From  `khsa`.`tblclient` Where `Client_ID` = '$nClientId'";
	$eSelect = mysql_query($oSelect);
	
	$data = mysql_fetch_array($eSelect);
	if ($sOldPass == $data['pwd'])
	{
		$oUpdate = "Update `khsa`.`tblclient` Set `pwd` = '$sNewPass' Where `Client_ID` = '$nClientId'";
		$eUpdate = mysql_query($oUpdate);
		
		if ($eUpdate == false)
		{
			echo "<script>
					alert('Failed to update system!');
					location ='admin.client.php';
				</script>";
		}
		else
		{
			echo "<script>
					alert('Password Successfully Changed!');
					location ='admin.client.php';
				</script>";
		}
	}
	else
	{
		echo "<script>
					alert('Old Password Doesn't Match!');
					location ='admin.client.php';
				</script>";
	}
		
?>