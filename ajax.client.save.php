<?php
require_once('classes/class.database.php');
if( isset($_POST['id']))
{
	$db = new Database();
	$db->update('tblclient',
		array($_POST['name']=>$_POST['value']),
		array('Client_ID'=>$_POST['id']));
	echo json_encode( array('status'=>'success') );
}
else
{
	echo json_encode( array('status'=>'fail') );
}
?>