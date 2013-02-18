<?php
session_start();
error_reporting(E_ERROR || E_WARNING);
require_once('classes/class.requirements.php');
$id = $_GET['id'] ?: null;

if($id){
	$stat = Req::get_req_status($id);
	echo json_encode( array('status'=>'success','message'=>$stat) );
}
else{
	echo json_encode( array('status'=>'failure','message'=>'No ID provided.') );
}