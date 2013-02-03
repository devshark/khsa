<?php

if( count($_POST) > 0 )
{
	if( empty($_POST['last_name']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Last name required.') ) ); }
	if( empty($_POST['middle_name']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Middle name required.') ) ); }
	if( empty($_POST['first_name']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'First name required.') ) ); }
	if( empty($_POST['address']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Address required.') ) ); }
	if( empty($_POST['address_city']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Address city required.') ) ); }
	if( empty($_POST['mobile_num']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Mobile number required.') ) ); }
	if( empty($_POST['date_of_birth']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Date of birth required.') ) ); }
	if( empty($_POST['status']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Status required.') ) ); }
	if( empty($_POST['educational_attainment']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Educational attainment required.') ) ); }
	if( empty($_POST['license_num']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'License number required.') ) ); }
	if( empty($_POST['license_expiry_date']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'License expiry date required.') ) ); }
	
	require_once('classes/class.database.php');
	
	$db = new Database();
	$db->insert('tblguards',
		$_POST
	);
	
	$id = $db->last_insert_id();
	
	$db->insert('tblrequirements',array('guard_id'=>$id));
	
	die( json_encode( array( 'status'=>'success', 'message'=>'Guard Sucessfuly added') ) );
}
else
{
	die( json_encode( array( 'status'=>'failed', 'message'=>'Invalid Request.') ) );
}