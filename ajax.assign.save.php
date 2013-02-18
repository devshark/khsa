<?php
session_start();
$clientid = $_POST['clientid'] ?: null;
$guardid = $_POST['guardid'] ?: null;
try{
	if( $clientid != null || $guardid != null )
	{
		require_once('classes/class.database.php');
		$db = new Database();
		$db->insert('tbldeployment',
			array('clientid'=>$clientid,
			'guardid'=>$guardid));
		$db->update('tblguards',
			array('guard_status'=>11),
			array('id'=>$guardid));
		echo json_encode( array( 'status'=>'success', 'message'=>'Success!' ) );
	}
}catch(Exception $ex){
	echo json_encode( array( 'status'=>'failed', 'message'=>$ex->getMessage() ) );
}