<?php
session_start();
if( count($_POST) > 0 )
{
	if( empty($_POST['Client_Name']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Client Name required.') ) ); }
	if( empty($_POST['Address']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Address required.') ) ); }
	if( empty($_POST['Contact_No']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Contact No required.') ) ); }
	if( empty($_POST['pwd']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Password required.') ) ); }
	if( strlen( trim($_POST['pwd']) ) < 8 ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Password length must be at least 8 characters long.') ) ); }
	if( empty($_POST['contact_person']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Contact person required.') ) ); }
	
	require_once('classes/class.database.php');
	
	$db = new Database();
	$db->insert('tblclient',
		$_POST
	);
	
	$id = $db->last_insert_id();
	
	require_once('classes/class.audit.php');
	Audit::audit_log($_SESSION['adminid'], 'Added new client #'.$id);
	
	die( json_encode( array( 'status'=>'success', 'message'=>'Client successfully added.New Client ID is '.$id) ) );
}
else
{
	die( json_encode( array( 'status'=>'failed', 'message'=>'Invalid Request.') ) );
}