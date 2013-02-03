<?php
session_start();
require_once('classes/class.database.php');
if( isset($_POST['id']))
{
	$db = new Database();
	$db->update('tblequipment',
		array($_POST['name']=>$_POST['value']),
		array('Equipment_ID'=>$_POST['id']));
		
	require_once('classes/class.audit.php');
	Audit::audit_log($_SESSION['adminid'], 'Edited equipment #'.$_POST['id']);
	
	echo json_encode( array('status'=>'success') );
}
else
{
	echo json_encode( array('status'=>'fail') );
}