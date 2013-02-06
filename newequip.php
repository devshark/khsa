<?php
session_start();
if( count($_POST) > 0 )
{
	if( empty($_POST['Equipment_Desc']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Equipment Description required.') ) ); }
	if( empty($_POST['Equipment_Serial_No']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Equipment Serial Number required.') ) ); }
	//if( empty($_POST['Ammo_quantity']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Ammo required.') ) ); }
	//if( empty($_POST['Equipment_expiry']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Equipment expiry required.') ) ); }
	if( empty($_POST['Equipment_Status']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Equipment Status required.') ) ); }

	require_once('classes/class.database.php');
	
	$db = new Database();
	$db->insert('tblequipment',
		$_POST
	);
	
	$id = $db->last_insert_id();
	
	require_once('classes/class.audit.php'); 
	Audit::audit_log($_SESSION['adminid'], 'Added new equipment #'.$id);
	
	die( json_encode( array( 'status'=>'success', 'message'=>'Equipment Sucessfully added') ) );
}
else
{
	die( json_encode( array( 'status'=>'failed', 'message'=>'Invalid Request.') ) );
}