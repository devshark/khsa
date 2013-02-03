<?php
try{
	require_once('classes/class.requirements.php');
	
	$req = new Req($_POST['id']);
	$req->updateCheck($_POST['name'],$_POST['val']);
		
	die( json_encode( array('status'=>'success', 'message'=>'oks' ) ) );
}catch(Exception $ex)
{
	die( json_encode( array('status'=>'failed', 'message'=>$ex->getMessage() ) ) );
}