<?php
session_start();
$id = $_POST['id'] ?: null;
$equips = $_POST['equips'] ?: null;
require_once('classes/class.equipments.php');
try{
	if( $id && $equips ){
		$db = new Database();
		$str_equipments = '';
		foreach( explode(',',$equips) as $equip ){
			$eq = new Equipment($equip);
			if( ! $eq->is_available() )
			{
				$db->insert('tblassignequip',
					array('deploy_id'=>$id,
					'equipment_id'=>$equip));
				$row = $eq->get_details();
				$str_equipments .= Equipment::compile_sdetails($equip);
			}
			else{
				throw new Exception("Equipment #{$equip} is unavailable.");
			}
		}
		echo json_encode( array( 'status'=>'success', 'message'=>$str_equipments ) );
	}
}catch(Exception $ex){
	echo json_encode( array( 'status'=>'failed', 'message'=>$ex->getMessage() ) );
}